    DROP TRIGGER IF EXISTS tr_utilisateur_insert;
    DROP TRIGGER IF EXISTS tr_utilisateur_update;
    DROP TRIGGER IF EXISTS tr_utilisateur_delete;
    DROP TRIGGER IF EXISTS tr_espece_insert;
    DROP TRIGGER IF EXISTS tr_espece_update;
    DROP TRIGGER IF EXISTS tr_espece_delete;
    DROP TRIGGER IF EXISTS tr_naturotheque_insert;
    DROP TRIGGER IF EXISTS tr_naturotheque_update;
    DROP TRIGGER IF EXISTS tr_naturotheque_delete;
    DROP TRIGGER IF EXISTS tr_espece_naturotheque_insert;
    DROP TRIGGER IF EXISTS tr_espece_naturotheque_update;
    DROP TRIGGER IF EXISTS tr_espece_naturotheque_delete;
    DROP TRIGGER IF EXISTS tr_observation_insert;
    DROP TRIGGER IF EXISTS tr_observation_update;
    DROP TRIGGER IF EXISTS tr_observation_delete;
    DROP TRIGGER IF EXISTS tr_consultation_espece_insert;
    DROP TRIGGER IF EXISTS tr_consultation_espece_update;
    DROP TRIGGER IF EXISTS tr_consultation_espece_delete;
    DROP TRIGGER IF EXISTS tr_consultation_naturotheque_insert;
    DROP TRIGGER IF EXISTS tr_consultation_naturotheque_update;
    DROP TRIGGER IF EXISTS tr_consultation_naturotheque_delete;

    DELIMITER //
    CREATE TRIGGER tr_utilisateur_insert
    AFTER INSERT ON Utilisateurs
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, nouvelle_valeur)
        VALUES (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'identifiant_utilisateur', NEW.identifiant_utilisateur),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'mot_de_passe', NEW.mot_de_passe),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'email', NEW.email),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'prenom', NEW.prenom),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'nom_de_famille', NEW.nom_de_famille),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'age', NEW.age),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'pays', NEW.pays),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'ville', NEW.ville),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'abonnement', NEW.abonnement),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'role', NEW.role),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'date_inscription', NEW.date_inscription),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'date_derniere_connexion', NEW.date_derniere_connexion),
            (NEW.identifiant_utilisateur, 'INSERT', NOW(), 'date_derniere_deconnexion', NEW.date_derniere_deconnexion);
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_utilisateur_update
    AFTER UPDATE ON Utilisateurs
    FOR EACH ROW
    BEGIN
        IF NEW.identifiant_utilisateur <> OLD.identifiant_utilisateur THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur, NEW.identifiant_utilisateur);
        END IF;
        IF NEW.mot_de_passe <> OLD.mot_de_passe THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'mot_de_passe', OLD.mot_de_passe, NEW.mot_de_passe);
        END IF;
        IF NEW.email <> OLD.email THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'email', OLD.email, NEW.email);
        END IF;
        IF NEW.prenom <> OLD.prenom THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'prenom', OLD.prenom, NEW.prenom);
        END IF;
        IF NEW.nom_de_famille <> OLD.nom_de_famille THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'nom_de_famille', OLD.nom_de_famille, NEW.nom_de_famille);
        END IF;
        IF NEW.age <> OLD.age THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'age', OLD.age, NEW.age);
        END IF;
        IF NEW.pays <> OLD.pays THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'pays', OLD.pays, NEW.pays);
        END IF;
        IF NEW.ville <> OLD.ville THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'ville', OLD.ville, NEW.ville);
        END IF;
        IF NEW.abonnement <> OLD.abonnement THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'abonnement', OLD.abonnement, NEW.abonnement);
        END IF;
        IF NEW.role <> OLD.role THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'role', OLD.role, NEW.role);
        END IF;
        IF NEW.date_inscription <> OLD.date_inscription THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'date_inscription', OLD.date_inscription, NEW.date_inscription);
        END IF;
        IF NEW.date_derniere_connexion <> OLD.date_derniere_connexion THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'date_derniere_connexion', OLD.date_derniere_connexion, NEW.date_derniere_connexion);
        END IF;
        IF NEW.date_derniere_deconnexion <> OLD.date_derniere_deconnexion THEN
            INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.identifiant_utilisateur, 'UPDATE', NOW(), 'date_derniere_deconnexion', OLD.date_derniere_deconnexion, NEW.date_derniere_deconnexion);
        END IF;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_utilisateur_delete
    AFTER DELETE ON Utilisateurs
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Utilisateurs (identifiant_utilisateur, action, date_modification, colonne_changee, ancienne_valeur)
        VALUES (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'mot_de_passe', OLD.mot_de_passe),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'email', OLD.email),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'prenom', OLD.prenom),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'nom_de_famille', OLD.nom_de_famille),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'age', OLD.age),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'pays', OLD.pays),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'ville', OLD.ville),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'abonnement', OLD.abonnement),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'role', OLD.role),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'date_inscription', OLD.date_inscription),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'date_derniere_connexion', OLD.date_derniere_connexion),
            (OLD.identifiant_utilisateur, 'DELETE', NOW(), 'date_derniere_deconnexion', OLD.date_derniere_deconnexion);
    END //
    DELIMITER ;


    DELIMITER //
    CREATE TRIGGER tr_espece_insert
    AFTER INSERT ON Especes
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, nouvelle_valeur)
        VALUES (NEW.id_espece, 'INSERT', NOW(), 'frenchVernacularNames', NEW.frenchVernacularNames),
            (NEW.id_espece, 'INSERT', NOW(), 'englishVernacularNames', NEW.englishVernacularNames),
            (NEW.id_espece, 'INSERT', NOW(), 'scientificNames', NEW.scientificNames),
            (NEW.id_espece, 'INSERT', NOW(), 'vernularGroups', NEW.vernularGroups),
            (NEW.id_espece, 'INSERT', NOW(), 'taxonomicRanks', NEW.taxonomicRanks),
            (NEW.id_espece, 'INSERT', NOW(), 'territories', NEW.territories),
            (NEW.id_espece, 'INSERT', NOW(), 'domain', NEW.domain),
            (NEW.id_espece, 'INSERT', NOW(), 'habitats', NEW.habitats),
            (NEW.id_espece, 'INSERT', NOW(), 'genusName', NEW.genusName),
            (NEW.id_espece, 'INSERT', NOW(), 'familyName', NEW.familyName),
            (NEW.id_espece, 'INSERT', NOW(), 'orderName', NEW.orderName),
            (NEW.id_espece, 'INSERT', NOW(), 'className', NEW.className),
            (NEW.id_espece, 'INSERT', NOW(), 'kingdomName', NEW.kingdomName),
            (NEW.id_espece, 'INSERT', NOW(), 'habitat', NEW.habitat),
            (NEW.id_espece, 'INSERT', NOW(), 'mediaImage', NEW.mediaImage);
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_espece_update
    AFTER UPDATE ON Especes
    FOR EACH ROW
    BEGIN
        IF NEW.frenchVernacularNames <> OLD.frenchVernacularNames THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'frenchVernacularNames', OLD.frenchVernacularNames, NEW.frenchVernacularNames);
        END IF;
        IF NEW.englishVernacularNames <> OLD.englishVernacularNames THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'englishVernacularNames', OLD.englishVernacularNames, NEW.englishVernacularNames);
        END IF;
        IF NEW.scientificNames <> OLD.scientificNames THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'scientificNames', OLD.scientificNames, NEW.scientificNames);
        END IF;
        IF NEW.vernularGroups <> OLD.vernularGroups THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'vernularGroups', OLD.vernularGroups, NEW.vernularGroups);
        END IF;
        IF NEW.taxonomicRanks <> OLD.taxonomicRanks THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'taxonomicRanks', OLD.taxonomicRanks, NEW.taxonomicRanks);
        END IF;
        IF NEW.territories <> OLD.territories THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'territories', OLD.territories, NEW.territories);
        END IF;
        IF NEW.domain <> OLD.domain THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'domain', OLD.domain, NEW.domain);
        END IF;
        IF NEW.habitats <> OLD.habitats THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'habitats', OLD.habitats, NEW.habitats);
        END IF;
        IF NEW.genusName <> OLD.genusName THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'genusName', OLD.genusName, NEW.genusName);
        END IF;
        IF NEW.familyName <> OLD.familyName THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'familyName', OLD.familyName, NEW.familyName);
        END IF;
        IF NEW.orderName <> OLD.orderName THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'orderName', OLD.orderName, NEW.orderName);
        END IF;
        IF NEW.className <> OLD.className THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'className', OLD.className, NEW.className);
        END IF;
        IF NEW.kingdomName <> OLD.kingdomName THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'kingdomName', OLD.kingdomName, NEW.kingdomName);
        END IF;
        IF NEW.habitat <> OLD.habitat THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'habitat', OLD.habitat, NEW.habitat);
        END IF;
        IF NEW.mediaImage <> OLD.mediaImage THEN
            INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_espece, 'UPDATE', NOW(), 'mediaImage', OLD.mediaImage, NEW.mediaImage);
        END IF;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_espece_delete
    AFTER DELETE ON Especes
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Especes (id_espece, action, date_modification, colonne_changee, ancienne_valeur)
        VALUES (OLD.id_espece, 'DELETE', NOW(), 'frenchVernacularNames', OLD.frenchVernacularNames),
            (OLD.id_espece, 'DELETE', NOW(), 'englishVernacularNames', OLD.englishVernacularNames),
            (OLD.id_espece, 'DELETE', NOW(), 'scientificNames', OLD.scientificNames),
            (OLD.id_espece, 'DELETE', NOW(), 'vernularGroups', OLD.vernularGroups),
            (OLD.id_espece, 'DELETE', NOW(), 'taxonomicRanks', OLD.taxonomicRanks),
            (OLD.id_espece, 'DELETE', NOW(), 'territories', OLD.territories),
            (OLD.id_espece, 'DELETE', NOW(), 'domain', OLD.domain),
            (OLD.id_espece, 'DELETE', NOW(), 'habitats', OLD.habitats),
            (OLD.id_espece, 'DELETE', NOW(), 'genusName', OLD.genusName),
            (OLD.id_espece, 'DELETE', NOW(), 'familyName', OLD.familyName),
            (OLD.id_espece, 'DELETE', NOW(), 'orderName', OLD.orderName),
            (OLD.id_espece, 'DELETE', NOW(), 'className', OLD.className),
            (OLD.id_espece, 'DELETE', NOW(), 'kingdomName', OLD.kingdomName),
            (OLD.id_espece, 'DELETE', NOW(), 'habitat', OLD.habitat),
            (OLD.id_espece, 'DELETE', NOW(), 'mediaImage', OLD.mediaImage);
    END //
    DELIMITER ;


    DELIMITER //
    CREATE TRIGGER tr_naturotheque_insert
    AFTER INSERT ON Naturotheques
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, nouvelle_valeur)
        VALUES (NEW.id_naturotheque, 'INSERT', NOW(), 'identifiant_utilisateur', NEW.identifiant_utilisateur),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'nom', NEW.nom),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'description', NEW.description),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'nombre_especes', NEW.nombre_especes),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'visibilite', NEW.visibilite),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'dateCreation', NEW.dateCreation),
            (NEW.id_naturotheque, 'INSERT', NOW(), 'dateDerniereModification', NEW.dateDerniereModification);
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_naturotheque_update
    AFTER UPDATE ON Naturotheques
    FOR EACH ROW
    BEGIN
        IF NEW.identifiant_utilisateur <> OLD.identifiant_utilisateur THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur, NEW.identifiant_utilisateur);
        END IF;
        IF NEW.nom <> OLD.nom THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'nom', OLD.nom, NEW.nom);
        END IF;
        IF NEW.description <> OLD.description THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'description', OLD.description, NEW.description);
        END IF;
        IF NEW.nombre_especes <> OLD.nombre_especes THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'nombre_especes', OLD.nombre_especes, NEW.nombre_especes);
        END IF;
        IF NEW.visibilite <> OLD.visibilite THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'visibilite', OLD.visibilite, NEW.visibilite);
        END IF;
        IF NEW.dateCreation <> OLD.dateCreation THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'dateCreation', OLD.dateCreation, NEW.dateCreation);
        END IF;
        IF NEW.dateDerniereModification <> OLD.dateDerniereModification THEN
            INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_naturotheque, 'UPDATE', NOW(), 'dateDerniereModification', OLD.dateDerniereModification, NEW.dateDerniereModification);
        END IF;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_naturotheque_delete
    AFTER DELETE ON Naturotheques
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Naturotheques (id_naturotheque, action, date_modification, colonne_changee, ancienne_valeur)
        VALUES (OLD.id_naturotheque, 'DELETE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'nom', OLD.nom),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'description', OLD.description),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'nombre_especes', OLD.nombre_especes),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'visibilite', OLD.visibilite),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'dateCreation', OLD.dateCreation),
            (OLD.id_naturotheque, 'DELETE', NOW(), 'dateDerniereModification', OLD.dateDerniereModification);
    END //
    DELIMITER ;


    DELIMITER //
    CREATE TRIGGER tr_espece_naturotheque_insert
    AFTER INSERT ON EspecesNaturotheque
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_EspecesNaturotheque (id_especes_naturotheque, action, date_modification, colonne_changee, nouvelle_valeur)
        VALUES (NEW.id_especes_naturotheque, 'INSERT', NOW(), 'id_espece', NEW.id_espece),
            (NEW.id_especes_naturotheque, 'INSERT', NOW(), 'id_naturotheque', NEW.id_naturotheque),
            (NEW.id_especes_naturotheque, 'INSERT', NOW(), 'interne', NEW.interne);
        UPDATE Naturotheques
        SET nombre_especes = nombre_especes + 1
        WHERE id_naturotheque = NEW.id_naturotheque;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_espece_naturotheque_update
    AFTER UPDATE ON EspecesNaturotheque
    FOR EACH ROW
    BEGIN
        IF NEW.id_espece <> OLD.id_espece THEN
            INSERT INTO Historique_EspecesNaturotheque (id_especes_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_especes_naturotheque, 'UPDATE', NOW(), 'id_espece', OLD.id_espece, NEW.id_espece);
        END IF;
        IF NEW.id_naturotheque <> OLD.id_naturotheque THEN
            INSERT INTO Historique_EspecesNaturotheque (id_especes_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_especes_naturotheque, 'UPDATE', NOW(), 'id_naturotheque', OLD.id_naturotheque, NEW.id_naturotheque);
        END IF;
        IF NEW.interne <> OLD.interne THEN
            INSERT INTO Historique_EspecesNaturotheque (id_especes_naturotheque, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_especes_naturotheque, 'UPDATE', NOW(), 'interne', OLD.interne, NEW.interne);
        END IF;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_espece_naturotheque_delete
    AFTER DELETE ON EspecesNaturotheque
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_EspecesNaturotheque (id_especes_naturotheque, action, date_modification, colonne_changee, ancienne_valeur)
        VALUES (OLD.id_especes_naturotheque, 'DELETE', NOW(), 'id_espece', OLD.id_espece),
            (OLD.id_especes_naturotheque, 'DELETE', NOW(), 'id_naturotheque', OLD.id_naturotheque),
            (OLD.id_especes_naturotheque, 'DELETE', NOW(), 'interne', OLD.interne);
        UPDATE Naturotheques
        SET nombre_especes = nombre_especes - 1
        WHERE id_naturotheque = OLD.id_naturotheque;
    END //
    DELIMITER ;


    DELIMITER //
    CREATE TRIGGER tr_observation_insert
    AFTER INSERT ON Observations
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, nouvelle_valeur)
        VALUES (NEW.id_observation, 'INSERT', NOW(), 'id_espece', NEW.id_espece),
            (NEW.id_observation, 'INSERT', NOW(), 'identifiant_utilisateur', NEW.identifiant_utilisateur),
            (NEW.id_observation, 'INSERT', NOW(), 'date_observation', NEW.date_observation),
            (NEW.id_observation, 'INSERT', NOW(), 'pays_observation', NEW.pays_observation),
            (NEW.id_observation, 'INSERT', NOW(), 'ville_observation', NEW.ville_observation),
            (NEW.id_observation, 'INSERT', NOW(), 'commentaire', NEW.commentaire),
            (NEW.id_observation, 'INSERT', NOW(), 'visibilite', NEW.visibilite),
            (NEW.id_observation, 'INSERT', NOW(), 'interne', NEW.interne);
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_observation_update
    AFTER UPDATE ON Observations
    FOR EACH ROW
    BEGIN
        IF NEW.id_espece <> OLD.id_espece THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'id_espece', OLD.id_espece, NEW.id_espece);
        END IF;
        IF NEW.identifiant_utilisateur <> OLD.identifiant_utilisateur THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur, NEW.identifiant_utilisateur);
        END IF;
        IF NEW.date_observation <> OLD.date_observation THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'date_observation', OLD.date_observation, NEW.date_observation);
        END IF;
        IF NEW.pays_observation <> OLD.pays_observation THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'pays_observation', OLD.pays_observation, NEW.pays_observation);
        END IF;
        IF NEW.ville_observation <> OLD.ville_observation THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'ville_observation', OLD.ville_observation, NEW.ville_observation);
        END IF;
        IF NEW.commentaire <> OLD.commentaire THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'commentaire', OLD.commentaire, NEW.commentaire);
        END IF;
        IF NEW.visibilite <> OLD.visibilite THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'visibilite', OLD.visibilite, NEW.visibilite);
        END IF;
        IF NEW.interne <> OLD.interne THEN
            INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur, nouvelle_valeur)
            VALUES (NEW.id_observation, 'UPDATE', NOW(), 'interne', OLD.interne, NEW.interne);
        END IF;
    END //
    DELIMITER ;

    DELIMITER //
    CREATE TRIGGER tr_observation_delete
    AFTER DELETE ON Observations
    FOR EACH ROW
    BEGIN
        INSERT INTO Historique_Observations (id_observation, action, date_modification, colonne_changee, ancienne_valeur)
        VALUES (OLD.id_observation, 'DELETE', NOW(), 'id_espece', OLD.id_espece),
            (OLD.id_observation, 'DELETE', NOW(), 'identifiant_utilisateur', OLD.identifiant_utilisateur),
            (OLD.id_observation, 'DELETE', NOW(), 'date_observation', OLD.date_observation),
            (OLD.id_observation, 'DELETE', NOW(), 'pays_observation', OLD.pays_observation),
            (OLD.id_observation, 'DELETE', NOW(), 'ville_observation', OLD.ville_observation),
            (OLD.id_observation, 'DELETE', NOW(), 'commentaire', OLD.commentaire),
            (OLD.id_observation, 'DELETE', NOW(), 'visibilite', OLD.visibilite),
            (OLD.id_observation, 'DELETE', NOW(), 'interne', OLD.interne);
    END //
    DELIMITER ;

