-- Insertions pour la table Utilisateurs
INSERT INTO Utilisateurs (identifiant_utilisateur, mot_de_passe, email, prenom, nom_de_famille, age, pays, ville, abonnement, role)
VALUES 
('user1', 'password1', 'user1@email.com', 'prenom1', 'nom1', 25, 'France', 'Paris', 'gratuit', 'lambda'),
('user2', 'password2', 'user2@email.com', 'prenom2', 'nom2', 26, 'France', 'Paris', 'gratuit', 'lambda'),
('user3', 'password3', 'user3@email.com', 'prenom3', 'nom3', 27, 'France', 'Paris', 'gratuit', 'lambda'),
('user4', 'password4', 'user4@email.com', 'prenom4', 'nom4', 28, 'France', 'Paris', 'gratuit', 'lambda'),
('user5', 'password5', 'user5@email.com', 'prenom5', 'nom5', 29, 'France', 'Paris', 'gratuit', 'lambda'),
('user6', 'password6', 'user6@email.com', 'prenom6', 'nom6', 30, 'France', 'Paris', 'gratuit', 'lambda'),
('user7', 'password7', 'user7@email.com', 'prenom7', 'nom7', 31, 'France', 'Paris', 'gratuit', 'lambda'),
('user8', 'password8', 'user8@email.com', 'prenom8', 'nom8', 32, 'France', 'Paris', 'gratuit', 'lambda'),
('user9', 'password9', 'user9@email.com', 'prenom9', 'nom9', 33, 'France', 'Paris', 'gratuit', 'lambda'),
('user10', 'password10', 'user10@email.com', 'prenom10', 'nom10', 34, 'France', 'Paris', 'gratuit', 'lambda');


-- Mises à jour pour la table Utilisateurs
UPDATE Utilisateurs SET email = 'new_email@email.com' WHERE id_utilisateur = 1;
UPDATE Utilisateurs SET age = 26 WHERE id_utilisateur = 2;

-- Suppressions pour la table Utilisateurs
DELETE FROM Utilisateurs WHERE id_utilisateur IN (1, 2, 3, 4, 5);


-- Insertions pour la table Especes
INSERT INTO Especes (frenchVernacularNames, englishVernacularNames, scientificNames, vernularGroups, taxonomicRanks, territories, domain, habitats, genusName, familyName, orderName, className, kingdomName, habitat, mediaImage)
VALUES 
('nomFrancais1', 'nomAnglais1', 'nomScientifique1', 'groupesVernaculaires1', 'rangsTaxonomiques1', 'territoires1', 'domaine1', 'habitats1', 'nomGenre1', 'nomFamille1', 'nomOrdre1', 'nomClasse1', 'nomRoyaume1', 'terrestre1', NULL),
('nomFrancais2', 'nomAnglais2', 'nomScientifique2', 'groupesVernaculaires2', 'rangsTaxonomiques2', 'territoires2', 'domaine2', 'habitats2', 'nomGenre2', 'nomFamille2', 'nomOrdre2', 'nomClasse2', 'nomRoyaume2', 'terrestre2', NULL),
('nomFrancais3', 'nomAnglais3', 'nomScientifique3', 'groupesVernaculaires3', 'rangsTaxonomiques3', 'territoires3', 'domaine3', 'habitats3', 'nomGenre3', 'nomFamille3', 'nomOrdre3', 'nomClasse3', 'nomRoyaume3', 'terrestre3', NULL),
('nomFrancais4', 'nomAnglais4', 'nomScientifique4', 'groupesVernaculaires4', 'rangsTaxonomiques4', 'territoires4', 'domaine4', 'habitats4', 'nomGenre4', 'nomFamille4', 'nomOrdre4', 'nomClasse4', 'nomRoyaume4', 'terrestre4', NULL),
('nomFrancais5', 'nomAnglais5', 'nomScientifique5', 'groupesVernaculaires5', 'rangsTaxonomiques5', 'territoires5', 'domaine5', 'habitats5', 'nomGenre5', 'nomFamille5', 'nomOrdre5', 'nomClasse5', 'nomRoyaume5', 'terrestre5', NULL);

-- Mises à jour pour la table Especes
UPDATE Especes SET frenchVernacularNames = 'nouveauNomFrancais' WHERE id_espece = 1;
UPDATE Especes SET englishVernacularNames = 'nouveauNomAnglais' WHERE id_espece = 2;

-- Suppressions pour la table Especes
DELETE FROM Especes WHERE id_espece IN (1, 2, 3);

-- Insertions pour la table Naturotheques
INSERT INTO Naturotheques (identifiant_utilisateur, nom, description, nombre_especes)
VALUES 
('user1', 'nom1', 'description1', 10),
('user2', 'nom2', 'description2', 20),
('user3', 'nom3', 'description3', 30),
('user4', 'nom4', 'description4', 40),
('user5', 'nom5', 'description5', 50);

-- Mises à jour pour la table Naturotheques
UPDATE Naturotheques SET nom = 'nouveauNom' WHERE id_naturotheque = 1;
UPDATE Naturotheques SET description = 'nouvelleDescription' WHERE id_naturotheque = 2;

-- Suppressions pour la table Naturotheques
DELETE FROM Naturotheques WHERE id_naturotheque IN (1, 2, 3);

-- Insertions pour la table EspecesNaturotheques
INSERT INTO EspecesNaturotheques (id_espece, id_naturotheque, interne)
VALUES 
(1, 1, FALSE),
(2, 2, TRUE),
(3, 3, FALSE),
(4, 4, TRUE),
(5, 5, FALSE);

-- Mises à jour pour la table EspecesNaturotheques
UPDATE EspecesNaturotheques SET interne = TRUE WHERE id_espece_naturotheque = 1;
UPDATE EspecesNaturotheques SET id_espece = 2 WHERE id_espece_naturotheque = 2;

-- Suppressions pour la table EspecesNaturotheques
DELETE FROM EspecesNaturotheques WHERE id_espece_naturotheque IN (1, 2, 3);

-- Insertions pour la table Observations
INSERT INTO Observations (id_espece, id_utilisateur, date_observation, pays_observation, ville_observation, commentaire)
VALUES 
(1, 1, '2023-01-01', 'France', 'Paris', 'commentaire1'),
(2, 2, '2023-02-01', 'France', 'Lyon', 'commentaire2'),
(3, 3, '2023-03-01', 'France', 'Marseille', 'commentaire3'),
(4, 4, '2023-04-01', 'France', 'Lille', 'commentaire4'),
(5, 5, '2023-05-01', 'France', 'Toulouse', 'commentaire5');

-- Mises à jour pour la table Observations
UPDATE Observations SET commentaire = 'nouveauCommentaire' WHERE id_observation = 1;
UPDATE Observations SET ville_observation = 'nouvelleVille' WHERE id_observation = 2;

-- Suppressions pour la table Observations
DELETE FROM Observations WHERE id_observation IN (1, 2, 3);
