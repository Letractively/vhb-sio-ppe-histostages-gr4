<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Ajout d'une période</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../../styles.css" rel="stylesheet" type="text/css" />
    <style>
.enteteTabQuad {
	font-size: 12px;
	font-family: Verdana, arial, helvetica, sans-serif;
	font-weight: bold;
	color: #333333;
	background-color: #a7ada7;
}

.enteteTab {
	font-size: 12px;
	font-family: Verdana, arial, helvetica, sans-serif;
	font-weight: bold;
	text-align: center;
}

.ligneTabQuad a:link {
	text-decoration: none;
	color: #333333;
}

.ligneTabQuad a:visited {
	text-decoration: none;
	color: #000066;
}

.ligneTabQuad a:hover {
	text-decoration: none;
	color: #FD4040;
}

/* Style du titre du tableau */
.titreTabQuad {
	font-size: 12px;
	font-family: Verdana, arial, helvetica, sans-serif;
	color: #eeeeee;
	text-align: center;
	font-weight: bold;
	background-color: #666666;
}

.ligneTabQuad {
	font-size: 12px;
	font-family: Verdana, arial, helvetica, sans-serif;
	color: #333333;
	background-color: #FFCC66;
	text-align: center;
}

/* Style des en-têtes d'un tableau non quadrillé*/
.enteteTabNonQuad {
	font-size: 12px;
	font-family: Verdana, arial, helvetica, sans-serif;
	font-weight: bold;
	color: #333333;
	background-color: #a7ada7;
}

/* Style des cellules */
.ligneTabNonQuad {
	font-size: 10px;
	font-family: Verdana, arial, helvetica, sans-serif;
	color: #333333;
	background-color: #FFCC66;
	vertical-align: top;
	text-align: left
}

div {
	float: left max-width:   100%;
	border: black solid 1px;
}
</style>
    
    <script src="menuCascade.js" type="text/javascript"></script>
  </head>
  <body>
<?php include('../includes/entete.html');?>

<?php include('../includes/menuGauche.html');?>


<?php 

include("../_gestionBase.inc.php");


$connexion = mysql_connect ('localhost', 'stssio', 'stssio');
mysql_select_db ('histostages');


$etape = lireDonneePost("etape");
$dateDeb = lireDonneePost("dateDeb");
$dateFin = lireDonneePost("dateFin");
$numAnneeForm = lireDonneePost("numAnneeForm");
switch ($etape)
{
	case "Ajouter" : if ($dateDeb >= $dateFin) {
		echo $msg = "La date de début doit être inférieure à la date de fin.";
	}
	else{
		$req="INSERT INTO `periodestage`(`id`,`dateDeb`, `dateFin`, `numAnneeForm`)
		VALUES (".obtenirNewId($connexion, 'periodestage').",'".$dateDeb."','".$dateFin."','".$numAnneeForm ."');";
		$rs=mysql_query($req, $connexion);
	}
	break;

}
?>


<div id="contenu">
	<table width="100%" cellspacing="0" cellpadding="0" align="center"
		class="tabQuadrille">
		<tr class="titreTabQuad">
			<td colspan="3">Liste des Périodes de stage</td>
		</tr>
		<tr class="enteteTabQuad">
			<td>Date de Début</td>
			<td>Date de Fin</td>
			<td>Année de Formation</td>
		</tr>
	
		<?php $sql = 'SELECT dateDeb, dateFin, numAnneeForm FROM periodestage';
	
		// on lance la requète (mysql_query) et on impose un message d'erreur si la requète ne se passe pas bien (or die)
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
		// on va scanner tous les tuples un par un
		while ($data = mysql_fetch_array($req)) {
			// on affiche les résultats
			?>
		<tr class="ligneTabQuad">
			<td><?php echo $data['dateDeb'] ?>
			</td>
			<?php ;?>
			<td><?php echo $data['dateFin']?>
			</td>
			<?php ;?>
			<td><?php echo $data['numAnneeForm'] ?></td>
		</tr>
		<?php ;
		}
	
		mysql_free_result ($req);
		mysql_close ();
		?>
	
	</table>
	
	<br />
	<br />
	<br />
	<br />
	<div>
		<div> Ajouter une période de stage :</div>
		<div>
			<form method="POST">
				<label> Date de Début :</label> <input type="date" name="dateDeb"
					id="dateDeb" size="25" required="required" /><br /> <label> Date de
					Fin :</label> <input type="date" name="dateFin" id="dateFin"
					size="25" required="required" /><br /> <label> Année de Formation :</label>
				<select type="text" name="numAnneeForm" id="numAnneeForm" size="1"
					required="required" />
				<option></option>
				<option>1</option>
				<option>2</option>
				</select>
				<p>
					<input type="submit" name="etape" id="etape" value="Ajouter" />
	
				</p>
	
	
			</form>
			<form action="accueil.txt" method="get">
				<input type="submit" value="Retour à l'accueil" name="boutonAnnuler" />
		
		</div>
	</div>
</div>

<?php include('../includes/pied.html');?>
