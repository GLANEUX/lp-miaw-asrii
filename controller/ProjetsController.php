<?php

require_once 'model\SqlModel.php';

class ProjetsController {
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
                'title' => 'Projets Tuteurés',
                'style' => [
                    'style.css'
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
                    'style.css'
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
                    'style.css'
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
                    $projets = $sqlModel->selectRequest('* FROM projets WHERE user_id = ' . $_SESSION['userid'] . 'AND id = ' . $_GET['id']);
                } elseif ($_SESSION['level'] == 'admin'){
                    $projets = $sqlModel->selectRequest('* FROM projets WHERE user_id = ' . $_SESSION['userid']);
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
                            'style.css'
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
                $projets = $sqlModel->updateRequest('projets SET titre = ' . $_POST['titre'] . ', description = ' . $_POST['description'] . ' WHERE id =' . $_POST['id']);

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

    }

    public function modification($id) {
        // Vérifier si un formulaire de modification a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];

            // Effectuer les opérations de mise à jour dans la base de données
            // ...
            echo "Projet $id modifié avec succès.";
        } else {
            // Afficher le formulaire de modification
            echo "Formulaire de modification du projet $id";
            // ...
        }
    }


    public function ajouter() {
        // Vérifier si un formulaire d'ajout a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];

            // Effectuer les opérations d'ajout dans la base de données
            // ...
            echo "Projet ajouté avec succès.";
        } else {
            // Afficher le formulaire d'ajout
            echo "Formulaire d'ajout de projet";
            // ...
        }
    }
}