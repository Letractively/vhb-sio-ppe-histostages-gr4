<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Ajouter un étudiant</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../../styles.css" rel="stylesheet" type="text/css" />
    
    <script src="menuCascade.js" type="text/javascript"></script>
  </head>
  <body>
<?php include('../includes/entete.html');?>

<?php include('../includes/menuGauche.html');?>
        <div id="contenu">
                <form enctype="multipart/form-data" action="ajoutEtudiant.php" method="post">
                        <label for="caseUpload">Fichier à importer</label>
                        <input type="file" name="caseUpload" id="caseUpload" /><br />
                        <input type="submit" id="btnEnvoyer" value="Importer"/>
                </form>
                <a href="accueilAdmin.php">Retour à l'accueil de l'administration</a>
        </div>
<?php include('../includes/pied.html');?>
