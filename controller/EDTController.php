<?php

require_once 'model\SqlModel.php';

class EDTController {
    public function index() {

        session_start();

        // Entreprise ou Admin
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
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: ' . URL .'/connexion');
            exit;
        }

    }


    public function ajouter() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_GET['id'])
            )
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Ajouter une note',
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
            require 'view/notesAjout.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_POST['idetudiant'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_POST['idetudiant'])
            )
        ) {

            $sqlModel = new SqlModel();

            $notes = $sqlModel->addNoteRequest($_POST['idetudiant'] . ', \''  . $_POST['matiere'] . '\', \'' . $_POST['libelle'] . '\',' . $_POST['note'] . ', \'' . $_SESSION['userid'] . '\'');
        
            header('Location: ' . URL .'/notes');
            exit;
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


    public function modifier() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();

            $notes = $sqlModel->selectRequest('* FROM notes WHERE id = ' . $_GET['id']);

            $not = [
                'id' => $notes[0]['id'],
                'matiere' => $notes[0]['matiere'],
                'libelle' => $notes[0]['libelle'],
                'note' => $notes[0]['note'],
            ];


            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notes.css',
                ],
                'script' => [
                    'script.js'
                ],
                'notes' => $not
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/notesModification.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_POST['idnote'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin' &&
                isset($_POST['idnote'])
            )
        ) {

            $sqlModel = new SqlModel();

            $notes = $sqlModel->updateRequest('notes SET matiere = \'' . $_POST['matiere'] . '\', libelle = \'' . $_POST['libelle'] . '\', note = ' . $_POST['note'] . ' WHERE id =' . $_POST['idnote']);
        
            header('Location: ' . URL .'/notes');
            exit;
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