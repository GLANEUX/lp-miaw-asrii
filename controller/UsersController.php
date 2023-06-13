<?php

require_once 'model\SqlModel.php';

class UsersController {

    public function index() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

            // Variables transmises
            $data = [
                'title' => 'Utilisateurs',
                'style' => [
                    'header.css',
                    'footer.css',
                    'users.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/users.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
        
    }

    public function ajouter() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

            // Variables transmises
            $data = [
                'title' => 'Ajouter un utilisateur',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersAdd.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersAdd.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
        
    }

    public function ajouterEtudiant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_de_naissance']) &&
                isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['ville'])&&
                isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])
            )
        ) {
            // Faire la requete sql
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $sqlModel->SqlRequest("INSERT INTO adresses (adresse, complement, code_postal, ville) VALUES ('$_POST[adresse]', $complement, '$_POST[code_postal]', '$_POST[ville]')");
            $query = $sqlModel->SqlRequest("SELECT id FROM adresses WHERE adresse = '$_POST[adresse]' AND code_postal = '$_POST[code_postal]' AND ville = '$_POST[ville]'");
            while ($row = $query->fetch_assoc()) {
                $adresse_id[] = $row;
            }
            $adresse_id = $adresse_id[0]['id'];
            $query = $sqlModel->SqlRequest("INSERT INTO etudiants (nom, prenom, date_de_naissance, adresse_id, email, username, password) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[date_de_naissance]', $adresse_id, '$_POST[email]', '$_POST[username]', '$password')");
        
            header('Location: ' . URL .'/users/list/etudiant');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            // Variables transmises
            $data = [
                'title' => 'Ajouter un étudiant',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersAddEtudiant.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersAddEtudiant.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function ajouterEnseignant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['nom']) && isset($_POST['prenom']) &&
                isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['ville'])&&
                isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])
            )
        ) {
            // Faire la requete sql
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $sqlModel->SqlRequest("INSERT INTO adresses (adresse, complement, code_postal, ville) VALUES ('$_POST[adresse]', $complement, '$_POST[code_postal]', '$_POST[ville]')");
            $query = $sqlModel->SqlRequest("SELECT id FROM adresses WHERE adresse = '$_POST[adresse]' AND code_postal = '$_POST[code_postal]' AND ville = '$_POST[ville]'");
            while ($row = $query->fetch_assoc()) {
                $adresse_id[] = $row;
            }
            $adresse_id = $adresse_id[0]['id'];
            $query = $sqlModel->SqlRequest("INSERT INTO enseignants (nom, prenom, adresse_id, email, username, password) VALUES ('$_POST[nom]', '$_POST[prenom]', $adresse_id, '$_POST[email]', '$_POST[username]', '$password')");
        
            header('Location: ' . URL .'/users/list/enseignant');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            // Variables transmises
            $data = [
                'title' => 'Ajouter un enseignant',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersAddEnseignant.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersAddEnseignant.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function ajouterEntreprise() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['societe']) && isset($_POST['siret']) && isset($_POST['numero']) &&
                isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['ville'])&&
                isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])
            )
        ) {
            // Faire la requete sql
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $sqlModel->SqlRequest("INSERT INTO adresses (adresse, complement, code_postal, ville) VALUES ('$_POST[adresse]', $complement, '$_POST[code_postal]', '$_POST[ville]')");
            $query = $sqlModel->SqlRequest("SELECT id FROM adresses WHERE adresse = '$_POST[adresse]' AND code_postal = '$_POST[code_postal]' AND ville = '$_POST[ville]'");
            while ($row = $query->fetch_assoc()) {
                $adresse_id[] = $row;
            }
            $adresse_id = $adresse_id[0]['id'];
            $query = $sqlModel->SqlRequest("INSERT INTO entreprises (societe, siret, adresse_id, numero, email, username, password, confirme) VALUES ('$_POST[societe]', '$_POST[siret]', $adresse_id, '$_POST[numero]', '$_POST[email]', '$_POST[username]', '$password', 1)");
        
            header('Location: ' . URL .'/users/list/entreprise');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            // Variables transmises
            $data = [
                'title' => 'Ajouter une entreprise',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersAddEntreprise.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersAddEntreprise.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function ajouterAdministrateur() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['nom']) && isset($_POST['prenom']) &&
                isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])
            )
        ) {
            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $query = $sqlModel->SqlRequest("INSERT INTO administrateurs (nom, prenom, email, username, password) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[username]', '$password')");
        
            header('Location: ' . URL .'/users/list/administrateur');
            exit;
        }
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            // Variables transmises
            $data = [
                'title' => 'Ajouter un administrateur',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersAddAdministrateur.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersAddAdministrateur.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function list() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {

            // Variables transmises
            $data = [
                'title' => 'Lister les utilisateurs',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersList.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersList.php';
            require 'view/footer.php';
        } 
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
        
    }

    public function listEtudiant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("DELETE FROM etudiants WHERE id = $_GET[id]");

            header('Location: ' . URL .'/users/list/etudiant');
    
        }
        else if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.nom, a.prenom, a.date_de_naissance, a.email, ad.adresse, ad.code_postal, ad.ville
                FROM etudiants AS a
                JOIN adresses AS ad ON a.adresse_id = ad.id         
            ");
        
            // Stocker les offres d'alternance dans une variable
            $etudiants = [];
            foreach ($query as $row) {
                $etudiants[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'date_de_naissance' => $row['date_de_naissance'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville']
                ];
            }

            // Variables transmises
            $data = [
                'title' => 'Liste des étudiants',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersListEtudiant.css',
                ],
                'script' => [
                    'script.js'
                ],
                'etudiants' => $etudiants,
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersListEtudiant.php';
            require 'view/footer.php';
        }
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function listEntreprise() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("DELETE FROM entreprises WHERE id = $_GET[id]");

            header('Location: ' . URL .'/users/list/entreprise');
    
        }
        else if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.societe, a.siret, a.numero, a.email, a.confirme, ad.adresse, ad.code_postal, ad.ville
                FROM entreprises AS a
                JOIN adresses AS ad ON a.adresse_id = ad.id         
            ");
        
            // Stocker les offres d'alternance dans une variable
            $entreprises = [];
            foreach ($query as $row) {
                $entreprises[] = [
                    'id' => $row['id'],
                    'societe' => $row['societe'],
                    'siret' => $row['siret'],
                    'numero' => $row['numero'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville'],
                    'confirme' => $row['confirme']
                ];
            }

            // Variables transmises
            $data = [
                'title' => 'Liste des entreprises',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersListEntreprise.css',
                ],
                'script' => [
                    'script.js'
                ],
                'entreprises' => $entreprises,
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersListEntreprise.php';
            require 'view/footer.php';
        }
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function listEnseignant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("DELETE FROM enseignants WHERE id = $_GET[id]");

            header('Location: ' . URL .'/users/list/enseignant');
    
        }
        else if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("
                SELECT a.id, a.nom, a.prenom, a.email, ad.adresse, ad.code_postal, ad.ville
                FROM enseignants AS a
                JOIN adresses AS ad ON a.adresse_id = ad.id         
            ");
        
            // Stocker les offres d'alternance dans une variable
            $enseignants = [];
            foreach ($query as $row) {
                $enseignants[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'],
                    'code_postal' => $row['code_postal'],
                    'ville' => $row['ville']
                ];
            }

            // Variables transmises
            $data = [
                'title' => 'Liste des enseignants',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersListEnseignant.css',
                ],
                'script' => [
                    'script.js'
                ],
                'enseignants' => $enseignants,
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersListEnseignant.php';
            require 'view/footer.php';
        }
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function listAdministrateur() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("DELETE FROM administrateurs WHERE id = $_GET[id]");

            header('Location: ' . URL .'/users/list/administrateur');
    
        }
        else if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT id, nom, prenom, email FROM administrateurs");
        
            // Stocker les offres d'alternance dans une variable
            $administrateurs = [];
            foreach ($query as $row) {
                $administrateurs[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'email' => $row['email']
                ];
            }

            // Variables transmises
            $data = [
                'title' => 'Liste des administrateurs',
                'style' => [
                    'header.css',
                    'footer.css',
                    'usersListAdministrateur.css',
                ],
                'script' => [
                    'script.js'
                ],
                'administrateurs' => $administrateurs,
            ];

            // Afficher la page
            require 'view/header.php';
            require 'view/usersListAdministrateur.php';
            require 'view/footer.php';
        }
        else {
            header('Location: ' . URL .'/home');
            exit;
        }
    }

    public function confirmeEntreprise() {
        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("UPDATE entreprises SET confirme = 1 WHERE id = $_GET[id]");

            header('Location: ' . URL .'/users/list/entreprise');
    
        }
        else {
            header('Location: ' . URL .'/users/list/entreprise');
            exit;
        }
    }

}