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
        $idUtilisateur = modelNaturotheques::getAttributParId('idUtilisateur', $id);
        $utilisateur = modelUtilisateur::getAttributParId('identifiant', $idUtilisateur);
        // Afficher la vue des détails de la naturothèque
        include 'views/naturotheques/detailsNaturothequeVue.php';
    }

    public function afficherMesNaturotheques(){
        // Récupérer les naturothèques de l'utilisateur
        $idUtilisateur = $_SESSION['identifiant_utilisateur'];
        $ids = modelNaturotheques::getIdsNaturothequesParIdentifiantUtilisateur($idUtilisateur);
        foreach ($ids as $id) {
            $naturotheques[] = [
                'id' => $id['id'],
                'nom' => modelNaturotheques::getAttributParId('nom', $id['id']),
                'description' => modelNaturotheques::getAttributParId('description', $id['id']),
                'dateCreation' => modelNaturotheques::getAttributParId('dateCreation', $id['id']),
                'dateDerniereModification' => modelNaturotheques::getAttributParId('dateDerniereModification', $id['id']),
                'idUtilisateur' => modelNaturotheques::getAttributParId('idUtilisateur', $id['id']),
                'utilisateur' => modelUtilisateur::getAttributParId('identifiant', modelNaturotheques::getAttributParId('idUtilisateur', $id['id']))
            ];
        }
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        include 'views/naturotheques/afficherMesNaturothequesVue.php';
    }

    public function ajouterNaturotheque(){
        // Afficher la vue d'ajout d'une naturothèque
        include 'views/naturotheques/ajouterNaturothequeVue.php';
    }

    public function ajoutNaturothequeBDD(){
        // Récupérer les informations de la naturothèque
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $dateCreation = date("Y-m-d");
        // Le format de date est YYYY-MM-DD parce que c'est le format de date accepté par MySQL
        $dateDerniereModification = date("Y-m-d");
        $idUtilisateur = $_SESSION['identifiant_utilisateur'];
        // Ajouter la naturothèque à la base de données
        $resultat = modelNaturotheques::addNaturothequeBDD($nom, $description, $dateCreation, $dateDerniereModification, $idUtilisateur);
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        $this->afficherMesNaturotheques();
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
        $idUtilisateur = modelNaturotheques::getAttributParId('idUtilisateur', $id);
        $utilisateur = modelUtilisateur::getAttributParId('identifiant', $idUtilisateur);
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
        $idUtilisateur = modelNaturotheques::getAttributParId('idUtilisateur', $id);
        // Modifier la naturothèque dans la base de données
        $resultat = modelNaturotheques::updateNaturothequeBDD($id, $nom, $description, $dateCreation, $dateDerniereModification, $idUtilisateur);
        // Afficher la vue de toutes les naturothèques de l'utilisateur
        $this->afficherMesNaturotheques();
    }
}