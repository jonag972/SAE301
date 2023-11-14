<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="assets/css/accueil/accueil.css">
    <meta charset="utf-8">
</head>
<body>
    <?php include 'views/elements/navbar.php'; ?>
    <h1>Page d'Accueil</h1>
    <?php if (isset($_SESSION['role']) && isset($_SESSION['identifiant_utilisateur'])){
        echo '<h2>Ravie de vous revoir ' . $_SESSION['prenom'] . '</h2>';
    } else {
        echo '<h2>Bonjour visiteur</h2>';
    }
    ?>
</body>
</html>
