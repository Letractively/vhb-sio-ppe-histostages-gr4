<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>Site intranet de la section STS IG-SIO</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../../styles.css" rel="stylesheet" type="text/css" />
    <script src="../../menuCascade.js" type="text/javascript"></script>
  </head>
<body>
<?php 
include('../includes/entete.html');
include('../includes/menuGauche.html');
include("../_gestionBase.inc.php");
include("../_controlesEtGestionErreurs.inc.php");
?>
<div id=contenu>
<?php


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

	$num = $_GET['numero'];
   $lg=obtenirDetailOrganisation($connexion, $num);
   // BOUCLE SUR LES ORGANISATIONS
   while ($lg!=FALSE)
   {
   	
   	  $num=htmlspecialchars($lg['numero']);
      $nom=htmlspecialchars($lg['nom']);
      $idCat=htmlspecialchars($lg['idCategorie']);
      $rue=htmlspecialchars($lg['rue']);
      $cp=htmlspecialchars($lg['cp']);
      $ville=htmlspecialchars($lg['ville']);
      $tel=htmlspecialchars($lg['tel']);
      $fax=htmlspecialchars($lg['fax']);
      $mail=htmlspecialchars($lg['email']);
      $web=htmlspecialchars($lg['urlSiteWeb']);
   
      ?>
		<form id="formModifierOrganisation" action = "/histostage_seance3/histo/administration/accueilAdmin.php" method="POST">
		
		<?php 
			
		
		$requete="SELECT libelle FROM categorie WHERE id = " . $idCat . ";";
		
		$rsCat = mysql_query($requete);
		
		$data = mysql_fetch_array($rsCat);
		$valeur = $data["libelle"];
		
		?>
		<p>
		<label for="nom" accesskey="n">Libellé de la catégorie :</label>
			<input type="text" value="<?php echo $valeur ?>" readonly name="libelle" id="libelle" size="50">
		</p>
		<p>
		<label for="cat�gorie" accesskey="c">Catégorie :</label>
			<select name="cat" id="cat" size="1" >
			<?php 
				mysql_select_db(histostages);
				$req="SELECT libelle FROM categorie;";
		
				$rsCat= mysql_query($req, $connexion);
		
				$lgCat=mysql_fetch_assoc($rsCat);
		
				while($lgCat !=false){
		
					$libelle = $lgCat['libelle'];
					if($libelle==$valeur){
						echo '<option value="' . $libelle . '" selected="selected" >' . $libelle . '</option>';
					}
					else
					{
						echo '<option value="' . $libelle . '">' . $libelle . '</option>';
					}
						
					$lgCat=mysql_fetch_assoc($rsCat);
				}
		
				
			?>
			</select>
		</p>
		<p>
		<label for="nom" accesskey="n">Nom :</label>
			<input type="text" value="<?php echo $nom ?>" name="nom" id="nom" size="50">
		</p>
		<p>
		<label for="rue" accesskey="r">Rue :</label>
			<input type="text" value="<?php echo $rue ?>" name="rue" id="rue" size="50">
		</p>
		<p>
		<label for="ville" accesskey="v">Ville :</label>
			<input type="text" value="<?php echo $ville ?>" name="ville" id="ville" size="25">
		</p>
		<p>
		<label for="codePostal" accesskey="p">Code Postal :</label>
			<input type="text" value="<?php echo $cp ?>" name="cp" id="cp" size="27" >
		</p>
		<p>
		<label for="Telephone" accesskey="t">Téléphone :</label>
			<input  type="text" value="<?php echo $tel ?>" pattern="[0-9]{10}" name="tel" id="tel" size="26">
		</p>
		<p>
		<label for="fax" accesskey="f">Fax :</label>
			<input type="text" value="<?php echo $fax ?>" pattern="[0-9]{10}"name="fax" id="fax" size="25">
		</p>
		<p>
		<label for="mail" accesskey="m">Mail :</label>
			<input type="email" value="<?php echo $mail ?>" name="mail" id="mail" size="25">
		</p>
		<p>
		<label for="url" accesskey="u">Site web :</label>
			<input type="url" value="<?php echo $web ?>" name="url" id="url" size="50">
		</p>
		<p>
		<input type="submit" name="Etape" value="Modifier" id="Etape">
		</p>
		<p>
		<input type="reset" name="Etape" value="Annuler" id="Etape" >
		</p>
		
		<?php
		$lg=mysql_fetch_array($rsCat);
   }
		$Etape = lireDonneePost("Etape");
		$nom = addslashes(lireDonneePost("nom"));
		$rue = addslashes(lireDonneePost("rue"));
		$cp = lireDonneePost("cp");
		$ville = addslashes(lireDonneePost("ville"));
		$tel = lireDonneePost("tel");
		$fax = lireDonneePost("fax");
		$mail = lireDonneePost("mail");
		$url = lireDonneePost("url");
		$cat = lireDonneePost("cat");
		
		
		switch ($Etape)
			{
				case "Modifier" :
					
					$req = "UPDATE organisation 
					 SET nom ='" .$nom. "', idCategorie = " . obtenirIdCat($connexion, $cat) . ", rue = '".$rue."', cp = '".$cp."', ville = '".$ville."', tel = ".$tel.", fax = ".$fax.",email = '".$mail."', urlSiteWeb = '".$url . "' WHERE numero = " . $num . ";";
					$rs=mysql_query($req, $connexion);
				break;
			}
		?>
	</form>
	<form action="accueilAdmin.php" method="get">
		<p>
		<input type="submit" name="Etape" value="retour" id="Etape" >
		</p>
		</form>
	</div>
</body>