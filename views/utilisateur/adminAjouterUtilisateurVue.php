<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Ajouter un utilisateur</h1>
    <form action="?action=adminAjoutUtilisateur" method="post">
        <label for="identifiant_utilisateur">Identifiant:</label>
        <input type="text" id="identifiant_utilisateur" name="identifiant_utilisateur" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
        <label for="nom_de_famille">Nom de famille:</label>
        <input type="text" id="nom_de_famille" name="nom_de_famille" required>
        <br>
        <label for="age">Âge:</label>
        <input type="number" id="age" name="age" required>
        <br>
        <label for="pays">Pays:</label>
        <input type="text" id="pays" name="pays" required>
        <br>
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required>
        <br>
        <label for="abonnement">Abonnement:</label>
        <select id="abonnement" name="abonnement" required>
            <option value="gratuit">Gratuit</option>
            <option value="premium">Premium</option>
        </select>
        <br>
        <label for="role">Rôle:</label>
        <input type="text" id="role" name="role" required>
        <br>
        <input type="submit" value="Ajouter">
        <?php if(isset($messageErreur)): ?>
            <p><?php echo $messageErreur; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>