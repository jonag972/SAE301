<?php require_once 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails Observation</title>
</head>
<body>
    <h1>Détails Observation</h1>
    <table>
        <tr>
            <th>Photo</th>
            <td>
                <?php if ($observation['photo_observation']): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($observation['photo_observation']) ?>" width="100" height="100">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>ID</th>
            <td><?= htmlspecialchars($observation['id_observation']) ?></td>
        </tr>
        <tr>
            <th>ID Espèce</th>
            <td><?= htmlspecialchars($observation['id_espece']) ?></td>
        </tr>
        <tr>
            <th>Date</th>
            <td><?= htmlspecialchars($observation['date_observation']) ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= htmlspecialchars($observation['pays_observation']) ?></td>
        </tr>
        <tr>
            <th>Ville</th>
            <td><?= htmlspecialchars($observation['ville_observation']) ?></td>
        </tr>
        <tr>
            <th>Commentaire</th>
            <td><?= htmlspecialchars($observation['commentaire']) ?></td>
        </tr>
        <?php if ($this->estAdmin()): ?>
            <tr>
                <th>Interne</th>
                <td><?= htmlspecialchars($observation['interne'] ? 'Oui' : 'Non') ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php if ($this->estAdmin() || $this->estProprietaireObservation($observation['identifiant_utilisateur'])): ?>
        <a href="?action=modifierObservation&id=<?= $observation['id_observation'] ?>">Modifier</a> |
        <a href="?action=supprimerObservation&id=<?= $observation['id_observation'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette observation ?');">Supprimer</a>
    <?php endif; ?>
</body>
</html>