<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des espèces <?php echo $interne === 'TRUE' ? 'de la base de données' : 'de l\'API'; ?></title>
    <link rel="stylesheet" href="assets/css/especes/afficherToutesLesEspeces.css">
    <meta charset="utf-8">
</head>
<?php include 'views/elements/navbar.php'; ?>
<body>
    <h1>Liste des espèces <?php echo $interne === 'TRUE' ? 'de la base de données' : 'de l\'API'; ?></h1>
    <?php if ($interne === 'FALSE') : ?>
        <a href="?action=afficherToutesLesEspeces&interne=TRUE&page=1&size=10">Afficher toutes les espèces depuis la base de données</a>
    <?php else : ?>
        <a href="?action=afficherToutesLesEspeces&interne=FALSE&page=1&size=10">Afficher toutes les espèces depuis l'API</a>
    <?php endif; ?>
    <?php if ($interne === 'TRUE') : ?>
        <a href="?action=ajouterEspece">Ajouter une espèce</a>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <!--<td><th>Id</th></td>-->
                <th>Nom</th>
                <th>Nom scientifique</th>
                <th>Genre</th>
                <th>Famille</th>
                <th>Ordre</th>
                <th>Classe</th>
                <th>Royaume</th>
                <th>Habitat</th>
                <th>Image de l'espece</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($especes as $espece) : ?>
                <tr>
                    <td><?php echo $espece['frenchVernacularName']; ?></td>
                    <td><?php echo $espece['scientificName']; ?></td>
                    <td><?php echo $espece['genusName']; ?></td>
                    <td><?php echo $espece['familyName']; ?></td>
                    <td><?php echo $espece['orderName']; ?></td>
                    <td><?php echo $espece['className']; ?></td>
                    <td><?php echo $espece['kingdomName']; ?></td>
                    <td><?php echo $espece['habitat']; ?></td>
                    <td><img id=especephoto src="<?php echo $espece['imagePrefix'] . $espece['mediaImage']; ?>" alt="Image de l'espèce" width="100" height="100"></td>
                    <td><a href="?action=detailsEspece&id=<?php echo $espece['id']; ?>&interne=<?php echo $espece['interne']; ?>">Voir Détails</a>
                    <a href="?action=ajouterEspeceANaturotheque&id_espece=<?php echo $espece['id']; ?>&interne=<?php echo $espece['interne']; ?>">Ajouter à Naturothèque</a></td>
                    <?php if ($interne === 'TRUE') : ?>
                        <td><a href="?action=modifierEspece&id=<?php echo $espece['id']; ?>">Modifier l'espèce</a>
                        <a href="?action=supprimerEspece&id=<?php echo $espece['id']; ?>">Supprimer l'espèce</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="<?php echo '?action=afficherToutesLesEspeces&page=' . ($page - 1) . '&size=' . $parPage . '&interne=' . $interne; ?>">Page précédente</a>
        <?php endif; ?>

        <?php if ($interne === 'FALSE') : ?>
            <a href="<?php echo '?action=afficherToutesLesEspeces&page=' . ($page + 1) . '&size=' . $parPage . '&interne=' . $interne; ?>">Page suivante</a>
        <?php endif; ?>
    </div>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>




</body>
</html>