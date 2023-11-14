<?php
require '/Users/professionnel/Library/CloudStorage/OneDrive-UPEC/Documents/BUT2-INFO/SAE/SAE 3.01/test4/models/modelEspeces.php';

// Désactiver l'envoi implicite du tampon
ob_implicit_flush(0);

// Début du tamponnage
ob_start();

// Afficher le titre et le menu de la page instantanément sans attendre que la fin du script soit atteinte
echo '<html>';
echo '<head>';
echo '<title>Ma page PHP</title>';
echo '</head>';
echo '<body>';
echo '<h1>Ma page PHP</h1>';
echo '<ul>';
echo '<li><a href="index.php">Accueil</a></li>';
echo '<li><a href="recettes.php">Recettes</a></li>';
echo '<li><a href="contact.php">Contact</a></li>';
echo '</ul>';

// Fin du tamponnage et envoi au navigateur
ob_end_flush();
flush();


$id = 1414;
$interne = FALSE;

// Début du tamponnage
ob_start();

echo 'id : ';
echo modelEspeces::getAttributParId('id',$id, $interne);
echo '<br>';

// Fin du tamponnage et envoi au navigateur
ob_end_flush();
flush();

// Début du tamponnage
ob_start();

echo 'frenchVernacularName : ';
echo modelEspeces::getAttributParId('frenchVernacularName',$id, $interne);
echo '<br>';

// Fin du tamponnage et envoi au navigateur
ob_end_flush();
flush();


echo 'englishVernacularName : ';
echo modelEspeces::getAttributParId('englishVernacularName',$id, $interne);
echo '<br>';
echo 'referenceId : ';
echo modelEspeces::getAttributParId('referenceId',$id, $interne);
echo '<br>';
echo 'parentId : ';
echo modelEspeces::getAttributParId('parentId',$id, $interne);
echo '<br>';
echo 'scientificName : ';
echo modelEspeces::getAttributParId('scientificName',$id, $interne);
echo '<br>';
echo 'authority : ';
echo modelEspeces::getAttributParId('authority',$id, $interne);
echo '<br>';
echo 'fullName : ';
echo modelEspeces::getAttributParId('fullName',$id, $interne);
echo '<br>';
echo 'fullNameHtml : ';
echo modelEspeces::getAttributParId('fullNameHtml',$id, $interne);
echo '<br>';
echo 'rankId : ';
echo modelEspeces::getAttributParId('rankId',$id, $interne);
echo '<br>';
echo 'rankName : ';
echo modelEspeces::getAttributParId('rankName',$id, $interne);
echo '<br>';
echo 'referenceName : ';
echo modelEspeces::getAttributParId('referenceName',$id, $interne);
echo '<br>';
echo 'referenceNameHtml : ';
echo modelEspeces::getAttributParId('referenceNameHtml',$id, $interne);
echo '<br>';
echo 'genusName : ';
echo modelEspeces::getAttributParId('genusName',$id, $interne);
echo '<br>';
echo 'familyName : ';
echo modelEspeces::getAttributParId('familyName',$id, $interne);
echo '<br>';
echo 'orderName : ';
echo modelEspeces::getAttributParId('orderName',$id, $interne);
echo '<br>';
echo 'className : ';
echo modelEspeces::getAttributParId('className',$id, $interne);
echo '<br>';
echo 'phylumName : ';
echo modelEspeces::getAttributParId('phylumName',$id, $interne);
echo '<br>';
echo 'kingdomName : ';
echo modelEspeces::getAttributParId('kingdomName',$id, $interne);
echo '<br>';
echo 'vernacularGenusName : ';
echo modelEspeces::getAttributParId('vernacularGenusName',$id, $interne);
echo '<br>';
echo 'vernacularFamilyName : ';
echo modelEspeces::getAttributParId('vernacularFamilyName',$id, $interne);
echo '<br>';
echo 'vernacularOrderName : ';
echo modelEspeces::getAttributParId('vernacularOrderName',$id, $interne);
echo '<br>';
echo 'vernacularClassName : ';
echo modelEspeces::getAttributParId('vernacularClassName',$id, $interne);
echo '<br>';
echo 'vernacularPhylumName : ';
echo modelEspeces::getAttributParId('vernacularPhylumName',$id, $interne);
echo '<br>';
echo 'vernacularKingdomName : ';
echo modelEspeces::getAttributParId('vernacularKingdomName',$id, $interne);
echo '<br>';
echo 'vernacularGroup1 : ';
echo modelEspeces::getAttributParId('vernacularGroup1',$id, $interne);
echo '<br>';
echo 'vernacularGroup2 : ';
echo modelEspeces::getAttributParId('vernacularGroup2',$id, $interne);
echo '<br>';
echo 'vernacularGroup3 : ';
echo modelEspeces::getAttributParId('vernacularGroup3',$id, $interne);
echo '<br>';
echo 'habitat : ';
echo modelEspeces::getAttributParId('habitat',$id, $interne);
echo '<br>';
echo 'mediaImageThumbnailURL : ';
echo modelEspeces::getAttributParId('mediaImage',$id, $interne);
echo '<br>';
echo 'mediaImageThumbnail : ';
echo '<br>';
echo '<img src="' . modelEspeces::getAttributParId('mediaImage',$id, $interne) . '" alt="Image du Média" width="100" height="100" loading="lazy">';

// Fin du tamponnage et envoi au navigateur
ob_end_flush();
flush();