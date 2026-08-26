<?php
// Routeur pour le serveur de développement PHP :  php -S localhost:8000 router.php
// Sert directement les fichiers existants (CSS, images, PDF…), sinon délègue à index.php.
$file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($file !== __DIR__ . '/' && is_file($file)) {
    return false;
}
require __DIR__ . '/index.php';
