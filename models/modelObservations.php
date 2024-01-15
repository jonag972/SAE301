<?php

require_once 'database.php';

class modelObservations {

    public static function obtenirObservationParId($id_observation) {
        $query = "SELECT * FROM Observations WHERE id_observation = :id_observation";
        $values = array(':id_observation' => $id_observation);
        $resultat = database::prepareEtExecute($query, $values);
        return !empty($resultat) ? $resultat[0] : null;
    }

    public static function obtenirObservations($page, $observationsParPage) {
        $debut = ($page - 1) * $observationsParPage;
        $query = "SELECT * FROM Observations LIMIT :debut, :observationsParPage";
        return database::prepareExecuteBind($query, array(
            ':debut' => $debut, 
            ':observationsParPage' => $observationsParPage
        ));
    }

    public static function compterObservations() {
        $query = "SELECT COUNT(*) AS count FROM Observations";
        $resultat = database::prepareEtExecute($query);
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function compterObservationsParUtilisateur($identifiant_utilisateur) {
        $query = "SELECT COUNT(*) AS count FROM Observations WHERE identifiant_utilisateur = :identifiant_utilisateur";
        $values = array(':identifiant_utilisateur' => $identifiant_utilisateur);
        $resultat = database::prepareEtExecute($query, $values);
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function obtenirObservationsParUtilisateur($identifiant_utilisateur, $page, $observationsParPage) {
        $debut = ($page - 1) * $observationsParPage;
        $query = "SELECT * FROM Observations WHERE identifiant_utilisateur = :identifiant_utilisateur LIMIT :debut, :observationsParPage";
        return database::prepareExecuteBind($query, array(
            ':identifiant_utilisateur' => $identifiant_utilisateur,
            ':debut' => $debut, 
            ':observationsParPage' => $observationsParPage
        ));
    }    

    public static function ajouterObservation($id_espece, $identifiant_utilisateur, $date_observation, $pays_observation, $ville_observation, $commentaire, $interne, $photo_observation) {
        $query = "INSERT INTO Observations (id_espece, identifiant_utilisateur, date_observation, pays_observation, ville_observation, commentaire, interne, photo_observation) VALUES (:id_espece, :identifiant_utilisateur, :date_observation, :pays_observation, :ville_observation, :commentaire, :interne, :photo_observation)";
        $values = array(':id_espece' => $id_espece, ':identifiant_utilisateur' => $identifiant_utilisateur, ':date_observation' => $date_observation, ':pays_observation' => $pays_observation, ':ville_observation' => $ville_observation, ':commentaire' => $commentaire, ':interne' => $interne, ':photo_observation' => $photo_observation);
        return database::prepareEtExecute($query, $values);
    }    

    public static function mettreAJourObservation($id_observation, $id_espece, $date_observation, $pays_observation, $ville_observation, $commentaire, $interne, $photo_observation) {
        $query = "UPDATE Observations SET id_espece = :id_espece, date_observation = :date_observation, pays_observation = :pays_observation, ville_observation = :ville_observation, commentaire = :commentaire, interne = :interne, photo_observation = :photo_observation WHERE id_observation = :id_observation";
        $values = array(':id_observation' => $id_observation, ':id_espece' => $id_espece, ':date_observation' => $date_observation, ':pays_observation' => $pays_observation, ':ville_observation' => $ville_observation, ':commentaire' => $commentaire, ':interne' => $interne, ':photo_observation' => $photo_observation);
        return database::prepareEtExecute($query, $values);
    }

    public static function supprimerObservation($id_observation) {
        $query = "DELETE FROM Observations WHERE id_observation = :id_observation";
        $values = array(':id_observation' => $id_observation);
        return database::prepareEtExecute($query, $values);
    }
    
    public static function obtenirObservationsParEspece($id_espece, $interne) {
        $query = "SELECT * FROM Observations WHERE id_espece = :id_espece AND interne = :interne";
        $values = array(':id_espece' => $id_espece, ':interne' => $interne);
        return database::prepareEtExecute($query, $values);
    }

    public static function rechercherObservationsParIdEspece($id_espece, $page, $observationsParPage) {
        $debut = ($page - 1) * $observationsParPage;
        $query = "SELECT * FROM Observations WHERE id_espece = :id_espece LIMIT :debut, :observationsParPage";
        return database::prepareExecuteBind($query, array(
            ':id_espece' => $id_espece,
            ':debut' => $debut, 
            ':observationsParPage' => $observationsParPage
        ));
    }

    public static function rechercherObservationsParIdentifiantUtilisateur($identifiant_utilisateur, $page, $observationsParPage) {
        $debut = ($page - 1) * $observationsParPage;
        $query = "SELECT * FROM Observations WHERE identifiant_utilisateur LIKE :identifiant_utilisateur LIMIT :debut, :observationsParPage";
        return database::prepareExecuteBind($query, array(
            ':identifiant_utilisateur' => $identifiant_utilisateur,
            ':debut' => $debut, 
            ':observationsParPage' => $observationsParPage
        ));
    }

    public static function compterObservationsParNom($nom) {
        $query = "SELECT COUNT(*) AS count FROM Observations WHERE commentaire LIKE :nom";
        $values = array(':nom' => '%' . $nom . '%');
        $resultat = database::prepareEtExecute($query, $values);
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }

    public static function getEvenementsToutesObservations($page, $nombreParPage) {
        $offset = ($page - 1) * $nombreParPage;
        $query = "SELECT * FROM Historique_Observations GROUP BY date_modification ORDER BY date_modification DESC LIMIT :offset, :nombreParPage";
        $values = array(':offset' => $offset, ':nombreParPage' => $nombreParPage);
        return database::prepareExecuteBind($query, $values);
    }

    public static function compterEvenementsToutesObservations() {
        $query = "SELECT COUNT(*) AS count FROM Historique_Observations GROUP BY date_modification";
        $resultat = database::prepareEtExecute($query);
        return !empty($resultat) ? $resultat[0]['count'] : 0;
    }
}
