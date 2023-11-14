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

    public static function rechercheIdEspeceParCritereInterne($frenchVernacularNames, $englishVernacularNames, $scientificNames, $vernularGroups, $taxonomicRanks, $territories, $domain, $habitats, $page, $parPage){
        $query = "SELECT id_espece FROM Especes WHERE 1=1";
        $values = array(
            ':offset' => ($page - 1) * $parPage,
            ':limit' => $parPage
        );
    
        if (!empty($frenchVernacularNames)) {
            $query .= " AND frenchVernacularNames LIKE :frenchVernacularNames";
            $values[':frenchVernacularNames'] = '%' . $frenchVernacularNames . '%';
        }
        if (!empty($englishVernacularNames)) {
            $query .= " AND englishVernacularNames LIKE :englishVernacularNames";
            $values[':englishVernacularNames'] = '%' . $englishVernacularNames . '%';
        }
        if (!empty($scientificNames)) {
            $query .= " AND scientificNames LIKE :scientificNames";
            $values[':scientificNames'] = '%' . $scientificNames . '%';
        }
        if (!empty($vernularGroups)) {
            $query .= " AND vernacularGroup LIKE :vernacularGroup";
            $values[':vernacularGroup'] = '%' . $vernularGroups . '%';
        }
        if (!empty($taxonomicRanks)) {
            $query .= " AND taxonomicRanks LIKE :taxonomicRanks";
            $values[':taxonomicRanks'] = '%' . $taxonomicRanks . '%';
        }
        if (!empty($territories)) {
            $query .= " AND territory LIKE :territory";
            $values[':territory'] = '%' . $territories . '%';
        }
        if (!empty($domain)) {
            $query .= " AND domain LIKE :domain";
            $values[':domain'] = '%' . $domain . '%';
        }
        if (!empty($habitats)) {
            $query .= " AND habitat LIKE :habitat";
            $values[':habitat'] = '%' . $habitats . '%';
        }
    
        $query .= " ORDER BY id_espece LIMIT :offset, :limit";
    
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat;
    }
    

    public function rechercheIdEspeceParCritereExterne($frenchVernacularNames, $englishVernacularNames, $scientificNames, $vernularGroups, $taxonomicRanks, $territories, $domain, $habitats, $page, $parPage){
        $apiUrl = "https://taxref.mnhn.fr/api/taxa/search?version=16.0&page=$page&size=$parPage";
    
        if (!empty($scientificNames)) {
            $apiUrl .= "&scientificNames={$scientificNames}";
        }
        if (!empty($frenchVernacularNames)) {
            $apiUrl .= "&frenchVernacularNames={$frenchVernacularNames}";
        }
        if (!empty($englishVernacularNames)) {
            $apiUrl .= "&englishVernacularNames={$englishVernacularNames}";
        }
        if (!empty($taxonomicRanks)) {
            $apiUrl .= "&taxonomicRanks={$taxonomicRanks}";
        }
        if (!empty($territories)) {
            $apiUrl .= "&territories={$territories}";
        }
        if (!empty($domain)) {
            $apiUrl .= "&domain={$domain}";
        }
        if (!empty($habitats)) {
            $apiUrl .= "&habitats={$habitats}";
        }
        if (!empty($vernularGroups)) {
            $apiUrl .= "&vernacularGroups={$vernularGroups}";
        }
    
        $speciesData = file_get_contents($apiUrl);
        $species = json_decode($speciesData, true);
        $ids = array();
        foreach ($species["_embedded"]["taxa"] as &$specie) {
            $ids[] = $specie['id'];
        }
        return $ids;
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
}
