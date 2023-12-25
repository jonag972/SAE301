<?php
require_once 'models/modelEspeces.php';
require_once 'models/modelNaturotheques.php';
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
class ControllerEspeces {
    public function afficherToutesLesEspeces() {
        // Récupérer le numéro de page à partir de l'URL
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        } else {
            $page = 1; // Valeur par défaut si page n'est pas défini dans l'URL
        }
        if (isset($_GET['size'])) {
            $parPage = (int) $_GET['size'];
        } else {
            $parPage = 10; // Valeur par défaut si size n'est pas défini dans l'URL
        }

        // Autres paramètres à gérer depuis l'URL, le cas échéant
        $interne = isset($_GET['interne']) ? $_GET['interne'] : TRUE;
        // Gérer la pagination
    
        // Utilisez l'API pour récupérer les espèces de la page demandée
        $apiUrl = "https://taxref.mnhn.fr/api/taxa/search?version=16.0&page={$page}&size={$parPage}";
        $speciesData = file_get_contents($apiUrl);
        $species = json_decode($speciesData, true);
    
        // Vérifiez le nombre d'espèces retournées
        $numSpecies = count($species["_embedded"]["taxa"]);
        $especes = [];
        if($interne === 'TRUE'){
            // Récupérer le nombre total d'espèces dans la base de données
            $nombreEspeces = modelEspeces::getNombreEspecesBDD();
            // Calculer le nombre total de pages à afficher
            $nombrePages = ceil($nombreEspeces / $parPage);
            // Récupérer les ids des espèces de la page actuelle
            $ids = modelEspeces::getIdsParPage($page, $parPage);
            // Faire une boucle sur les ids des espèces pour récupérer les attributs
            foreach ($ids as $id) {
                $especes[] = [
                    'id' => $id,
                    'frenchVernacularNames' => modelEspeces::getAttributParIdInterne('frenchVernacularNames', $id),
                    'scientificNames' => modelEspeces::getAttributParIdInterne('scientificNames', $id),
                    'genusName' => modelEspeces::getAttributParIdInterne('genusName', $id),
                    'familyName' => modelEspeces::getAttributParIdInterne('familyName', $id),
                    'orderName' => modelEspeces::getAttributParIdInterne('orderName', $id),
                    'className' => modelEspeces::getAttributParIdInterne('className', $id),
                    'kingdomName' => modelEspeces::getAttributParIdInterne('kingdomName', $id),
                    'habitat' => modelEspeces::getAttributParIdInterne('habitat', $id),
                    'mediaImage' => base64_encode(modelEspeces::getAttributParIdInterne('mediaImage', $id)),
                    // On ajoute 'imagePrefix' pour pouvoir afficher l'image dans la vue
                    'imagePrefix' => 'data:image/jpeg;base64,',
                    'interne' => 'TRUE'
                ];
            }

        } elseif ($interne === 'FALSE') {
            foreach ($species["_embedded"]["taxa"] as &$specie) {
                $especes[] = [
                    'id' => $specie['id'],
                    'frenchVernacularNames' => modelEspeces::getAttributParIdExterne('frenchVernacularNames', $specie['id']),
                    'scientificNames' => modelEspeces::getAttributParIdExterne('scientificNames', $specie['id']),
                    'genusName' => modelEspeces::getAttributParIdExterne('genusName', $specie['id']),
                    'familyName' => modelEspeces::getAttributParIdExterne('familyName', $specie['id']),
                    'orderName' => modelEspeces::getAttributParIdExterne('orderName', $specie['id']),
                    'className' => modelEspeces::getAttributParIdExterne('className', $specie['id']),
                    'kingdomName' => modelEspeces::getAttributParIdExterne('kingdomName', $specie['id']),
                    'habitat' => modelEspeces::getAttributParIdExterne('habitat', $specie['id']),
                    'mediaImage' => modelEspeces::getAttributParIdExterne('mediaImage', $specie['id']),
                    'imagePrefix' => '',
                    'interne' => 'FALSE'
                ];
            }
        }
        // Charger la vue et passer les données à la vue
        include 'views/especes/afficherToutesLesEspecesVue.php';
    }

    public function rechercherEspecesResultats() {
        // Récupérer le numéro de page à partir de l'URL
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        } else {
            $page = 1; // Valeur par défaut si page n'est pas défini dans l'URL
        }
        if (isset($_GET['parPage'])) {
            $parPage = (int) $_GET['parPage'];
        } else {
            $parPage = 10; // Valeur par défaut si size n'est pas défini dans l'URL
        }
    
        // Autres paramètres à gérer depuis l'URL, le cas échéant
        $interne = isset($_GET['interne']) ? $_GET['interne'] : TRUE;
        // Gérer la pagination
        $parPage = 10; // Nombre d'espèces par page
    
        if($interne === 'TRUE'){
            $ids = modelEspeces::rechercheIdEspeceParCritereInterne($_GET['frenchVernacularNames'], $_GET['englishVernacularNames'], $_GET['scientificNames'], $_GET['vernacularGroups'], $_GET['taxonomicRanks'], $_GET['territories'], $_GET['domain'], $_GET['habitats'], $page, $parPage);
                // Faire une boucle sur les ids des espèces pour récupérer les attributs
                if (empty($ids)) {
                    $especes = [];
                }else {
                    foreach ($ids as $id) {
                        $especes[] = [
                            'frenchVernacularNames' => modelEspeces::getAttributParIdInterne('frenchVernacularNames', $id),
                            'scientificNames' => modelEspeces::getAttributParIdInterne('scientificNames', $id),
                            'genusName' => modelEspeces::getAttributParIdInterne('genusName', $id),
                            'familyName' => modelEspeces::getAttributParIdInterne('familyName', $id),
                            'orderName' => modelEspeces::getAttributParIdInterne('orderName', $id),
                            'className' => modelEspeces::getAttributParIdInterne('className', $id),
                            'kingdomName' => modelEspeces::getAttributParIdInterne('kingdomName', $id),
                            'habitat' => modelEspeces::getAttributParIdInterne('habitat', $id)
                        ];
                    }
                }
        } 
        elseif ($interne === 'FALSE') {
            if (empty($ids)) {
                $especes = 'bite';
            }
            else {
                $ids = modelEspeces::rechercheIdEspeceParCritereExterne($_GET['frenchVernacularNamesSearchValue'], $_GET['englishVernacularNamesSearchValue'], $_GET['scientificNames'], $_GET['vernacularGroups'], $_GET['taxonomicRanks'], $_GET['territories'], $_GET['domain'], $_GET[''], $page, $parPage);
                foreach ($ids as $id) {
                    $especes[] = [
                        'frenchVernacularNames' => modelEspeces::getAttributParIdExterne('frenchVernacularNames', $id),
                        'scientificNames' => modelEspeces::getAttributParIdExterne('scientificNames', $id),
                        'genusName' => modelEspeces::getAttributParIdExterne('genusName', $id),
                        'familyName' => modelEspeces::getAttributParIdExterne('familyName', $id),
                        'orderName' => modelEspeces::getAttributParIdExterne('orderName', $id),
                        'className' => modelEspeces::getAttributParIdExterne('className', $id),
                        'kingdomName' => modelEspeces::getAttributParIdExterne('kingdomName', $id),
                        'habitat' => modelEspeces::getAttributParIdExterne('habitat', $id)
                    ];
                
                }
            }
        }
        include 'views/especes/rechercherEspecesResultatsVue.php';
    }

    public function rechercherEspeces() {
        // Afficher la vue de recherche
        include 'views/especes/rechercherEspecesVue.php';
    }

    public function ajouterEspece() {
        // Afficher la vue d'ajout d'espèce
        include 'views/especes/ajouterEspeceVue.php';
    }

    public function ajouterEspeceConfirmation() {
        // Si le formulaire entier n'a pas été soumis, afficher la vue d'ajout d'espèce
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['mediaImage']) && $_FILES['mediaImage']['error'] == 0){
                $mediaImage = base64_encode(file_get_contents($_FILES['mediaImage']['tmp_name']));
                $frenchVernacularNames = $_POST['frenchVernacularNames'];
                $englishVernacularNames = $_POST['englishVernacularNames'];
                $scientificNames = $_POST['scientificNames'];
                $genusName = $_POST['genusName'];
                $familyName = $_POST['familyName'];
                $orderName = $_POST['orderName'];
                $className = $_POST['className'];
                $kingdomName = $_POST['kingdomName'];
                $habitat = $_POST['habitat'];
                $resultat = modelEspeces::addEspeceBDD($frenchVernacularNames, $englishVernacularNames, $scientificNames, $genusName, $familyName, $orderName, $className, $kingdomName, $habitat, $mediaImage);
                include 'views/especes/ajouterEspeceVue.php';
            } else {
                // Il y a eu une erreur lors du téléchargement du fichier ou le fichier n'a pas été téléchargé
                $message = "Une erreur est survenue lors du téléchargement du fichier.";
                include 'views/especes/ajouterEspeceVue.php';
            }
        } else {
            // Le formulaire n'a pas été soumis
            $message = "Le formulaire n'a pas été soumis.";
            include 'views/especes/ajouterEspeceVue.php';
        }
    }

    public function detailsEspece() {
        $id = $_GET['id'];
        $interne = $_GET['interne'];
        if ($interne === 'TRUE') {
            $espece = modelEspeces::getEspeceParIdInterne($id);
            $espece['interne'] = 'TRUE';
        } elseif ($interne === 'FALSE') {
            $espece = modelEspeces::getEspeceParIdExterne($id);
            $espece['interne'] = 'FALSE';
        }
        include 'views/especes/detailsEspeceVue.php';
    }

    public function ajouterEspeceANaturotheque() {
        $id_espece = $_GET['id_espece'];
        $interne = $_GET['interne'];
        $naturotheques = modelNaturotheques::obtenirNaturothequesParUtilisateur($_SESSION['identifiant_utilisateur']);
        include 'views/naturotheques/ajouterEspeceANaturothequeVue.php';
    }


}