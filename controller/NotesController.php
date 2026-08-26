<?php

require_once 'model/SqlModel.php';

class NotesController {
    public function index() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        // Entreprise ou Admin
        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            )  || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();

            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant') {
                $query = $sqlModel->SqlRequest("SELECT * FROM notes WHERE etudiant_id = ?", [$_SESSION['userid']]);
            }
            elseif (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant') {
                $query = $sqlModel->SqlRequest("SELECT * FROM notes WHERE etudiant_id = ? AND enseignant_id = ?", [$_GET['id'], $_SESSION['userid']]);
            }
            elseif ( isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur') {
                $query = $sqlModel->SqlRequest("SELECT * FROM notes WHERE etudiant_id = ?", [$_GET['id']]);
            } 
            else {
                header('Location: ' . URL .'/home');
                exit;
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

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Notes',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notes.css',
                ],
                'script' => [
                    'script.js'
                ],
                'notes' => $notes ?? [],
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/notes.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
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

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Notes',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notesListEtudiants.css',
                ],
                'script' => [
                    'script.js'
                ],
                'etudiants' => $etudiants ?? [],
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/notesListEtudiants.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
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


    public function ajouter() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();

            if ($_SESSION['level'] == 'administrateur') {
                $query = $sqlModel->SqlRequest("SELECT id, nom, prenom FROM `enseignants`");
            
                $enseignant = [];
            
                foreach ($query as $row) {
                    $enseignant[] = [
                        'id' => $row['id'],
                        'name' => $row['prenom'] . ' ' . $row['nom'],
                    ];
                }
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Ajouter une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notesAjout.css',
                ],
                'script' => [
                    'script.js'
                ],
                'enseignant' => $enseignant ?? [],
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
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant' &&
                isset($_POST['idetudiant'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['idetudiant'])
            )
        ) {

            $sqlModel = new SqlModel();

            if ($_SESSION['level'] == 'enseignant') {
                $query = $sqlModel->SqlRequest("INSERT INTO notes (etudiant_id, matiere, libelle, commentaire, note, enseignant_id) VALUES (?, ?, ?, ?, ?, ?)", [$_POST['idetudiant'], $_POST['matiere'], $_POST['libelle'], $_POST['commentaire'], $_POST['note'], $_SESSION['userid']]);
            }
            else if ($_SESSION['level'] == 'administrateur') {
                $query = $sqlModel->SqlRequest("INSERT INTO notes (etudiant_id, matiere, libelle, commentaire, note, enseignant_id) VALUES (?, ?, ?, ?, ?, ?)", [$_POST['idetudiant'], $_POST['matiere'], $_POST['libelle'], $_POST['commentaire'], $_POST['note'], $_POST['enseignant_id']]);
            } else {
                header('Location: ' . URL .'/notes');
                exit;
            }

            header('Location: ' . URL .'/notes');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
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

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'&&
                isset($_GET['id'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();

            $query = $sqlModel->SqlRequest("SELECT * FROM notes WHERE id =  ?", [$_GET['id']]);

            $note = [];
            while ($row = $query->fetch_assoc()) {
                $note[] = $row;
            }

            $note = [
                'id' => $note[0]['id'],
                'matiere' => $note[0]['matiere'],
                'libelle' => $note[0]['libelle'],
                'commentaire' => $note[0]['commentaire'],
                'note' => $note[0]['note'],
            ];


            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'notesModification.css',
                ],
                'script' => [
                    'script.js'
                ],
                'note' => $note ?? [],
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
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['idnote'])
            )
        ) {
            $commentaire = (($_POST['commentaire'] ?? '') !== '') ? $_POST['commentaire'] : null;

            $sqlModel = new SqlModel();

            $query = $sqlModel->SqlRequest("UPDATE notes SET matiere = ?, libelle = ?, commentaire = ?, note = ? WHERE id = ?", [$_POST['matiere'], $_POST['libelle'], $commentaire, $_POST['note'], $_POST['idnote']]);

            header('Location: ' . URL .'/notes');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
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

    // Supprimer une note
    public function supprimer() {
        
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Si les données de l'offre ont été transmises en GET (Suppression)
        if (isset($_GET['id'])) {

            // Si connecté en tant qu'enseignant
            if (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) {
                $sqlModel = new SqlModel();
                $query = $sqlModel->SqlRequest("DELETE FROM notes WHERE id = ? AND enseignant_id = ?", [$_GET['id'], $_SESSION['userid']]);

                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/notes');
                exit;
            }

            // Si connecté en tant qu'administrateur
            elseif (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            ) {
                $sqlModel = new SqlModel();
                // Ajouter l'offre d'alternance pour une entreprise
                $query = $sqlModel->SqlRequest("DELETE FROM notes WHERE id = ?", [$_GET['id']]);

                // Rediriger vers la liste des offres d'alternance
                header('Location: ' . URL .'/notes');
                exit;
            }
            // Si connecté en tant qu'étudiant ou entreprise
            elseif (
                (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
                ) || (
                    isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                    isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
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