<?php

include_once('db.php');

$slug = explode("?", $_SERVER["REQUEST_URI"])[0];

$routes = [
    '/' => 'PHP/accueil.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php',
    '/services' => 'services.php'
];

// Vérifier si l'URL correspond à une route définie
if (array_key_exists($slug, $routes)) {
    // Inclure le fichier correspondant à la route
    include $routes[$slug];
} else {
    // Page non trouvée
    header("HTTP/1.0 404 Not Found");
    echo "404 - Page non trouvée";
}
?>