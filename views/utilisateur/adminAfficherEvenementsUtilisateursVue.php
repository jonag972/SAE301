<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Afficher les événements des utilisateurs</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Événements des utilisateurs en ordre décroissant</h1>
    <?php if (!empty($evenements)) : ?>
        <?php foreach ($evenements as $evenement) :
            if ($evenement['action'] == 'INSERT') {
                echo $evenement['identifiant_utilisateur'] . ' s\'est inscrit ou a été ajouté le ' . $evenement['date_modification'] . '<br>';
            } else if ($evenement['action'] == 'UPDATE') {
                if ($evenement['colonne_changee'] == 'date_derniere_connexion') {
                    echo $evenement['identifiant_utilisateur'] . ' s\'est connecté le ' . $evenement['date_modification'] . '<br>';
                } else if ($evenement['colonne_changee'] == 'date_derniere_deconnexion') {
                    echo $evenement['identifiant_utilisateur'] . ' s\'est déconnecté le ' . $evenement['date_modification'] . '<br>';
                } else {
                    echo $evenement['identifiant_utilisateur'] . ' a changé ' . $evenement['colonne_changee'] . ' de son compte le ' . $evenement['date_modification'] . ' de ' . $evenement['ancienne_valeur'] . ' à ' . $evenement['nouvelle_valeur'] . '<br>';
                }
            } else if ($evenement['action'] == 'DELETE') {
                echo $evenement['identifiant_utilisateur'] . ' s\'est désinscrit ou a été supprimé le ' . $evenement['date_modification'] . '<br>';
            }
        endforeach; ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?action=adminAfficherEvenementsUtilisateurs&page=<?php echo $page - 1; ?>">Page précédente</a>
            <?php endif; ?>
            <?php if (count($evenements) == 10) : ?>
                <a href="?action=adminAfficherEvenementsUtilisateurs&page=<?php echo $page + 1; ?>">Page suivante</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <strong><p><?php echo $messageErreur; ?></p></strong>
        <a href="?action=adminAfficherEvenementsUtilisateurs&page=<?php echo $page - 1; ?>">Page précédente</a>
    <?php endif; ?>
    </body>
</html>