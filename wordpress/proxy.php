<?php
// Proxy script (proxy.php)

// URL de votre application Laravel
$url = 'https://clinique-cepi.fr/get-csrf-token';

// Effectue la requête vers l'URL de l'application Laravel
$response = file_get_contents($url);

// Renvoie la réponse de l'application Laravel
echo $response;
