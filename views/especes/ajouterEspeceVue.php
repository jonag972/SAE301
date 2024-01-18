<?php include 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une espèce</title>
</head>
<body>
    <h1>Ajouter une espèce</h1>
    <form action="?action=ajouterEspeceConfirmation" method="post" enctype="multipart/form-data">
        <label for="frenchVernacularName">Nom vernaculaire français:</label><br>
        <input type="text" id="frenchVernacularName" name="frenchVernacularName"><br>
        <label for="englishVernacularName">Nom vernaculaire anglais:</label><br>
        <input type="text" id="englishVernacularName" name="englishVernacularName"><br>
        <label for="scientificName">Nom scientifique:</label><br>
        <input type="text" id="scientificName" name="scientificName"><br>
        <label for="genusName">Nom du genre:</label><br>
        <input type="text" id="genusName" name="genusName"><br>
        <label for="familyName">Nom de la famille:</label><br>
        <input type="text" id="familyName" name="familyName"><br>
        <label for="orderName">Nom de l'ordre:</label><br>
        <input type="text" id="orderName" name="orderName"><br>
        <label for="className">Nom de la classe:</label><br>
        <input type="text" id="className" name="className"><br>
        <label for="kingdomName">Nom du royaume:</label><br>
        <input type="text" id="kingdomName" name="kingdomName"><br>
        <label for="mediaImage">Image de l'espèce:</label><br>
        <input type="file" id="mediaImage" name="mediaImage"><br>
        <label for="habitat">Habitat:</label><br>
        <select name="habitat" id="habitat">
            <option value="Marin">Marin</option>
            <option value="Eau douce">Eau douce</option>
            <option value="Terrestre">Terrestre</option>
            <option value="Marin et eau douce">Marin et eau douce</option>
            <option value="Marin et terrestre">Marin et terrestre</option>
            <option value="Eau saumâtre">Eau saumâtre</option>
            <option value="Continental (terrestre et/ou eau douce)">Continental (terrestre et/ou eau douce)</option>
            <option value="Continental (terrestre et eau douce)">Continental (terrestre et eau douce)</option>
        </select><br>
        <input type="submit" value="Ajouter l'espèce">
        <?php if (isset($message)) : ?>
            <p><?php echo 'Message: ' . $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
