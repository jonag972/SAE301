<?php
require_once 'database.php';
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}

class ModelUtilisateur {
    public static function getAttributUtilisateurParIdentifiant($attribut, $identifiant_utilisateur) {
            // On prépare la requête SQL pour récupérer un attribut d'un utilisateur à partir de son identifiant
            $query = "SELECT $attribut FROM Utilisateurs WHERE identifiant_utilisateur = :identifiant";
            // On prépare les valeurs à utiliser dans la requête SQL
            $values = array(
                ':identifiant' => $identifiant_utilisateur
            );
            // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
            $resultat = database::prepareEtExecute($query, $values);
            // On retourne la résultat à l'utilisateur si elle existe ou null
            return $resultat ? $resultat[0][$attribut] : NULL;
    }

    public static function modifierAttributUtilisateurParIdentifiant($attribut, $valeur, $identifiant_utilisateur) {
        // On prépare la requête SQL pour modifier un attribut d'un utilisateur à partir de son identifiant
        $query = "UPDATE Utilisateurs SET $attribut = :valeur WHERE identifiant_utilisateur = :identifiant";
        // On prépare les valeurs à utiliser dans la requête SQL
        $values = array(
            ':valeur' => $valeur,
            ':identifiant' => $identifiant_utilisateur
        );
        // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
        database::prepareEtExecute($query, $values);
    }

    public static function ajouterUtilisateur($identifiant_utilisateur, $mot_de_passe, $email,  $prenom, $nom_de_famille, $age, $pays, $abonnement, $role, $photo_de_profil) {
        // On prépare la requête SQL pour ajouter un utilisateur
        $query = "INSERT INTO Utilisateurs (identifiant_utilisateur, photo_de_profil, mot_de_passe, email, prenom, nom_de_famille, age, pays, abonnement, role) VALUES (:identifiant_utilisateur, :photo_de_profil, :mot_de_passe, :email, :prenom, :nom_de_famille, :age, :pays, :abonnement, :role)";
        // On prépare les valeurs à utiliser dans la requête SQL
        $values = array(
            ':identifiant_utilisateur' => $identifiant_utilisateur,
            ':photo_de_profil' => $photo_de_profil,
            ':mot_de_passe' => $mot_de_passe,
            ':email' => $email,
            ':prenom' => $prenom,
            ':nom_de_famille' => $nom_de_famille,
            ':age' => $age,
            ':pays' => $pays,
            ':abonnement' => $abonnement,
            ':role' => $role
        );
        // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
        database::prepareEtExecute($query, $values);
    }

    public static function supprimerUtilisateurParIdentifiant($identifiant_utilisateur) {
        // On prépare la requête SQL pour supprimer un utilisateur à partir de son identifiant
        $query = "DELETE FROM Utilisateurs WHERE identifiant_utilisateur = :identifiant";
        // On prépare les valeurs à utiliser dans la requête SQL
        $values = array(
            ':identifiant' => $identifiant_utilisateur
        );
        // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
        database::prepareEtExecute($query, $values);
    }

    public static function getTousLesUtilisateurs() {
        // On prépare la requête SQL pour récupérer tous les utilisateurs
        $query = "SELECT * FROM Utilisateurs";
        // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
        $resultat = database::prepareEtExecute($query);
        // On retourne la résultat à l'utilisateur si elle existe ou null
        return $resultat ? $resultat : NULL;
    }

    public static function getUtilisateurParIdentifiant($identifiant_utilisateur) {
        // On prépare la requête SQL pour récupérer un utilisateur à partir de son identifiant
        $query = "SELECT * FROM Utilisateurs WHERE identifiant_utilisateur = :identifiant";
        // On prépare les valeurs à utiliser dans la requête SQL
        $values = array(
            ':identifiant' => $identifiant_utilisateur
        );
        // On exécute la requête SQL en utilisant la méthode "prepareEtExecute" de la classe "database"
        $resultat = database::prepareEtExecute($query, $values);
        // On retourne la résultat à l'utilisateur si elle existe ou null
        return $resultat ? $resultat[0] : NULL;
    }

    public static function getEvenementsTousUtilisateurs($page, $nombreParPage) {
        $offset = ($page - 1) * $nombreParPage;
        // On prépare la requête SQL pour récupérer l'historique de tous les utilisateurs en groupant par date de modification
        $query = "SELECT * FROM Historique_Utilisateurs JOIN Utilisateurs ON Historique_Utilisateurs.identifiant_utilisateur = Utilisateurs.identifiant_utilisateur GROUP BY date_modification ORDER BY date_modification DESC LIMIT :offset, :nombreParPage";
        $values = array(':offset' => $offset, ':nombreParPage' => $nombreParPage);
        return database::prepareExecuteBind($query, $values);
    }
}
?>