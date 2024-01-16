<?php
require_once 'database.php';
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}

class modelEspeces {
    public static function getHabitatDefinitionParIdAPI($habitatnbr){
        if($habitatnbr == "Non renseigné"){
            return $habitatnbr;
        } else {
            $urlhabitat = "https://taxref.mnhn.fr/api/habitats/$habitatnbr";
            $jsonhabitat = file_get_contents($urlhabitat);
            $reponsehabitat = json_decode($jsonhabitat, true);
            $habitat = $reponsehabitat['definition'] ??= "Non renseigné";
            return $habitat;
        }
    }
    public static function getImageParIdAPI($id_espece){
        $url = "https://taxref.mnhn.fr/api/taxa/$id_espece/media";
        $json = file_get_contents($url);
        $reponseimage = json_decode($json, true);
        $image = $reponseimage["_embedded"]["media"][0]["_links"]["thumbnailFile"]["href"] ??= 'assets/images/unknown/unknownanimal.jpeg';
        return $image;
    }

    public static function getNombreEspecesBDD(){
        $query = "SELECT COUNT(*) AS nombreEspeces FROM Especes";
        $resultat = database::prepareEtExecute($query);
        $nombreEspeces = $resultat[0]['nombreEspeces'];
        return $nombreEspeces;
    }
    
    public static function getEspecesInterneParPage($offset, $limit){
        $query = "SELECT * FROM Especes ORDER BY id_espece LIMIT :offset, :limit";
        $values = array(
            ':offset' => $offset,
            ':limit' => $limit
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function getAttributParIdInterne($attribut, $id_espece){
        $query = "SELECT $attribut FROM Especes WHERE id_espece = :id_espece";
        $values = array(
            ':id_espece' => $id_espece
        );
        $resultat = database::prepareEtExecute($query, $values);
        $attribut = $resultat[0][$attribut];
        return $attribut;
    }

    public static function getIdsParPage($page, $parPage){
        $offset = ($page - 1) * $parPage;
        $query = "SELECT id_espece FROM Especes ORDER BY id_espece LIMIT :offset, :limit";
        $stmt = database::prepare($query);
        // Utiliser bindValue pour lier les paramètres à la requête SQL.
        // Spécifier le type de données du paramètre pour s'assurer que les paramètres sont traités comme des entiers.
        // Cela est nécessaire car PDO traite tous les paramètres comme des chaînes de caractères par défaut,
        // ce qui peut provoquer une erreur de syntaxe SQL lors de l'utilisation de la clause LIMIT.
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $parPage, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $resultat;
    }
    
    

    public static function getAttributParIdExterne($attribut, $id_espece){
            $url = "https://taxref.mnhn.fr/api/taxa/$id_espece";
            $json = file_get_contents($url);
            $reponseattribut = json_decode($json, true);

            if($attribut=='habitat'){
                $habitatnbr = $reponseattribut['habitat'] ??= "Non renseigné";
                return self::getHabitatDefinitionParIdAPI($habitatnbr);
            } else if($attribut=='mediaImage'){
                return self::getImageParIdAPI($id_espece);
            }
            else {
                $attribut = $reponseattribut[$attribut] ??= "Non renseigné";
                return $attribut;
            }
    }

    public static function rechercheEspeceInterneParScientificNames($scientificNames, $page, $parPage){
        $offset = ($page - 1) * $parPage;
        $query = "SELECT * FROM Especes WHERE scientificNames LIKE :scientificNames ORDER BY id_espece LIMIT :offset, :limit";
        $pdoStatement = database::prepare($query);
        $pdoStatement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $pdoStatement->bindParam(':limit', $parPage, PDO::PARAM_INT);
        $pdoStatement->bindValue(':scientificNames', '%' . $scientificNames . '%');
        $pdoStatement->execute();
        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function rechercheEspeceExterneParScientificNames($scientificNames, $page, $parPage){
        $offset = ($page - 1) * $parPage;
        $url = "https://external-api.example.com/especes?scientificNames=" . urlencode($scientificNames) . "&offset=" . $offset . "&limit=" . $parPage;
        $json = file_get_contents($url);
        $reponse = json_decode($json, true);
        $resultat = array();
        foreach ($reponse['data'] as $espece) { // Assurez-vous que 'data' correspond au format de réponse de l'API
            $resultat[] = $espece; // Adaptez cette ligne en fonction de la structure de données retournée par l'API
        }
        return $resultat;
    }
    
    

    public static function addEspeceBDD ($frenchVernacularNames, $englishVernacularNames, $scientificNames, $genusName, $familyName, $orderName, $classNAme, $kingdomName, $habitat, $mediaImage){
        $query = "INSERT INTO Especes (frenchVernacularNames, englishVernacularNames, scientificNames, genusName, familyName, orderName, className, kingdomName, habitat, mediaImage) VALUES (:frenchVernacularNames, :englishVernacularNames, :scientificNames, :genusName, :familyName, :orderName, :className, :kingdomName, :habitat, :mediaImage)";
        $values = array(
            ':frenchVernacularNames' => $frenchVernacularNames,
            ':englishVernacularNames' => $englishVernacularNames,
            ':scientificNames' => $scientificNames,
            ':genusName' => $genusName,
            ':familyName' => $familyName,
            ':orderName' => $orderName,
            ':className' => $classNAme,
            ':kingdomName' => $kingdomName,
            ':habitat' => $habitat,
            ':mediaImage' => $mediaImage
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function getEspeceParIdInternes($id_espece){
        $query = "SELECT * FROM Especes WHERE id_espece = :id_espece";
        $values = array(
            ':id_espece' => $id_espece
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function getEspeceParIdExterne($id_espece){
        $url = "https://taxref.mnhn.fr/api/taxa/$id_espece";
        $json = file_get_contents($url);
        $reponse = json_decode($json, true);
        return $reponse;
    }

    public static function getEvenementsToutesEspeces($page, $parPage){
        $offset = ($page - 1) * $parPage;
        $query = "SELECT * FROM Evenements ORDER BY id_evenement LIMIT :offset, :limit";
        $stmt = database::prepare($query);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $parPage, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
