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

    public static function rechercheEspeceInterneParscientificName($scientificName, $page, $parPage){
        $offset = ($page - 1) * $parPage;
        $query = "SELECT * FROM Especes WHERE scientificName LIKE :scientificName ORDER BY id_espece LIMIT :offset, :limit";
        $pdoStatement = database::prepare($query);
        $pdoStatement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $pdoStatement->bindParam(':limit', $parPage, PDO::PARAM_INT);
        $pdoStatement->bindValue(':scientificName', '%' . $scientificName . '%');
        $pdoStatement->execute();
        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function rechercheEspeceExterneParscientificName($scientificName, $page, $parPage){
        $url = "https://taxref.mnhn.fr/api/taxa/search?scientificName=" . urlencode($scientificName) . "&page=" . $page . "&size=" . $parPage;
        $json = file_get_contents($url);
        $reponse = json_decode($json, true);
        $resultat = array();
        
        if (isset($reponse['_embedded']['taxa'])) {
            foreach ($reponse['_embedded']['taxa'] as $espece) {
                $resultat[] = [
                    'id' => $espece['id'],
                    'frenchVernacularName' => $espece['vernacularNames'][0]['vernacularName'] ??= "Non renseigné",
                    'englishVernacularName' => $espece['vernacularNames'][1]['vernacularName'] ??= "Non renseigné",
                    'scientificName' => $espece['scientificName'] ??= "Non renseigné",
                    'genusName' => $espece['genusName'] ??= "Non renseigné",
                    'familyName' => $espece['familyName'] ??= "Non renseigné",
                    'orderName' => $espece['orderName'] ??= "Non renseigné",
                    'className' => $espece['className'] ??= "Non renseigné",
                    'kingdomName' => $espece['kingdomName'] ??= "Non renseigné",
                    'habitat' => $espece['habitat'] ??= "Non renseigné",
                    'media' => $espece['_links']['thumbnailFile']['href'] ??= 'assets/images/unknown/unknownanimal.jpeg'
                ];
            }
        }
        
        return $resultat;
    }
    
    
    

    public static function addEspeceBDD ($frenchVernacularName, $englishVernacularName, $scientificName, $genusName, $familyName, $orderName, $classNAme, $kingdomName, $habitat, $mediaImage){
        $query = "INSERT INTO Especes (frenchVernacularName, englishVernacularName, scientificName, genusName, familyName, orderName, className, kingdomName, habitat, mediaImage) VALUES (:frenchVernacularName, :englishVernacularName, :scientificName, :genusName, :familyName, :orderName, :className, :kingdomName, :habitat, :mediaImage)";
        $values = array(
            ':frenchVernacularName' => $frenchVernacularName,
            ':englishVernacularName' => $englishVernacularName,
            ':scientificName' => $scientificName,
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

    public static function modificationEspece($id_espece, $frenchVernacularName, $englishVernacularName, $scientificName, $genusName, $familyName, $orderName, $classNAme, $kingdomName, $habitat, $mediaImage){
        $query = "UPDATE Especes SET frenchVernacularName = :frenchVernacularName, englishVernacularName = :englishVernacularName, scientificName = :scientificName, genusName = :genusName, familyName = :familyName, orderName = :orderName, className = :className, kingdomName = :kingdomName, habitat = :habitat, mediaImage = :mediaImage WHERE id_espece = :id_espece";
        $values = array(
            ':id_espece' => $id_espece,
            ':frenchVernacularName' => $frenchVernacularName,
            ':englishVernacularName' => $englishVernacularName,
            ':scientificName' => $scientificName,
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

    public static function supprimerEspece($id_espece){
        $query = "DELETE FROM Especes WHERE id_espece = :id_espece";
        $values = array(
            ':id_espece' => $id_espece
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function getEspecesParNaturotheque($id_naturotheque){
        $query = "SELECT * FROM Especes NATURAL JOIN EspecesNaturotheque WHERE id_naturotheque = :id_naturotheque";
        $values = array(
            ':id_naturotheque' => $id_naturotheque
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }

    public static function compterEvenementsToutesEspeces(){
        $query = "SELECT COUNT(*) AS count FROM Historique_Especes GROUP BY date_modification";
        $resultat = database::prepareEtExecute($query);
        $nombreEvenements = count($resultat);
        return $nombreEvenements;
    }

    public static function getEvenementsToutesEspeces($page, $nombreParPage){
        $offset = ($page - 1) * $nombreParPage;
        $query = "SELECT * FROM Historique_Especes GROUP BY date_modification ORDER BY date_modification DESC LIMIT :offset, :nombreParPage";
        $values = array(':offset' => $offset, ':nombreParPage' => $nombreParPage);
        return database::prepareExecuteBind($query, $values);
    }
}
