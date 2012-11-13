<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Site intranet de la section STS IG-SIO</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <script src="menuCascade.js" type="text/javascript"></script>
  </head>
  <body>
    <?php include('histo/includes/entete.html');?>

	<?php include('histo/includes/menuGauche.html');?>
		  
	
	 <div id="contenu">
	 	<h1>
	 	<?php
	 	$correspondancePageAvecTitreNiveau1 = 
	 	array(
			"accueil" => "<a href='accueil.php'>Historique stages</a>",
			"competencesSavoirsDA" => " > <a href='accueil.php?page=competencesSavoirsDA'>Compétences savoirs DA</a>",
			"competencesSavoirsAR" => " > <a href='accueil.php?page=competencesSavoirsAR'>Compétences savoirs AR</a>",
			"activitesP1" => " > <a href='accueil.php?page=activitesP1'>Activités P1</a>",
			"activitesP2" => " > <a href='accueil.php?page=activitesP2'>Activités P2</a>",
			"activitesP3" => " > <a href='accueil.php?page=activitesP3'>Activités P3</a>",
			"activitesP4" => " > <a href='accueil.php?page=activitesP4'>Activités P4</a>",
			"activitesP5" => " > <a href='accueil.php?page=activitesP5'>Activités P5</a>",
			"listeOrganisations" => " > <a href='accueil.php?page=listeOrganisations'>Liste organisations</a>",
			"rechercheStagesCriteres" => " > <a href='accueil.php?page=rechercheStagesCriteres'>Recherche stages</a>",
			"adressesSites" => " > <a href='accueil.php?page=adressesSites'>Adresses Sites</a>"	 	
		);
		$correspondancePageAvecTitreNiveau2 =
		array(
				"detailOrganisation" => $correspondancePageAvecTitreNiveau1["listeOrganisations"]." > <a href='accueil.php?page=detailOrganisation'>Détail d'une organisation</a>",
				"resultatsRechercheStages" => $correspondancePageAvecTitreNiveau1["rechercheStagesCriteres"]." > <a href='accueil.php?page=resultatsRechercheStages'>Résultat stages</a>"
		);
		$correspondancePageAvecTitreNiveau3 =
		array(
				"detailStage" => $correspondancePageAvecTitreNiveau2["resultatsRechercheStages"]." > <a href='accueil.php?page=detailStage'>Détail d'un stage</a>"
		);
		echo $correspondancePageAvecTitreNiveau1["accueil"];
		if (isset($_GET["page"])) {
			if(isset($correspondancePageAvecTitreNiveau1[$_GET["page"]]))
			{
				echo $correspondancePageAvecTitreNiveau1[$_GET["page"]];
			}
			elseif(isset($correspondancePageAvecTitreNiveau2[$_GET["page"]]))
			{
				echo $correspondancePageAvecTitreNiveau2[$_GET["page"]];
			}
			elseif(isset($correspondancePageAvecTitreNiveau3[$_GET["page"]]))
			{
				echo $correspondancePageAvecTitreNiveau3[$_GET["page"]];
			}
		}
	 	?> 
	 	</h1>
  		<?php if ( isset($_GET["page"]) ) { $page = $_GET["page"]; include('./histo/'.$page.'.php');} ?>
	 </div>
	
	<?php include('histo/includes/pied.html');?>

  </body>
</html>
