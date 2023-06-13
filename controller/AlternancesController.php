<?php

require_once 'model\SqlModel.php';

class AlternancesController {

    // Page de gestion des offres d'alternances
    public function index() {

        session_start();

        // Si connecté en tant qu'entreprise ou administrateur
        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

            // Variables transmises
            $data = [
                'title' => 'Alternances',
                'style' => [
                    'header.css',
                    'footer.css',
                    'alternances.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/alternances.php';
            require 'view/footer.php';
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
            header('Location: ' . URL .'/offres');
            exit;
        } 
        
        // Si non connecté
        else {
            // Rediriger vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
        
    }

    // Lister les offres d'alternance
    public function list() {

        session_start();

        // Si connecté en tant qu'étudiant, enseignant ou administrateur
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

            // Variables transmises
            $data = [
                'title' => 'Liste - Offres d\'alternance',
                'style' => [
                    'header.css',
                    'footer.css',
                    'alternancesList.css',
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alternances,
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/alternancesList.php';
            require 'view/footer.php';
        }

        // Si connecté en tant qu'entreprise
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
        ) {

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

            // Variables transmises
            $data = [
                'title' => 'Liste - Offres d\'alternance',
                'style' => [
                    'header.css',
                    'footer.css',
                    'alternancesList.css',
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alternances,
            ];
        
            // Afficher la page
            require 'view/header.php';
            require 'view/alternancesList.php';
            require 'view/footer.php';
        }

        // Si non connecté
        else {
            // Rediriger vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
    }

    // Modifier les offres d'alternance
    public function modifier() {

        session_start();

        // Si l'id de l'offre a été transmise en GET (Formulaire de modification)
        if (isset($_GET['id']) && $_GET['id']) {

            // Si connecté en tant qu'entreprise ou administrateur
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

                // Si connecté en tant qu'entreprise
                if ($_SESSION['level'] == 'entreprise'){
                    // Récupérer la liste des offres d'alternance de l'entreprise de la base de données
                    $query = $sqlModel->SqlRequest("SELECT * FROM alternances WHERE entreprise_id = $_SESSION[userid] AND id = $_GET[id]");
                } 

                // Si connecté en tant qu'administrateur
                elseif ($_SESSION['level'] == 'administrateur'){
                    // Récupérer la liste des offres d'alternance de la base de données
                    $query = $sqlModel->SqlRequest("SELECT * FROM alternances WHERE id = $_GET[id]");
                } 
                
                // Stocker les offres d'alternance dans une variable
                $alternances = [];
                foreach ($query as $row) {
                    $alternances[] = [
                        'id' => $row['id'],
                        'poste' => $row['poste'],
                        'description' => $row['description']
                    ];
                }

                // Extraire l'offre d'alternance à modifier
                if ($alternances[0]) {
                    $alternance = [
                        'id' => $alternances[0]['id'],
                        'poste' => $alternances[0]['poste'],
                        'description' => $alternances[0]['description']
                    ];

                    // Variables transmises
                    $data = [
                        'title' => $alternance['poste'] . '- Modification',
                        'style' => [
                            'header.css',
                            'footer.css',
                            'alternancesModification.css',
                        ],
                        'script' => [
                            'script.js'
                        ],
                        'alternances' => $alternance,
                    ];
                
                    // Afficher la page
                    require 'view/header.php';
                    require 'view/alternancesModification.php';
                    require 'view/footer.php';

                }
                // Si l'offre n'existe pas
                else {
                    // Rediriger vers la liste des offres
                    header('Location: ' . URL .'/offres');
                    exit;
                }
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
                // Rediriger vers les offres d'alternance
                header('Location: ' . URL .'/offres');
                exit;
            }

            // Si non connecté
            else {
                // Rediriger vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }
        } 
        // Si l'id de l'offre a été transmise en POST (Modification)
        elseif (isset($_POST['id']) && $_POST['id']) {

            // Si connecté en tant qu'entreprise ou administrateur
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

                // Mettre à jour les données de l'offre d'alternance
                $query = $sqlModel->SqlRequest("UPDATE alternances SET poste = '$_POST[poste]', description = '$_POST[description]' WHERE id = $_POST[id]");

                // Rediriger vers les offres d'alternance
                header('Location: ' . URL .'/offres');
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
                // Rediriger vers les offres d'alternance
                header('Location: ' . URL .'/offres');
                exit;
            }
            // Si non connecté
            else {
                // Rediriger vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }
        // Si aucune variable n'a été transmise
        else {
            // Rediriger vers les offres d'alternance
            header('Location: ' . URL .'/offres');
            exit;
        }

    }

    // Ajouter une offre
    public function ajouter() {
        
        session_start();

        // Si les données de l'offre ont été transmises en POST (Ajout)
        if (isset($_POST['poste']) && isset($_POST['description']) && $_POST['poste'] && $_POST['description']) {

            // Si connecté en tant qu'entreprise
            if (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) {
                $sqlModel = new SqlModel();
                // Ajouter l'offre d'alternance pour l'entreprise
                $query = $sqlModel->SqlRequest("
                    INSERT INTO alternances (entreprise_id, poste, description)
                    VALUES ($_SESSION[userid], '$_POST[poste]', '$_POST[description]')
                ");

                // Rediriger vers la gestion des offres d'alternance
                header('Location: ' . URL .'/alternances');
                exit;
            }

            // Si connecté en tant qu'administrateur
            elseif (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            ) {
                $sqlModel = new SqlModel();
                // Ajouter l'offre d'alternance pour une entreprise
                $query = $sqlModel->SqlRequest("
                    INSERT INTO alternances (entreprise_id, poste, description) 
                    VALUES ($_POST[entreprise_id], '$_POST[poste]', '$_POST[description]')
                ");

                // Rediriger vers la gestion des offres d'alternance
                header('Location: ' . URL .'/alternances');
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
                header('Location: ' . URL .'/offres');
                exit;
            }
            // Si non connecté
            else {
                // Rediriger vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }
        // Si les données n'ont pas été transmises (Formulaire d'ajout)
        else {
            // Si connecté en tant qu'entreprise ou administrateur
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
                // Si connecté en tant qu'administrateur
                if ($_SESSION['level'] == 'administrateur') {

                    // Récupérer la liste des entreprises
                    $query = $sqlModel->SqlRequest("SELECT id, societe FROM `entreprises`");
                
                    // Stocker la liste des enteprises dans une variable
                    $entreprises = [];
                    foreach ($query as $row) {
                        $entreprises[] = [
                            'id' => $row['id'],
                            'name' => $row['societe'],
                        ];
                    }
                }

                // Variables transmises
                $data = [
                    'title' => 'Ajouter - Offre d\'alternance',
                    'style' => [
                        'header.css',
                        'footer.css',
                        'alternancesAjout.css',
                    ],
                    'script' => [
                        'script.js'
                    ],
                    'entreprises' => $entreprises ?? null,
                ];
            
                // Afficher la page
                require 'view/header.php';
                require 'view/alternancesAjout.php';
                require 'view/footer.php';
                
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
                header('Location: ' . URL .'/offres');
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

    // Supprimer une offre
    public function supprimer() {
        
        session_start();

        // Si les données de l'offre ont été transmises en GET (Suppression)
        if (isset($_GET['id'])) {

            // Si connecté en tant qu'entreprise
            if (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) {
                $sqlModel = new SqlModel();
                // Supprimer l'offre d'alternance de l'entreprise
                $query = $sqlModel->SqlRequest("DELETE FROM alternances WHERE id = $_GET[id] AND entreprise_id = $_SESSION[userid]");

                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/offres');
                exit;
            }

            // Si connecté en tant qu'administrateur
            elseif (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            ) {
                $sqlModel = new SqlModel();
                // Supprimer l'offre d'alternance
                $query = $sqlModel->SqlRequest("DELETE FROM alternances WHERE id = $_GET[id]");

                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/offres');
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
                header('Location: ' . URL .'/offres');
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
                header('Location: ' . URL .'/offres');
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