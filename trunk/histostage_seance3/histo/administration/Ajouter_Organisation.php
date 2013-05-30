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

	<?php include('includes/entete.html');?>
	<?php include('includes/menuGauche.html');?>
	
	<div id="contenu">
		<form id="formAjouterOrganisation" method="POST">
		<p>
		<label for="catégorie" accesskey="c">Catégorie :</label>
			<select name="cat" id="cat" size="1">
			<option value="0" selected="selected">Indifférent</option>
			<?php
			
				include ("_gestionBase.inc.php");
				$connexion= connect();
				mysql_select_db(histostages);
				$req="SELECT libelle FROM categorie;";
		
				$rsCat= mysql_query($req, $connexion);
		
				$lgCat=mysql_fetch_assoc($rsCat);
		
				while($lgCat !=false){
		
					$libelle = $lgCat['libelle'];
					echo '<option value="' . $libelle . '">' . $libelle . '</option>';
					$lgCat=mysql_fetch_assoc($rsCat);
				}
		
				mysql_free_result($rsCat);
		?>
			</select>
		</p>
		<p>
		<label for="nom" accesskey="n">Nom :</label>
			<input type="text" required placeholder="Le nom de l'organisation" name="nom" id="nom" size="50">
		</p>
		<p>
		<label for="rue" accesskey="r">Rue :</label>
			<input type="text" placeholder="La rue de l'organisation" name="rue" id="rue" size="50">
		</p>
		<p>
		<label for="ville" accesskey="v">Ville :</label>
			<input type="text" name="ville" id="ville" size="25" placeholder="La ville de l'organisation">
		</p>
		<p>
		<label for="codePostal" accesskey="p">Code Postal :</label>
			<input type="text" name="cp" id="cp" size="27" placeholder="Le code postal de l'organisation">
		</p>
		<p>
		<label for="Telephone" accesskey="t">Téléphone :</label>
			<input  type="text" required placeholder="Le téléphone de l'organisation" pattern="[0-9]{10}" name="tel" id="tel" size="26">
		</p>
		<p>
		<label for="fax" accesskey="f">Fax :</label>
			<input type="text" placeholder="Le fax de l'organisation" pattern="[0-9]{10}"name="fax" id="fax" size="25">
		</p>
		<p>
		<label for="mail" accesskey="m">Mail :</label>
			<input type="email" placeholder="L'e-mail de l'organisation" name="mail" id="mail" size="25">
		</p>
		<p>
		<label for="url" accesskey="u">Site web :</label>
			<input type="url" placeholder="Le site web de l'organisation" name="url" id="url" size="50">
		</p>
		<p>
		<input type="submit" name="Etape" value="Ajouter" id="Etape">
		</p>
		<p>
		<input type="reset" name="Etape" value="Annuler" id="Etape" >
		</p>
		
		<?php
		$Etape = lireDonneePost("Etape");
		$nom = lireDonneePost("nom");
		$rue = lireDonneePost("rue");
		$cp = lireDonneePost("cp");
		$ville = lireDonneePost("ville");
		$tel = lireDonneePost("tel");
		$fax = lireDonneePost("fax");
		$mail = lireDonneePost("mail");
		$url = lireDonneePost("url");
		$cat = lireDonneePost("cat");
		
			switch ($Etape)
			{
				case "Ajouter" :
					
					//$rsId = obtenirIdCat($connexion, $cat);
					$numero = obtenirNewId($connexion, 'organisation');
					$req = "INSERT INTO organisation (numero, nom, idCategorie, rue, cp, ville, numeroDept, tel, fax, email, distanceKM, libelleDistance, urlSiteWeb)
					 VALUES (" .$numero. ", '" .$nom. "', " . obtenirIdCat($connexion, $cat) . ", '".$rue."', ".$cp.", '".$ville."', NULL, '".$tel."', '".$fax."','".$mail."', NULL, NULL, '".$url . "');";
					echo $req;
					$rs=mysql_query($req, $connexion);
				break;
			}
		?>
			
		</form>
	</div>
	<?php include('includes/pied.html');?>
</body>