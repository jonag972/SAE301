<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'utilisateur</title>
</head>
<body> 
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Modifier l'utilisateur <?php echo $utilisateur['identifiant_utilisateur']; ?></h1>
    <?php if($utilisateur): ?>
        <form action="?action=adminModificationUtilisateur" method="post">
            <input type="hidden" name="identifiant_utilisateur" value="<?php echo $utilisateur['identifiant_utilisateur']; ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder = "<?php echo $utilisateur['email']; ?>">
            <br>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" placeholder = "<?php echo $utilisateur['prenom']; ?>">
            <br>
            <label for="nom_de_famille">Nom de famille:</label>
            <input type="text" id="nom_de_famille" name="nom_de_famille" placeholder = "<?php echo $utilisateur['nom_de_famille']; ?>">
            <br>
            <label for="age">Âge:</label>
            <input type="number" id="age" name="age" placeholder = "<?php echo $utilisateur['age']; ?>">
            <br>
            <label for="pays">Pays:</label>
            <input type="text" id="pays" name="pays" placeholder = "<?php echo $utilisateur['pays']; ?>">
            <br>
            <label for="ville">Ville:</label>
            <input type="text" id="ville" name="ville" placeholder = "<?php echo $utilisateur['ville']; ?>">
            <br>
            <label for="abonnement">Abonnement:</label>
            <input type="text" id="abonnement" name="abonnement" placeholder = "<?php echo $utilisateur['abonnement']; ?>">
            <br>
            <label for="role">Rôle:</label>
            <input type="text" id="role" name="role" placeholder = "<?php echo $utilisateur['role']; ?>">
            <br>
            <input type="submit" value="Modifier">
        </form>
    <?php else: ?>
        <p>Aucun utilisateur trouvé avec cet identifiant.</p>
    <?php endif; ?>
</body>
</html>