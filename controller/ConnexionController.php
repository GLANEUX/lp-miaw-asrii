<?php

require_once 'model\ConnexionModel.php';


class ConnexionController {
    public function index() {
        session_start();
        if (isset($_SESSION['is_logged_in'])) {
            header('Location: ' . URL .'/home');
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $emailOrUsername = $_POST['email_or_username'];
                $password = $_POST['password'];
                $this->login($emailOrUsername, $password);
            } else {
                $this->showLoginForm();
            }
        }
    }

    private function showLoginForm($error = '') {
        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/connexion.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }

    private function login($emailOrUsername, $password) {
        // Valider les données du formulaire de connexion
        if (empty($emailOrUsername) || empty($password)) {
            echo 'Veuillez remplir tous les champs.';
            return;
        }

        // Charger l'utilisateur depuis la base de données
        $user = User::findByEmailOrUsername($emailOrUsername);

        if (!$user || !password_verify($password, $user->getPassword())) {
            //var_dump($user);
            //echo password_hash("test", PASSWORD_DEFAULT);
            $this->showLoginForm('Identifiants invalides.');
            return;
        }

        // Mettre à jour la dernière connexion de l'utilisateur
        $user->setLastLogin(date('Y-m-d H:i:s'));
        $user->setLastLoginIP($_SERVER['REMOTE_ADDR']);
        $user->save();

        // Rediriger l'utilisateur vers une page sécurisée après la connexion réussie
        $_SESSION['is_logged_in'] = true;
        $_SESSION['userid'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['level'] = $user->getLevel();
        header('Location: ' . URL .'/home');
        exit;
    }
}
?>


