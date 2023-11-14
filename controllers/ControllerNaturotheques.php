<?php 

require 'models/modelNaturotheques.php';

class ControllerNaturotheques{
    public function afficherToutesLesNaturotheques(){
        // Récupérer les naturothèques
        $naturotheques = modelNaturotheques::getNaturotheques();
        // Afficher la vue de toutes les naturothèques
        include 'views/naturotheques/afficherToutesLesNaturothequesVue.php';
    }

    public function detailsNaturotheque(){
        // Récupérer les informations de la naturothèque
        $id = $_GET['id'];
        $nom = modelNaturotheques::getAttributParId('nom', $id);
        $description = modelNaturotheques::getAttributParId('description', $id);
        $dateCreation = modelNaturotheques::getAttributParId('dateCreation', $id);
        $dateDerniereModification = modelNaturotheques::getAttributParId('dateDerniereModification', $id);
        $identifiant_utilisateur = modelNaturotheques::getAttributParId('identifiant_utilisateur', $id);
        $utilisateur = modelNaturotheques::getAttributParId('identifiant_utilisateur', $identifiant_utilisateur);
        // Afficher la vue des détails de la naturothèque
        include 'views/naturotheques/detailsNaturothequeVue.php';
    }

    public function afficherMesNaturotheques(){
        // Récupérer les naturothèques de l'utilisateur
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        $ids = modelNaturotheques::getIdsNaturothequesParIdentifiantUtilisateur($identifiant_utilisateur);
        foreach ($ids as $id) {
            $naturotheques[] = [
                'id_naturotheque' => $id['id_naturotheque'],
                'nom' => modelNaturotheques::getAttributParId('nom', $id['id_naturotheque']),
                'description' => modelNaturotheques::getAttributParId('description', $id['id_naturotheque']),
                'dateCreation' => modelNaturotheques::getAttributParId('dateCreation', $id['id_naturotheque']),
                'dateDerniereModification' => modelNaturotheques::getAttributParId('dateDerniereModification', $id['id_naturotheque']),
                'identifiant_utilisateur' => modelNaturotheques::getAttributParId('identifiant_utilisateur', $id['id_naturotheque']),
                'utilisateur' => modelNaturotheques::getAttributParId('identifiant_utilisateur', modelNaturotheques::getAttributParId('identifiant_utilisateur', $id['id_naturotheque']))
            ];
        }
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        include 'views/naturotheques/afficherMesNaturothequesVue.php';
    }

    public function ajouterNaturotheque(){
        // Si l'utilisateur n'est pas connecté, afficher la vue de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            include 'views/utilisateurs/connexionVue.php';
            return;
        } else {
            // Sinon, afficher la vue d'ajout d'une naturothèque
            include 'views/naturotheques/ajouterNaturothequeVue.php';
        }
    }

    public function ajoutNaturothequeBDD(){
        // Si l'utilisateur n'est pas connecté, afficher la vue de connexion
        if (!isset($_SESSION['identifiant_utilisateur'])) {
            include 'views/utilisateurs/connexionVue.php';
            return;
        }else {
        // Récupérer les informations de la naturothèque
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        // Le format de date est YYYY-MM-DD parce que c'est le format de date accepté par MySQL
        $identifiant_utilisateur = $_SESSION['identifiant_utilisateur'];
        // Ajouter la naturothèque à la base de données
        $resultat = modelNaturotheques::addNaturothequeBDD($identifiant_utilisateur, $nom, $description);
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        $this->afficherMesNaturotheques();
        }
    }

    public function supprimerNaturotheque(){
        // Récupérer l'id de la naturothèque
        $id = $_GET['id'];
        // Supprimer la naturothèque de la base de données
        $resultat = modelNaturotheques::deleteNaturothequeBDD($id);
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        $this->afficherMesNaturotheques();
    }

    public function modifierNaturotheque(){
        // Récupérer les informations de la naturothèque
        $id = $_GET['id'];
        $nom = modelNaturotheques::getAttributParId('nom', $id);
        $description = modelNaturotheques::getAttributParId('description', $id);
        $dateCreation = modelNaturotheques::getAttributParId('dateCreation', $id);
        $dateDerniereModification = modelNaturotheques::getAttributParId('dateDerniereModification', $id);
        $identifiant_utilisateur = modelNaturotheques::getAttributParId('identifiant_utilisateur', $id);
        $utilisateur = modelUtilisateur::getAttributParId('identifiant', $identifiant_utilisateur);
        // Afficher la vue de modification de la naturothèque
        include 'views/naturotheques/modifierNaturothequeVue.php';
    }

    public function modificationNaturotheque(){
        // Récupérer les informations de la naturothèque
        $id = $_GET['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $dateCreation = modelNaturotheques::getAttributParId('dateCreation', $id);
        $dateDerniereModification = date("Y-m-d");
        $identifiant_utilisateur = modelNaturotheques::getAttributParId('identifiant_utilisateur', $id);
        // Modifier la naturothèque dans la base de données
        $resultat = modelNaturotheques::updateNaturothequeBDD($id, $nom, $description, $dateCreation, $dateDerniereModification, $identifiant_utilisateur);
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        $this->afficherMesNaturotheques();
    }
}