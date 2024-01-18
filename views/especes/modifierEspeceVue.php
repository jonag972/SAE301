<?php include 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'espèce</title>
</head>
<body>
    <h1>Modifier l'espèce</h1>
    <form action="?action=modifierEspeceConfirmation" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_espece" id="id_espece" value="<?php echo $espece[0]['id_espece']; ?>">
        <label for="scientificName">Nom scientifique</label>
        <input type="text" name="scientificName" id="scientificName" value="<?php echo $espece[0]['scientificName']; ?>">
        <br>
        <label for="frenchVernacularName">Nom vernaculaire français</label>
        <input type="text" name="frenchVernacularName" id="frenchVernacularName" value="<?php echo $espece[0]['frenchVernacularName']; ?>">
        <br>
        <label for="englishVernacularName">Nom vernaculaire anglais</label>
        <input type="text" name="englishVernacularName" id="englishVernacularName" value="<?php echo $espece[0]['englishVernacularName']; ?>">
        <br>
        <label for="genusName">Nom du genre</label>
        <input type="text" name="genusName" id="genusName" value="<?php echo $espece[0]['genusName']; ?>">
        <br>
        <label for="familyName">Nom de la famille</label>
        <input type="text" name="familyName" id="familyName" value="<?php echo $espece[0]['familyName']; ?>">
        <br>
        <label for="orderName">Nom de l'ordre</label>
        <input type="text" name="orderName" id="orderName" value="<?php echo $espece[0]['orderName']; ?>">
        <br>
        <label for="className">Nom de la classe</label>
        <input type="text" name="className" id="className" value="<?php echo $espece[0]['className']; ?>">
        <br>
        <label for="kingdomName">Nom du royaume</label>
        <input type="text" name="kingdomName" id="kingdomName" value="<?php echo $espece[0]['kingdomName']; ?>">
        <br>
        <label for="habitat">Habitat</label>
        <select name="habitat" id="habitat">
            <option value="Marin" <?php if ($espece[0]['habitat'] == 'Marin') : ?>selected<?php endif; ?>>Marin</option>
            <option value="Eau douce" <?php if ($espece[0]['habitat'] == 'Eau douce') : ?>selected<?php endif; ?>>Eau douce</option>
            <option value="Terrestre" <?php if ($espece[0]['habitat'] == 'Terrestre') : ?>selected<?php endif; ?>>Terrestre</option>
            <option value="Marin et eau douce" <?php if ($espece[0]['habitat'] == 'Marin et eau douce') : ?>selected<?php endif; ?>>Marin et eau douce</option>
            <option value="Marin et terrestre" <?php if ($espece[0]['habitat'] == 'Marin et terrestre') : ?>selected<?php endif; ?>>Marin et terrestre</option>
            <option value="Eau saumâtre" <?php if ($espece[0]['habitat'] == 'Eau saumâtre') : ?>selected<?php endif; ?>>Eau saumâtre</option>
            <option value="Continental (terrestre et/ou eau douce)" <?php if ($espece[0]['habitat'] == 'Continental (terrestre et/ou eau douce)') : ?>selected<?php endif; ?>>Continental (terrestre et/ou eau douce)</option>
            <option value="Continental (terrestre et eau douce)" <?php if ($espece[0]['habitat'] == 'Continental (terrestre et eau douce)') : ?>selected<?php endif; ?>>Continental (terrestre et eau douce)</option>
        </select>
        <br>
        <label for="mediaImage">Image de l'espèce</label>
        <input type="file" name="mediaImage" id="mediaImage" value="<?php echo $espece[0]['mediaImage']; ?>">
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>