<?php
require '/Users/professionnel/Library/CloudStorage/OneDrive-UPEC/Documents/BUT2-INFO/SAE/SAE 3.01/test4/models/modelUtilisateur.php';

// Désactiver l'envoi implicite du tampon
ob_implicit_flush(0);

// Début du tamponnage
ob_start();

// Afficher le titre et le menu de la page instantanément sans attendre que la fin du script soit atteinte
echo '<html>';
echo '<head>';
echo '<title>Page de test du modèle Utilisateur</title>';
echo '<meta charset="UTF-8">';
echo '</head>';
echo '<body>';
echo '<h1>Page de test du modèle Utilisateur</h1>';


// Fin du tamponnage et envoi au navigateur
ob_end_flush();
flush();

$identifiant_utilisateur = 'lambda';

modelUtilisateur::supprimerUtilisateurParIdentifiant($identifiant_utilisateur);

// Début du tamponnage
ob_start();

$id_utilisateur = 'lambda';
$identifiant_utilisateur = 'lambda';
$mot_de_passe = 'lambda';
$photo_de_profil = 'lambda';
$email = 'lambda';
$prenom = 'lambda';
$nom_de_famille = 'lambda';
$age = 48;
$pays = 'lambda';
$ville = 'France';
$abonnement = 'lambda';
$role = 'lambda';

echo 'Ajout d\'un utilisateur avec les attributs suivants : id_utilisateur = ' . $id_utilisateur . ', identifiant_utilisateur = ' . $identifiant_utilisateur . ', mot_de_passe = ' . $mot_de_passe . ', photo_de_profil = ' . $photo_de_profil . ', email = ' . $email . ', prenom = ' . $prenom . ', nom_de_famille = ' . $nom_de_famille . ', age = ' . $age . ', pays = ' . $pays . ', ville = ' . $ville . ', abonnement = ' . $abonnement . ', role = ' . $role . '<br>';

modelUtilisateur::ajouterUtilisateur($identifiant_utilisateur, $mot_de_passe, base64_encode($photo_de_profil), $email, $prenom, $nom_de_famille, $age, $pays, $ville, $abonnement, $role);

echo 'Voici les attributs de l\'utilisateur ajouté : <br>';

echo 'id : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('id_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'identifiant_utilisateur : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'motDePasse : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $identifiant_utilisateur);
echo '<br>';
echo 'photo_de_profil : ';
echo base64_decode(modelUtilisateur::getAttributUtilisateurParIdentifiant('photo_de_profil', $identifiant_utilisateur));
echo '<br>';
echo 'email : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('email', $identifiant_utilisateur);
echo '<br>';
echo 'prenom : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('prenom', $identifiant_utilisateur);
echo '<br>';
echo 'nom_de_famille : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('nom_de_famille', $identifiant_utilisateur);
echo '<br>';
echo 'age : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('age', $identifiant_utilisateur);
echo '<br>';
echo 'pays : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('pays', $identifiant_utilisateur);
echo '<br>';
echo 'ville : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('ville', $identifiant_utilisateur);
echo '<br>';
echo 'abonnement : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('abonnement', $identifiant_utilisateur);
echo '<br>';
echo 'role : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('role', $identifiant_utilisateur);
echo '<br>';

echo 'Modification de l\'attribut identifiant_utilisateur de l\'utilisateur ajouté : <br>';
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('mot_de_passe', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('photo_de_profil', NULL, $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('email', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('prenom', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('nom_de_famille', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('age', 43, $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('pays', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('ville', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('abonnement', 'lambda2', $identifiant_utilisateur);
modelUtilisateur::modifierAttributUtilisateurParIdentifiant('role', 'lambda2', $identifiant_utilisateur);

echo 'Voici les attributs de l\'utilisateur modifié : <br>';
echo 'id : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('id_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'identifiant_utilisateur : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'motDePasse : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $identifiant_utilisateur);
echo '<br>';
echo 'photo_de_profil : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('photo_de_profil', $identifiant_utilisateur);
echo '<br>';
echo 'email : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('email', $identifiant_utilisateur);
echo '<br>';
echo 'prenom : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('prenom', $identifiant_utilisateur);
echo '<br>';
echo 'nom_de_famille : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('nom_de_famille', $identifiant_utilisateur);
echo '<br>';
echo 'age : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('age', $identifiant_utilisateur);
echo '<br>';
echo 'pays : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('pays', $identifiant_utilisateur);
echo '<br>';
echo 'ville : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('ville', $identifiant_utilisateur);
echo '<br>';
echo 'abonnement : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('abonnement', $identifiant_utilisateur);
echo '<br>';
echo 'role : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('role', $identifiant_utilisateur);
echo '<br>';

echo 'Suppression de l\'utilisateur ajouté : <br>';
modelUtilisateur::supprimerUtilisateurParIdentifiant($identifiant_utilisateur);

echo 'Voici les attributs de l\'utilisateur supprimé : <br>';
echo 'id : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('id_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'identifiant_utilisateur : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('identifiant_utilisateur', $identifiant_utilisateur);
echo '<br>';
echo 'motDePasse : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('mot_de_passe', $identifiant_utilisateur);
echo '<br>';
echo 'photo_de_profil : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('photo_de_profil', $identifiant_utilisateur);
echo '<br>';
echo 'email : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('email', $identifiant_utilisateur);
echo '<br>';
echo 'prenom : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('prenom', $identifiant_utilisateur);
echo '<br>';
echo 'nom_de_famille : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('nom_de_famille', $identifiant_utilisateur);
echo '<br>';
echo 'age : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('age', $identifiant_utilisateur);
echo '<br>';
echo 'pays : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('pays', $identifiant_utilisateur);
echo '<br>';
echo 'ville : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('ville', $identifiant_utilisateur);
echo '<br>';
echo 'abonnement : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('abonnement', $identifiant_utilisateur);
echo '<br>';
echo 'role : ';
echo modelUtilisateur::getAttributUtilisateurParIdentifiant('role', $identifiant_utilisateur);
echo '<br>';