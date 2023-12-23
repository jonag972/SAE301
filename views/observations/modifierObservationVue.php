<?php require_once 'views/elements/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Observation</title>
</head>
<body>
    <h1>Modifier Observation</h1>
    <form action="?action=miseAJourObservation&id=<?= $observation['id_observation'] ?>" method="post" enctype="multipart/form-data">
        <label for="id_espece">ID Espèce:</label>
        <input type="text" id="id_espece" name="id_espece" value="<?= htmlspecialchars($observation['id_espece']) ?>" required>

        <label for="date_observation">Date:</label>
        <input type="date" id="date_observation" name="date_observation" value="<?= htmlspecialchars($observation['date_observation']) ?>" required>

        <label for="pays_observation">Pays:</label>
        <input type="text" id="pays_observation" name="pays_observation" value="<?= htmlspecialchars($observation['pays_observation']) ?>" required>

        <label for="ville_observation">Ville:</label>
        <input type="text" id="ville_observation" name="ville_observation" value="<?= htmlspecialchars($observation['ville_observation']) ?>" required>

        <label for="commentaire">Commentaire:</label>
        <textarea id="commentaire" name="commentaire" required><?= htmlspecialchars($observation['commentaire']) ?></textarea>

        <label for="interne">Interne:</label>
        <input type="checkbox" id="interne" name="interne" <?= $observation['interne'] ? 'checked' : '' ?>>

        <label for="photo_observation">Photo:</label>
        <input type="file" id="photo_observation" name="photo_observation">

        <input type="submit" value="Modifier">
    </form>
</body>
</html>