<?php
// Créer le cookie si il n'existe pas
if (!isset($_COOKIE['PHPSESSID'])) {
    session_start();
    setcookie('PHPSESSID', session_id(), time() + 3600, '/');
}

class ControllerAccueil {
    public function accueil() {

        // Inclure la vue de la page d'accueil
        include 'views/accueil/accueilVue.php';
    }
}
?>
