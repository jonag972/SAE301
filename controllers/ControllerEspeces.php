<?php
require_once 'models/modelEspeces.php';
require_once 'models/modelNaturotheques.php';
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
class ControllerEspeces {
    public function estAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    public function especeAjouteParUtilisateur($id_espece) {
        $query = "SELECT * FROM Especes WHERE id_espece = :id_espece AND identifiant_utilisateur = :identifiant_utilisateur";
        $values = array(
            ':id_espece' => $id_espece,
            ':identifiant_utilisateur' => $_SESSION['identifiant_utilisateur']
        );
        $resultat = database::prepareEtExecute($query, $values);
        return $resultat ? true : false;
    }

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
        $nombreEspeces = modelEspeces::getNombreEspecesBDD();
        $nombrePages = ceil($nombreEspeces / $parPage);
        $pagination = [
            'page' => $page,
            'parPage' => $parPage,
            'nombreEspeces' => $nombreEspeces,
            'nombrePages' => $nombrePages
        ];

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
                    'frenchVernacularName' => modelEspeces::getAttributParIdInterne('frenchVernacularName', $id),
                    'scientificName' => modelEspeces::getAttributParIdInterne('scientificName', $id),
                    'genusName' => modelEspeces::getAttributParIdInterne('genusName', $id),
                    'familyName' => modelEspeces::getAttributParIdInterne('familyName', $id),
                    'orderName' => modelEspeces::getAttributParIdInterne('orderName', $id),
                    'className' => modelEspeces::getAttributParIdInterne('className', $id),
                    'kingdomName' => modelEspeces::getAttributParIdInterne('kingdomName', $id),
                    'habitat' => modelEspeces::getAttributParIdInterne('habitat', $id),
                    'mediaImage' => modelEspeces::getAttributParIdInterne('mediaImage', $id),
                    // On ajoute 'imagePrefix' pour pouvoir afficher l'image dans la vue
                    'imagePrefix' => 'data:image/jpeg;base64,',
                    'interne' => 'TRUE'
                ];
            }

        } elseif ($interne === 'FALSE') {
            foreach ($species["_embedded"]["taxa"] as &$specie) {
                $especes[] = [
                    'id' => $specie['id'],
                    'frenchVernacularName' => modelEspeces::getAttributParIdExterne('frenchVernacularName', $specie['id']),
                    'scientificName' => modelEspeces::getAttributParIdExterne('scientificName', $specie['id']),
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
                $frenchVernacularName = $_POST['frenchVernacularName'];
                $englishVernacularName = $_POST['englishVernacularName'];
                $scientificName = $_POST['scientificName'];
                $genusName = $_POST['genusName'];
                $familyName = $_POST['familyName'];
                $orderName = $_POST['orderName'];
                $className = $_POST['className'];
                $kingdomName = $_POST['kingdomName'];
                $habitat = $_POST['habitat'];
                $resultat = modelEspeces::addEspeceBDD($frenchVernacularName, $englishVernacularName, $scientificName, $genusName, $familyName, $orderName, $className, $kingdomName, $habitat, $mediaImage);
                header('Location: ?action=afficherToutesLesEspeces&page=1&parPage=10&interne=TRUE');
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

    public function modifierEspece() {
        $id = $_GET['id'];
        if ($this->especeAjouteParUtilisateur($id) || $this->estAdmin()) {
            $espece = modelEspeces::getEspeceParIdInternes($id);
            include 'views/especes/modifierEspeceVue.php';
        } else {
            $error = 'Vous n\'avez pas la permission de modifier cette espèce.';
            include 'views/errors/error.php';
        }
    }

    public function modifierEspeceConfirmation() {
        $id = $_POST['id'];
        if ($this->especeAjouteParUtilisateur($id) || $this->estAdmin()) {
                if (isset($_FILES['mediaImage']) && $_FILES['mediaImage']['error'] == 0){
                    $mediaImage = base64_encode(file_get_contents($_FILES['mediaImage']['tmp_name']));
                } else {
                    $mediaImage = modelEspeces::getAttributParIdInterne('mediaImage', $id);
                }
                $frenchVernacularName = $_POST['frenchVernacularName'];
                $englishVernacularName = $_POST['englishVernacularName'];
                $scientificName = $_POST['scientificName'];
                $genusName = $_POST['genusName'];
                $familyName = $_POST['familyName'];
                $orderName = $_POST['orderName'];
                $className = $_POST['className'];
                $kingdomName = $_POST['kingdomName'];
                $habitat = $_POST['habitat'];
                $resultat = modelEspeces::modificationEspece($id, $frenchVernacularName, $englishVernacularName, $scientificName, $genusName, $familyName, $orderName, $className, $kingdomName, $habitat, $mediaImage);
                header('Location: ?action=afficherToutesLesEspeces');
        } else {
            $error = 'Vous n\'avez pas la permission de modifier cette espèce.';
            include 'views/errors/error.php';
        }
    }

    public function supprimerEspece() {
        $id = $_GET['id'];
        if ($this->especeAjouteParUtilisateur($id) || $this->estAdmin()) {
            modelEspeces::supprimerEspece($id);
            // Redirection appropriée
            header('Location: ?action=afficherToutesLesEspeces');
        } else {
            $error = 'Vous n\'avez pas la permission de supprimer cette espèce.';
            include 'views/errors/error.php';
        }
    }

    public function detailsEspece() {
        $id = $_GET['id'];
        $interne = $_GET['interne'];
        if ($interne == 'TRUE' || $interne == '1') {
            $espece['id'] = $id;
            $espece['frenchVernacularName'] = modelEspeces::getAttributParIdInterne('frenchVernacularName', $id);
            $espece['englishVernacularName'] = modelEspeces::getAttributParIdInterne('englishVernacularName', $id);
            $espece['scientificName'] = modelEspeces::getAttributParIdInterne('scientificName', $id);
            $espece['genusName'] = modelEspeces::getAttributParIdInterne('genusName', $id);
            $espece['familyName'] = modelEspeces::getAttributParIdInterne('familyName', $id);
            $espece['orderName'] = modelEspeces::getAttributParIdInterne('orderName', $id);
            $espece['className'] = modelEspeces::getAttributParIdInterne('className', $id);
            $espece['kingdomName'] = modelEspeces::getAttributParIdInterne('kingdomName', $id);
            $espece['habitat'] = modelEspeces::getAttributParIdInterne('habitat', $id);
            $espece['imagePrefix'] = 'data:image/jpeg;base64,';
            $espece['mediaImage'] = modelEspeces::getAttributParIdInterne('mediaImage', $id);
            $espece['interne'] = 'TRUE';
        } elseif ($interne === 'FALSE' || $interne === '0') {
            $espece['id'] = $id;
            $espece['frenchVernacularName'] = modelEspeces::getAttributParIdExterne('frenchVernacularName', $id);
            $espece['englishVernacularName'] = modelEspeces::getAttributParIdExterne('englishVernacularName', $id);
            $espece['scientificName'] = modelEspeces::getAttributParIdExterne('scientificName', $id);
            $espece['genusName'] = modelEspeces::getAttributParIdExterne('genusName', $id);
            $espece['familyName'] = modelEspeces::getAttributParIdExterne('familyName', $id);
            $espece['orderName'] = modelEspeces::getAttributParIdExterne('orderName', $id);
            $espece['className'] = modelEspeces::getAttributParIdExterne('className', $id);
            $espece['kingdomName'] = modelEspeces::getAttributParIdExterne('kingdomName', $id);
            $espece['habitat'] = modelEspeces::getAttributParIdExterne('habitat', $id);
            $espece['mediaImage'] = modelEspeces::getAttributParIdExterne('mediaImage', $id);
            $espece['interne'] = 'FALSE';
            $espece['imagePrefix'] = '';
        }
        include 'views/especes/detailsEspeceVue.php';
    }

    public function ajouterEspeceANaturotheque() {
        $id_espece = $_GET['id_espece'];
        $interne = $_GET['interne'];
        if ($interne === 'TRUE' || $interne === '1') {
            $espece['id'] = $id_espece;
            $espece['frenchVernacularName'] = modelEspeces::getAttributParIdInterne('frenchVernacularName', $id_espece);
            $espece['englishVernacularName'] = modelEspeces::getAttributParIdInterne('englishVernacularName', $id_espece);
            $espece['scientificName'] = modelEspeces::getAttributParIdInterne('scientificName', $id_espece);
            $espece['genusName'] = modelEspeces::getAttributParIdInterne('genusName', $id_espece);
            $espece['familyName'] = modelEspeces::getAttributParIdInterne('familyName', $id_espece);
            $espece['orderName'] = modelEspeces::getAttributParIdInterne('orderName', $id_espece);
            $espece['className'] = modelEspeces::getAttributParIdInterne('className', $id_espece);
            $espece['kingdomName'] = modelEspeces::getAttributParIdInterne('kingdomName', $id_espece);
            $espece['habitat'] = modelEspeces::getAttributParIdInterne('habitat', $id_espece);
            $espece['imagePrefix'] = 'data:image/jpeg;base64,';
            $espece['mediaImage'] = base64_encode(modelEspeces::getAttributParIdInterne('mediaImage', $id_espece));
            $espece['interne'] = 'TRUE';
        } elseif ($interne === 'FALSE' || $interne === '0') {
            $espece['id'] = $id_espece;
            $espece['frenchVernacularName'] = modelEspeces::getAttributParIdExterne('frenchVernacularName', $id_espece);
            $espece['englishVernacularName'] = modelEspeces::getAttributParIdExterne('englishVernacularName', $id_espece);
            $espece['scientificName'] = modelEspeces::getAttributParIdExterne('scientificName', $id_espece);
            $espece['genusName'] = modelEspeces::getAttributParIdExterne('genusName', $id_espece);
            $espece['familyName'] = modelEspeces::getAttributParIdExterne('familyName', $id_espece);
            $espece['orderName'] = modelEspeces::getAttributParIdExterne('orderName', $id_espece);
            $espece['className'] = modelEspeces::getAttributParIdExterne('className', $id_espece);
            $espece['kingdomName'] = modelEspeces::getAttributParIdExterne('kingdomName', $id_espece);
            $espece['habitat'] = modelEspeces::getAttributParIdExterne('habitat', $id_espece);
            $espece['interne'] = 'FALSE';
            $espece['imagePrefix'] = '';
        }
        $naturotheques = modelNaturotheques::obtenirNaturothequesParUtilisateur($_SESSION['identifiant_utilisateur'], 1, 100);
        include 'views/especes/ajouterEspeceANaturothequeVue.php';
    }

    public function rechercherEspecesResultats() {
        // Récupération des paramètres de recherche depuis la requête GET
        $scientificName = isset($_GET['scientificName']) ? $_GET['scientificName'] : '';
        $interne = isset($_GET['interne']) ? $_GET['interne'] : 'TRUE';
    
        // Récupération des paramètres de pagination
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $parPage = isset($_GET['parPage']) ? (int) $_GET['parPage'] : 10;
    
        // Initialisation du tableau de résultats
        $especes = [];
    
        if ($interne === 'TRUE') {
            // Recherche dans la base de données interne
            $resultat = modelEspeces::rechercheEspeceInterneParscientificName($scientificName, $page, $parPage);
            foreach ($resultat as $espece) {
                $especes[] = [
                    'id' => $espece['id_espece'],
                    'frenchVernacularName' => $espece['frenchVernacularName'],
                    'scientificName' => $espece['scientificName'],
                    'genusName' => $espece['genusName'],
                    'familyName' => $espece['familyName'],
                    'orderName' => $espece['orderName'],
                    'className' => $espece['className'],
                    'kingdomName' => $espece['kingdomName'],
                    'habitat' => $espece['habitat'],
                    'mediaImage' => base64_encode($espece['mediaImage']),
                    'imagePrefix' => 'data:image/jpeg;base64,',
                    'interne' => 'TRUE'
                ];
            }
        } elseif ($interne === 'FALSE') {
            // Recherche dans l'API externe
            $resultat = modelEspeces::rechercheEspeceExterneParscientificName($scientificName, $page, $parPage);
            foreach ($resultat as $espece) {
                $especes[] = [
                    'id' => $espece['id'],
                    'frenchVernacularName' => $espece['frenchVernacularName'],
                    'scientificName' => $espece['scientificName'],
                    'genusName' => $espece['genusName'],
                    'familyName' => $espece['familyName'],
                    'orderName' => $espece['orderName'],
                    'className' => $espece['className'],
                    'kingdomName' => $espece['kingdomName'],
                    'habitat' => $espece['habitat'],
                    'mediaImage' => $espece['media'],
                    'imagePrefix' => '',
                    'interne' => 'FALSE'
                ];
            }
        }
    
        // Charger la vue et passer les données à la vue
        include 'views/especes/rechercherEspecesResultatsVue.php';
    }

    public function adminAfficherEvenementsEspeces() {
        if ($this->estAdmin()) {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $parPage = isset($_GET['parPage']) ? (int)$_GET['parPage'] : 10;
            $totalEvenements = modelEspeces::compterEvenementsToutesEspeces();
            $evenements = modelEspeces::getEvenementsToutesEspeces($page, $parPage);
            $nombreDePages = ceil($totalEvenements / $parPage);
            include 'views/especes/adminAfficherEvenementsEspecesVue.php';
            $messageErreur = '';
        } else {
            $error = 'Vous n\'avez pas la permission d\'afficher les événements de toutes les espèces.';
            include 'views/errors/error.php';
        }
    }
}
