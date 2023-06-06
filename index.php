<?php

// Inclure le fichier de configuration
require_once 'conf.php';

// Récupérer l'URL demandée
$requestUrl = rtrim($_SERVER['REQUEST_URI'], '/');

// Décomposer l'URL pour séparer le chemin et les paramètres
$parts = parse_url($requestUrl);
$path = $parts['path'];

// Récupérer les paramètres de l'URL
$params = [];
if (isset($parts['query'])) {
    parse_str($parts['query'], $params);
}

// Inclure le fichier des routes
require_once 'routes.php';

// Vérifier la correspondance de l'URL avec les routes définies
$routeFound = false;
foreach ($routes as $route => $controllerAction) {
    // Supprimer le "?" et les paramètres de l'URL
    $cleanRoute = strtok($route, '?');

    // Vérifier la correspondance de l'URL avec la route
    if ($cleanRoute === $path) {
        $routeFound = true;
        $controllerName = $controllerAction[0];
        $actionName = $controllerAction[1];
        break;
    }
}

// Si aucune correspondance n'est trouvée, vérifier si la route avec "/" à la fin correspond
if (!$routeFound) {
    foreach ($routes as $route => $controllerAction) {
        // Supprimer le "?" et les paramètres de l'URL
        $cleanRoute = rtrim(strtok($route, '?'), '/');

        // Vérifier la correspondance de l'URL avec la route avec "/" à la fin
        if ($cleanRoute === $path) {
            $routeFound = true;
            $controllerName = $controllerAction[0];
            $actionName = $controllerAction[1];
            break;
        }
    }
}

// Rediriger vers une page d'erreur 404 si l'URL ne correspond à aucune route
if (!$routeFound) {
    header('HTTP/1.0 404 Not Found');
    echo 'Page not found';
    exit();
}

// Inclure le contrôleur correspondant et exécuter l'action
require_once 'controller/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->$actionName($params);
