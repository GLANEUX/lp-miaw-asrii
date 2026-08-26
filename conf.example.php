<?php
// Copier ce fichier en conf.php et adapter les valeurs (conf.php est ignoré par Git).
// En Docker, conf.docker.php est utilisé à la place (variables d'environnement).

// Préfixe d'URL sous lequel le site est servi : '' à la racine, '/lp-miaw-asrii' dans un sous-dossier XAMPP.
define('URL', '');

// Base de données MySQL / MariaDB
define('DB_HOST', 'localhost');
define('DB_USER', 'asrii');
define('DB_PASSWORD', 'changez-moi');
define('DB_NAME', 'asrii');
define('DB_PORT', 3306);
