SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

DROP TABLE IF EXISTS Historique_Utilisateurs;
DROP TABLE IF EXISTS Historique_Especes;
DROP TABLE IF EXISTS Historique_Naturotheques;
DROP TABLE IF EXISTS Historique_EspecesNaturotheques;
DROP TABLE IF EXISTS Historique_Observations;

CREATE TABLE IF NOT EXISTS Historique_Utilisateurs (
  id_historique_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
  identifiant_utilisateur VARCHAR (255) NOT NULL,
  action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
  date_modification TIMESTAMP,
  colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
  ancienne_valeur TEXT DEFAULT NULL,
  nouvelle_valeur TEXT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS Historique_Especes(
    id_historique_espece INT PRIMARY KEY AUTO_INCREMENT,
    ajoute_par VARCHAR (255) NOT NULL,
    id_espece INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
);


CREATE TABLE IF NOT EXISTS Historique_Naturotheques(
    id_historique_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR (255) NOT NULL,
    id_naturotheque INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
);

CREATE TABLE IF NOT EXISTS Historique_EspecesNaturotheque(
    id_historique_espece_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR (255) NOT NULL,
    id_especes_naturotheque INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
);

CREATE TABLE IF NOT EXISTS Historique_Observations(
    id_historique_observation INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR (255) NOT NULL,
    id_observation INT NOT NULL,
    action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
    date_modification TIMESTAMP,
    colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT
);

