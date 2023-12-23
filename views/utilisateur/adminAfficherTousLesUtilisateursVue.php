<!DOCTYPE html>
<html>
<head>
    <title>Tous les utilisateurs</title>
</head>
<body>
    <?php require_once 'views/elements/navbar.php'; ?>
    <h1>Tous les utilisateurs</h1>
    <a href="?action=adminAjouterUtilisateur">Ajouter un utilisateur</a>
    <?php if(!empty($utilisateurs)): ?>
        <p>Il y a <?php echo count($utilisateurs); ?> utilisateur(s) dans la base de données.</p>
        <table>
            <thead>
                <tr>
                    <th>Photo de profil</th>
                    <th>Identifiant</th>
                    <th>Email</th>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Âge</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td>
                            <?php if ($utilisateur['photo_de_profil']): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($utilisateur['photo_de_profil']) ?>" width="100" height="100">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $utilisateur['identifiant_utilisateur']; ?></td>
                        <td><?php echo $utilisateur['email']; ?></td>
                        <td><?php echo $utilisateur['prenom']; ?></td>
                        <td><?php echo $utilisateur['nom_de_famille']; ?></td>
                        <td><?php echo $utilisateur['age']; ?></td>
                        <td><?php echo $utilisateur['role']; ?></td>
                        <td>
                            <a href="?action=adminAfficherUtilisateur&identifiant_utilisateur=<?php echo $utilisateur['identifiant_utilisateur']; ?>">Afficher</a>
                            <a href="?action=adminModifierUtilisateur&identifiant_utilisateur=<?php echo $utilisateur['identifiant_utilisateur']; ?>">Modifier</a>
                            <a href="?action=adminSupprimerUtilisateur&identifiant_utilisateur=<?php echo $utilisateur['identifiant_utilisateur']; ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Il n'y a aucun utilisateur dans la base de données.</p>
    <?php endif; ?>
</body>
</html>