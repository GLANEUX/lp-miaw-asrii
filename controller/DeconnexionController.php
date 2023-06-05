<?php

class DeconnexionController {
    public function index() {
        // Démarrer la session
        session_start();

        // Détruire toutes les données de session
        $_SESSION = array();
        
        // Détruire la session
        session_destroy();

        // Rediriger l'utilisateur vers la page de connexion après la déconnexion
        header('Location: ' . URL . '/');
        exit;
    }
}


?>


