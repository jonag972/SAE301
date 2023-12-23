    <?php
    require 'models/modelUtilisateur.php';
    class ControllerUtilisateur {
        public function sinscrire() {
            // Afficher le formulaire d'inscription
            include 'views/utilisateur/sinscrireVue.php';
        }

        public function seconnecter() {
            // Afficher le formulaire de connexion
            include 'views/utilisateur/seconnecterVue.php';
        }

        public function inscription() {
            $messageErreur = ''; // Initialisation de la variable d'erreur
            $identifiant_utilisateur = $_POST['identifiant_utilisateur'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $email = $_POST['email'];
            $prenom = $_POST['prenom'];
            $nom_de_famille = $_POST['nom_de_famille'];
            $age = $_POST['age'];
            $pays = $_POST['pays'];
            $abonnement = $_POST['abonnement'];
            $role = 'lambda'; // Role par défaut
            $photo_de_profil = file_get_contents($_FILES['photo_de_profil']['tmp_name']);
            if (!empty($identifiant_utilisateur) && !empty($mot_de_passe) && !empty($email) && !empty($prenom) && !empty($nom_de_famille) && !empty($age) && !empty($pays)) {
                if (modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur) == NULL) {
                    $modelUtilisateur = new ModelUtilisateur();
                    $modelUtilisateur->ajouterUtilisateur($identifiant_utilisateur, password_hash($mot_de_passe, PASSWORD_DEFAULT), $email, $prenom, $nom_de_famille, $age, $pays, $abonnement, $role, $photo_de_profil);
                    // Créer la session ou la remplacer si elle existe déjà
                    if (isset($_SESSION)) {
                        session_destroy();
                    }
                    // Rediriger l'utilisateur vers la page de connection
                    header('Location: ?action=seconnecter');
                } 
                else {
                    $messageErreur = "L'identifiant existe déjà. Veuillez en choisir un autre.";
                    include 'views/utilisateur/sinscrireVue.php';
                }
            }else {
                $messageErreur = "Veuillez remplir tous les champs avec l'astérisque.";
                include 'views/utilisateur/sinscrireVue.php';
            }
        }

        public function connexion() {
            if (isset($_SESSION['identifiant_utilisateur'])) {
                // L'utilisateur est déjà connecté, redirigez-le vers la page d'accueil
                header('Location: ?action=accueil');
            }
            $identifiant_utilisateur = $_POST['identifiant_utilisateur'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $mot_de_passe_hash = modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $identifiant_utilisateur);
                if (!empty($identifiant_utilisateur)) { 
                    if (!empty($mot_de_passe)) {
                        if ($identifiant_utilisateur == modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur)) {
                            // Maintenant qu'on sait que l'utilisateur et le mot de passe existe, on vérifie si le mot de passe est correct
                            if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
                                // Les identifiants sont corrects, connectez l'utilisateur
                                // Créer la session ou la remplacer si elle existe déjà
                                if (isset($_SESSION)) {
                                    session_destroy();
                                }
                                session_start();
                                // Ici, vous devez récupérer toutes les informations de l'utilisateur à partir de la base de données
                                // et les stocker dans la session. Je vais supposer que vous avez une méthode pour cela.
                                $_SESSION['identifiant_utilisateur'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur);
                                $_SESSION['identifiant_utilisateur'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur);
                                $_SESSION['email'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('email', $identifiant_utilisateur);
                                $_SESSION['prenom'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('prenom', $identifiant_utilisateur);
                                $_SESSION['nom_de_famille'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('nom_de_famille', $identifiant_utilisateur);
                                $_SESSION['age'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('age', $identifiant_utilisateur);
                                $_SESSION['pays'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('pays', $identifiant_utilisateur);
                                $_SESSION['abonnement'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('abonnement', $identifiant_utilisateur);
                                $_SESSION['role'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('role', $identifiant_utilisateur);
                                // Changer la date de dernière connexion
                                modelUtilisateur::modifierAttributUtilisateurParIdentifiant('date_derniere_connexion', date('Y-m-d H:i:s'), $identifiant_utilisateur);
                                header('Location: ?action=accueil');
                            } 
                            else {
                                $messageErreur = "Mot de passe incorrect.";
                                // Afficher la vue avec le message d'erreur
                                include 'views/utilisateur/seconnecterVue.php';
                            }
                        }
                        else {
                            $messageErreur = "Nom d'utilisateur inexistant.";
                            // Afficher la vue avec le message d'erreur
                            include 'views/utilisateur/seconnecterVue.php';
                        }
                    }
                    else {
                    $messageErreur = "Veuillez saisir un mot de passe.";
                    // Afficher la vue avec le message d'erreur
                    include 'views/utilisateur/seconnecterVue.php';
                    }
                }
                else {
                    $messageErreur = "Veuillez saisir un nom d'utilisateur.";
                    // Afficher la vue avec le message d'erreur
                    include 'views/utilisateur/seconnecterVue.php';
                }
        }
    

        public function deconnexion() {
            // Déconnectez l'utilisateur
            session_destroy();
            header('Location: ?action=accueil');
            modelUtilisateur::modifierAttributUtilisateurParIdentifiant('date_derniere_deconnexion', date('Y-m-d H:i:s'), $_SESSION['identifiant_utilisateur']);
        }

        public function monCompte() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Afficher les informations de l'utilisateur
            include 'views/utilisateur/monCompteVue.php';
        }

        public function modifierCompte() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Afficher le formulaire de modification de compte
            include 'views/utilisateur/modifierCompteVue.php';
        }

        public function modificationCompte() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            $messageErreur = ''; // Initialisation de la variable d'erreur
            if (!empty($_POST['mot_de_passe_confirmation'])) {
                if (password_verify($_POST['mot_de_passe_confirmation'], modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $_SESSION['identifiant_utilisateur']))) {
                    // Les identifiants sont corrects, modifiez l'utilisateur
                    // Faire une boucle pour vérifier si les champs sont vides ou non et modifier les champs non vides
                    $champs = array(
                        'mot_de_passe' => !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : null,
                        'email' => $_POST['email'],
                        'prenom' => $_POST['prenom'],
                        'nom_de_famille' => $_POST['nom_de_famille'],
                        'age' => $_POST['age'],
                        'pays' => $_POST['pays'],
                        'abonnement' => $_POST['abonnement']
                    );
            
                    // Parcourir le tableau pour vérifier si chaque champ est vide ou non
                    foreach ($champs as $champ => $valeur) {
                        if (!empty($valeur)) {
                            // Si le champ n'est pas vide, modifier l'attribut correspondant
                            modelUtilisateur::modifierAttributUtilisateurParIdentifiant($champ, $valeur, $_SESSION['identifiant_utilisateur']);
                        }
                    }
                    // Mettre à jour la session
                    $_SESSION['identifiant_utilisateur'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['email'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('email', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['prenom'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('prenom', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['nom_de_famille'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('nom_de_famille', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['age'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('age', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['pays'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('pays', $_SESSION['identifiant_utilisateur']);
                    $_SESSION['abonnement'] = modelUtilisateur::getAttributUtilisateurParIdentifiant('abonnement', $_SESSION['identifiant_utilisateur']);
                    header('Location: ?action=monCompte');
                } 
                else {
                    $messageErreur = "Mot de passe incorrect.";
                    // Afficher la vue avec le message d'erreur
                    include 'views/utilisateur/modifierCompteVue.php';
                }
            }
            else {
                $messageErreur = "Veuillez saisir votre mot de passe actuel pour confirmer les modifications.";
                include 'views/utilisateur/modifierCompteVue.php';
            }
        }
        

        public function supprimerCompte() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                $messageErreur = "Vous avez besoin d'être connecté pour supprimer votre compte.";
                header('Location: ?action=seconnecter');
                exit();
            }
            // Afficher le formulaire de suppression de compte
            include 'views/utilisateur/supprimerCompteVue.php';
        }

        public function supprimerCompteConfirmation() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                $messageErreur = "Vous avez besoin d'être connecté pour supprimer votre compte.";
                header('Location: ?action=seconnecter');
                exit();
            }
            $messageErreur = ''; // Initialisation de la variable d'erreur
            $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $mot_de_passe_hash = modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $identifiant_utilisateur);
            if (!empty($mot_de_passe)) {
                if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
                    // Les identifiants sont corrects, supprimez l'utilisateur
                    modelUtilisateur::supprimerUtilisateurParIdentifiant($identifiant_utilisateur);
                    // Déconnectez l'utilisateur
                    session_destroy();
                    header('Location: ?action=accueil');
                } 
                else {
                    $messageErreur = "Mot de passe incorrect.";
                    // Afficher la vue avec le message d'erreur
                    include 'views/utilisateur/supprimerCompteVue.php';
                }
            }
            else {
                $messageErreur = "Veuillez saisir un mot de passe.";
                // Afficher la vue avec le message d'erreur
                include 'views/utilisateur/supprimerCompteVue.php';
            }
        }

        public function adminAfficherTousLesUtilisateurs() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
            if ($_SESSION['role'] != 'admin') {
                header('Location: ?action=accueil');
                exit();
            }
            // On récupère tous les utilisateurs
            $utilisateurs = modelUtilisateur::getTousLesUtilisateurs();
            // Afficher la vue
            include 'views/utilisateur/adminAfficherTousLesUtilisateursVue.php';
        }

        public function adminAfficherUtilisateur() {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
            if ($_SESSION['role'] != 'admin') {
                header('Location: ?action=accueil');
                exit();
            }
            // On récupère l'utilisateur
            $utilisateur = modelUtilisateur::getUtilisateurParIdentifiant($_GET['identifiant_utilisateur']);
            // Afficher la vue
            include 'views/utilisateur/adminAfficherUtilisateurVue.php';
        }

        public function adminModifierUtilisateur($identifiant_utilisateur) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
            if ($_SESSION['role'] != 'admin') {
                header('Location: ?action=accueil');
                exit();
            }
            // On récupère l'utilisateur
            $utilisateur = modelUtilisateur::getUtilisateurParIdentifiant($_GET['identifiant_utilisateur']);
            // Afficher la vue
            include 'views/utilisateur/adminModifierUtilisateurVue.php';
        }

        public function adminModificationUtilisateur($identifiant_utilisateur) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            if (!isset($_SESSION['identifiant_utilisateur'])) {
                header('Location: ?action=seconnecter');
                exit();
            }
            // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
            if ($_SESSION['role'] != 'admin') {
                header('Location: ?action=accueil');
                exit();
            }
            // On modifie l'utilisateur pour tous les champs non vides
            $champs = array(
                'identifiant_utilisateur' => $_POST['identifiant_utilisateur'],
                'mot_de_passe' => !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : null,
                'email' => $_POST['email'],
                'prenom' => $_POST['prenom'],
                'nom_de_famille' => $_POST['nom_de_famille'],
                'age' => $_POST['age'],
                'pays' => $_POST['pays'],
                'ville' => $_POST['ville'],
                'abonnement' => $_POST['abonnement'],
                'role' => $_POST['role']
            );

            // Parcourir le tableau pour vérifier si chaque champ est vide ou non
            foreach ($champs as $champ => $valeur) {
                if (!empty($valeur)) {
                    // Si le champ n'est pas vide, modifier l'attribut correspondant
                    modelUtilisateur::modifierAttributUtilisateurParIdentifiant($champ, $valeur, $_POST['identifiant_utilisateur']);
                }
            }
            // Rediriger l'utilisateur vers le controlleur pour afficher l'utilisateur modifié
            header('Location: ?action=adminAfficherUtilisateur&identifiant_utilisateur=' . $_POST['identifiant_utilisateur']);

    }    
    
    public function adminSupprimerUtilisateur($identifiant_utilisateur) {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
        if ($_SESSION['role'] != 'admin') {
            header('Location: ?action=accueil');
            exit();
        }
        // On supprime l'utilisateur
        modelUtilisateur::supprimerUtilisateurParIdentifiant($_GET['identifiant_utilisateur']);
        // Rediriger l'utilisateur vers le controlleur pour afficher tous les utilisateurs
        header('Location: ?action=adminAfficherTousLesUtilisateurs');
    }

    public function adminAjouterUtilisateur() {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
        if ($_SESSION['role'] != 'admin') {
            header('Location: ?action=accueil');
            exit();
        }
        // Afficher le formulaire d'ajout d'utilisateur
        include 'views/utilisateur/adminAjouterUtilisateurVue.php';
    }

    public function adminAjoutUtilisateur() {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
        if ($_SESSION['role'] != 'admin') {
            header('Location: ?action=accueil');
            exit();
        }
        $messageErreur = ''; // Initialisation de la variable d'erreur
        $identifiant_utilisateur = $_POST['identifiant_utilisateur'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $email = $_POST['email'];
        $prenom = $_POST['prenom'];
        $nom_de_famille = $_POST['nom_de_famille'];
        $age = $_POST['age'];
        $pays = $_POST['pays'];
        $abonnement = $_POST['abonnement'];
        $role = $_POST['role'];
        if (!empty($identifiant_utilisateur) && !empty($mot_de_passe) && !empty($email) && !empty($prenom) && !empty($nom_de_famille) && !empty($age) && !empty($pays)) {
            if (modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur) == NULL) {
                $modelUtilisateur = new ModelUtilisateur();
                $modelUtilisateur->ajouterUtilisateur($identifiant_utilisateur, password_hash($mot_de_passe, PASSWORD_DEFAULT), $email, $prenom, $nom_de_famille, $age, $pays, $abonnement, $role);
                // Rediriger l'utilisateur vers le controlleur pour afficher tous les utilisateurs
                header('Location: ?action=adminAfficherTousLesUtilisateurs');
            }
            else {
                $messageErreur = "L'identifiant existe déjà. Veuillez en choisir un autre.";
                include 'views/utilisateur/adminAjouterUtilisateurVue.php';
            }
        }
        else {
            $messageErreur = "Veuillez remplir tous les champs avec l'astérisque.";
            include 'views/utilisateur/adminAjouterUtilisateurVue.php';
        }
    }

    public function adminAfficherEvenementsUtilisateurs() {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        // Si l'utilisateur n'est pas un administrateur, redirigez-le vers la page d'accueil
        if ($_SESSION['role'] != 'admin') {
            header('Location: ?action=accueil');
            exit();
        }
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        if (!isset($_GET['parPage'])) {
            $_GET['parPage'] = 10;
        }
        $page = $_GET['page'];
        $parPage = $_GET['parPage'];
        if ($page < 1) {
            $messageErreur = "La page " . $page . " n'existe pas.";
            include 'views/utilisateur/adminAfficherEvenementsUtilisateursVue.php';
            exit();
        }
        // On récupère tous les utilisateurs
        $evenements = modelUtilisateur::getEvenementsTousUtilisateurs($page, $parPage);
        if ($page == 1) {
            if (empty($evenements)) {
                $messageErreur = "Il n'y a aucun événement à afficher.";
            }
        }
        else if ($page > 1) {
            if (empty($evenements)) {
                $messageErreur = "Il n'y a aucun événement à afficher pour la page " . $page . ".";
            }
        }
        // Afficher la vue
        include 'views/utilisateur/adminAfficherEvenementsUtilisateursVue.php';
    }


}  
