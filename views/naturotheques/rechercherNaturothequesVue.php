<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Rechercher des Naturothèques</title>
</head>
<body>
    <h1>Rechercher des Naturothèques</h1>
    <form action="" method="get">
    <input type="hidden" name="action" value="rechercherNaturotheques">
        <input type="text" name="nom" placeholder="Nom de la naturothèque" value="<?php echo isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : ''; ?>">
        <input type="submit" value="Rechercher">
    </form>

    <?php if (!empty($naturotheques)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Identifiant Utilisateur</th>
                    <th>Détails</th>
                    <?php if ($this->estAdmin()): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($naturotheques as $naturotheque): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($naturotheque['nom']); ?></td>
                        <td><?php echo htmlspecialchars($naturotheque['description']); ?></td>
                        <td><?php echo htmlspecialchars($naturotheque['identifiant_utilisateur']); ?></td>
                        <td><a href="?action=detailsNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Détails</a></td>
                        <?php if ($this->estAdmin()): ?>
                            <td>
                                <a href="?action=modifierNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Modifier</a> | 
                                <a href="?action=supprimerNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette naturothèque ?');">Supprimer</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            if ($page > 1) {
                echo '<a href="?action=rechercherNaturotheques&nom=' . urlencode($nom) . '&page=' . ($page - 1) . '">Page précédente</a> | ';
            }
            if ($page < $nombreDePages) {
                echo '<a href="?action=rechercherNaturotheques&nom=' . urlencode($nom) . '&page=' . ($page + 1) . '">Page suivante</a>';
            }
            ?>
        </div>

    <?php else: ?>
        <p>Aucune naturothèque trouvée pour la recherche '<?php echo htmlspecialchars($_GET['nom']); ?>'.</p>
    <?php endif; ?>
</body>
</html>
