<?php
/**
 * Script pour ajouter les configurations WordPress pour résoudre les problèmes d'API REST
 */

// Configuration de la base de données
$servername = "mysql";
$username = "sql-dev";
$password = "NDK5r+6RIpRtSX=^=8[0oULFK";
$dbname = "cliniquecepi_main";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Configuration des URLs pour l'API REST...\n";
    
    // Mettre à jour les URLs WordPress pour qu'elles pointent vers l'URL du conteneur pour les requêtes internes
    $queries = [
        "UPDATE wp_options SET option_value = 'https://localhost:8443' WHERE option_name = 'home'",
        "UPDATE wp_options SET option_value = 'https://localhost:8443' WHERE option_name = 'siteurl'",
        // Ajouter une option pour l'URL interne
        "INSERT INTO wp_options (option_name, option_value, autoload) VALUES ('rest_url_override', 'https://wordpress:443', 'no') ON DUPLICATE KEY UPDATE option_value = 'https://wordpress:443'"
    ];
    
    foreach ($queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        echo "Configuration mise à jour : " . substr($query, 0, 80) . "...\n";
    }
    
    echo "Configuration API REST terminée !\n";
    
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
?>
