<?php
class CampusController {

    // Page Campus
    public function index() {
        
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Variables transmises
        $data = [
            'title' => 'Campus',
            'style' => [
                'header.css',
                'footer.css',
                'banner.css',
                'campus.css'
            ]
        ];

        // Afficher la page
        require 'view/header.php';
        require 'view/campus.php';
        require 'view/footer.php';
    }
}
