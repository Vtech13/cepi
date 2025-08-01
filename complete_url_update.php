<?php
/**
 * Script de mise à jour complète des URLs WordPress incluant les données sérialisées
 * Ce script gère les URLs stockées dans des formats sérialisés PHP
 */

// Configuration de la base de données
$servername = "mysql";
$username = "sql-dev";
$password = "NDK5r+6RIpRtSX=^=8[0oULFK";
$dbname = "cliniquecepi_main";

// URLs à remplacer
$old_urls = [
    "https://preprod-clinique-cepi.fr",
    "http://preprod-clinique-cepi.fr",
    "https://preprod.clinique-cepi.fr",
    "http://preprod.clinique-cepi.fr",
    "https://clinique-cepi.fr",
    "http://clinique-cepi.fr"
];
$new_url = "https://localhost:8443";

/**
 * Fonction pour remplacer les URLs dans les données sérialisées
 */
function recursive_unserialize_replace($data, $from, $to) {
    if (is_string($data) && ($unserialized = @unserialize($data)) !== false) {
        $data = recursive_unserialize_replace($unserialized, $from, $to);
        $data = serialize($data);
    } elseif (is_array($data)) {
        $_tmp = array();
        foreach ($data as $key => $value) {
            $_tmp[recursive_unserialize_replace($key, $from, $to)] = recursive_unserialize_replace($value, $from, $to);
        }
        $data = $_tmp;
        unset($_tmp);
    } elseif (is_object($data)) {
        $props = get_object_vars($data);
        foreach ($props as $key => $value) {
            $data->$key = recursive_unserialize_replace($value, $from, $to);
        }
    } else {
        if (is_string($data)) {
            $data = str_replace($from, $to, $data);
        }
    }
    return $data;
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== MISE À JOUR COMPLÈTE DES URLs WORDPRESS ===\n";
    echo "Connexion à la base de données réussie.\n\n";
    
    // 1. Mettre à jour les options principales
    echo "1. Mise à jour des options principales...\n";
    $main_queries = [
        "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'home'",
        "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'siteurl'"
    ];
    
    foreach ($main_queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        echo "   ✓ " . substr($query, 0, 60) . "...\n";
    }
    
    // 2. Traitement des données sérialisées dans wp_options
    echo "\n2. Traitement des données sérialisées dans wp_options...\n";
    $stmt = $pdo->prepare("SELECT option_id, option_name, option_value FROM wp_options WHERE option_value LIKE '%preprod%' OR option_value LIKE '%clinique-cepi%'");
    $stmt->execute();
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($options as $option) {
        $original_value = $option['option_value'];
        $new_value = $original_value;
        
        foreach ($old_urls as $old_url) {
            $new_value = recursive_unserialize_replace($new_value, $old_url, $new_url);
        }
        
        if ($new_value !== $original_value) {
            $update_stmt = $pdo->prepare("UPDATE wp_options SET option_value = ? WHERE option_id = ?");
            $update_stmt->execute([$new_value, $option['option_id']]);
            echo "   ✓ Mise à jour: " . $option['option_name'] . "\n";
        }
    }
    
    // 3. Traitement des métadonnées de posts
    echo "\n3. Traitement des métadonnées de posts...\n";
    $stmt = $pdo->prepare("SELECT meta_id, meta_key, meta_value FROM wp_postmeta WHERE meta_value LIKE '%preprod%' OR meta_value LIKE '%clinique-cepi%'");
    $stmt->execute();
    $postmetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($postmetas as $meta) {
        $original_value = $meta['meta_value'];
        $new_value = $original_value;
        
        foreach ($old_urls as $old_url) {
            $new_value = recursive_unserialize_replace($new_value, $old_url, $new_url);
        }
        
        if ($new_value !== $original_value) {
            $update_stmt = $pdo->prepare("UPDATE wp_postmeta SET meta_value = ? WHERE meta_id = ?");
            $update_stmt->execute([$new_value, $meta['meta_id']]);
            echo "   ✓ Mise à jour meta: " . $meta['meta_key'] . "\n";
        }
    }
    
    // 4. Traitement du contenu des posts
    echo "\n4. Traitement du contenu des posts...\n";
    foreach ($old_urls as $old_url) {
        $stmt = $pdo->prepare("UPDATE wp_posts SET post_content = REPLACE(post_content, ?, ?)");
        $stmt->execute([$old_url, $new_url]);
        echo "   ✓ Remplacement: $old_url → $new_url\n";
        
        $stmt = $pdo->prepare("UPDATE wp_posts SET post_excerpt = REPLACE(post_excerpt, ?, ?)");
        $stmt->execute([$old_url, $new_url]);
    }
    
    // 5. Nettoyage du cache et transients
    echo "\n5. Nettoyage du cache...\n";
    $cache_queries = [
        "DELETE FROM wp_options WHERE option_name LIKE '_transient_%'",
        "DELETE FROM wp_options WHERE option_name LIKE '_site_transient_%'",
        "DELETE FROM wp_options WHERE option_name = 'rewrite_rules'"
    ];
    
    foreach ($cache_queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        echo "   ✓ Cache vidé\n";
    }
    
    // 6. Mise à jour spécifique pour Elementor (si présent)
    echo "\n6. Mise à jour spécifique pour Elementor...\n";
    $stmt = $pdo->prepare("SELECT meta_id, meta_value FROM wp_postmeta WHERE meta_key = '_elementor_data' AND meta_value LIKE '%preprod%'");
    $stmt->execute();
    $elementor_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($elementor_data as $data) {
        $original_value = $data['meta_value'];
        $new_value = $original_value;
        
        foreach ($old_urls as $old_url) {
            $new_value = str_replace($old_url, $new_url, $new_value);
        }
        
        if ($new_value !== $original_value) {
            $update_stmt = $pdo->prepare("UPDATE wp_postmeta SET meta_value = ? WHERE meta_id = ?");
            $update_stmt->execute([$new_value, $data['meta_id']]);
            echo "   ✓ Elementor data mis à jour\n";
        }
    }
    
    echo "\n=== MISE À JOUR TERMINÉE AVEC SUCCÈS ===\n";
    echo "WordPress est maintenant configuré pour : $new_url\n";
    echo "Veuillez vider le cache de votre navigateur et recharger la page.\n";
    
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
?>
