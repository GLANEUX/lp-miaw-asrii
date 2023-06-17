<?php

require_once 'model\SqlModel.php';

class HomeConnectedController {
    public function index() {
        session_start();












        // Entreprise
        if (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
        ) { 
             // Récupérer les données des projets depuis la base de données
             $sqlModel = new SqlModel();
             $query = $sqlModel->SqlRequest("SELECT id, titre, description FROM projets WHERE entreprise_id = $_SESSION[userid]");
 
             $projets = [];
             foreach ($query as $row) {
                 $projets[] = [
                     'id' => $row['id'],
                     'titre' => $row['titre'],
                     'description' => $row['description']
                 ];
             }


             
            // Récupérer la liste des offres d'alternance de l'entreprise de la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT id, poste, description FROM alternances WHERE entreprise_id = $_SESSION[userid]");

            // Stocker les offres d'alternance dans une variable
            $alternances = [];
            foreach ($query as $row) {
                $alternances[] = [
                    'id' => $row['id'],
                    'poste' => $row['poste'],
                    'description' => $row['description']
                ];
            }

 
            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Entreprise',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeEntreprise.css',
                ],
                'script' => [
                    'script.js'
                ],
                'projets' => $projets,
                'alternances' => $alternances,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/homeEntreprise.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 



















        // Etudiant
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM supports");

            $supports = [];
            while ($row = $query->fetch_assoc()) {
                $supports[] = $row;
            }
        
            foreach ($supports as $support) {
                $sup[] = [
                    'id' => $support['id'],
                    'titre' => $support['titre'],
                    'matiere' => $support['matiere']
                ];
            }

            if (isset($_GET['id'])) {
                $query = $sqlModel->SqlRequest('SELECT url FROM supports WHERE id=' . $_GET['id']);
                while ($row = $query->fetch_assoc()) {
                    $supporturl[] = $row;
                }
                $url_s = $supporturl[0]['url'];
            } else {
                $url_s = $supports[0]['url'];
            }






                        //récupérer emplois du temps

            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM emplois_du_temps");

            $edt = [];

            while ($row = $query->fetch_assoc()) {
                $emploisdutemps[] = $row;
            }
        
            foreach ($emploisdutemps as $emploidutemps) {
                $edt[] = [
                    'id' => $emploidutemps['id'],
                    'date' => $emploidutemps['date'],
                ];
            }
            $url = $emploisdutemps[0]['url'];



            //récupérer les notes
            $sqlModel = new SqlModel();

            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant') {
                $query = $sqlModel->SqlRequest("SELECT * FROM notes WHERE etudiant_id = $_SESSION[userid]");
            }

            $notes = [];
        
            foreach ($query as $row) {
                $notes[] = [
                    'matiere' => $row['matiere'],
                    'libelle' => $row['libelle'],
                    'commentaire' => $row['commentaire'],
                    'note' => $row['note'],
                    'idnote' => $row['id']
                ];
            }


