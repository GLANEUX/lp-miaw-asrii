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

        // Vérification des erreurs de connexion
        if ($this->mysqli->connect_errno) {
            echo "Erreur lors de la connexion à la base de données MySQL: " . $this->mysqli->connect_error;
            exit();
        }
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function getTableData($tableName) {
        $query = "SELECT * FROM " . $tableName;

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        // Récupération des données de la table
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Libération des résultats de la requête
        $result->free();

        return $data;
    }
    public function selectRequest($req) {
        $query = "SELECT $req";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        // Récupération des données de la table
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Libération des résultats de la requête
        $result->free();

        return $data;
    }
    public function updateRequest($req) {
        $query = "UPDATE $req";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
    public function addProjetRequest($req) {
        $query = "INSERT INTO projets (user_id, titre, description) VALUES ($req)";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
    public function addAlternanceRequest($req) {
        $query = "INSERT INTO alternance (user_id, poste, entreprise) VALUES ($req)";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
    public function addNoteRequest($req) {
        $query = "INSERT INTO notes (user_id, matiere, libelle, note, enseignant) VALUES ($req)";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
    public function addEntrepriseRequest($req) {
        $val = $req . ', \'' . date('Y-m-d H:i:s') . '\', \'' . $_SERVER['REMOTE_ADDR'] . '\', \'entreprise\'';
        $query = "INSERT INTO users (nom, prenom, email, username, password, last_login, last_login_ip, level) VALUES ($val)";

        // Exécution de la requête
        $result = $this->mysqli->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $this->mysqli->error;
            exit();
        }

        return $result;
    }
    public function addEDTRequest($req) {
        $query = "INSERT INTO emploi_du_temps (date, url) VALUES ($req)";

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
