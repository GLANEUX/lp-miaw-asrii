<?php

class SqlModel {
    private $mysqli;

    public function __construct() {
        $dbHost = DB_HOST;
        $dbUser = DB_USER;
        $dbPassword = DB_PASSWORD;
        $dbName = DB_NAME;
        $dbPort = DB_PORT;

        // Création de la connexion
        $this->mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);
        $this->mysqli->set_charset("utf8mb4");

        // Vérification des erreurs de connexion
        if ($this->mysqli->connect_errno) {
            echo "Erreur lors de la connexion à la base de données MySQL: " . $this->mysqli->connect_error;
            exit();
        }
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function SqlRequest($req) {
        $query = "$req";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
}
?>
