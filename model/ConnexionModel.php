<?php
require_once 'model/SqlModel.php';

class User {
    private $id;
    private $email;
    private $username;
    private $password;
    private $lastLogin;
    private $lastLoginIP;

    // Getters et Setters pour les propriétés
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function getLastLoginIP() {
        return $this->lastLoginIP;
    }

    public function setLastLoginIP($lastLoginIP) {
        $this->lastLoginIP = $lastLoginIP;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public static function findByEmailOrUsername($emailOrUsername) {
        $sqlModel = new SqlModel();
        $mysqli = $sqlModel->getMysqli();

        $emailOrUsername = $mysqli->real_escape_string($emailOrUsername);

        $query = "SELECT * FROM (
            SELECT id, username, email, password, 'etudiant' AS level FROM etudiants WHERE email = '$emailOrUsername' OR username = '$emailOrUsername'
            UNION
            SELECT id, username, email, password, 'enseignant' AS level FROM enseignants WHERE email = '$emailOrUsername' OR username = '$emailOrUsername'
            UNION
            SELECT id, username, email, password, 'entreprise' AS level FROM entreprises WHERE email = '$emailOrUsername' OR username = '$emailOrUsername' AND confirme = 1
            UNION
            SELECT id, username, email, password, 'administrateur' AS level FROM administrateurs WHERE email = '$emailOrUsername' OR username = '$emailOrUsername'
        ) AS users LIMIT 1";

        $result = $mysqli->query($query);

        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $mysqli->error;
            exit();
        }

        $user = null;
        if ($row = $result->fetch_assoc()) {
            $user = new User();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setLevel($row['level']);
        }

        $result->free();

        return $user;
    }

    public function save() {
        $sqlModel = new SqlModel();
        $mysqli = $sqlModel->getMysqli();

        $id = $this->getId();
        $level = $this->getLevel();
        $lastLogin = $mysqli->real_escape_string($this->getLastLogin());
        $lastLoginIP = $mysqli->real_escape_string($this->getLastLoginIP());

        if ($level == 'etudiant'){
            $query = "UPDATE etudiants SET last_login = '$lastLogin', last_login_ip = '$lastLoginIP' WHERE id = $id";
        } elseif ($level == 'enseignant'){
            $query = "UPDATE enseignants SET last_login = '$lastLogin', last_login_ip = '$lastLoginIP' WHERE id = $id";
        } elseif ($level == 'entreprise'){
            $query = "UPDATE entreprises SET last_login = '$lastLogin', last_login_ip = '$lastLoginIP' WHERE id = $id";
        } elseif ($level == 'administrateur'){
            $query = "UPDATE administrateurs SET last_login = '$lastLogin', last_login_ip = '$lastLoginIP' WHERE id = $id";
        }

        $result = $mysqli->query($query);

        if (!$result) {
            echo "Erreur lors de l'exécution de la requête: " . $mysqli->error;
            exit();
        }
    }
}
?>
