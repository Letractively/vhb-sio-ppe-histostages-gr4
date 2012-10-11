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
    <div id="entete">
<!--      <img src="img/logo.jpg" class="logo" alt="logo" /> -->
      <h1>Site intranet de la section STS IG-SIO</h1>
    </div>

	<div id="menugauche">
	  <ul id="menulist">
       	 <li class="smenu"><a href="#" accesskey="c">Compétences IG</a>
          <ul>
            <li>
              <a href="?page=competencesSavoirsDA" title="Liste des compétences DA">Compétences DA</a>
            </li>
            <li>
              <a href="?page=competencesSavoirsAR" title="Liste des compétences AR">Compétences AR</a>
            </li>
          </ul> 
         </li>
       	 <li class="smenu"><a href="#" accesskey="a">Activités SIO</a>
          <ul>
            <li>
              <a href="?page=activitesP1" title="Liste des activités du processus P1">Activités P1</a>
            </li>
            <li>
              <a href="?page=activitesP2" title="Liste des activités du processus P2">Activités P2</a>
            </li>
            <li>
              <a href="?page=activitesP3" title="Liste des activités du processus P3">Activités P3</a>
            </li>
            <li>
              <a href="?page=activitesP4" title="Liste des activités du processus P4">Activités P4</a>
            </li>
            <li>
              <a href="?page=activitesP5" title="Liste des activités du processus P5">Activités P5</a>
            </li>
          </ul> 
         </li>
       	 <li class="smenu"><a href="#" accesskey="h">Historique stages</a>
          <ul >
            <li>
              <a href="?page=listeOrganisations" title="Liste des organisations ayant accueilli un stagiaire">Liste entreprises</a>
            </li>
            <li>
              <a href="?page=rechercheStagesCriteres" title="Rechercher un stage sur critÃ¨res">Recherche stages</a>
            </li>
          </ul> 
         </li>
       	 <li class="smenu"><a href="?page=adressesSites" accesskey="L">Liens sites stages</a>
       	 </li>
      
  </ul>
 </div>
		  
	
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
	
  <!-- Division pour le pied de page -->
  <div id="pied">
    <p id="logoValidW3c">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
    </p>
  <p id="libValidW3c">Cette page est conforme aux standards du Web</p>
  </div>

  </body>
</html>
