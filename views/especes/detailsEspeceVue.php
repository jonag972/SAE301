<?php include 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails Espèce</title>
</head>
<body>
    <h1>Détails Espèce</h1>
    <?php if (isset($espece)): ?>
        <h2>Nom scientifique : <?php echo htmlspecialchars($espece['scientificName']); ?></h2>
        <p>ID: <?php echo htmlspecialchars($espece['id']); ?></p>
        <p>Nom vernaculaire français: <?php echo htmlspecialchars($espece['frenchVernacularName'] ?? 'Nom vernaculaire français non renseigné'); ?></p>
        <p>Nom vernaculaire anglais: <?php echo htmlspecialchars($espece['englishVernacularName'] ?? 'Nom vernaculaire anglais non renseigné'); ?></p>
        <p>Genre: <?php echo htmlspecialchars($espece['genusName'] ?? 'Genre non renseigné'); ?></p>
        <p>Famille: <?php echo htmlspecialchars($espece['familyName'] ?? 'Famille non renseigné'); ?></p>
        <p>Ordre: <?php echo htmlspecialchars($espece['orderName'] ?? 'Ordre non renseigné'); ?></p>
        <p>Classe: <?php echo htmlspecialchars($espece['className'] ?? 'Classe non renseigné'); ?></p>
        <p>Royaume: <?php echo htmlspecialchars($espece['kingdomName'] ?? 'Royaume non renseigné'); ?></p>
        <p>Habitat: <?php echo htmlspecialchars($espece['habitat'] ?? 'Habitat non renseigné'); ?></p>
        <p>Interne: <?php echo htmlspecialchars($espece['interne'] ?? 'Source non renseigné'); ?></p>
        <p>Image: <img src="<?php echo $espece['imagePrefix'] . $espece['mediaImage']; ?>" alt="Image de l'espèce"></p>
    <?php else: ?>
        <p>Aucune espèce sélectionnée.</p>
    <?php endif; ?>
    <a href="?action=afficherToutesLesEspeces&interne=<?php echo $espece['interne']; ?>">Retour à la liste des espèces</a>
    <a href="?action=ajouterEspeceANaturotheque&id_espece=<?php echo $espece['id']; ?>&interne=<?php echo $espece['interne']; ?>">Ajouter à Naturothèque</a>
</body>
</html>