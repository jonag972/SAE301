<?php
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
//Par défaut si aucun paramètre n'est passé dans l'URL, on affiche la page d'accueil
if (empty($_GET['action'])) {
    $action = 'accueil';
} else {
    $action = $_GET['action'];

}


// On vérifie la valeur du paramètre page et on appelle le contrôleur correspondant
switch ($action) {
    // Naturothèques
    case 'afficherToutesLesNaturotheques':
        // On appelle le contrôleur de la page de toutes les naturothèques
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'detailsNaturotheque':
        // On appelle le contrôleur de la page de détails d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'afficherMesNaturotheques':
        // On appelle le contrôleur de la page de mes naturothèques
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'ajouterNaturotheque':
        // On appelle le contrôleur de la page d'ajout d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'ajoutNaturothequeBDD':
        // On appelle le contrôleur de la page d'ajout d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;
    
    case 'modifierNaturotheque':
        // On appelle le contrôleur de la page de modification d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'modificationNaturothequeBDD':
        // On appelle le contrôleur de la page de modification d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'supprimerNaturotheque':
        // On appelle le contrôleur de la page de suppression d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'rechercherNaturotheques':
        // On appelle le contrôleur de la page de recherche de naturothèques
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    // Observations
    case 'afficherToutesLesObservations':
        // On appelle le contrôleur de la page de toutes les observations
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'afficherObservation':
        // On appelle le contrôleur de la page de détails d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'ajouterObservation':
        // On appelle le contrôleur de la page d'ajout d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'enregistrerObservation':
        // On appelle le contrôleur de la page d'ajout d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'modifierObservation':
        // On appelle le contrôleur de la page de modification d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'miseAJourObservation':
        // On appelle le contrôleur de la page de modification d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'supprimerObservation':
        // On appelle le contrôleur de la page de suppression d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;
    
    case 'detailsObservation':
        // On appelle le contrôleur de la page de détails d'une observation
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'rechercherObservations':
        // On appelle le contrôleur de la page de recherche d'observations
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    

    // Utilisateurs

    case 'adminAfficherTousLesUtilisateurs':
        // On appelle le contrôleur de la page d'administration des utilisateurs
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminSupprimerUtilisateur':
        // On appelle le contrôleur de la page de suppression d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminAfficherUtilisateur':
        // On appelle le contrôleur de la page d'affichage d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminModifierUtilisateur':
        // On appelle le contrôleur de la page de modification d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminModificationUtilisateur':
        // On appelle le contrôleur de la page de modification d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminAjouterUtilisateur':
        // On appelle le contrôleur de la page d'ajout d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'adminAjoutUtilisateur':
        // On appelle le contrôleur de la page d'ajout d'un utilisateur
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;


    case 'adminAfficherEvenementsUtilisateurs':
        // On appelle le contrôleur de la page d'affichage des événements des utilisateurs
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    // Espèces    

    case 'afficherToutesLesEspeces':
        // On appelle le contrôleur des espèces
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'detailsEspece':
        // On appelle le contrôleur des espèces pour la page de détails
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'ajouterEspeceANaturotheque':
        // On appelle le contrôleur des espèces pour la page d'ajout d'espèce à une naturothèque
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'ajouterEspeceANaturothequeConfirmation':
        // On appelle le contrôleur des espèces pour la page de confirmation d'ajout d'espèce à une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'accueil':
        // On appelle le contrôleur de la page d'accueil
        $controller_file = 'controllers/ControllerAccueil.php';
        $controllerName = 'ControllerAccueil';
        break;

    case 'sinscrire':
        // On appelle le contrôleur de la page d'inscription
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'inscription':
        // On appelle le contrôleur de la page d'inscription
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'seconnecter':
        // On appelle le contrôleur de la page de connexion
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'connexion':
        // On appelle le contrôleur de la page de connexion
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'deconnexion':
        // On appelle le contrôleur de la page de déconnexion
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'monCompte':
        // On appelle le contrôleur de la page de mon compte
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;
    
    case 'modifierCompte':
        // On appelle le contrôleur de la page de modification de compte
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'modificationCompte':
        // On appelle le contrôleur de la page de modification de compte
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'supprimerCompte':
        // On appelle le contrôleur de la page de suppression de compte
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'rechercherEspeces':
        // On appelle le contrôleur de la page de recherche d'espèces
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'rechercherEspecesResultats':
        // On appelle le contrôleur de la page de résultats de recherche d'espèces
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'testmodelEspeces':
        // On appelle le contrôleur de la page de test du modèle des espèces
        $controller_file = 'models/tests/TestModelEspeces.php';
        $controllerName = 'TestModelEspeces';
        break;

    case 'testmodelUtilisateur':
        // On appelle le contrôleur de la page de test du modèle des utilisateurs
        $controller_file = 'models/tests/TestModelUtilisateur.php';
        $controllerName = 'TestModelUtilisateur';
        break;

    case 'supprimerCompteConfirmation':
        // On appelle le contrôleur de la page de confirmation de suppression de compte
        $controller_file = 'controllers/ControllerUtilisateur.php';
        $controllerName = 'ControllerUtilisateur';
        break;

    case 'ajouterEspece':
        // On appelle le contrôleur de la page d'ajout d'espèce
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'ajouterEspeceConfirmation':
        // On appelle le contrôleur de la page de confirmation d'ajout d'espèce
        $controller_file = 'controllers/ControllerEspeces.php';
        $controllerName = 'ControllerEspeces';
        break;

    case 'afficherToutesLesNaturotheques':
        // On appelle le contrôleur de la page de toutes les naturothèques
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'detailsNaturotheque':
        // On appelle le contrôleur de la page de détails d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'afficherMesNaturotheques':
        // On appelle le contrôleur de la page de mes naturothèques
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'ajouterNaturotheque':
        // On appelle le contrôleur de la page d'ajout d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'ajoutNaturothequeBDD':
        // On appelle le contrôleur de la page d'ajout d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;
    
    case 'ajoutNaturothequeConfirmation':
        // On appelle le contrôleur de la page de confirmation d'ajout d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'modifierNaturotheque':
        // On appelle le contrôleur de la page de modification d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'modificationNaturotheque':
        // On appelle le contrôleur de la page de modification d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'supprimerNaturotheque':
        // On appelle le contrôleur de la page de suppression d'une naturothèque
        $controller_file = 'controllers/ControllerNaturotheques.php';
        $controllerName = 'ControllerNaturotheques';
        break;

    case 'afficherToutesLesObservations':
        // On appelle le contrôleur de la page de toutes les observations
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'afficherMesObservations':
        // On appelle le contrôleur de la page de mes observations
        $controller_file = 'controllers/ControllerObservations.php';
        $controllerName = 'ControllerObservations';
        break;

    case 'detailsObservation':
        // On appelle le contrôleur de la page de détails d'une observation
        $controller_file = 'controllers/ControllerObservation.php';
        $controllerName = 'ControllerObservation';
        break;
    
    case 'ajouterObservation':
        // On appelle le contrôleur de la page d'ajout d'une observation
        $controller_file = 'controllers/ControllerObservation.php';
        $controllerName = 'ControllerObservation';
        break;
    

    default:
        // La page par défaut est la page d'accueil
        $controller_file = 'controllers/ControllerHome.php';
        $controllerName = 'ControllerHome';
        break;

}

// Inclut le fichier du contrôleur correspondant
if (file_exists($controller_file)) {
    include $controller_file;

    // Crée une instance du contrôleur
    $controller = new $controllerName();

    // Appelle la méthode correspondante à l'action
    $controller->$action($_GET);

} else {
    // Si le contrôleur n'existe pas, on redirige vers la page d'erreur "unknownPage"
    $controller_file = 'controllers/unknownPageController.php';
    include $controller_file;
    $controllerName = 'UnknownPageController';
    $controller = new $controllerName();
    $controller->index();
}

?>
