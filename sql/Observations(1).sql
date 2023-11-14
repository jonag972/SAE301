DROP TABLE IF EXISTS Observations;
DROP TABLE IF EXISTS Historique_Observations;
DROP TRIGGER IF EXISTS tr_observations_insert;
DROP TRIGGER IF EXISTS tr_observations_update;
DROP TRIGGER IF EXISTS tr_observations_delete;

CREATE TABLE IF NOT EXISTS Observations (
    id_observation INT PRIMARY KEY AUTO_INCREMENT,
    id_espece INT NOT NULL,
    id_utilisateur INT NOT NULL,
    date_observation DATE,
    pays_observation VARCHAR (255),
    ville_observation VARCHAR (255),
    commentaire TEXT,
    FOREIGN KEY (id_espece) REFERENCES Especes(id_espece),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
    );

CREATE TABLE IF NOT EXISTS Historique_Observations(
    id_historique_observation INT PRIMARY KEY AUTO_INCREMENT,
    id_observation INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
    );

DELIMITER //
CREATE TRIGGER tr_observations_update
AFTER UPDATE ON Observations
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
    VALUES (NEW.id_observation, 'UPDATE', NOW(), 'ALL', CONCAT(OLD.id_espece, ', ', OLD.id_utilisateur, ', ', OLD.date_observation, ', ', OLD.pays_observation, ', ', OLD.ville_observation, ', ', OLD.commentaire), CONCAT(NEW.id_espece, ', ', NEW.id_utilisateur, ', ', NEW.date_observation, ', ', NEW.pays_observation, ', ', NEW.ville_observation, ', ', NEW.commentaire));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_observations_insert
AFTER INSERT ON Observations
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, nouvelle_valeur)
    VALUES (NEW.id_observation, 'INSERT', NOW(), 'ALL', CONCAT(NEW.id_espece, ', ', NEW.id_utilisateur, ', ', NEW.date_observation, ', ', NEW.pays_observation, ', ', NEW.ville_observation, ', ', NEW.commentaire));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_observations_delete
AFTER DELETE ON Observations
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur)
    VALUES (OLD.id_observation, 'DELETE', NOW(), 'ALL', CONCAT(OLD.id_espece, ', ', OLD.id_utilisateur, ', ', OLD.date_observation, ', ', OLD.pays_observation, ', ', OLD.ville_observation, ', ', OLD.commentaire));
END //
DELIMITER ;
