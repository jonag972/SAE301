<html>
<head>
  <title>S'inscrire</title>
  <link rel="stylesheet" href="assets/css/utilisateur/sinscrire.css">
</head>
<body>
  <!-- On utilise la méthode POST pour envoyer les données du formulaire et enctype="multipart/form-data" pour envoyer les fichiers -->
  <form class="form" method="post" action="?action=inscription" enctype="multipart/form-data">
    <p class="title">S'inscrire</p>
    <p class="message">Inscrivez-vous et obtenez l'accès total de notre application </p>
        <div class="flex">
        <label>
            <input required="" placeholder="" type="text" name="prenom" class="input">
            <span>Prenom</span>
        </label>

        <label>
            <input required="" placeholder="" type="text" name="nom_de_famille" class="input">
            <span>Nom de famille</span>
        </label>
        
        <label>
            <input required="" placeholder="" type="text" name="age" class="input">
            <span>Age</span>
        </label>
        
    </div>  
    <label>
      <input type="file" name="photo_de_profil" id="photo_de_profil">
      <span>Photo de profil</span>
    </label>


    <label>
        <input required="" placeholder="" type="text" name="identifiant_utilisateur" class="input">
        <span>Pseudo</span>
    </label>

    <label>
        <input required="" placeholder="" type="email" name="email" class="input">
        <span>Email</span>
    </label> 
        
    <label>
        <input required="" placeholder="" type="password" name="mot_de_passe" class="input">
        <span>Mot de passe</span>
    </label>

    <label>
        <input required="" placeholder="" type="text" name="pays" class="input">
        <span>Pays</span>
    </label>

    <label for="abonnement">Abonnement :</label>
    <select name="abonnement" id="abonnement">
        <option value="gratuit">Gratuit</option>
        <option value="premium">Premium</option>
    </select><br>

    <?php
      if (!empty($messageErreur)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $messageErreur; ?>
        </div>
      <?php endif; ?>

    <input type="submit" class="submit" value="Soumettre">

    <a href="?action=seconnecter">Déjà inscrit ?</a><br>
  </form>

</body>
</html>
