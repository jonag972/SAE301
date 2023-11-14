<!DOCTYPE html>
<html>
<head>
    <title>Toutes les Naturothèques</title>
    <!-- Vous pouvez ajouter ici vos feuilles de style CSS et autres ressources -->
</head>
<body>
    <?php include 'views/elements/navbar.php'; ?>
    <h1>Toutes les Naturothèques</h1>
    <a href="?action=ajouterNaturotheque">Ajouter une naturothèque</a>
    <?php
    // Supposons que vous ayez une variable $naturotheques qui est un tableau de toutes les naturothèques
    foreach($naturotheques as $naturotheque): ?>
        <div>
            <h2><?php echo htmlspecialchars($naturotheque['nom']); ?></h2>
            <p><?php echo htmlspecialchars($naturotheque['description']); ?></p>
            <a href="afficherNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Voir détails</a>
        </div>
    <?php endforeach; ?>
</body>
</html>