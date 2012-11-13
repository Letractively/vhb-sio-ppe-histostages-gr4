<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Accueil de l'administration</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../../styles.css" rel="stylesheet" type="text/css" />
    
    <script src="menuCascade.js" type="text/javascript"></script>
  </head>
  <body>
<?php include('../includes/entete.html');?>

<?php include('../includes/menuGauche.html');?>

 <div id="contenu">
        <div class="colonneAdmin">
                <h3>Organisations</h3>
                <div>
                        <br /><a href=""><input type="button" value="Modifier" /></a><br /><br /><br />
                        <a href=""><input type="button" value="Ajouter" /></a><br />
                </div>
        </div>
        <div class="colonneAdmin">
                <h3>Contacts</h3>
                <div>
                        <br /><a href=""><input type="button" value="Modifier" /></a><br /><br /><br />
                        <a href=""><input type="button" value="Ajouter" /></a><br />
                </div>
        </div>
        <div class="colonneAdmin">
                <h3>Etudiants</h3>
                <div>
                        <br /><a href="ajoutEtudiant.php"><input type="button" value="Modifier" /></a><br /><br /><br />
                        <a href=""><input type="button" value="Ajouter" /></a><br />
                </div>
        </div>
</div>













<?php include('../includes/pied.html');?>