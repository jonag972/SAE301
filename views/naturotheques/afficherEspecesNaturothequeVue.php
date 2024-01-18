<?php include 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Especes de la Naturothèque</title>
</head>
<body>
    <h1>Especes de la Naturothèque</h1>
    <?php if (!empty($especes)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nom scientifique</th>
                    <th>Nom vernaculaire français</th>
                    <th>Nom vernaculaire anglais</th>
                    <th>Genre</th>
                    <th>Famille</th>
                    <th>Ordre</th>
                    <th>Classe</th>
                    <th>Royaume</th>
                    <th>Habitat</th>
                    <th>Interne</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($especes as $espece) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($espece['scientificName']); ?></td>
                        <td><?php echo htmlspecialchars($espece['frenchVernacularName'] ?? 'Nom vernaculaire français non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['englishVernacularName'] ?? 'Nom vernaculaire anglais non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['genusName'] ?? 'Genre non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['familyName'] ?? 'Famille non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['orderName'] ?? 'Ordre non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['className'] ?? 'Classe non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['kingdomName'] ?? 'Royaume non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['habitat'] ?? 'Habitat non renseigné'); ?></td>
                        <td><?php echo htmlspecialchars($espece['interne'] ?? 'Source non renseigné'); ?></td>
                        <td><img src="<?php echo $espece['imagePrefix'] . $espece['mediaImage']; ?>" alt="Image de l'espèce" width="100" height="100"></td>
                        <td><a href="?action=detailsEspece&id=<?php echo $espece['id_espece']; ?>&interne=<?php echo $espece['interne']; ?>">Voir Détails</a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <a href="?action=afficherToutesLesEspeces&interne=<?php echo $espece['interne']; ?>">Retour à la liste des espèces</a>
    <a href="?action=afficherToutesLesNaturotheques">Retour à la liste des naturothèques</a>
    <?php else : ?>
        <p>Aucune espèce dans cette naturothèque.</p>
    <?php endif; ?>

</body>
</html>
                
