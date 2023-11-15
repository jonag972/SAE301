<?php require_once 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Détails de la Naturothèque</title>
</head>
<body>
    <h1>Détails de la Naturothèque</h1>
    <p>Nom: <?php echo htmlspecialchars($naturotheque['nom']); ?></p>
    <p>Description: <?php echo htmlspecialchars($naturotheque['description']); ?></p>
    <p>Date de Création: <?php echo htmlspecialchars($naturotheque['dateCreation']); ?></p>
    <p>Identifiant Utilisateur: <?php echo htmlspecialchars($naturotheque['identifiant_utilisateur']); ?></p>
    <?php if ($this->estAdmin() || $this->estProprietaireNaturotheque($naturotheque['id_naturotheque'])): ?>
        <a href="?action=modifierNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>">Modifier</a>
        <a href="?action=supprimerNaturotheque&id=<?php echo $naturotheque['id_naturotheque']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette naturothèque ?');">Supprimer</a>
    <?php endif; ?>
</body>
</html>
