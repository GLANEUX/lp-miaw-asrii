<?php

// Ne jamais afficher les erreurs PHP au visiteur : elles vont dans le journal du serveur.
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// Cookies de session : inaccessibles en JavaScript, limités au site.
session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'path' => '/']);

// Toujours travailler depuis la racine du projet (les require sont relatifs).
chdir(__DIR__);

// Configuration : conf.php (copie locale de conf.example.php), sinon conf.docker.php (variables d'environnement).
require_once file_exists(__DIR__ . '/conf.php') ? __DIR__ . '/conf.php' : __DIR__ . '/conf.docker.php';

/** Échappe une valeur pour l'affichage HTML (protection XSS). Utilisé dans toutes les vues. */
function e($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Récupérer l'URL demandée
$requestUrl = rtrim($_SERVER['REQUEST_URI'], '/');

// Décomposer l'URL pour séparer le chemin et les paramètres
$parts = parse_url($requestUrl);
$path = $parts['path'] ?? '';

// Récupérer les paramètres de l'URL
$params = [];
if (isset($parts['query'])) {
    parse_str($parts['query'], $params);
}

// Inclure le fichier des routes
require_once 'routes.php';

// Vérifier la correspondance de l'URL avec les routes définies (avec ou sans "/" final)
$routeFound = false;
foreach ($routes as $route => $controllerAction) {
    $cleanRoute = rtrim(strtok($route, '?'), '/');

    if ($cleanRoute === $path) {
        $routeFound = true;
        $controllerName = $controllerAction[0];
        $actionName = $controllerAction[1];
        break;
    }
}

// Page d'erreur 404 si l'URL ne correspond à aucune route
if (!$routeFound) {
    http_response_code(404);
    echo 'Page not found';
    exit();
}

// Inclure le contrôleur correspondant et exécuter l'action
require_once 'controller/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->$actionName($params);
