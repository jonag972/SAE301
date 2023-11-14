<!DOCTYPE html>
<html>
<head>
    <title>Mes Naturothèques</title>
    <!-- Vous pouvez ajouter ici vos feuilles de style CSS et autres ressources -->
</head>
<body>
    <h1>Mes Naturothèques</h1>
    <?php
    // Supposons que vous ayez une variable $mesNaturotheques qui est un tableau de toutes les naturothèques de l'utilisateur
    foreach($mesNaturotheques as $naturotheque): ?>
        <div>
            <h2><?php echo htmlspecialchars($naturotheque['nom']); ?></h2>
            <p><?php echo htmlspecialchars($naturotheque['description']); ?></p>
            <a href="detailsNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Voir détails</a>
            <a href="supprimerNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Supprimer</a>
            <a href="modifierNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>">Modifier</a>
        </div>
    <?php endforeach; ?>
</body>
</html>