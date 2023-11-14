<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Naturothèque</title>
    <!-- Vous pouvez ajouter ici vos feuilles de style CSS et autres ressources -->
</head>
<body>
    <?php include 'views/elements/navbar.php'; ?>
    <h1>Ajouter une Naturothèque</h1>
    <form action="?action=ajoutNaturothequeBDD" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>