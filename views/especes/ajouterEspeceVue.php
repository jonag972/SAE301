<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une espèce</title>
</head>
<body>
    <h1>Ajouter une espèce</h1>
    <form action="?action=ajouterEspeceConfirmation" method="post" enctype="multipart/form-data">
        <label for="frenchVernacularNames">Nom vernaculaire français:</label><br>
        <input type="text" id="frenchVernacularNames" name="frenchVernacularNames"><br>
        <label for="englishVernacularNames">Nom vernaculaire anglais:</label><br>
        <input type="text" id="englishVernacularNames" name="englishVernacularNames"><br>
        <label for="scientificNames">Nom scientifique:</label><br>
        <input type="text" id="scientificNames" name="scientificNames"><br>
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
            <option value="1">Terrestre</option>
            <option value="2">Aquatique</option>
            <option value="3">Aérien</option>
            <option value="4">Souterrain</option>
            <option value="5">Terrestre</option>
            <option value="6">Aquatique</option>
            <option value="7">Aérien</option>
            <option value="8">Souterrain</option>
        </select><br>
        <input type="submit" value="Ajouter l'espèce">
        <?php if (isset($message)) : ?>
            <p><?php echo 'Message: ' . $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
