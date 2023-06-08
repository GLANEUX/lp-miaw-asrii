<?php

require_once 'model\SqlModel.php';

class EDTController {
    public function index() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant' &&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise' &&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant' &&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $emploisdutemps = $sqlModel->selectRequest('* FROM emploi_du_temps');

            $edt = [];
        
            foreach ($emploisdutemps as $emploidutemps) {
                $edt[] = [
                    'id' => $emploidutemps['id'],
                    'date' => $emploidutemps['date'],
                ];
            }

            $edturl = $sqlModel->selectRequest('* FROM emploi_du_temps WHERE id=' . $_GET['id']);

            $edt += [
                'url' => $edturl[0]['url']
            ];
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
            )
        ) {
            $sqlModel = new SqlModel();
            $emploisdutemps = $sqlModel->selectRequest('* FROM emploi_du_temps');

            $edt = [];
        
            foreach ($emploisdutemps as $emploidutemps) {
                $edt[] = [
                    'id' => $emploidutemps['id'],
                    'date' => $emploidutemps['date'],
                ];
            }
            $edt += [
                'url' => $emploisdutemps[0]['url']
            ];
        }
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }

        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Emploi du temps',
            'style' => [
                'header.css',
                'footer.css',
                'edt.css',
            ],
            'script' => [
                'script.js'
            ],
            'edt' => $edt,
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue avec les données
        require 'view/emploiDuTemps.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';

    }


    public function ajouter() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_FILES['edt']) && isset($_POST['date'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_FILES['edt']) && isset($_POST['date'])
            )
        ) {
            $nomFichier = $_FILES['edt']['name'];
            move_uploaded_file($_FILES["edt"]["tmp_name"], 'public/img/' . $nomFichier);
            
            $sqlModel = new SqlModel();

            $emploisdt = $sqlModel->addEDTRequest('\'' . $_POST['date'] . '\', \''  . '/public/img/' . $nomFichier . '\'');
        
            header('Location: ' . URL .'/emplois-du-temps');
            exit;
        }

        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' 
            )
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Ajouter un emploi du temps',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notes.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/emploiDuTempsAjouter.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            )
        ) {
            header('Location: ' . URL .'/home');
            exit;
        }
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }

    }
}