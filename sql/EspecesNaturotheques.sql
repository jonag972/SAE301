DROP TABLE IF EXISTS EspecesNaturotheques;
DROP TABLE IF EXISTS Historique_EspecesNaturotheques;
DROP TRIGGER IF EXISTS tr_especesnaturotheques_insert;
DROP TRIGGER IF EXISTS tr_especesnaturotheques_update;
DROP TRIGGER IF EXISTS tr_especesnaturotheques_delete;

CREATE TABLE IF NOT EXISTS EspecesNaturotheques (
    id_espece_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    id_espece INT NOT NULL,
    id_naturotheque INT NOT NULL,
    FOREIGN KEY (id_espece) REFERENCES Especes(id_espece),
    FOREIGN KEY (id_naturotheque) REFERENCES Naturotheques(id_naturotheque)
);

CREATE TABLE IF NOT EXISTS Historique_EspecesNaturotheques(
    id_historique_espece_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    id_espece_naturotheque INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
    );

DELIMITER //
CREATE TRIGGER tr_especesnaturotheques_update
AFTER UPDATE ON EspecesNaturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_EspecesNaturotheques (id_espece_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
    VALUES (NEW.id_espece_naturotheque, 'UPDATE', NOW(), 'ALL', CONCAT(OLD.id_espece, ', ', OLD.id_naturotheque), CONCAT(NEW.id_espece, ', ', NEW.id_naturotheque));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_especesnaturotheques_insert
AFTER INSERT ON EspecesNaturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_EspecesNaturotheques (id_espece_naturotheque, action, date_modification, colonne_changee, nouvelle_valeur)
    VALUES (NEW.id_espece_naturotheque, 'INSERT', NOW(), 'ALL', CONCAT(NEW.id_espece, ', ', NEW.id_naturotheque));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_especesnaturotheques_delete
AFTER DELETE ON EspecesNaturotheques
FOR EACH ROW
BEGIN
    INSERT INTO Historique_EspecesNaturotheques (id_espece_naturotheque, action, date_modification, colonne_changee, ancienne_valeur)
    VALUES (OLD.id_espece_naturotheque, 'DELETE', NOW(), 'ALL', CONCAT(OLD.id_espece, ', ', OLD.id_naturotheque));
END //
DELIMITER ;