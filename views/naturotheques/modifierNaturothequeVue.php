<!DOCTYPE html>
<html>
<head>
    <title>Modifier une Naturothèque</title>
    <!-- Vous pouvez ajouter ici vos feuilles de style CSS et autres ressources -->
</head>
<body>
    <h1>Modifier une Naturothèque</h1>
    <form action="modifierNaturotheque.php?id=<?php echo $naturotheque['id_naturotheque']; ?>" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($naturotheque['nom']); ?>" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($naturotheque['description']); ?></textarea>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>