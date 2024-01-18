<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Toutes les Naturothèques</title>
</head>
<body>
    <h1>Toutes les Naturothèques</h1>
    <a href="?action=ajouterNaturotheque">Ajouter une Naturothèque</a>
    <a href="?action=afficherMesNaturotheques">Mes Naturothèques</a>
    <a href="?action=rechercherNaturotheques">Rechercher naturothèque(s)</a>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Identifiant Utilisateur</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($naturotheques as $naturotheque): ?>
                <tr>
                    <td>
                        <?php if ($naturotheque['photo_naturotheque']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($naturotheque['photo_naturotheque']) ?>" width="100" height="100">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($naturotheque['nom']); ?></td>
                    <td><?php echo htmlspecialchars($naturotheque['description']); ?></td>
                    <td><?php echo htmlspecialchars($naturotheque['identifiant_utilisateur']); ?></td>
                    <td><?php echo htmlspecialchars($naturotheque['dateCreation']); ?></td>
                    <td><a href="?action=afficherEspecesNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Voir</a></td>
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
            echo '<a href="?action=afficherToutesLesNaturotheques&page=' . ($page - 1) . '">Page précédente</a> | ';
        }
        if ($page < $nombreDePages) {
            echo '<a href="?action=afficherToutesLesNaturotheques&page=' . ($page + 1) . '">Page suivante</a>';
        }
        ?>
    </div>
</body>
</html>
