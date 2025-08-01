<?php
/**
 * Script pour vider le cache WordPress
 */

// Configuration de la base de données
$servername = "mysql";
$username = "sql-dev";
$password = "NDK5r+6RIpRtSX=^=8[0oULFK";
$dbname = "cliniquecepi_main";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Vidage du cache WordPress...\n";
    
    // Supprimer les transients (cache temporaire)
    $queries = [
        "DELETE FROM wp_options WHERE option_name LIKE '_transient_%'",
        "DELETE FROM wp_options WHERE option_name LIKE '_site_transient_%'",
        "DELETE FROM wp_options WHERE option_name = 'rewrite_rules'"
    ];
    
    foreach ($queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        echo "Cache vidé : " . $query . "\n";
    }
    
    echo "Cache WordPress vidé avec succès !\n";
    
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
?>
