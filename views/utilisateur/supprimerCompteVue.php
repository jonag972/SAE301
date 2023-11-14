<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de suppression de compte</title>
</head>
<body>
<?php include 'views/elements/navbar.php'; ?>
    <h1>Confirmation de suppression de compte</h1>
    <h3>Êtes-vous sûr de vouloir supprimer votre compte avec l'identifiant <?php echo $_SESSION['identifiant_utilisateur']; ?> ?</h3>
    <p>Veuillez entrer votre mot de passe pour confirmer la suppression de votre compte.</p>
    <form action="?action=supprimerCompteConfirmation" method="post">
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <input type="submit" value="Confirmer la suppression">
    </form>
    <?php if (isset($messageErreur)) : ?>
        <p><?php echo $messageErreur; ?></p>
    <?php endif; ?>
</body>
</html>