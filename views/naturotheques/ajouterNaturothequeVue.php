<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Naturothèque</title>
</head>
<body>
    <h1>Ajouter une Naturothèque</h1>
    <form action="?action=ajoutNaturothequeBDD" method="post" enctype="multipart/form-data">
        Nom: <input type="text" name="nom"><br>
        Description: <textarea name="description"></textarea><br>
        Photo de couverture: <input type="file" name="photo_naturotheque"><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
