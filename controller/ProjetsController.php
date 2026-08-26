<?php

require_once 'model/SqlModel.php';

class ProjetsController {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        // Entreprise ou Admin
        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Projets Tuteurés',
                'style' => [
                    'header.css',
                    'footer.css',
                    'projets.css'
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/projets.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        // Etudiant ou Enseignant
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            )
        ) {

            header('Location: ' . URL .'/projets/list');
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
        
    }



    public function list() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

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
                'title' => 'Liste - Projets Tuteurés',
                'style' => [
                    'header.css',
                    'footer.css',
                    'projetsList.css',
                ],
                'script' => [
                    'script.js'
                ],
                'projets' => $projets ?? [],
            ];
        
            // Inclure le fichier d'en-tête
            require 'view/header.php';
            
            // Afficher la vue avec les données
            require 'view/projetsList.php';
        
            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
        ) {
            // Récupérer les données des projets depuis la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT id, titre, description FROM projets WHERE entreprise_id = ?", [$_SESSION['userid']]);

            $projets = [];
            foreach ($query as $row) {
                $projets[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'description' => $row['description']
                ];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Liste - Projets Tuteurés',
                'style' => [
                    'header.css',
                    'footer.css',
                    'projetsList.css',
                ],
                'script' => [
                    'script.js'
                ],
                'projets' => $projets ?? [],
            ];
        
            // Inclure le fichier d'en-tête
            require 'view/header.php';
            
            // Afficher la vue avec les données
            require 'view/projetsList.php';
        
            // Inclure le fichier de pied de page
            require 'view/footer.php';
        }
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
    }


    public function modifier() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_GET['id']) && $_GET['id']) {

            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
                )
            ) {

                // Récupérer les données des projets depuis la base de données
                $sqlModel = new SqlModel();
                if ($_SESSION['level'] == 'entreprise'){
                    $query = $sqlModel->SqlRequest("SELECT * FROM projets WHERE entreprise_id = ? AND id = ?", [$_SESSION['userid'], $_GET['id']]);
                } elseif ($_SESSION['level'] == 'administrateur'){
                    $query = $sqlModel->SqlRequest("SELECT * FROM projets WHERE id = ?", [$_GET['id']]);
                } else { $query = null; }

                $projets = [];
                foreach ($query as $row) {
                    $projets[] = [
                        'id' => $row['id'],
                        'titre' => $row['titre'],
                        'description' => $row['description']
                    ];
                }

                if ($projets[0]) {

                    $projet = [
                        'id' => $projets[0]['id'],
                        'titre' => $projets[0]['titre'],
                        'description' => $projets[0]['description']
                    ];

                    // Charger les données nécessaires pour la vue
                    $data = [
                        'title' => $projet['titre'] . '- Modification',
                        'style' => [
                            'header.css',
                            'footer.css',
                            'projetsModification.css',
                        ],
                        'script' => [
                            'script.js'
                        ],
                        'projets' => $projet ?? null,
                    ];
                
                    // Inclure le fichier d'en-tête
                    require 'view/header.php';
                    
                    // Afficher la vue avec les données
                    require 'view/projetsModification.php';
                
                    // Inclure le fichier de pied de page
                    require 'view/footer.php';

                }
                else {
                    header('Location: ' . URL .'/projets/list');
                    exit;
                }
            }
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                )
            ) {
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        } elseif (isset($_POST['id']) && $_POST['id']) {

            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
                )
            ) {

                $sqlModel = new SqlModel();
                // Récupérer les données des projets depuis la base de données
                $query = $sqlModel->SqlRequest("UPDATE projets SET titre = ?, description = ? WHERE id = ?", [$_POST['titre'], $_POST['description'], $_POST['id']]);

                header('Location: ' . URL .'/projets/list');
                exit;
                
            }
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                )
            ) {
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }

        else {
            header('Location: ' . URL .'/projets/list');
            exit;
        }

    }

    public function ajouter() {
        
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_POST['titre']) && isset($_POST['description']) && $_POST['titre'] && $_POST['description']) {

            if (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) {
                $sqlModel = new SqlModel();
                $query = $sqlModel->SqlRequest("INSERT INTO projets (entreprise_id, titre, description) VALUES (?, ?, ?)", [$_SESSION['userid'], $_POST['titre'], $_POST['description']]);
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            //Admin
            elseif (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            ) {
                $sqlModel = new SqlModel();
                $query = $sqlModel->SqlRequest("INSERT INTO projets (entreprise_id, titre, description) VALUES (?, ?, ?)", [$_POST['entreprise_id'], $_POST['titre'], $_POST['description']]);
                header('Location: ' . URL .'/projets/list');
                exit;
            }
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                )
            ) {
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }

        else {

            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
                )
            ) {

                $sqlModel = new SqlModel();

                if ($_SESSION['level'] == 'administrateur') {
                    $query = $sqlModel->SqlRequest("SELECT id, societe FROM `entreprises`");
                
                    $entreprises = [];
                    foreach ($query as $row) {
                        $entreprises[] = [
                            'id' => $row['id'],
                            'name' => $row['societe'],
                        ];
                    }
                }

                // Charger les données nécessaires pour la vue
                $data = [
                    'title' => 'Ajouter - Projet tuteuré',
                    'style' => [
                        'header.css',
                        'footer.css',
                        'projetsAjout.css',
                    ],
                    'script' => [
                        'script.js'
                    ],
                    'entreprises' => $entreprises ?? [],
                ];
            
                // Inclure le fichier d'en-tête
                require 'view/header.php';
                
                // Afficher la vue avec les données
                require 'view/projetsAjout.php';
            
                // Inclure le fichier de pied de page
                require 'view/footer.php';
                
            }
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                )
            ) {
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }

    }

    // Supprimer un projet
    public function supprimer() {
        
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Si les données de l'offre ont été transmises en GET (Suppression)
        if (isset($_GET['id'])) {

            // Si connecté en tant qu'entreprise
            if (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) {
                $sqlModel = new SqlModel();
                // Ajouter l'offre d'alternance pour l'entreprise
                $query = $sqlModel->SqlRequest("DELETE FROM projets WHERE id = ? AND entreprise_id = ?", [$_GET['id'], $_SESSION['userid']]);

                // Rediriger vers la liste des projets
                header('Location: ' . URL .'/projets/list');
                exit;
            }

            // Si connecté en tant qu'administrateur
            elseif (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            ) {
                $sqlModel = new SqlModel();
                // Ajouter l'offre d'alternance pour une entreprise
                $query = $sqlModel->SqlRequest("DELETE FROM projets WHERE id = ?", [$_GET['id']]);

                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/projets/list');
                exit;
            }
            // Si connecté en tant qu'étudiant ou enseignant
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) 
            ) {
                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/projets/list');
                exit;
            }
            // Si non connecté
            else {
                // Rediriger vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }
        // Si les données n'ont pas été transmises (Redirection)
        else {
            // Si connecté en tant qu'entreprise ou administrateur
            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
                ) ||
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
                )
            ) {
                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/projets/list');
                exit;
            }
            // Si non connecté
            else {
                // Rediriger vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }

    }

}