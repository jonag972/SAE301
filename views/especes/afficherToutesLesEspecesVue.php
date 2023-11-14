<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des espèces</title>
    <link rel="stylesheet" href="assets/css/especes/afficherToutesLesEspeces.css">
    <meta charset="utf-8">
</head>
<?php include 'views/elements/navbar.php'; ?>
<body>
    <h1>Liste des espèces</h1>
    <?php if ($interne === 'FALSE') : ?>
        <a href="?action=afficherToutesLesEspeces&interne=FALSE&page=1&parPage=10&interne=TRUE">Afficher toutes les espèces depuis la base de données</a>
    <?php elseif ($interne === 'TRUE') : ?>
        <a href="?action=afficherToutesLesEspeces&interne=TRUE&page=1&parPage=10&interne=FALSE">Afficher toutes les espèces depuis l'API</a>
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
                <th>Image du Média</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($especes as $espece) : ?>
                <tr>
                    <!--<td><?php echo $espece['id']; ?></td>-->
                    <td><?php echo $espece['frenchVernacularNames']; ?></td>
                    <td><?php echo $espece['scientificNames']; ?></td>
                    <td><?php echo $espece['genusName']; ?></td>
                    <td><?php echo $espece['familyName']; ?></td>
                    <td><?php echo $espece['orderName']; ?></td>
                    <td><?php echo $espece['className']; ?></td>
                    <td><?php echo $espece['kingdomName']; ?></td>
                    <td><?php echo $espece['habitat']; ?></td>
                    <td><img id=especephoto src="<?php echo $espece['imagePrefix'] . $espece['mediaImage']; ?>" alt="Image de l'espèce"></td>
                </tr>
                <?php 
                    // Flush the output buffer to the browser
                    ob_flush();
                    flush();
                ?>
            <?php endforeach; ?>
        </tbody>

    </table>

    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="<?php echo '?action=afficherToutesLesEspeces&page=' . ($page - 1) . '&parPage=' . $parPage . '&interne=' . $interne; ?>">Page précédente</a>
        <?php endif; ?>

        <?php if ($numSpecies == $parPage) : ?>
            <a href="<?php echo '?action=afficherToutesLesEspeces&page=' . ($page + 1) . '&parPage=' . $parPage . '&interne=' . $interne; ?>">Page suivante</a>
        <?php endif; ?>
    </div>

</body>
</html>