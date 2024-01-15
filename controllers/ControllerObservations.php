<?php

require 'models/modelObservations.php';

class ControllerObservations {

    private $observationsParPage = 10;


    private function estAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    private function estProprietaireObservation($id_observation) {
        $observation = modelObservations::obtenirObservationParId($id_observation);
        return $observation && $observation['identifiant_utilisateur'] === $_SESSION['identifiant_utilisateur'];
    }

    public function afficherToutesLesObservations() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalObservations = modelObservations::compterObservations();
        $nombreDePages = ceil($totalObservations / $this->observationsParPage);
        $observations = modelObservations::obtenirObservations($page, $this->observationsParPage);

        include 'views/observations/afficherToutesLesObservationsVue.php';
    }

    public function afficherMesObservations() {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            header('Location: ?action=seconnecter');
            exit();
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $totalObservations = modelObservations::compterObservationsParUtilisateur($identifiant_utilisateur);
        $nombreDePages = ceil($totalObservations / $this->observationsParPage);
        $observations = modelObservations::obtenirObservationsParUtilisateur($identifiant_utilisateur, $page, $this->observationsParPage);

        include 'views/observations/afficherMesObservationsVue.php';
    }

    public function afficherObservation($id_observation) {
        $observation = modelObservations::obtenirObservationParId($id_observation);
        include 'views/observations/afficherObservationVue.php';
    }

    public function ajouterObservation() {
        // Afficher le formulaire d'ajout d'une observation
        include 'views/observations/ajouterObservationVue.php';
    }

    public function enregistrerObservation() {
        $id_espece = $_POST['id_espece'];
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $date_observation = $_POST['date_observation'];
        $pays_observation = $_POST['pays_observation'];
        $ville_observation = $_POST['ville_observation'];
        $commentaire = $_POST['commentaire'];
        if (isset($_POST['interne']) && $_POST['interne'] === 'on') {
            $interne = 1;
        } else {
            $interne = 0;
        }   

        // Gestion de l'image
        $photo_observation = null;
        if (isset($_FILES['photo_observation']) && $_FILES['photo_observation']['error'] == UPLOAD_ERR_OK) {
            $photo_observation = file_get_contents($_FILES['photo_observation']['tmp_name']);
        }

        modelObservations::ajouterObservation($id_espece, $identifiant_utilisateur, $date_observation, $pays_observation, $ville_observation, $commentaire, $interne, $photo_observation);
        header('Location: ?action=afficherMesObservations');
    }

    public function modifierObservation() {
        $id_observation = $_GET['id'];
        if (!$this->estProprietaireObservation($id_observation) && !$this->estAdmin()) {
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
            exit ();
        }

        $observation = modelObservations::obtenirObservationParId($id_observation);
        include 'views/observations/modifierObservationVue.php';
    }

    public function miseAJourObservation() {
        $id_observation = $_GET['id'];
        if (!$this->estProprietaireObservation($id_observation) && !$this->estAdmin()) {
            // Gérer l'accès non autorisé
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
            exit ();
        }

        // Collecter les données du formulaire
        $id_espece = $_POST['id_espece'];
        $date_observation = $_POST['date_observation'];
        $pays_observation = $_POST['pays_observation'];
        $ville_observation = $_POST['ville_observation'];
        $commentaire = $_POST['commentaire'];
        $interne = isset($_POST['interne']) && $_POST['interne'] === 'on' ? 1 : 0;
        $photo_observation = null;
        if (isset($_FILES['photo_observation']) && $_FILES['photo_observation']['error'] == UPLOAD_ERR_OK) {
            $photo_observation = file_get_contents($_FILES['photo_observation']['tmp_name']);
        }
        // Appel au modèle pour mettre à jour l'observation
        modelObservations::mettreAJourObservation($id_observation, $id_espece, $date_observation, $pays_observation, $ville_observation, $commentaire, $interne, $photo_observation);
        header('Location: ?action=afficherMesObservations');
    }

    public function supprimerObservation() {
        $id_observation = $_GET['id'];
        if (!$this->estProprietaireObservation($id_observation) && !$this->estAdmin()) {
            // Gérer l'accès non autorisé
            $error = 'Vous n\'avez pas la permission de supprimer cette naturothèque.';
            include 'views/errors/error.php';
            exit ();
        }

        modelObservations::supprimerObservation($id_observation);
        header('Location: ?action=afficherMesObservations');
    }

    public function detailsObservation() {
        $id_observation = $_GET['id'];
        $observation = modelObservations::obtenirObservationParId($id_observation);
        include 'views/observations/detailsObservationVue.php';
    }

    public function rechercherObservations() {
        $id_espece = isset($_GET['id_espece']) ? $_GET['id_espece'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalObservations = modelObservations::compterObservations();
        $nombreDePages = ceil($totalObservations / $this->observationsParPage);
        $observations = modelObservations::rechercherObservationsParIdEspece($id_espece, $page, $this->observationsParPage);

        include 'views/observations/rechercherObservationVue.php';
    }

    public function rechercherMesObservations() {
        $id_espece = isset($_GET['id_espece']) ? $_GET['id_espece'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $totalObservations = modelObservations::compterObservationsParUtilisateur($identifiant_utilisateur);
        $nombreDePages = ceil($totalObservations / $this->observationsParPage);
        $observations = modelObservations::rechercherObservationsParIdEspeceEtUtilisateur($id_espece, $identifiant_utilisateur, $page, $this->observationsParPage);

        include 'views/observations/rechercherMesObservationsVue.php';
    }

    public function adminAfficherEvenementsObservations() {
        if (!$this->estAdmin()) {
            $error = 'Vous n\'avez pas la permission d\'accéder à cette page.';
            include 'views/errors/error.php';
            exit ();
        }
        else {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalObservations = modelObservations::compterEvenementsToutesObservations();
            $nombreDePages = ceil($totalObservations / $this->observationsParPage);
            $evenements = modelObservations::getEvenementsToutesObservations($page, $this->observationsParPage);
            $messageErreur = 'Il n\'y a pas d\'événements à afficher.';
            include 'views/observations/adminAfficherEvenementsObservationsVue.php';
        }
    }        
}
