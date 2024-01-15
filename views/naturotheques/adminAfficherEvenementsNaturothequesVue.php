<!DOCTYPE html>
<html>
<head>
    <title>Admin - Afficher les événements des naturothèques</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Événements des naturothèques en ordre décroissant</h1>
    <?php if (!empty($evenements)) : ?>
        <?php foreach ($evenements as $evenement) :
            if ($evenement['action'] == 'INSERT') {
                echo $evenement['identifiant_utilisateur'] . ' a créé la naturothèque ' . $evenement['id_naturotheque'] . ' le ' . $evenement['date_modification'] . '<a href="?action=detailsNaturotheque&id=' . $evenement['id_naturotheque'] . '">Voir la naturothèque</a><br>';
            } else if ($evenement['action'] == 'UPDATE') {
                echo 'La valeur de ' . $evenement['colonne_changee'] . ' de la naturotheque ' . $evenement['id_naturotheque'] . ' a été modifiée le ' . $evenement['date_modification'] . ' de ' . $evenement['ancienne_valeur'] . ' à ' . $evenement['nouvelle_valeur'] . '<a href="?action=detailsNaturotheque&id=' . $evenement['id_naturotheque'] . '">Voir la naturothèque</a><br>';
            } else if ($evenement['action'] == 'DELETE') {
                echo 'La naturotheque ' . $evenement['id_naturotheque'] . ' a été supprimée le ' . $evenement['date_modification'] . '<br>';
            }
        endforeach; ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?action=adminAfficherEvenementsNaturotheques&page=<?php echo $page - 1; ?>">Page précédente</a>
            <?php endif; ?>
            <?php if (count($evenements) == 10) : ?>
                <a href="?action=adminAfficherEvenementsNaturotheques&page=<?php echo $page + 1; ?>">Page suivante</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <strong><p><?php echo $messageErreur; ?></p></strong>
        <a href="?action=adminAfficherEvenementsNaturotheques&page=<?php echo $page - 1; ?>">Page précédente</a>
    <?php endif; ?>
    </body>
</html>