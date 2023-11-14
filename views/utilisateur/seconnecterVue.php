<html>
    <head>
        <title>Se connecter</title>
        <link rel="stylesheet" href="assets/css/utilisateur/seconnecter.css">
        <meta charset="utf-8">
    </head>
    <body>
    <form class="form" method="post" action="?action=connexion">
    <p class="title">Se connecter</p>
    <p class="message">Bon retour chez nous !</p>

    <label>
        <input required="" placeholder="" type="text" name="identifiant_utilisateur" class="input">
        <span>Email ou Pseudo</span>
    </label> 
        
    <label>
        <input required="" placeholder="" type="password" name="mot_de_passe" class="input">
        <span>Mot de passe</span>
    </label>

    <?php
      if (!empty($messageErreur)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $messageErreur; ?>
        </div>
      <?php endif; ?>

    <input type="submit" class="submit" value="Soumettre">

    <a href="?action=sinscrire">Pas encore inscrit ?</a><br>
</form>
</body>
</html>
