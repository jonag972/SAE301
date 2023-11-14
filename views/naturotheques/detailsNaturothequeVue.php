<!DOCTYPE html>
<html>
<head>
    <title>Détails de la Naturothèque</title>
    <!-- Vous pouvez ajouter ici vos feuilles de style CSS et autres ressources -->
</head>
<body>
    <h1>Détails de la Naturothèque : <?php echo htmlspecialchars($naturotheque['nom']); ?></h1>
    <p><?php echo htmlspecialchars($naturotheque['description']); ?></p>
    <h2>Espèces dans cette naturothèque</h2>
    <?php
    // Supposons que vous ayez une variable $especes qui est un tableau de toutes les espèces dans cette naturothèque
    foreach($especes as $espece): ?>
        <div>
            <h3><?php echo htmlspecialchars($espece['nom']); ?></h3>
            <p><?php echo htmlspecialchars($espece['description']); ?></p>
        </div>
    <?php endforeach; ?>
    <a href="supprimerNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Supprimer cette naturothèque</a>
    <a href="modifierNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Modifier cette naturothèque</a>
</body>
</html>