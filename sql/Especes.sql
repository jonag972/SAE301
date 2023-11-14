DROP TABLE IF EXISTS Especes;
DROP TRIGGER IF EXISTS tr_espece_insert;
DROP TRIGGER IF EXISTS tr_espece_update;
DROP TRIGGER IF EXISTS tr_espece_delete;


CREATE TABLE IF NOT EXISTS Especes (
  id_espece INT PRIMARY KEY AUTO_INCREMENT,
  frenchVernacularNames VARCHAR (100) DEFAULT NULL,
  englishVernacularNames VARCHAR (100) DEFAULT NULL,
  scientificNames VARCHAR (100) DEFAULT NULL,
  vernularGroups VARCHAR (100) DEFAULT NULL,
  taxonomicRanks VARCHAR (100) DEFAULT NULL,
  territories VARCHAR (100) DEFAULT NULL,
  domain VARCHAR (100) DEFAULT NULL,
  habitats VARCHAR (100) DEFAULT NULL,
  genusName VARCHAR (100) DEFAULT NULL,
  familyName VARCHAR (100) DEFAULT NULL,
  orderName VARCHAR (100) DEFAULT NULL,
  className VARCHAR (100) DEFAULT NULL,
  kingdomName VARCHAR (100) DEFAULT NULL,
  habitat VARCHAR (255) DEFAULT NULL,
  mediaImage LONGBLOB DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS Historique_Especes(
    id_historique_espece INT PRIMARY KEY AUTO_INCREMENT,
    id_espece INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
    );


DELIMITER //
CREATE TRIGGER tr_espece_update
AFTER UPDATE ON Especes
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
    VALUES (NEW.id_espece, 'UPDATE', NOW(), 'ALL', CONCAT(OLD.frenchVernacularNames, ', ', OLD.englishVernacularNames, ', ', OLD.scientificNames, ', ', OLD.vernularGroups, ', ', OLD.taxonomicRanks, ', ', OLD.territories, ', ', OLD.domain, ', ', OLD.habitats, ', ', OLD.genusName, ', ', OLD.familyName, ', ', OLD.orderName, ', ', OLD.className, ', ', OLD.kingdomName, ', ', OLD.habitat), CONCAT(NEW.frenchVernacularNames, ', ', NEW.englishVernacularNames, ', ', NEW.scientificNames, ', ', NEW.vernularGroups, ', ', NEW.taxonomicRanks, ', ', NEW.territories, ', ', NEW.domain, ', ', NEW.habitats, ', ', NEW.genusName, ', ', NEW.familyName, ', ', NEW.orderName, ', ', NEW.className, ', ', NEW.kingdomName, ', ', NEW.habitat));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_espece_insert
AFTER INSERT ON Especes
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, nouvelle_valeur)
    VALUES (NEW.id_espece, 'INSERT', NOW(), 'ALL', CONCAT(NEW.frenchVernacularNames, ', ', NEW.englishVernacularNames, ', ', NEW.scientificNames, ', ', NEW.vernularGroups, ', ', NEW.taxonomicRanks, ', ', NEW.territories, ', ', NEW.domain, ', ', NEW.habitats, ', ', NEW.genusName, ', ', NEW.familyName, ', ', NEW.orderName, ', ', NEW.className, ', ', NEW.kingdomName, ', ', NEW.habitat));
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_espece_delete
AFTER DELETE ON Especes
FOR EACH ROW
BEGIN
    INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur)
    VALUES (OLD.id_espece, 'DELETE', NOW(), 'ALL', CONCAT(OLD.frenchVernacularNames, ', ', OLD.englishVernacularNames, ', ', OLD.scientificNames, ', ', OLD.vernularGroups, ', ', OLD.taxonomicRanks, ', ', OLD.territories, ', ', OLD.domain, ', ', OLD.habitats, ', ', OLD.genusName, ', ', OLD.familyName, ', ', OLD.orderName, ', ', OLD.className, ', ', OLD.kingdomName, ', ', OLD.habitat));
END //
DELIMITER ;


