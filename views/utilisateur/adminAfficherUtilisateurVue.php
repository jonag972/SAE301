<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'utilisateur</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <?php
    ?>
    <h1>Détails de l'utilisateur <?php echo $utilisateur['identifiant_utilisateur']; ?></h1>
    <?php if($utilisateur): ?>
        <?php if ($utilisateur['photo_de_profil']): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($utilisateur['photo_de_profil']) ?>" width="100" height="100">
        <?php endif; ?>
        <p>Identifiant: <?php echo $utilisateur['identifiant_utilisateur']; ?></p>
        <p>Email: <?php echo $utilisateur['email']; ?></p>
        <p>Prénom: <?php echo $utilisateur['prenom']; ?></p>
        <p>Nom de famille: <?php echo $utilisateur['nom_de_famille']; ?></p>
        <p>Âge: <?php echo $utilisateur['age']; ?></p>
        <p>Pays: <?php echo $utilisateur['pays']; ?></p>
        <p>Ville: <?php echo $utilisateur['ville']; ?></p>
        <p>Abonnement: <?php echo $utilisateur['abonnement']; ?></p>
        <p>Rôle: <?php echo $utilisateur['role']; ?></p>
        <p>date_inscription: <?php echo $utilisateur['date_inscription']; ?></p>
        <p>date_derniere_connexion: <?php echo $utilisateur['date_derniere_connexion']; ?></p>
        <p>date_derniere_deconnexion: <?php echo $utilisateur['date_derniere_deconnexion']; ?></p>
        <a href="?action=adminModifierUtilisateur&identifiant_utilisateur=<?php echo $utilisateur['identifiant_utilisateur']; ?>">Modifier</a>
        <a href="?action=adminSupprimerUtilisateur&identifiant_utilisateur=<?php echo $utilisateur['identifiant_utilisateur']; ?>">Supprimer</a>
    <?php else: ?>
        <p>Aucun utilisateur trouvé avec cet identifiant.</p>
    <?php endif; ?>
</body>
</html>