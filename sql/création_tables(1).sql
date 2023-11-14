CREATE TABLE IF NOT EXISTS Utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    identifiant VARCHAR (100) UNIQUE,
    mot_de_passe VARCHAR (255),
    photo_profil BLOB,
    email VARCHAR (255) UNIQUE,
    prenom VARCHAR (100),
    nom_de_famille VARCHAR (100),
    age INT,
    country VARCHAR (255),
    ville VARCHAR (255),
    abonnement VARCHAR (50) DEFAULT 'gratuit',
    role VARCHAR (50) DEFAULT 'lambda'
);

CREATE TABLE IF NOT EXISTS Espece (
  id INT PRIMARY KEY NOT NULL,
  nom_vernaculaire_francais VARCHAR (100) DEFAULT NULL,
  nom_vernaculaire_anglais VARCHAR (100) DEFAULT NULL,
  nom_scientifique VARCHAR (100) DEFAULT NULL,
  habitat VARCHAR (255) DEFAULT NULL,
  image BLOB DEFAULT NULL,
  autority VARCHAR (100) DEFAULT NULL,
  fullname VARCHAR (100) DEFAULT NULL,
  fullnamehtml VARCHAR (100) DEFAULT NULL,
  rang_id INT DEFAULT NULL,
  rang_nom VARCHAR (100) DEFAULT NULL,
  reference_nom VARCHAR (100) DEFAULT NULL,
  reference_nom_html VARCHAR (100) DEFAULT NULL,
  genre_nom VARCHAR (100) DEFAULT NULL,
  famille_nom VARCHAR (100) DEFAULT NULL,
  famille_nom VARCHAR (100) DEFAULT NULL,
  ordre_nom VARCHAR (100) DEFAULT NULL,
  classe_nom VARCHAR (100) DEFAULT NULL,
  phylum_nom VARCHAR (100) DEFAULT NULL,
  regne_nom VARCHAR (100) DEFAULT NULL,
  genre_vernaculaire VARCHAR (100) DEFAULT NULL,
  famille_vernaculaire VARCHAR (100) DEFAULT NULL,
  ordre_vernaculaire VARCHAR (100) DEFAULT NULL,
  classe_vernaculaire VARCHAR (100) DEFAULT NULL,
  phylum_vernaculaire VARCHAR (100) DEFAULT NULL,
  regne_vernaculaire VARCHAR (100) DEFAULT NULL,
  groupe_vernaculaire1 VARCHAR (100) DEFAULT NULL,
  groupe_vernaculaire2 VARCHAR (100) DEFAULT NULL,
  groupe_vernaculaire3 VARCHAR (100) DEFAULT NULL,
  ordre VARCHAR (100) DEFAULT NULL,
  classe VARCHAR (100) DEFAULT NULL,
  royaume VARCHAR (100) DEFAULT NULL,
  interne BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS Naturotheque (
  id_naturotheque INT PRIMARY KEY NOT NULL,
  identifiant_utilisateur INT NOT NULL,
  nom VARCHAR (255),
  description TEXT,
  nombre_especes INT,
  FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE IF NOT EXISTS EspecesNaturotheque (
  id_espece INT NOT NULL,
  id_naturotheque INT NOT NULL,
  interne BOOLEAN,
  FOREIGN KEY (id_espece) REFERENCES Espece(id_espece),
  FOREIGN KEY (id_naturotheque) REFERENCES Naturotheque(id_naturotheque)
);

CREATE TABLE IF NOT EXISTS Consultation (
  id_consultation INT PRIMARY KEY NOT NULL,
  id_utilisateur INT NOT NULL,
  date DATE,
  id_espece INT NOT NULL,
  source VARCHAR (255),
  FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
  FOREIGN KEY (id_espece) REFERENCES Espece(id_espece)
);

CREATE TABLE IF NOT EXISTS Observation (
  id_observation INT PRIMARY KEY NOT NULL,
  id_utilisateur INT NOT NULL,
  id_espece INT NOT NULL,
  date DATE,
  lieu VARCHAR (255),
  notes TEXT,
  FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
  FOREIGN KEY (id_espece) REFERENCES Espece(id_espece)
);

CREATE TABLE IF NOT EXISTS Historique_Utilisateur (
  id_histo INT PRIMARY KEY NOT NULL,
  id_utilisateur INT NOT NULL,
  action VARCHAR (10),  -- Peut être "INSERT", "UPDATE" ou "DELETE"
  date_modification TIMESTAMP,
  colonne_changee VARCHAR (100),  -- Le nom de la colonne modifiée
  ancienne_valeur TEXT,
  nouvelle_valeur TEXT
);












