<?php require_once 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mes Observations</title>
</head>
<body>
    <h1>Mes Observations</h1>
    <a href="?action=ajouterObservation">Ajouter une Observation</a>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>ID</th>
                <th>ID Espèce</th>
                <th>Date</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Commentaire</th>
                <th>Interne</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($observations as $observation): ?>
                <tr>
                    <td>
                        <?php if ($observation['photo_observation']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($observation['photo_observation']) ?>" width="100" height="100">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($observation['id_observation']) ?></td>
                    <td><?= htmlspecialchars($observation['id_espece']) ?></td>
                    <td><?= htmlspecialchars($observation['date_observation']) ?></td>
                    <td><?= htmlspecialchars($observation['pays_observation']) ?></td>
                    <td><?= htmlspecialchars($observation['ville_observation']) ?></td>
                    <td><?= htmlspecialchars($observation['commentaire']) ?></td>
                    <td><?= htmlspecialchars($observation['interne'] ? 'Oui' : 'Non') ?></td>
                    <td><?= htmlspecialchars($observation['identifiant_utilisateur']) ?></td>
                    <td>
                        <a href="?action=modifierObservation&id=<?= $observation['id_observation'] ?>">Modifier</a> |
                        <a href="?action=supprimerObservation&id=<?= $observation['id_observation'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette observation ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>