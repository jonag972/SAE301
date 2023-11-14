<?php include 'views/elements/navbar.php'; ?>
<h1>Salut, <?php echo $_SESSION['prenom']?></h1>
<h2>Voici les informations de votre compte :</h2>
<p>Votre identifiant : <?php echo $_SESSION['identifiant_utilisateur']?></p>
<p>Votre prénom : <?php echo $_SESSION['prenom']?></p>
<p>Votre nom de famille : <?php echo $_SESSION['nom_de_famille']?></p>
<p>Votre adresse email : <?php echo $_SESSION['email']?></p>
<p>Votre âge : <?php echo $_SESSION['age']?> ans</p>
<p>Votre pays : <?php echo $_SESSION['pays']?></p>
<p>Votre abonnement : <?php echo $_SESSION['abonnement']?></p>
<p>Votre rôle : <?php echo $_SESSION['role']?></p>
<a href="?action=modifierCompte">Modifier mon compte</a>
<a href="?action=supprimerCompte">Supprimer mon compte</a>
<a href="?action=deconnexion">Se déconnecter</a>