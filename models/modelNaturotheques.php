<?php

require_once 'database.php';

class modelNaturotheques{
    public static function getAttributParId($attribut, $identifiant_utilisateur){
        $query = "SELECT $attribut FROM naturotheques WHERE identifiant_utilisateur = :identifiant_utilisateur";
        $values = array(
            ':identifiant_utilisateur' => $identifiant_utilisateur
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat[0][$attribut] ?? null;
    }

    public static function getNaturotheques(){
        $query = "SELECT * FROM naturotheques";
        $resultat = database::prepareEtExecute($query);
        return $resultat;
    }

    public static function getNaturothequesParIdentifiantUtilisateur($identifiant_utilisateur){
        $query = "SELECT * FROM naturotheques WHERE id_utilisateur = :identifiant_utilisateur";
        $values = array(
            ':identifiant_utilisateur' => $identifiant_utilisateur
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function getIdsNaturothequesParIdentifiantUtilisateur($identifiant_utilisateur){
        $query = "SELECT id_naturotheque FROM naturotheques WHERE identifiant_utilisateur = :identifiant_utilisateur";
        $values = array(
            ':identifiant_utilisateur' => $identifiant_utilisateur
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function addNaturothequeBDD($identifiant_utilisateur, $nom, $description){
        $query = "INSERT INTO naturotheques (identifiant_utilisateur, nom, description, nombre_especes) VALUES (:identifiant_utilisateur, :nom, :description, :nombre_especes)";
        $values = array(
            ':identifiant_utilisateur' => $identifiant_utilisateur,
            ':nom' => $nom,
            ':description' => $description,
            ':nombre_especes' => 0
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function deleteNaturothequeBDD($id_naturotheque){
        $query = "DELETE FROM Naturotheques WHERE id_naturotheque = :id_naturotheque";
        $values = array(
            ':id_naturotheque' => $id_naturotheque
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }



    // Vu qu'il faut faire une jointure entre les tables naturotheques et utilisateurs et especesNaturotheques pour insérer une ligne dans especesNaturotheques, il faut faire une requête SQL avec une sous-requête
    public static function addEspeceToNaturotheque($id_espece, $id_naturotheque){
        $query = "INSERT INTO EspecesNaturotheques (id_espece, id_naturotheque) VALUES (:id_espece, :id_naturotheque)";
        $values = array(
            ':id_espece' => $id_espece,
            ':id_naturotheque' => $id_naturotheque
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function updateNaturothequeBDD($id_naturotheque, $nom, $description){
        $query = "UPDATE Naturotheques SET nom = :nom, description = :description WHERE id_naturotheque = :id_naturotheque";
        $values = array(
            ':id_naturotheque' => $id_naturotheque,
            ':nom' => $nom,
            ':description' => $description
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }
    
    public static function deleteEspeceFromNaturothequeBDD($id_espece, $id_naturotheque){
        $query = "DELETE FROM EspecesNaturotheques WHERE id_espece = :id_espece AND id_naturotheque = :id_naturotheque";
        $values = array(
            ':id_espece' => $id_espece,
            ':id_naturotheque' => $id_naturotheque
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

}