               // Récupérer la liste des offres d'alternance de la base de données
               $sqlModel = new SqlModel();
               $query = $sqlModel->SqlRequest("
                   SELECT a.id, a.poste, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                   FROM alternances AS a
                   JOIN entreprises AS e ON a.entreprise_id = e.id
                   JOIN adresses AS ad ON e.adresse_id = ad.id         
               ");
           
               // Stocker les offres d'alternance dans une variable
               $alternances = [];
               foreach ($query as $row) {
                   $alternances[] = [
                       'id' => $row['id'],
                       'poste' => $row['poste'],
                       'description' => $row['description'],
                       'societe' => $row['societe'],
                       'numero' => $row['numero'],
                       'email' => $row['email'],
                       'adresse' => $row['adresse'],
                       'code_postal' => $row['code_postal'],
                       'ville' => $row['ville']
                   ];
               }


            // Récupérer les données des projets depuis la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.titre, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                FROM projets AS a
                JOIN entreprises AS e ON a.entreprise_id = e.id
                JOIN adresses AS ad ON e.adresse_id = ad.id         
            ");

            // Stocker les projets dans une variable
            $projets = [];
            foreach ($query as $row) {
                $projets[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'description' => $row['description'],
                    'societe' => $row['societe'],
                    'numero' => $row['numero'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville']
                ];
            }


            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Etudiant',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeEtudiant.css',
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alternances,
                'projets' => $projets,
                'notes' => $notes,
                'edt' => $edt,
                'url' => $url,
                'sup' => $sup,
                'url_s' => $url_s,



            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/homeEtudiant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 



















        // Enseignant
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM etudiants");

            $etudiants = [];
        
            foreach ($query as $row) {
                $etudiants[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom']
                ];
            }

            
               // Récupérer la liste des offres d'alternance de la base de données
               $sqlModel = new SqlModel();
               $query = $sqlModel->SqlRequest("
                   SELECT a.id, a.poste, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                   FROM alternances AS a
                   JOIN entreprises AS e ON a.entreprise_id = e.id
                   JOIN adresses AS ad ON e.adresse_id = ad.id         
               ");
           
               // Stocker les offres d'alternance dans une variable
               $alternances = [];
               foreach ($query as $row) {
                   $alternances[] = [
                       'id' => $row['id'],
                       'poste' => $row['poste'],
                       'description' => $row['description'],
                       'societe' => $row['societe'],
                       'numero' => $row['numero'],
                       'email' => $row['email'],
                       'adresse' => $row['adresse'],
                       'code_postal' => $row['code_postal'],
                       'ville' => $row['ville']
                   ];
               }


            // Récupérer les données des projets depuis la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.titre, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                FROM projets AS a
                JOIN entreprises AS e ON a.entreprise_id = e.id
                JOIN adresses AS ad ON e.adresse_id = ad.id         
            ");

            // Stocker les projets dans une variable
            $projets = [];
            foreach ($query as $row) {
                $projets[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'description' => $row['description'],
                    'societe' => $row['societe'],
                    'numero' => $row['numero'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville']
                ];
            }


            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM emplois_du_temps");

            $edt = [];

            while ($row = $query->fetch_assoc()) {
                $emploisdutemps[] = $row;
            }
        
            foreach ($emploisdutemps as $emploidutemps) {
                $edt[] = [
                    'id' => $emploidutemps['id'],
                    'date' => $emploidutemps['date'],
                ];
            }
            $url = $emploisdutemps[0]['url'];



            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM supports");

            $supports = [];
            while ($row = $query->fetch_assoc()) {
                $supports[] = $row;
            }
        
            foreach ($supports as $support) {
                $sup[] = [
                    'id' => $support['id'],
                    'titre' => $support['titre'],
                    'matiere' => $support['matiere']
                ];
            }

            if (isset($_GET['id'])) {
                $query = $sqlModel->SqlRequest('SELECT url FROM supports WHERE id=' . $_GET['id']);
                while ($row = $query->fetch_assoc()) {
                    $supporturl[] = $row;
                }
                $url_s = $supporturl[0]['url'];
            } else {
                $url_s = $supports[0]['url'];
            }
            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Enseignant',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeEnseignant.css',
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alternances,
                'projets' => $projets,
                'etudiants' => $etudiants,
                'edt' => $edt,
                'url' => $url,
                'sup' => $sup,
                'url_s' => $url_s,
                
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/homeEnseignant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 














        
        // Admin
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
        ) {

            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM etudiants");

            $etudiants = [];
        
            foreach ($query as $row) {
                $etudiants[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom']
                ];
            }

            
               // Récupérer la liste des offres d'alternance de la base de données
               $sqlModel = new SqlModel();
               $query = $sqlModel->SqlRequest("
                   SELECT a.id, a.poste, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                   FROM alternances AS a
                   JOIN entreprises AS e ON a.entreprise_id = e.id
                   JOIN adresses AS ad ON e.adresse_id = ad.id         
               ");
           
               // Stocker les offres d'alternance dans une variable
               $alternances = [];
               foreach ($query as $row) {
                   $alternances[] = [
                       'id' => $row['id'],
                       'poste' => $row['poste'],
                       'description' => $row['description'],
                       'societe' => $row['societe'],
                       'numero' => $row['numero'],
                       'email' => $row['email'],
                       'adresse' => $row['adresse'],
                       'code_postal' => $row['code_postal'],
                       'ville' => $row['ville']
                   ];
               }


            // Récupérer les données des projets depuis la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.titre, a.description, e.societe, e.numero, e.email, ad.adresse, ad.code_postal, ad.ville
                FROM projets AS a
                JOIN entreprises AS e ON a.entreprise_id = e.id
                JOIN adresses AS ad ON e.adresse_id = ad.id         
            ");

            // Stocker les projets dans une variable
            $projets = [];
            foreach ($query as $row) {
                $projets[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'description' => $row['description'],
                    'societe' => $row['societe'],
                    'numero' => $row['numero'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville']
                ];
            }


            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM emplois_du_temps");

            $edt = [];

            while ($row = $query->fetch_assoc()) {
                $emploisdutemps[] = $row;
            }
        
            foreach ($emploisdutemps as $emploidutemps) {
                $edt[] = [
                    'id' => $emploidutemps['id'],
                    'date' => $emploidutemps['date'],
                ];
            }
            $url = $emploisdutemps[0]['url'];



            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM supports");

            $supports = [];
            while ($row = $query->fetch_assoc()) {
                $supports[] = $row;
            }
        
            foreach ($supports as $support) {
                $sup[] = [
                    'id' => $support['id'],
                    'titre' => $support['titre'],
                    'matiere' => $support['matiere']
                ];
            }

            if (isset($_GET['id'])) {
                $query = $sqlModel->SqlRequest('SELECT url FROM supports WHERE id=' . $_GET['id']);
                while ($row = $query->fetch_assoc()) {
                    $supporturl[] = $row;
                }
                $url_s = $supporturl[0]['url'];
            } else {
                $url_s = $supports[0]['url'];
            }
            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Administrateur',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeAdmin.css'
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alternances,
                'projets' => $projets,
                'etudiants' => $etudiants,
                'edt' => $edt,
                'url' => $url,
                'sup' => $sup,
                'url_s' => $url_s,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/homeAdmin.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }

        
    }
}
