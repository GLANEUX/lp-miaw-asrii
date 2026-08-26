<?php
// Configuration lue depuis les variables d'environnement (utilisée par l'image Docker).
define('URL', rtrim(getenv('APP_URL_PREFIX') ?: '', '/'));
define('DB_HOST', getenv('DB_HOST') ?: 'db');
define('DB_USER', getenv('DB_USER') ?: 'asrii');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'asrii');
define('DB_PORT', (int)(getenv('DB_PORT') ?: 3306));
