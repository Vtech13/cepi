<?php
/**
 * Script pour activer automatiquement le plugin Local Docker Fix
 */

// Configuration de la base de données
$servername = "mysql";
$username = "sql-dev";
$password = "NDK5r+6RIpRtSX=^=8[0oULFK";
$dbname = "cliniquecepi_main";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Activation du plugin Local Docker Fix...\n";
    
    // Récupérer les plugins actifs
    $stmt = $pdo->prepare("SELECT option_value FROM wp_options WHERE option_name = 'active_plugins'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $active_plugins = unserialize($result['option_value']);
    if (!$active_plugins) {
        $active_plugins = array();
    }
    
    // Ajouter notre plugin s'il n'est pas déjà actif
    $plugin_path = 'local-docker-fix/local-docker-fix.php';
    if (!in_array($plugin_path, $active_plugins)) {
        $active_plugins[] = $plugin_path;
        
        $serialized_plugins = serialize($active_plugins);
        $stmt = $pdo->prepare("UPDATE wp_options SET option_value = ? WHERE option_name = 'active_plugins'");
        $stmt->execute([$serialized_plugins]);
        
        echo "Plugin activé avec succès !\n";
    } else {
        echo "Plugin déjà actif.\n";
    }
    
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
?>
