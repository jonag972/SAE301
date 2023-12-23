DROP TABLE IF EXISTS Utilisateurs;
DROP TABLE IF EXISTS Especes;
DROP TABLE IF EXISTS Naturotheques;
DROP TABLE IF EXISTS EspecesNaturotheques;
DROP TABLE IF EXISTS Observations;
DROP TABLE IF EXISTS ConsultationsEspeces;
DROP TABLE IF EXISTS ConsultationsObservations;
DROP TABLE IF EXISTS ConsultationsNaturotheques;
DROP TABLE IF EXISTS InsertionsEspeces;

CREATE TABLE IF NOT EXISTS Utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR (255) UNIQUE ,
    photo_de_profil LONGBLOB DEFAULT NULL,
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

CREATE TABLE IF NOT EXISTS InsertionsEspeces (
    id_insertion INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR(255) ,
    id_espece INT ,
    date_insertion TIMESTAMP DEFAULT NOW(),
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE SET NULL,
    FOREIGN KEY (id_espece) REFERENCES Especes(id_espece)
);


CREATE TABLE IF NOT EXISTS Naturotheques (
    id_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    photo_naturotheque LONGBLOB DEFAULT NULL,
    identifiant_utilisateur VARCHAR(255),
    nom VARCHAR (255),
    description TEXT,
    nombre_especes INT DEFAULT 0,
    dateCreation TIMESTAMP DEFAULT NOW(),
    dateDerniereModification TIMESTAMP DEFAULT NOW(),
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS EspecesNaturotheques (
    id_espece_naturotheque INT PRIMARY KEY AUTO_INCREMENT,
    id_espece INT ,
    id_naturotheque INT ,
    interne BOOLEAN DEFAULT FALSE, -- Si l'espèce est interne à la base de données ou non
    FOREIGN KEY (id_espece) REFERENCES Especes(id_espece) ON DELETE SET NULL,
    FOREIGN KEY (id_naturotheque) REFERENCES Naturotheques(id_naturotheque) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Observations (
    id_observation INT PRIMARY KEY AUTO_INCREMENT,
    id_espece INT ,
    photo_observation LONGBLOB DEFAULT NULL,
    identifiant_utilisateur VARCHAR(255) ,
    date_observation DATE,
    pays_observation VARCHAR (255),
    ville_observation VARCHAR (255),
    commentaire TEXT,
    interne BOOLEAN DEFAULT FALSE, -- Si l'espèce est interne à la base de données ou non
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS ConsultationsEspeces (
    id_consultation INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR(255),
    id_espece INT,
    date_consultation TIMESTAMP DEFAULT NOW(),
    interne BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE SET NULL
);


CREATE TABLE IF NOT EXISTS ConsultationsNaturotheques (
    id_consultation INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR(255),
    id_naturotheque INT,
    date_consultation TIMESTAMP DEFAULT NOW(),
    interne BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE SET NULL,
    FOREIGN KEY (id_naturotheque) REFERENCES Naturotheques(id_naturotheque)
);

CREATE TABLE IF NOT EXISTS ConsultationsObservations (
    id_consultation INT PRIMARY KEY AUTO_INCREMENT,
    identifiant_utilisateur VARCHAR(255) ,
    id_observation INT ,
    date_consultation TIMESTAMP DEFAULT NOW(),
    interne BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (identifiant_utilisateur) REFERENCES Utilisateurs(identifiant_utilisateur) ON DELETE SET NULL,
    FOREIGN KEY (id_observation) REFERENCES Observations(id_observation) ON DELETE SET NULL
);
