<?php
/**
 * Script pour mettre à jour les URLs WordPress pour l'environnement local
 * À exécuter une seule fois après avoir importé la base de données de production
 */

// Configuration de la base de données
$servername = "mysql";
$username = "sql-dev";
$password = "NDK5r+6RIpRtSX=^=8[0oULFK";
$dbname = "cliniquecepi_main";

// URLs à remplacer (toutes les variantes possibles)
$old_urls = [
    "https://preprod-clinique-cepi.fr",
    "http://preprod-clinique-cepi.fr",
    "https://preprod.clinique-cepi.fr",
    "http://preprod.clinique-cepi.fr",
    "https://clinique-cepi.fr",
    "http://clinique-cepi.fr"
];
$new_url = "https://localhost:8443";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion à la base de données réussie.\n";
    
    // Mettre à jour les options WordPress
    $queries = [
        "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'home'",
        "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'siteurl'"
    ];
    
    // Ajouter les requêtes de remplacement pour chaque ancienne URL
    foreach ($old_urls as $old_url) {
        $queries = array_merge($queries, [
            "UPDATE wp_posts SET post_content = REPLACE(post_content, '$old_url', '$new_url')",
            "UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '$old_url', '$new_url')",
            "UPDATE wp_comments SET comment_content = REPLACE(comment_content, '$old_url', '$new_url')",
            "UPDATE wp_options SET option_value = REPLACE(option_value, '$old_url', '$new_url')",
            "UPDATE wp_posts SET post_excerpt = REPLACE(post_excerpt, '$old_url', '$new_url')",
            "UPDATE wp_links SET link_url = REPLACE(link_url, '$old_url', '$new_url')",
            "UPDATE wp_links SET link_image = REPLACE(link_image, '$old_url', '$new_url')"
        ]);
    }
    
    foreach ($queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        echo "Requête exécutée : " . substr($query, 0, 50) . "...\n";
    }
    
    echo "Mise à jour des URLs terminée avec succès !\n";
    echo "WordPress est maintenant configuré pour : $new_url\n";
    echo "Laravel sera accessible via : https://localhost:8001\n";
    
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage() . "\n";
}
?>
