<?php require_once 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Rechercher Observation</title>
</head>
<body>
    <h1>Rechercher Observation</h1>
    <form action="" method="get">
    <input type="hidden" name="action" value="rechercherObservations">
        <input type="text" name="id_espece" placeholder="ID Espèce" value="<?php echo isset($_GET['id_espece']) ? $_GET['id_espece'] : '' ?>">
        <input type="submit" value="Rechercher">
    </form>
    <?php if (isset($observations)): ?>
        <h2>Résultats de la recherche</h2>
        <table>
            <tr>
                <th>Cover</th>
                <th>ID Observation</th>
                <th>ID Espèce</th>
                <th>Date</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Commentaire</th>
                <th>Interne</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($observations as $observation): ?>
                <tr>
                    <td>
                        <?php if ($observation['photo_observation']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($observation['photo_observation']) ?>" width="100" height="100">
                        <?php endif; ?>
                    </td>
                    <td><?= $observation['id_observation'] ?></td>
                    <td><?= $observation['id_espece'] ?></td>
                    <td><?= $observation['date_observation'] ?></td>
                    <td><?= $observation['pays_observation'] ?></td>
                    <td><?= $observation['ville_observation'] ?></td>
                    <td><?= $observation['commentaire'] ?></td>
                    <td><?= $observation['interne'] ? 'Oui' : 'Non' ?></td>
                    <td>
                        <a href="?action=afficherObservation&id=<?= $observation['id_observation'] ?>">Afficher</a>
                        <a href="?action=modifierObservation&id=<?= $observation['id_observation'] ?>">Modifier</a>
                        <a href="?action=supprimerObservation&id=<?= $observation['id_observation'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <div class="pagination">
        <?php
        if ($page > 1) {
        echo '<a href="?action=rechercherObservations&page=' . ($page - 1) . '&id_espece=' . $_GET['id_espece'] . '">Précédente</a>';
        }
        if ($page < $nombreDePages) {
        echo '<a href="?action=rechercherObservations&page=' . ($page + 1) . '&id_espece=' . $_GET['id_espece'] . '">Suivante</a>';
        }
        ?>
    </div>
</body>
</html>