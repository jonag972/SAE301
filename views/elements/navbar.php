<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/elements/navbar.css">
    <meta charset="utf-8">
</head>
<body>
    <div class="navbar-wrapper">
        <nav id="navbar">
            <ul>
                <li><a href="?action=accueil">Accueil</a></li>
                <li><a href="?action=afficherToutesLesEspeces&page=1&parPage=10&interne=TRUE">Espèces</a></li>
                <?php
                // Vérifiez si l'utilisateur est connecté
                if (isset($_SESSION['identifiant_utilisateur'])) {
                    echo '<li><a href="?action=afficherToutesLesNaturotheques">Naturothèques</a></li>';
                    echo '<li><a href="?action=afficherToutesLesObservations">Observations</a></li>';
                }
                ?>
                <?php
                // Afficher le nom de l'utilisateur
                // Afficher une liste déroulante qui affiche l'identifiant de l'utilisateur et dans la liste déroulante, il y a un lien vers la page de modification du compte
                echo '<li><a href="?action=rechercherEspeces">Rechercher</a></li>';
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li id="admin">Events</a>';
                    echo '<ul>';
                    echo '<li><a href="?action=adminAfficherEvenementsUtilisateurs">Afficher tous les événements des utilisateurs</a></li>';
                    echo '<li><a href="?action=adminAfficherEvenementsEspeces">Afficher tous les événements des espèces</a></li>';
                    echo '<li><a href="?action=adminAfficherEvenementsNaturotheques">Afficher tous les événements des naturothèques</a></li>';
                    echo '<li><a href="?action=adminAfficherEvenementsObservations">Afficher tous les événements des observations</a></li>';
                    echo '</ul>';
                }
                if (isset($_SESSION['identifiant_utilisateur'])) {
                    echo '<li id="utilisateur"><a href="?action=monCompte">' . $_SESSION['identifiant_utilisateur'] . '</a>';
                    echo '<ul>';
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                        echo '<li><a href="?action=adminAfficherTousLesUtilisateurs">Afficher tous les utilisateurs</a></li>';
                    }
                    echo '<li><a href="?action=modifierCompte">Modifier mon compte</a></li>';
                    echo '<li><a href="?action=deconnexion">Se déconnecter</a></li>';
                    echo '</ul>';
                    echo '</li>';
                }
                if (!isset($_SESSION['identifiant_utilisateur'])) {
                    echo '<li><a href="?action=seconnecter">Se connecter</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</body>
</html>
