<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier la Naturothèque</title>
</head>
<body>
    <h1>Modifier la Naturothèque</h1>
    <form action="?action=modificationNaturothequeBDD" method="post">
        <input type="hidden" name="id" value="<?php echo $naturotheque['id_naturotheque']; ?>">
        Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($naturotheque['nom']); ?>"><br>
        Description: <textarea name="description"><?php echo htmlspecialchars($naturotheque['description']); ?></textarea><br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
