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

    public static function ajouterNaturotheque($identifiant_utilisateur, $nom, $description) {
        $query = "INSERT INTO naturotheques (identifiant_utilisateur, nom, description) VALUES (:identifiant_utilisateur, :nom, :description)";
        $values = array(':identifiant_utilisateur' => $identifiant_utilisateur, ':nom' => $nom, ':description' => $description);
        return database::prepareEtExecute($query, $values);
    }

    public static function mettreAJourNaturotheque($id_naturotheque, $nom, $description) {
        $query = "UPDATE naturotheques SET nom = :nom, description = :description, dateDerniereModification = NOW() WHERE id_naturotheque = :id_naturotheque";
        $values = array(':id_naturotheque' => $id_naturotheque, ':nom' => $nom, ':description' => $description);
        return database::prepareEtExecute($query, $values);
    }

    public static function supprimerNaturotheque($id_naturotheque) {
        $query = "DELETE FROM naturotheques WHERE id_naturotheque = :id_naturotheque";
        $values = array(':id_naturotheque' => $id_naturotheque);
        return database::prepareEtExecute($query, $values);
    }

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
    
    
}
