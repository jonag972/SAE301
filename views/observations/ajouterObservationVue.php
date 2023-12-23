<?php require_once 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Observation</title>
</head>
<body>
    <h1>Ajouter une Observation</h1>
    <form action="?action=enregistrerObservation" method="post" enctype="multipart/form-data">
        <label for="id_espece">ID Espèce</label>
        <input type="text" name="id_espece" id="id_espece">
        <br>
        <label for="photo_observation">Photo</label>
        <input type="file" name="photo_observation" id="photo_observation">
        <br>
        <label for="date_observation">Date</label>
        <input type="date" name="date_observation" id="date_observation">
        <br>
        <label for="pays_observation">Pays</label>
        <input type="text" name="pays_observation" id="pays_observation">
        <br>
        <label for="ville_observation">Ville</label>
        <input type="text" name="ville_observation" id="ville_observation">
        <br>
        <label for="commentaire">Commentaire</label>
        <input type="text" name="commentaire" id="commentaire">
        <br>
        <label for="interne">Interne</label>
        <input type="checkbox" name="interne" id="interne">
        <br>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
