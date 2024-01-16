<?php 

require 'models/modelNaturotheques.php';

class ControllerNaturotheques {
    private $naturothequesParPage = 10;

    private function estAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    private function estProprietaireNaturotheque($id_naturotheque) {
        $naturotheque = modelNaturotheques::obtenirNaturothequeParId($id_naturotheque);
        if (isset($_SESSION['identifiant_utilisateur'])){
            return $naturotheque && $naturotheque['identifiant_utilisateur'] == $_SESSION['identifiant_utilisateur'];
        }
    }

    public function afficherToutesLesNaturotheques() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalNaturotheques = modelNaturotheques::compterNaturotheques();
        $nombreDePages = ceil($totalNaturotheques / $this->naturothequesParPage);
        $naturotheques = modelNaturotheques::obtenirNaturotheques($page, $this->naturothequesParPage);
        include 'views/naturotheques/afficherToutesLesNaturothequesVue.php';
    }

    public function afficherMesNaturotheques() {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $totalNaturotheques = modelNaturotheques::compterNaturothequesParUtilisateur($identifiant_utilisateur);
        $nombreDePages = ceil($totalNaturotheques / $this->naturothequesParPage);
        $naturotheques = modelNaturotheques::obtenirNaturothequesParUtilisateur($identifiant_utilisateur, $page, $this->naturothequesParPage);
        include 'views/naturotheques/afficherMesNaturothequesVue.php';
    }

    public function detailsNaturotheque() {
        $id = $_GET['id'];
        $naturotheque = modelNaturotheques::obtenirNaturothequeParId($id);
        include 'views/naturotheques/detailsNaturothequeVue.php';
    }

    public function ajouterNaturotheque() {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        include 'views/naturotheques/ajouterNaturothequeVue.php';
    }

    public function ajoutNaturothequeBDD() {
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $photo_naturotheque = null;
        if (isset($_FILES['photo_naturotheque']) && $_FILES['photo_naturotheque']['error'] === UPLOAD_ERR_OK) {
            $photo_naturotheque = file_get_contents($_FILES['photo_naturotheque']['tmp_name']);
        }
        modelNaturotheques::ajouterNaturotheque($identifiant_utilisateur, $nom, $description, $photo_naturotheque);
        $this->afficherMesNaturotheques();
    }

    public function modifierNaturotheque() {
        $id = $_GET['id'];
        if ($this->estProprietaireNaturotheque($id) || $this->estAdmin()) {
            $naturotheque = modelNaturotheques::obtenirNaturothequeParId($id);
            include 'views/naturotheques/modifierNaturothequeVue.php';
        } else {
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function modificationNaturothequeBDD() {
        $id = $_POST['id'];
        if ($this->estProprietaireNaturotheque($id) || $this->estAdmin()) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $photo_naturotheque = file_get_contents($_FILES['photo_naturotheque']['tmp_name']) ?? null;
            modelNaturotheques::mettreAJourNaturotheque($id, $nom, $description, $photo_naturotheque);
            // Rediriger vers une page appropriée après la mise à jour
            header('Location: ?action=afficherMesNaturotheques');
        } else {
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function supprimerNaturotheque() {
        $id = $_GET['id'];
        if ($this->estProprietaireNaturotheque($id) || $this->estAdmin()) {
            modelNaturotheques::supprimerNaturotheque($id);
            // Redirection appropriée
            header('Location: ?action=afficherMesNaturotheques');
        } else {
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function rechercherNaturotheques() {
        $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
        $totalResultats = modelNaturotheques::compterNaturothequesParNom($nom);
        $nombreDePages = ceil($totalResultats / $this->naturothequesParPage);
        
        $naturotheques = modelNaturotheques::rechercherNaturothequesParNom($nom, $page, $this->naturothequesParPage);
        include 'views/naturotheques/rechercherNaturothequesVue.php';
    }

    public function ajoutEspeceANaturothequeBDD() {
        $id_naturotheque = $_POST['id_naturotheque'];
        $id_espece = $_POST['id_espece'];
        modelNaturotheques::ajouterEspeceANaturotheque($id_naturotheque, $id_espece);
        header('Location: ?action=afficherMesNaturotheques');
    }

    public function ajouterEspeceANaturothequeConfirmation() {
        $id_espece = $_GET['id_espece'];
        $id_naturotheque = $_GET['id_naturotheque'];
        $interne = $_GET['interne'] === 'TRUE' ? 1 : 0;
        if ($this->estProprietaireNaturotheque($id_naturotheque) || $this->estAdmin()) {
            $resultat = modelNaturotheques::ajouterEspeceANaturotheque($id_naturotheque, $id_espece, $interne);
            $message = "L'espèce a bien été ajoutée à la naturothèque.";
            header('Location: ?action=afficherMesNaturotheques');
        } else {
            $error = 'Vous n\'avez pas la permission d\'ajouter une espèce à cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function supprimerEspeceDeNaturotheque() {
        $id_espece = $_GET['id_espece'];
        $id_naturotheque = $_GET['id_naturotheque'];
        if ($this->estProprietaireNaturotheque($id_naturotheque) || $this->estAdmin()) {
            $resultat = modelNaturotheques::supprimerEspeceDeNaturotheque($id_naturotheque, $id_espece);
            $message = "L'espèce a bien été supprimée de la naturothèque.";
            header('Location: ?action=afficherMesNaturotheques');
        } else {
            $error = 'Vous n\'avez pas la permission de supprimer une espèce de cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function afficherNaturotheque() {
        $id = $_GET['id'];
        $naturotheque = modelNaturotheques::obtenirNaturothequeParId($id);
        $especes = modelNaturotheques::obtenirEspecesParNaturotheque($id);
        include 'views/naturotheques/afficherNaturothequeVue.php';
    }

    public function afficherEspecesNaturotheque() {
        if ($this->estAdmin()) {
            $id = $_GET['id'];
            $naturotheque = modelNaturotheques::obtenirNaturothequeParId($id);
            $especes = modelNaturotheques::obtenirEspecesParNaturotheque($id);
            include 'views/naturotheques/afficherEspecesNaturothequeVue.php';
        } else {
            $error = 'Vous n\'avez pas la permission d\'afficher les espèces de cette naturothèque.';
            include 'views/errors/error.php';
        }
    }

    public function adminAfficherEvenementsNaturotheques() {
        if ($this->estAdmin()) {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalEvenements = modelNaturotheques::compterEvenementsToutesNaturotheques();
            $nombreDePages = ceil($totalEvenements / $this->naturothequesParPage);
            $evenements = modelNaturotheques::getEvenementsToutesNaturotheques($page, $this->naturothequesParPage);
            include 'views/naturotheques/adminAfficherEvenementsNaturothequesVue.php';
            $messageErreur = '';
        } else {
            $messageErreur = 'Vous n\'avez pas la permission d\'afficher les événements des naturothèques.';
            include 'views/errors/error.php';
        }
    }
    
}
