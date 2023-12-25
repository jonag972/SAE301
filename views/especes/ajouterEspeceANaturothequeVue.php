<?php include 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Espèce à la Naturothèque</title>
</head>
<body>
    <h1>Ajouter Espèce à la Naturothèque</h1>
    <p>ID de l'espèce : <?php echo $espece['id']; ?></p>
    <p>Nom scientifique de l'espèce : <?php echo $espece['scientificName']; ?></p>
    <p>Nom vernaculaire français de l'espèce : <?php echo $espece['frenchVernacularName']; ?></p>
    <p>Nom vernaculaire anglais de l'espèce : <?php echo $espece['englishVernacularName']; ?></p>
    <p>Genre de l'espèce : <?php echo $espece['genusName']; ?></p>
    <p>Famille de l'espèce : <?php echo $espece['familyName']; ?></p>
    <p>Ordre de l'espèce : <?php echo $espece['orderName']; ?></p>
    <p>Classe de l'espèce : <?php echo $espece['className']; ?></p>
    <p>Royaume de l'espèce : <?php echo $espece['kingdomName']; ?></p>
    <p>Habitat de l'espèce : <?php echo $espece['habitat']; ?></p>
    <form action="?action=ajouterEspeceANaturotheque" method="get">
        <input type="hidden" name="action" value="ajouterEspeceANaturothequeConfirmation">
        <input type="hidden" name="id_espece" value="<?php echo $id_espece; ?>">
        <input type="hidden" name="interne" value="<?php echo $interne; ?>">
        <label for="id_naturothe    que">Choisir une naturothèque</label>
        <select name="id_naturotheque" id="id_naturotheque">
            <?php foreach ($naturotheques as $naturotheque) : ?>
                <option value="<?php echo $naturotheque['id_naturotheque']; ?>"><?php echo $naturotheque['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>