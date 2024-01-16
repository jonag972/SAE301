<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/rechercherEspeces.css" />
    <script src="assets/js/rechercherEspeces.js"></script>
    <title>Recherche par critères</title>
</head>
<body>
    <?php include 'views/elements/navbar.php'; ?>
    <h1>Recherche par critères</h1>
    <form method="get" action="">
        <input type="hidden" name="action" value="rechercherEspecesResultats">
        <strong><label for="taxrefIds">Rechercher par :</label></strong>
        <br>
        <label for="searchByScientificName">Nom scientifique</label>
        <input type="text" name="scientificNames" id="scientificNames" placeholder="Canis lupus" >
        <br>
        <label for="interne">Rechercher dans la base de données interne</label>
        <input type="radio" name="interne" id="interne" value="TRUE" checked>
        <br>
        <label for="externe">Rechercher dans l'API externe</label>
        <input type="radio" name="interne" id="externe" value="FALSE">
        <br>
        <input type="submit" value="Rechercher">
    </form>
</body>
</html>