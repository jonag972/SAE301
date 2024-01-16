<!DOCTYPE html>
<html>
<head>
    <title>Résultats de la recherche d'espèces</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/especes/rechercherEspecesResultats.css" />
</head>
<body>
    <?php include 'views/elements/navbar.php'; ?>
    <h1>Résultats de la recherche d'espèces</h1>
    <?php
    if (is_array($especes) && !empty($especes)) {
        echo "<table>
            <thead>
                <tr>
                    <th>Nom vernaculaire français</th>
                    <th>Nom scientifique</th>
                    <th>Nom du genre</th>
                    <th>Nom de la famille</th>
                    <th>Nom de l'ordre</th>
                    <th>Nom de la classe</th>
                    <th>Nom du royaume</th>
                    <th>Habitat</th>
                    <th>Image</th>
                    <th>Voir la fiche</th>
                    <th>Ajouter à une naturothèque</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($especes as $espece) {
            echo "<tr>
                <td>{$espece['frenchVernacularName']}</td>
                <td>{$espece['scientificName']}</td>
                <td>{$espece['genusName']}</td>
                <td>{$espece['familyName']}</td>
                <td>{$espece['orderName']}</td>
                <td>{$espece['className']}</td>
                <td>{$espece['kingdomName']}</td>
                <td>{$espece['habitat']}</td>
                <td><img src='{$espece['mediaImage']}' alt='Image de l\'espèce' style='width: 100px; height: 100px;' /></td>
                <td><a href='?action=detailsEspece&id={$espece['id']}&interne={$espece['interne']}'>Voir Détails</a></td>
                <td><a href='?action=ajouterEspeceANaturotheque&id_espece={$espece['id']}&interne={$espece['interne']}'>Ajouter à Naturothèque</a></td>
            </tr>";
        }
        echo "</tbody>
        </table>";
    } else {
        echo "<p>Aucune espèce trouvée.</p>";
        echo "<p> Pour les critères suivants : </p>";
        echo "<ul>";
        if (!empty($_GET['frenchVernacularNames'])) {
            echo "<li>Nom vernaculaire français : {$_GET['frenchVernacularNames']}</li>";
        }
        if (!empty($_GET['englishVernacularNames'])) {
            echo "<li>Nom vernaculaire anglais : {$_GET['englishVernacularNames']}</li>";
        }
        if (!empty($_GET['scientificNames'])) {
            echo "<li>Nom scientifique : {$_GET['scientificNames']}</li>";
        }
        if (!empty($_GET['vernacularGroups'])) {
            echo "<li>Groupe vernaculaire : {$_GET['vernacularGroups']}</li>";
        }
        if (!empty($_GET['taxonomicRanks'])) {
            echo "<li>Rang taxonomique : {$_GET['taxonomicRanks']}</li>";
        }
        if (!empty($_GET['territories'])) {
            echo "<li>Territoire : {$_GET['territories']}</li>";
        }
        if (!empty($_GET['domain'])) {
            echo "<li>Domaine : {$_GET['domain']}</li>";
        }
        if (!empty($_GET['habitats'])) {
            echo "<li>Habitat : {$_GET['habitats']}</li>";
        }
    }
    ?>
</body>
</html>