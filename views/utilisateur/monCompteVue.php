<?php include 'views/elements/navbar.php'; ?>
<h1>Salut, <?php echo $_COOKIE['prenom']?></h1>
<h2>Voici les informations de votre compte :</h2>
<p>Votre identifiant : <?php echo $_COOKIE['identifiant_utilisateur']?></p>
<p>Votre prénom : <?php echo $_COOKIE['prenom']?></p>
<p>Votre nom de famille : <?php echo $_COOKIE['nom_de_famille']?></p>
<p>Votre adresse email : <?php echo $_COOKIE['email']?></p>
<p>Votre âge : <?php echo $_COOKIE['age']?> ans</p>
<p>Votre pays : <?php echo $_COOKIE['pays']?></p>
<p>Votre abonnement : <?php echo $_COOKIE['abonnement']?></p>
<p>Votre rôle : <?php echo $_COOKIE['role']?></p>
<a href="?action=modifierCompte">Modifier mon compte</a>
<a href="?action=supprimerCompte">Supprimer mon compte</a>
<a href="?action=deconnexion">Se déconnecter</a>