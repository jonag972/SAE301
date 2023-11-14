DROP TABLE IF EXISTS Utilisateurs;
DROP TABLE IF EXISTS Historique_Utilisateurs;
DROP TRIGGER IF EXISTS tr_utilisateur_insert;
DROP TRIGGER IF EXISTS tr_utilisateur_update;
DROP TRIGGER IF EXISTS tr_utilisateur_delete;

CREATE TABLE IF NOT EXISTS Utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR (100) UNIQUE,
    mot_de_passe VARCHAR (255),
    email VARCHAR (255) UNIQUE,
    prenom VARCHAR (100),
    nom_de_famille VARCHAR (100),
    age INT,
    pays VARCHAR (255),
    ville VARCHAR (255),
    abonnement VARCHAR (50) DEFAULT 'gratuit',
    role VARCHAR (50) DEFAULT 'lambda',
    date_inscription TIMESTAMP DEFAULT NOW(),
    date_derniere_connexion TIMESTAMP DEFAULT NOW(),
    date_derniere_deconnexion TIMESTAMP DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS Historique_Utilisateurs (
  id_historique_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
  id_utilisateur INT NOT NULL,
  action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
  date_modification TIMESTAMP,
  colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
  ancienne_valeur TEXT,
  nouvelle_valeur TEXT
);


DELIMITER //
CREATE TRIGGER tr_utilisateur_update
AFTER UPDATE ON Utilisateurs
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Utilisateurs (id_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
    VALUES (NEW.id_utilisateur, 'UPDATE', NOW(), 'ALL', CONCAT(OLD.identifiant_utilisateur, ', ', OLD.mot_de_passe, ', ', OLD.email, ', ', OLD.prenom, ', ', OLD.nom_de_famille, ', ', OLD.age, ', ', OLD.pays, ', ', OLD.ville, ', ', OLD.abonnement, ', ', OLD.role, ', ', OLD.date_inscription, ', ', OLD.date_derniere_connexion, ', ', OLD.date_derniere_modification, ', ', OLD.date_derniere_deconnexion), CONCAT(NEW.identifiant_utilisateur, ', ', NEW.mot_de_passe, ', ', NEW.email, ', ', NEW.prenom, ', ', NEW.nom_de_famille, ', ', NEW.age, ', ', NEW.pays, ', ', NEW.ville, ', ', NEW.abonnement, ', ', NEW.role, ', ', NEW.date_inscription, ', ', NEW.date_derniere_connexion, ', ', NEW.date_derniere_modification, ', ', NEW.date_derniere_deconnexion));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_utilisateur_insert
AFTER INSERT ON Utilisateurs
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Utilisateurs (id_utilisateur, action, date_modification, colonne_changee, nouvelle_valeur)
    VALUES (NEW.id_utilisateur, 'INSERT', NOW(), 'ALL', CONCAT(NEW.identifiant_utilisateur, ', ', NEW.mot_de_passe, ', ', NEW.email, ', ', NEW.prenom, ', ', NEW.nom_de_famille, ', ', NEW.age, ', ', NEW.pays, ', ', NEW.ville, ', ', NEW.abonnement, ', ', NEW.role, ', ', NEW.date_inscription, ', ', NEW.date_derniere_connexion, ', ', NEW.date_derniere_modification, ', ', NEW.date_derniere_deconnexion));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_utilisateur_delete
AFTER DELETE ON Utilisateurs
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Utilisateurs (id_utilisateur, action, date_modification, colonne_changee, ancienne_valeur)
    VALUES (OLD.id_utilisateur, 'DELETE', NOW(), 'ALL', CONCAT(OLD.identifiant_utilisateur, ', ', OLD.mot_de_passe, ', ', OLD.email, ', ', OLD.prenom, ', ', OLD.nom_de_famille, ', ', OLD.age, ', ', OLD.pays, ', ', OLD.ville, ', ', OLD.abonnement, ', ', OLD.role, ', ', OLD.date_inscription, ', ', OLD.date_derniere_connexion, ', ', OLD.date_derniere_modification, ', ', OLD.date_derniere_deconnexion));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_utilisateur_