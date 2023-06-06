<?php

require_once 'model\SqlModel.php';

class NotesController {
    public function index() {

        session_start();

        // Entreprise ou Admin
        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            )  || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
            )
        ) {

            $sqlModel = new SqlModel();
            // Récupérer les données des notes depuis la base de données
            $notes = $sqlModel->selectRequest('* FROM notes');////////////////////////////////////////////////////////////////////
        
            $not = [];
        
            foreach ($notes as $note) {
                $not[] = [
                    'id' => $note['id'],////////////////////////////////////////////////////////////////////
                    'titre' => $note['titre'],////////////////////////////////////////////////////////////////////
                    'description' => $note['description']////////////////////////////////////////////////////////////////////
                ];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Notes',
                'style' => [
                    'header.css',
                    'footer.css',
                    'projetsList.css',////////////////////////////////////////////////////////////////////
                ],
                'script' => [
                    'script.js'
                ],
                'notes' => $not,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/notes.php';////////////////////////////////////////////////////////////////////

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            )
        ) {

            header('Location: ' . URL .'/home');
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
        
    }



    public function list() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
            )
        ) {

            $sqlModel = new SqlModel();
            // Récupérer les données des projets depuis la base de données
            $projets = $sqlModel->getTableData('projets');
        
            $proj = [];
        
            foreach ($projets as $projet) {
                $proj[] = [
                    'id' => $projet['id'],
                    'titre' => $projet['titre'],
                    'description' => $projet['description']
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
                'projets' => $proj,
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
            $sqlModel = new SqlModel();
            // Récupérer les données des projets depuis la base de données
            $projets = $sqlModel->selectRequest('* FROM projets WHERE user_id = ' . $_SESSION['userid']);
        
            $proj = [];
        
            foreach ($projets as $projet) {
                $proj[] = [
                    'id' => $projet['id'],
                    'titre' => $projet['titre'],
                    'description' => $projet['description']
                ];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Liste - Projets Tuteurés',
                'style' => [
                    'header.css',
                    'footer.css',
                    'projets.css',
                ],
                'script' => [
                    'script.js'
                ],
                'projets' => $proj,
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

        session_start();

        if (isset($_GET['id']) && $_GET['id']) {

            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
                )
            ) {

                $sqlModel = new SqlModel();
                // Récupérer les données des projets depuis la base de données
                if ($_SESSION['level'] == 'entreprise'){
                    $projets = $sqlModel->selectRequest('* FROM projets WHERE user_id = \'' . $_SESSION['userid'] . '\' AND id = \'' . $_GET['id'] .'\'');
                } elseif ($_SESSION['level'] == 'admin'){
                    $projets = $sqlModel->selectRequest('* FROM projets WHERE id = ' . $_GET['id']);
                } else { $projet = null; }

                if ($projets[0]) {

                    $proj = [
                        'id' => $projets[0]['id'],
                        'titre' => $projets[0]['titre'],
                        'description' => $projets[0]['description']
                    ];

                    // Charger les données nécessaires pour la vue
                    $data = [
                        'title' => $proj['titre'] . '- Modification',
                        'style' => [
                            'header.css',
                            'footer.css',
                            'projetsModification.css',
                        ],
                        'script' => [
                            'script.js'
                        ],
                        'projets' => $proj,
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
                    isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
                )
            ) {

                $sqlModel = new SqlModel();
                // Récupérer les données des projets depuis la base de données
                $projets = $sqlModel->updateRequest('projets SET titre = \'' . $_POST['titre'] . '\', description = \'' . $_POST['description'] . '\' WHERE id =' . $_POST['id']);

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
        
        session_start();

        if (isset($_POST['titre']) && isset($_POST['description']) && $_POST['titre'] && $_POST['description']) {

            if (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
                )
            ) {

                $sqlModel = new SqlModel();
                // Récupérer les données des projets depuis la base de données
                $projets = $sqlModel->addProjetRequest($_SESSION['userid'] . ', \''  . $_POST['titre'] . '\', \'' . $_POST['description'] . '\'');

                header('Location: ' . URL .'/projets');
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
                    isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
                )
            ) {

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

}