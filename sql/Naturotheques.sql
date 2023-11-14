DROP TABLE IF EXISTS Naturotheque;
DROP TABLE IF EXISTS Historique_Naturotheques;
DROP TRIGGER IF EXISTS tr_naturotheques_insert;
DROP TRIGGER IF EXISTS tr_naturotheques_update;
DROP TRIGGER IF EXISTS tr_naturotheques_delete;

CREATE TABLE IF NOT EXISTS Naturotheques (
    id_naturotheque INT PRIMARY KEY NOT NULL,
    id_utilisateur INT NOT NULL,
    nom VARCHAR (255),
    description TEXT,
    nombre_especes INT,
    dateCreation TIMESTAMP DEFAULT NOW(),
    dateDerniereModification TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE IF NOT EXISTS Historique_Naturotheques(
    id_historique_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    id_naturotheque INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
    );


DELIMITER //
CREATE TRIGGER tr_naturotheques_update
AFTER UPDATE ON Naturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
    VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'ALL', CONCAT(OLD.id_utilisateur, ', ', OLD.nom, ', ', OLD.description, ', ', OLD.nombre_especes, ', ', OLD.dateCreation, ', ', OLD.dateDerniereModification), CONCAT(NEW.id_utilisateur, ', ', NEW.nom, ', ', NEW.description, ', ', NEW.nombre_especes, ', ', NEW.dateCreation, ', ', NEW.dateDerniereModification));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_naturotheques_insert
AFTER INSERT ON Naturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, nouvelle_valeur)
    VALUES (NEW.id_naturotheque, 'INSERT', NOW(), 'ALL', CONCAT(NEW.id_utilisateur, ', ', NEW.nom, ', ', NEW.description, ', ', NEW.nombre_especes, ', ', NEW.dateCreation, ', ', NEW.dateDerniereModification));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_naturotheques_delete
AFTER DELETE ON Naturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur)
    VALUES (OLD.id_naturotheque, 'DELETE', NOW(), 'ALL', CONCAT(OLD.id_utilisateur, ', ', OLD.nom, ', ', OLD.description, ', ', OLD.nombre_especes, ', ', OLD.dateCreation, ', ', OLD.dateDerniereModification));
END //
DELIMITER ;