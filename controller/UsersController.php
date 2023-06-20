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
            // Faire la requête SQL
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }
    
            $sqlModel = new SqlModel();
    
            // Vérifier si le nom d'utilisateur existe déjà
            $query = $sqlModel->SqlRequest("SELECT username FROM etudiants WHERE username = '$_POST[username]'");
            if ($query->num_rows > 0) {
                // Nom d'utilisateur déjà utilisé, afficher une erreur
                header('Location: ' . URL .'/users/add/etudiant');
            exit;
                
            }
    
            // Vérifier si l'adresse e-mail existe déjà
            $query = $sqlModel->SqlRequest("SELECT email FROM etudiants WHERE email = '$_POST[email]'");
            if ($query->num_rows > 0) {
                // Adresse e-mail déjà utilisée, afficher une erreur
                header('Location: ' . URL .'/users/add/etudiant');
                exit;
            }
    
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            // Effectuer l'insertion dans la base de données
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





    public function editEtudiant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();




            
            $query = $sqlModel->SqlRequest("SELECT * FROM etudiants WHERE id =  $_GET[id]");

            while ($row = $query->fetch_assoc()) {
                $etu[] = $row;
            }

            $etu = [
                'id' => $etu[0]['id'],
                'nom' => $etu[0]['nom'],
                'prenom' => $etu[0]['prenom'],
                'date_de_naissance' => $etu[0]['date_de_naissance'],
                'username' => $etu[0]['username'],
                'email' => $etu[0]['email'],
            ];


            $query = $sqlModel->SqlRequest("SELECT e.id AS etu_id, a.id AS add_id, a.adresse, a.complement, a.code_postal, a.ville, e.adresse_id FROM adresses a JOIN etudiants e ON e.adresse_id = a.id WHERE e.id = $_GET[id] AND a.id = e.adresse_id");


            while ($row = $query->fetch_assoc()) {
                $add[] = $row;
            }

            $add = [
                'add_id' => $add[0]['add_id'],
                'adresse' => $add[0]['adresse'],
                'complement' => $add[0]['complement'],
                'code_postal' => $add[0]['code_postal'],
                'ville' => $add[0]['ville'],
            ];

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'EtuModification.css',
                ],
                'script' => [
                    'script.js'
                ],
                'etu' => $etu,
                'add' => $add

            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/userModifEtudiant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
          (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['id'])
            )
        ) {
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();




            $query = $sqlModel->SqlRequest("UPDATE adresses SET adresse = '$_POST[adresse]', complement = $complement, code_postal = '$_POST[code_postal]', ville = '$_POST[ville]' WHERE id = $_POST[add_id]");


            $query = $sqlModel->SqlRequest("UPDATE etudiants SET nom = '$_POST[nom]', prenom = '$_POST[prenom]', date_de_naissance = '$_POST[date_de_naissance]', email = '$_POST[email]', username = '$_POST[username]' WHERE id = $_POST[id]");


            header('Location: ' . URL .'/users/list/etudiant');
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




    public function editEnseignant() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();




            
            $query = $sqlModel->SqlRequest("SELECT * FROM enseignants WHERE id =  $_GET[id]");

            while ($row = $query->fetch_assoc()) {
                $etu[] = $row;
            }

            $etu = [
                'id' => $etu[0]['id'],
                'nom' => $etu[0]['nom'],
                'prenom' => $etu[0]['prenom'],
                'username' => $etu[0]['username'],
                'email' => $etu[0]['email'],
            ];


            $query = $sqlModel->SqlRequest("SELECT e.id AS etu_id, a.id AS add_id, a.adresse, a.complement, a.code_postal, a.ville, e.adresse_id FROM adresses a JOIN enseignants e ON e.adresse_id = a.id WHERE e.id = $_GET[id] AND a.id = e.adresse_id");


            while ($row = $query->fetch_assoc()) {
                $add[] = $row;
            }

            $add = [
                'add_id' => $add[0]['add_id'],
                'adresse' => $add[0]['adresse'],
                'complement' => $add[0]['complement'],
                'code_postal' => $add[0]['code_postal'],
                'ville' => $add[0]['ville'],
            ];

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'EnseignantModification.css',
                ],
                'script' => [
                    'script.js'
                ],
                'etu' => $etu,
                'add' => $add

            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/userModifEnseignant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
          (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['id'])
            )
        ) {
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();




            $query = $sqlModel->SqlRequest("UPDATE adresses SET adresse = '$_POST[adresse]', complement = $complement, code_postal = '$_POST[code_postal]', ville = '$_POST[ville]' WHERE id = $_POST[add_id]");


            $query = $sqlModel->SqlRequest("UPDATE enseignants SET nom = '$_POST[nom]', prenom = '$_POST[prenom]', email = '$_POST[email]', username = '$_POST[username]' WHERE id = $_POST[id]");


            header('Location: ' . URL .'/users/list/enseignant');
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





    public function editEntreprise() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();




            
            $query = $sqlModel->SqlRequest("SELECT * FROM entreprises WHERE id =  $_GET[id]");

            while ($row = $query->fetch_assoc()) {
                $etu[] = $row;
            }

            $etu = [
                'id' => $etu[0]['id'],
                'societe' => $etu[0]['societe'],
                'siret' => $etu[0]['siret'],
                'numero' => $etu[0]['numero'],
                'username' => $etu[0]['username'],
                'email' => $etu[0]['email'],
            ];


            $query = $sqlModel->SqlRequest("SELECT e.id AS etu_id, a.id AS add_id, a.adresse, a.complement, a.code_postal, a.ville, e.adresse_id FROM adresses a JOIN entreprises e ON e.adresse_id = a.id WHERE e.id = $_GET[id] AND a.id = e.adresse_id");


            while ($row = $query->fetch_assoc()) {
                $add[] = $row;
            }

            $add = [
                'add_id' => $add[0]['add_id'],
                'adresse' => $add[0]['adresse'],
                'complement' => $add[0]['complement'],
                'code_postal' => $add[0]['code_postal'],
                'ville' => $add[0]['ville'],
            ];

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'EntrepriseModif.css',
                ],
                'script' => [
                    'script.js'
                ],
                'etu' => $etu,
                'add' => $add

            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/userModifEntreprise.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
          (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['id'])
            )
        ) {
            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();




            $query = $sqlModel->SqlRequest("UPDATE adresses SET adresse = '$_POST[adresse]', complement = $complement, code_postal = '$_POST[code_postal]', ville = '$_POST[ville]' WHERE id = $_POST[add_id]");


            $query = $sqlModel->SqlRequest("UPDATE entreprises SET societe = '$_POST[societe]', siret = '$_POST[siret]', numero = '$_POST[numero]', email = '$_POST[email]', username = '$_POST[username]' WHERE id = $_POST[id]");


            header('Location: ' . URL .'/users/list/entreprise');
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

    public function editAdministrateur() {

        session_start();

        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_GET['id'])
            )
        ) {

            $sqlModel = new SqlModel();




            
            $query = $sqlModel->SqlRequest("SELECT * FROM administrateurs  WHERE id =  $_GET[id]");

            while ($row = $query->fetch_assoc()) {
                $admin[] = $row;
            }

            $admin = [
                'id' => $admin[0]['id'],
                'nom' => $admin[0]['nom'],
                'prenom' => $admin[0]['prenom'],
                'username' => $admin[0]['username'],
                'email' => $admin[0]['email'],
            ];


            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Modifier une note',
                'style' => [
                    'header.css',
                    'footer.css',
                    'AdminModification.css',
                ],
                'script' => [
                    'script.js'
                ],
                'admin' => $admin,

            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/userModifAdmin.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }

        elseif (
          (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur' &&
                isset($_POST['id'])
            )
        ) {

            $sqlModel = new SqlModel();



            $query = $sqlModel->SqlRequest("UPDATE administrateurs SET nom = '$_POST[nom]', prenom = '$_POST[prenom]', email = '$_POST[email]', username = '$_POST[username]' WHERE id = $_POST[id]");


            header('Location: ' . URL .'/users/list/administrateur');
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


                       // Vérifier si le nom d'utilisateur existe déjà
                       $query = $sqlModel->SqlRequest("SELECT username FROM enseignants WHERE username = '$_POST[username]'");
                       if ($query->num_rows > 0) {
                           // Nom d'utilisateur déjà utilisé, afficher une erreur
                           header('Location: ' . URL .'/users/add/enseignant');
                       exit;
                           
                       }
               
                       // Vérifier si l'adresse e-mail existe déjà
                       $query = $sqlModel->SqlRequest("SELECT email FROM enseignants WHERE email = '$_POST[email]'");
                       if ($query->num_rows > 0) {
                           // Adresse e-mail déjà utilisée, afficher une erreur
                           header('Location: ' . URL .'/users/add/enseignant');
                           exit;
                       }

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

            
                       // Vérifier si le nom d'utilisateur existe déjà
                       $query = $sqlModel->SqlRequest("SELECT username FROM entreprises WHERE username = '$_POST[username]'");
                       if ($query->num_rows > 0) {
                           // Nom d'utilisateur déjà utilisé, afficher une erreur
                           header('Location: ' . URL .'/users/add/entreprise');
                       exit;
                           
                       }
                        // Vérifier si le nom d'utilisateur existe déjà
                        $query = $sqlModel->SqlRequest("SELECT username FROM entreprises WHERE username = '$_POST[username]'");
                        if ($query->num_rows > 0) {
                            // Nom d'utilisateur déjà utilisé, afficher une erreur
                            header('Location: ' . URL .'/users/add/entreprise');
                        exit;
                            
                        }
                
                       // Vérifier si l'adresse e-mail existe déjà
                       $query = $sqlModel->SqlRequest("SELECT siret FROM entreprises WHERE siret = '$_POST[siret]'");
                       if ($query->num_rows > 0) {
                           // Adresse e-mail déjà utilisée, afficher une erreur
                           header('Location: ' . URL .'/users/add/entreprise');
                           exit;
                       }

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
        // Vérifier si l'adresse e-mail existe déjà
        $query = $sqlModel->SqlRequest("SELECT username FROM administrateurs WHERE username = '$_POST[username]'");
        if ($query->num_rows > 0) {
            // Adresse e-mail déjà utilisée, afficher une erreur
            header('Location: ' . URL .'/users/add/administrateur');
            exit;
        }
        // Vérifier si l'adresse e-mail existe déjà
        $query = $sqlModel->SqlRequest("SELECT email FROM administrateurs WHERE email = '$_POST[email]'");
        if ($query->num_rows > 0) {
            // Adresse e-mail déjà utilisée, afficher une erreur
            header('Location: ' . URL .'/users/add/administrateur');
            exit;
        }

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
                SELECT a.id, a.nom, a.prenom, a.date_de_naissance, a.email, ad.adresse, ad.code_postal, ad.ville, ad.complement
                FROM etudiants AS a
                JOIN adresses AS ad ON a.adresse_id = ad.id         
            ");
      
            // Stocker les offres d'alternance dans une variable
            $etudiants = [];
            foreach ($query as $row) {
                $nul = '';
                if ($row['complement'] != NULL){$nul = ', ';}

                $etudiants[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'date_de_naissance' => $row['date_de_naissance'],
                    'email' => $row['email'],
                    'adresse' => $row['adresse'] . $nul . $row['complement'],
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