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
        <label for="frenchVernacularNames">Nom vernaculaire français :</label>
        <input type="text" name="frenchVernacularNames" id="frenchVernacularName" placeholder="Loup gris" >
        <br>
        <label for="englishVernacularNames">Nom vernaculaire anglais :</label>
        <input type="text" name="englishVernacularNames" id="englishVernacularNames" placeholder="Gray wolf" >
        <br>
        <label for="vernacularGroupsInput">Groupe vernaculaire :</label>
        <input type="text" name="vernacularGroups" id="vernacularGroups" placeholder="Carnivores" >
        <br>
        <label for="taxonomicRanksSelect">Rang taxonomique :</label>
        <select name="taxonomicRanks" id="taxonomicRanksSelect" >
            <option value=""></option>
            <option value="Dumm">Domaine</option>
            <option value="KD">Règne</option>
            <option value="PH">Phylum</option>
            <option value="CL">Classe</option>
            <option value="OR">Ordre</option>
            <option value="FM">Famille</option>
            <option value="SBFM">Sous-Famille</option>
            <option value="TR">Tribu</option>
            <option value="GN">Genre</option>
            <option value="AGES">Agrégat</option>
            <option value="ES">Espèce</option>
            <option value="SSES">Sous-Espèce</option>
            <option value="NAT">Natio</option>
            <option value="VAR">Variété</option>
            <option value="SVAR">Sous-Variété</option>
            <option value="FO">Forme</option>
            <option value="SSFO">Sous-Forme</option>
            <option value="RACE">Race</option>
            <option value="CAR">Cultivar</option>
            <option value="AB">Abberatio</option>
        </select>
        <br>
        <label for="territoriesSelect">Territoire d'occurence :</label>
        <select name="territories" id="territoriesSelect" >
            <option value=""></option>
            <option value="fr">France métropolitaine</option>
            <option value="gf">Guyane française</option>
            <option value="gua">Guadeloupe</option>
            <option value="mar">Martinique</option>
            <option value="sm">Saint-Martin</option>
            <option value="sb">Saint-Barthélemy</option>
            <option value="spm">Saint-Pierre-et-Miquelon</option>
            <option value="epa">Îles éparses</option>
            <option value="may">Mayotte</option>
            <option value="reu">Réunion</option>
            <option value="sa">Îles subantarctiques</option>
            <option value="ta">Terre Adélie</option>
            <option value="nc">Nouvelle-Calédonie</option>
            <option value="wf">Wallis et Futuna</option>
            <option value="pf">Polynésie française</option>
            <option value="cli">Clipperton</option>
        </select>
        <br>
        <label for="domainSelect">Domaine :</label>
        <select name="domain" id="domainSelect" >
            <option value=""></option>
            <option value="Marin">Marin</option>
            <option value="Continental">Continental</option>
        </select>
        <br>
        <label for="habitatsSelect">Habitat :</label>
        <select name="habitats" id="habitatsSelect" >
            <option value=""></option>
            <option value="1">Marin</option>
            <option value="2">Eau douce</option>
            <option value="3">Terrestre</option>
            <option value="4">Marin et eau douce</option>
            <option value="5">Marin et terrestre</option>
            <option value="6">Eau saumâtre</option>
            <option value="7">Continental (terrestre et/ou eau douce)</option>
            <option value="8">Continental (terrestre et eau douce)</option>
        </select>
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