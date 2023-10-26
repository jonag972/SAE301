<?php
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
class ControllerAccueil {
    public function accueil() {

        // Inclure la vue de la page d'accueil
        include 'views/barredenavigation.php';
        $content = include 'views/accueil/accueilVue.php';
    }
}
?>
