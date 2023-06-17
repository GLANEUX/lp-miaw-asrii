<?php

require_once 'model\SqlModel.php';

class SupportsController {
    public function index() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
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
                $url = $supporturl[0]['url'];
            } else {
                $url = $supports[0]['url'];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Support de cours',
                'style' => [
                    'header.css',
                    'footer.css',
                    'supportsDeCours.css',
                ],
                'script' => [
                    'script.js'
                ],
                'sup' => $sup,
                'url' => $url,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/supportsDeCours.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        }
        else if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT * FROM supports WHERE enseignant_id = $_SESSION[userid]");

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
                $query = $sqlModel->SqlRequest("SELECT url FROM supports WHERE id= $_GET[id] AND enseignant_id = $_SESSION[userid]");
                while ($row = $query->fetch_assoc()) {
                    $supporturl[] = $row;
                }
                $url = $supporturl[0]['url'];
            } else {
                $url = $supports[0]['url'];
            }

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Support de cours',
                'style' => [
                    'header.css',
                    'footer.css',
                    'supportsDeCours.css',
                ],
                'script' => [
                    'script.js'
                ],
                'sup' => $sup,
                'url' => $url,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/supportsDeCours.php';

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
                isset($_FILES['sup']) && isset($_POST['matiere']) && isset($_POST['titre'])
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_FILES['sup']) && isset($_POST['matiere']) && isset($_POST['titre']) && isset($_POST['enseignant'])
            )
        ) {
            $nomFichier = $_FILES['sup']['name'];
            move_uploaded_file($_FILES["sup"]["tmp_name"], 'public/supports_de_cours/' . $nomFichier);
            
            $sqlModel = new SqlModel();

            if ($_SESSION['level'] == 'enseignant') {
                $query = $sqlModel->SqlRequest("INSERT INTO supports (titre, matiere, url, enseignant_id) VALUES ('$_POST[titre]', '$_POST[matiere]', '/public/supports_de_cours/$nomFichier', $_SESSION[userid])");
            } elseif ($_SESSION['level'] == 'administrateur') {
                $query = $sqlModel->SqlRequest("INSERT INTO supports (titre, matiere, url, enseignant_id) VALUES ('$_POST[titre]', '$_POST[matiere]', '/public/supports_de_cours/$nomFichier', $_POST[enseignant])");
            }

            header('Location: ' . URL .'/supports');
            exit;
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
            if ($_SESSION['level'] == 'administrateur') {
                $sqlModel = new SqlModel();
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
                'title' => 'Ajouter un support de cours',
                'style' => [
                    'header.css',
                    'footer.css',
                    'supportsDeCoursAjouter.css',
                ],
                'script' => [
                    'script.js'
                ],
                'enseignant' => $enseignant ?? null,
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/supportsDeCoursAjouter.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        }
        elseif (
            (
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

    public function supprimer() {

        session_start();

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
            if ($_SESSION['level'] == 'enseignant') {
                $query = $sqlModel->SqlRequest("SELECT url FROM supports WHERE id= $_GET[id] AND enseignant_id = $_SESSION[userid]");
                while ($row = $query->fetch_assoc()) {
                    $supurl[] = $row;
                }
                $sup = $supurl[0]['url'];
                unlink(".$sup");
                $query = $sqlModel->SqlRequest("DELETE FROM supports WHERE id = $_GET[id] AND enseignant_id = $_SESSION[userid]");
            } elseif ($_SESSION['level'] == 'administrateur') {
                $query = $sqlModel->SqlRequest("SELECT url FROM supports WHERE id= $_GET[id]");
                while ($row = $query->fetch_assoc()) {
                    $supurl[] = $row;
                }
                $sup = $supurl[0]['url'];
                unlink(".$sup");
                $query = $sqlModel->SqlRequest("DELETE FROM supports WHERE id = $_GET[id]");
            }
        
            header('Location: ' . URL .'/supports');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
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