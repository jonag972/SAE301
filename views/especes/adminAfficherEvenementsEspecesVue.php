<!DOCTYPE html>
<html>
<head>
    <title>Admin - Afficher les événements des Especes</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Événements des Especes en ordre décroissant</h1>
    <?php if (!empty($evenements)) : ?>
        <?php foreach ($evenements as $evenement) :
            if ($evenement['action'] == 'INSERT') {
                echo $evenement['ajoute_par'] . ' a créé l\'espece ' . $evenement['id_espece'] . ' le ' . $evenement['date_modification'] . '<a href="?action=detailsEspece&id=' . $evenement['id_espece'] . '">Voir l\'espece</a><br>';
            } else if ($evenement['action'] == 'UPDATE') {
                echo 'La valeur de ' . $evenement['colonne_changee'] . ' de l\'espece ' . $evenement['id_espece'] . ' a été modifiée le ' . $evenement['date_modification'] . ' de ' . $evenement['ancienne_valeur'] . ' à ' . $evenement['nouvelle_valeur'] . '<a href="?action=detailsEspece&id=' . $evenement['id_espece'] . '">Voir l\'espece</a><br>';
            } else if ($evenement['action'] == 'DELETE') {
                echo 'L\'espece ' . $evenement['id_espece'] . ' a été supprimée le ' . $evenement['date_modification'] . '<br>';
            }
        endforeach; ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?action=adminAfficherEvenementsEspeces&page=<?php echo $page - 1; ?>">Page précédente</a>
            <?php endif; ?>
            <?php if (count($evenements) == 10) : ?>
                <a href="?action=adminAfficherEvenementsEspeces&page=<?php echo $page + 1; ?>">Page suivante</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <strong><p><?php echo $messageErreur; ?></p></strong>
        <a href="?action=adminAfficherEvenementsEspeces&page=<?php echo $page - 1; ?>">Page précédente</a>
    <?php endif; ?>
    </body>
</html>