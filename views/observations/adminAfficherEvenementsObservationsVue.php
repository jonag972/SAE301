<!DOCTYPE html>
<html>
<head>
    <title>Admin - Afficher les événements des observations</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Événements des observations en ordre décroissant</h1>
    <?php if (!empty($evenements)) : ?>
        <?php foreach ($evenements as $evenement) :
            if ($evenement['action'] == 'INSERT') {
                echo 'L\'observation ' . $evenement['id_observation'] . ' a été créée le ' . $evenement['date_modification'] . '<br>';	
            } else if ($evenement['action'] == 'UPDATE') {
                echo 'La valeur de ' . $evenement['colonne_changee'] . ' de l\'observation ' . $evenement['id_observation'] . ' a été modifiée le ' . $evenement['date_modification'] . ' de ' . $evenement['ancienne_valeur'] . ' à ' . $evenement['nouvelle_valeur'] . '<br>';
            } else if ($evenement['action'] == 'DELETE') {
                echo 'L\'observation ' . $evenement['id_observation'] . ' a été supprimée le ' . $evenement['date_modification'] . '<br>';
            }
        endforeach; ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?action=adminAfficherEvenementsObservations&page=<?php echo $page - 1; ?>">Page précédente</a>
            <?php endif; ?>
            <?php if (count($evenements) == 10) : ?>
                <a href="?action=adminAfficherEvenementsObservations&page=<?php echo $page + 1; ?>">Page suivante</a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <strong><p><?php echo $messageErreur; ?></p></strong>
        <a href="?action=adminAfficherEvenementsObservations&page=<?php echo $page - 1; ?>">Page précédente</a>
    <?php endif; ?>
    </body>
</html>