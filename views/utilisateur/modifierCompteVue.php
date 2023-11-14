<html>
<head>
    <title>Modifier mon compte</title>
    <link rel="stylesheet" href="assets/css/stylemodifierCompte.css">
</head>
    <?php include 'views/elements/navbar.php'; ?>
    <?php
    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['identifiant_utilisateur'])) {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        header('Location: ?action=connexion');
        exit();
    }
    ?>

    <body>
        <h2>Modifier mon compte</h2>
        <h3>Laissez les champs vides pour ne pas changer les informations</h3>
        <form method="post" action="?action=modificationCompte">
            <label for="identifiant_utilisateur_actuel">Nom d'utilisateur actuel :</label>
            <input type="text" id="identifiant_utilisateur_actuel" name="identifiant_utilisateur_actuel" value="<?php echo $_SESSION['identifiant_utilisateur']; ?>" readonly><br>

            <br>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Laissez vide pour ne pas changer"><br>
            <br>

            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" placeholder="<?php echo $_SESSION['email']; ?>"><br>

            <br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="<?php echo $_SESSION['prenom']; ?>"><br>

            <br>

            <label for="nom_de_famille">Nom de famille :</label>
            <input type="text" id="nom_de_famille" name="nom_de_famille" placeholder="<?php echo $_SESSION['nom_de_famille']; ?>"><br>

            <br>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" placeholder="<?php echo $_SESSION['age']; ?>"><br>

            <br>

            <label for="pays">Pays :</label>
            <input type="text" id="pays" name="pays" placeholder="<?php echo $_SESSION['pays']; ?>"><br>

            <br>

            <label for="abonnement">Abonnement :</label>
            <select name="abonnement" id="abonnement">
                <option value="gratuit" <?php if ($_SESSION['abonnement'] == 'gratuit') echo 'selected'; ?>>Gratuit</option>
                <option value="premium" <?php if ($_SESSION['abonnement'] == 'premium') echo 'selected'; ?>>Premium</option>
            </select><br>

            <br>

            <label for="mot_de_passe_confirmation">Pour modifier vos informations, veuillez confirmer votre mot de passe :</label>
            <input type="password" id="mot_de_passe_confirmation" name="mot_de_passe_confirmation" required><br>

            <br>

            <input type="submit" value="Confirmer la modification">
        </form>
        <?php
        // Affichez le message d'erreur (s'il existe)
        if (!empty($messageErreur)) {
            echo '<p><strong>' . $messageErreur . '</strong></p>';
        }
        ?>
    </body>
</html>