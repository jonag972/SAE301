<?php

require_once 'database.php';

class modelNaturotheques {

    public static function obtenirNaturothequeParId($id_naturotheque) {
        $query = "SELECT * FROM naturotheques WHERE id_naturotheque = :id_naturotheque";
        $values = array(':id_naturotheque' => $id_naturotheque);
        $resultat = database::prepareEtExecute($query, $values);
    
        // Vérifier si le résultat n'est pas vide avant d'accéder à l'index 0
        return !empty($resultat) ? $resultat[0] : null;
    }

    public static function obtenirNaturotheques($page, $naturothequesParPage) {
        $debut = ($page - 1) * $naturothequesParPage;
        $query = "SELECT * FROM naturotheques LIMIT :debut, :naturothequesParPage";
        
        return database::prepareExecuteBind($query, array(
            ':debut' => $debut, 
            ':naturothequesParPage' => $naturothequesParPage
        ));
    }
       

    public static function compterNaturotheques() {
        $query = "SELECT COUNT(*) AS count FROM naturotheques";
        $resultat = database::prepareEtExecute($query);
    
        // Vérifier si le résultat n'est pas vide avant d'accéder à l'index 0
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function compterNaturothequesParUtilisateur($identifiant_utilisateur) {
        $query = "SELECT COUNT(*) AS count FROM naturotheques WHERE identifiant_utilisateur = :identifiant_utilisateur";
        $values = array(':identifiant_utilisateur' => $identifiant_utilisateur);
        $resultat = database::prepareEtExecute($query, $values);

        // Vérifier si le résultat n'est pas vide avant d'accéder à l'index 0
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function obtenirNaturothequesParUtilisateur($identifiant_utilisateur, $page, $naturothequesParPage) {
        $debut = ($page - 1) * $naturothequesParPage;
        $query = "SELECT * FROM naturotheques WHERE identifiant_utilisateur = :identifiant_utilisateur LIMIT :debut, :naturothequesParPage";
        
        return database::prepareExecuteBind($query, array(
            ':identifiant_utilisateur' => $identifiant_utilisateur,
            ':debut' => $debut, 
            ':naturothequesParPage' => $naturothequesParPage
        ));
    }    

    public static function ajouterNaturotheque($identifiant_utilisateur, $nom, $description, $photo_naturotheque) {
        $query = "INSERT INTO naturotheques (identifiant_utilisateur, nom, description, photo_naturotheque) VALUES (:identifiant_utilisateur, :nom, :description, :photo_naturotheque)";
        $values = array(':identifiant_utilisateur' => $identifiant_utilisateur, ':nom' => $nom, ':description' => $description, ':photo_naturotheque' => $photo_naturotheque);
        return database::prepareEtExecute($query, $values);
    }

    public static function mettreAJourNaturotheque($id_naturotheque, $nom, $description, $photo_naturotheque) {
        $query = "UPDATE naturotheques SET nom = :nom, description = :description, photo_naturotheque = :photo_naturotheque WHERE id_naturotheque = :id_naturotheque";
        $values = array(':id_naturotheque' => $id_naturotheque, ':nom' => $nom, ':description' => $description, ':photo_naturotheque' => $photo_naturotheque);
        return database::prepareEtExecute($query, $values);
    }

    public static function supprimerNaturotheque($id_naturotheque) {
        $query = "DELETE FROM naturotheques WHERE id_naturotheque = :id_naturotheque";
        $values = array(':id_naturotheque' => $id_naturotheque);
        return database::prepareEtExecute($query, $values);
    }

    // A rajouter pour obtenir les naturotheques par espece grace a la jointure entre les tables naturotheques et especenaturotheques

    public static function rechercherNaturothequesParNom($nom, $page, $naturothequesParPage) {
        $debut = ($page - 1) * $naturothequesParPage;
        $query = "SELECT * FROM naturotheques WHERE nom LIKE :nom LIMIT :debut, :naturothequesParPage";
        
        return database::prepareExecuteBind($query, array(
            ':nom' => '%' . $nom . '%',
            ':debut' => $debut, 
            ':naturothequesParPage' => $naturothequesParPage
        ));
    }
    
    public static function compterNaturothequesParNom($nom) {
        $query = "SELECT COUNT(*) AS count FROM naturotheques WHERE nom LIKE :nom";
        $values = array(':nom' => '%' . $nom . '%');
        $resultat = database::prepareEtExecute($query, $values);
    
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function ajouterEspeceANaturotheque($id_naturotheque, $id_espece, $interne) {
        $query = "INSERT INTO especesnaturotheque (id_naturotheque, id_espece, interne, identifiant_utilisateur) 
                    VALUES (:id_naturotheque, :id_espece, :interne, :identifiant_utilisateur)";
        $values = array(':id_naturotheque' => $id_naturotheque, ':id_espece' => $id_espece, ':interne' => $interne, ':identifiant_utilisateur' => $_SESSION['identifiant_utilisateur']);
        return database::prepareEtExecute($query, $values);
    }

    public static function supprimerEspeceDeNaturotheque($id_naturotheque, $id_espece) {
        $query = "DELETE FROM especesnaturotheque WHERE id_naturotheque = :id_naturotheque AND id_espece = :id_espece";
        $values = array(':id_naturotheque' => $id_naturotheque, ':id_espece' => $id_espece);
        return database::prepareEtExecute($query, $values);
    }

    public static function obtenirEspeceDeNaturotheque($id_naturotheque, $id_espece) {
        $query = "SELECT * FROM especesnaturotheque WHERE id_naturotheque = :id_naturotheque AND id_espece = :id_espece";
        $values = array(':id_naturotheque' => $id_naturotheque, ':id_espece' => $id_espece);
        $resultat = database::prepareEtExecute($query, $values);
    
        return !empty($resultat) ? $resultat[0] : null;
    }

    public static function getEvenementsToutesNaturotheques($page, $nombreParPage) {
        $offset = ($page - 1) * $nombreParPage;
        // On prépare la requête SQL pour récupérer l'historique de tous les utilisateurs en groupant par date de modification
        $query = "SELECT * FROM Historique_Naturotheques GROUP BY date_modification ORDER BY date_modification DESC LIMIT :offset, :nombreParPage";
        $values = array(':offset' => $offset, ':nombreParPage' => $nombreParPage);
        return database::prepareExecuteBind($query, $values);
    }

    public static function compterEvenementsToutesNaturotheques() {
        $query = "SELECT COUNT(*) AS count FROM Historique_Naturotheques GROUP BY date_modification";
        $resultat = database::prepareEtExecute($query);
    
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }
    
    
}
