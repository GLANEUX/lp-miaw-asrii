<?php
require_once 'model/SqlModel.php';

class User {
    private $id;
    private $email;
    private $username;
    private $password;
    private $lastLogin;
    private $lastLoginIP;
    private $level;

    private const TABLES = [
        'etudiant' => 'etudiants',
        'enseignant' => 'enseignants',
        'entreprise' => 'entreprises',
        'administrateur' => 'administrateurs',
    ];

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

    /**
     * Recherche un utilisateur par e-mail ou identifiant dans les quatre tables de comptes.
     * Une entreprise ne peut se connecter que si son compte a été confirmé par un administrateur.
     */
    public static function findByEmailOrUsername($emailOrUsername) {
        $sqlModel = new SqlModel();

        $query = "SELECT * FROM (
            SELECT id, username, email, password, 'etudiant' AS level FROM etudiants WHERE email = ? OR username = ?
            UNION
            SELECT id, username, email, password, 'enseignant' AS level FROM enseignants WHERE email = ? OR username = ?
            UNION
            SELECT id, username, email, password, 'entreprise' AS level FROM entreprises WHERE (email = ? OR username = ?) AND confirme = 1
            UNION
            SELECT id, username, email, password, 'administrateur' AS level FROM administrateurs WHERE email = ? OR username = ?
        ) AS users LIMIT 1";

        $result = $sqlModel->SqlRequest($query, array_fill(0, 8, $emailOrUsername));

        $user = null;
        if ($row = $result->fetch_assoc()) {
            $user = new User();
            $user->setId((int) $row['id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setLevel($row['level']);
        }

        $result->free();

        return $user;
    }

    /** Enregistre la date et l'adresse IP de la dernière connexion. */
    public function save() {
        $table = self::TABLES[$this->getLevel()] ?? null;
        if ($table === null) {
            return;
        }
        $sqlModel = new SqlModel();
        $sqlModel->SqlRequest(
            "UPDATE $table SET last_login = ?, last_login_ip = ? WHERE id = ?",
            [$this->getLastLogin(), $this->getLastLoginIP(), $this->getId()]
        );
    }
}
