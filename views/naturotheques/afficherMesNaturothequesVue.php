<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Mes Naturothèques</title>
</head>
<body>
    <h1>Mes Naturothèques</h1>
    <a href="?action=ajouterNaturotheque">Ajouter une Naturothèque</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($naturotheques as $naturotheque): ?>
                <tr>
                    <td><?php echo htmlspecialchars($naturotheque['nom']); ?></td>
                    <td><?php echo htmlspecialchars($naturotheque['description']); ?></td>
                    <td><?php echo htmlspecialchars($naturotheque['dateCreation']); ?></td>
                    <td><a href="?action=detailsNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Détails</a></td>
                    <td><a href="?action=modifierNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Modifier</a></td>
                    <td><a href="?action=supprimerNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette naturothèque ?');">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php
        if ($page > 1) {
            echo '<a href="?action=afficherMesNaturotheques&page=' . ($page - 1) . '">Page précédente</a> | ';
        }
        if ($page < $nombreDePages) {
            echo '<a href="?action=afficherMesNaturotheques&page=' . ($page + 1) . '">Page suivante</a>';
        }
        ?>
    </div>
</body>
</html>
