<?php

/**
 * Accès à la base de données (mysqli).
 * Une seule connexion est ouverte par requête HTTP (partagée entre les instances).
 * Toutes les requêtes contenant des valeurs externes doivent passer par des paramètres liés (?).
 */
class SqlModel {
    private static ?mysqli $shared = null;
    private mysqli $mysqli;

    public function __construct() {
        if (self::$shared === null) {
            mysqli_report(MYSQLI_REPORT_OFF);
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
            if ($mysqli->connect_errno) {
                error_log('Connexion MySQL impossible : ' . $mysqli->connect_error);
                http_response_code(500);
                echo 'Erreur : la base de données est indisponible.';
                exit();
            }
            $mysqli->set_charset('utf8mb4');
            self::$shared = $mysqli;
        }
        $this->mysqli = self::$shared;
    }

    public function getMysqli(): mysqli {
        return $this->mysqli;
    }

    /**
     * Exécute une requête. Les valeurs externes sont passées dans $params et liées
     * à des marqueurs « ? » (requête préparée) : jamais concaténées dans le SQL.
     *
     * @return mysqli_result|bool  résultat pour un SELECT, true pour INSERT/UPDATE/DELETE
     */
    public function SqlRequest(string $req, array $params = []) {
        if ($params === []) {
            $result = $this->mysqli->query($req);
            if ($result === false) {
                $this->fail($req, $this->mysqli->error);
            }
            return $result;
        }

        $stmt = $this->mysqli->prepare($req);
        if ($stmt === false) {
            $this->fail($req, $this->mysqli->error);
        }
        $params = array_values($params);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        if (!$stmt->execute()) {
            $this->fail($req, $stmt->error);
        }
        $result = $stmt->get_result();
        return $result === false ? true : $result;
    }

    /**
     * Valide un fichier uploadé et renvoie un nom de fichier sûr (aléatoire + extension autorisée),
     * ou null si le fichier est refusé (extension/MIME non autorisés, taille > 20 Mo, erreur d'upload).
     */
    public static function nomFichierSecurise(array $file, array $extensionsAutorisees): ?string {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || ($file['size'] ?? 0) > 20 * 1024 * 1024) {
            return null;
        }
        $ext = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
        if (!in_array($ext, $extensionsAutorisees, true)) {
            return null;
        }
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (in_array($mime, ['text/x-php', 'application/x-php', 'application/x-httpd-php', 'text/html', 'application/javascript'], true)) {
            return null;
        }
        return bin2hex(random_bytes(12)) . '.' . $ext;
    }

    private function fail(string $req, string $error): void {
        error_log("Erreur SQL : $error — requête : $req");
        http_response_code(500);
        echo "Erreur lors de l'exécution de la requête.";
        exit();
    }
}
