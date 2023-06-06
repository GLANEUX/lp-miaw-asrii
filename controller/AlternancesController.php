<?php

require_once 'model\SqlModel.php';

class AlternancesController {
    public function index() {

        session_start();

        // Entreprise ou Admin
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

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/alternances.php';

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

            header('Location: ' . URL .'/offres');
            exit;
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }
        
    } // Desactiver redirection auto 



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
            // Récupérer les données des alternances depuis la base de données
            $alternances = $sqlModel->getTableData('alternance');
        
            $alter = [];
        
            foreach ($alternances as $alternance) {
                $alter[] = [
                    'id' => $alternance['id'],
                    'poste' => $alternance['poste'],
                    'entreprise' => $alternance['entreprise']
                ];
            }

            // Charger les données nécessaires pour la vue
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
                'alternances' => $alter,
            ];
        
            // Inclure le fichier d'en-tête
            require 'view/header.php';
            
            // Afficher la vue avec les données
            require 'view/alternancesList.php';
        
            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
        ) {
            $sqlModel = new SqlModel();
            // Récupérer les données des alternances depuis la base de données
            $alternances = $sqlModel->selectRequest('* FROM alternance WHERE user_id = ' . $_SESSION['userid']);
        
            $alter = [];
        
            foreach ($alternances as $alternance) {
                $alter[] = [
                    'id' => $alternance['id'],
                    'poste' => $alternance['poste'],
                    'entreprise' => $alternance['entreprise']
                ];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Liste - Offres d\'alternance',
                'style' => [
                    'header.css',
                    'footer.css',
                    'alternances.css',
                ],
                'script' => [
                    'script.js'
                ],
                'alternances' => $alter,
            ];
        
            // Inclure le fichier d'en-tête
            require 'view/header.php';
            
            // Afficher la vue avec les données
            require 'view/alternancesList.php';
        
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
                // Récupérer les données des alternances depuis la base de données
                if ($_SESSION['level'] == 'entreprise'){
                    $alternances = $sqlModel->selectRequest('* FROM alternance WHERE user_id = \'' . $_SESSION['userid'] . '\' AND id = \'' . $_GET['id'] .'\'');
                } elseif ($_SESSION['level'] == 'admin'){
                    $alternances = $sqlModel->selectRequest('* FROM alternance WHERE id = ' . $_GET['id']);
                } else { $alternances = null; }

                if ($alternances[0]) {

                    $alter = [
                        'id' => $alternances[0]['id'],
                        'poste' => $alternances[0]['poste'],
                        'entreprise' => $alternances[0]['entreprise']
                    ];

                    // Charger les données nécessaires pour la vue
                    $data = [
                        'title' => $alter['poste'] . $alter['entreprise'] . '- Modification',
                        'style' => [
                            'header.css',
                            'footer.css',
                            'alternancesModification.css',
                        ],
                        'script' => [
                            'script.js'
                        ],
                        'alternances' => $alter,
                    ];
                
                    // Inclure le fichier d'en-tête
                    require 'view/header.php';
                    
                    // Afficher la vue avec les données
                    require 'view/alternancesModification.php';
                
                    // Inclure le fichier de pied de page
                    require 'view/footer.php';

                }
                else {
                    header('Location: ' . URL .'/offres');
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
                header('Location: ' . URL .'/offres');
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
                // Récupérer les données des alternances depuis la base de données
                $alternances = $sqlModel->updateRequest('alternance SET poste = \'' . $_POST['poste'] . '\', entreprise = \'' . $_POST['entreprise'] . '\' WHERE id =' . $_POST['id']);

                header('Location: ' . URL .'/offres');
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
                header('Location: ' . URL .'/offres');
                exit;
            }

            else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header('Location: ' . URL .'/connexion');
                exit;
            }

        }

        else {
            header('Location: ' . URL .'/offres');
            exit;
        }

    }

    public function ajouter() {
        
        session_start();

        if (isset($_POST['poste']) && isset($_POST['entreprise']) && $_POST['poste'] && $_POST['entreprise']) {

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
                // Récupérer les données des alternances depuis la base de données
                $alternances = $sqlModel->addAlternanceRequest($_SESSION['userid'] . ', \''  . $_POST['poste'] . '\', \'' . $_POST['entreprise'] . '\'');

                header('Location: ' . URL .'/alternances');
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
                header('Location: ' . URL .'/offres');
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
                    'title' => 'Ajouter - Offre d\'alternance',
                    'style' => [
                        'header.css',
                        'footer.css',
                        'alternancesAjout.css',
                    ],
                    'script' => [
                        'script.js'
                    ],
                ];
            
                // Inclure le fichier d'en-tête
                require 'view/header.php';
                
                // Afficher la vue avec les données
                require 'view/alternancesAjout.php';
            
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
                header('Location: ' . URL .'/offres');
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