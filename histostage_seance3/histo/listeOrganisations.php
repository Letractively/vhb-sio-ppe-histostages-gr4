<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Site intranet de la section STS IG-SIO</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../styles.css" rel="stylesheet" type="text/css" />
    <script src="../menuCascade.js" type="text/javascript"></script>
  </head>
<body>
<?php

include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");
include('/includes/entete.html');
include('/includes/menuGauche.html');
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$tabErreurs = array();

$connexion=connect();
if (!$connexion)
{
   ajouterErreur($tabErreurs, "Echec de la connexion au serveur MySql");
   afficherErreurs($tabErreurs);
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur($tabErreurs, "La base de données stsig est inexistante ou non accessible");
   afficherErreurs($tabErreurs);
   exit();
}

// AFFICHER L'ENSEMBLE DES organisations
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// COMPAGNIE

$nbOrga = obtenirNbOrganisations($connexion);
echo '
<table width="100%" cellspacing="0" cellpadding="0" class="tabQuadrille">
   <tr class="titreTabQuad">
      <td colspan="4">Liste des organisations (' . $nbOrga . ')</td>
   </tr>
   <tr class="enteteTabQuad">
      <td>Nom</td>
      <td>Adresse</td>
      <td>Nombre stages</td>
      <td>Modifier</td>
   </tr>';
     
   $req=obtenirReqOrganisations();
   $rs=mysql_query($req, $connexion);
   $lg=mysql_fetch_array($rs);
   // BOUCLE SUR LES ORGANISATIONS
   while ($lg!=FALSE)
   {
   	
      $nom=htmlspecialchars($lg['nom']);
      $num=htmlspecialchars($lg['numero']);
      $rue=htmlspecialchars($lg['rue']);
      $cp=htmlspecialchars($lg['cp']);
      $ville=htmlspecialchars($lg['ville']);
      $nbStages=$lg['nbStages'];
      echo '
		<tr class="ligneTabQuad">
         <td><a href="accueil.php?page=detailOrganisation&amp;numero='.$num.'">'.$nom.'</a></td>
         <td>'. $rue .' '. $cp . ' '. $ville . '</td>
         <td>'. $nbStages . '</td>
         <td><a href="./administration/Modifier_Organisation.php?numero='.$num.'" title="Modifier Organisation">'. "Modifier cette organisation" .'</a> </td>
    </tr>';

    $lg=mysql_fetch_array($rs);
   }   
   echo '
</table>';
   mysql_free_result($rs);

?>