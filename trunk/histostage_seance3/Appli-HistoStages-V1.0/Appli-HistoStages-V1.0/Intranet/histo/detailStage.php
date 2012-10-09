<?php

include("_gestionBase.inc.php");
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÃ‰LECTION DE LA BASE DE DONNÃ‰ES Hynos

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
	ajouterErreur($tabErreurs, "La base de donnÃ©es stsig est inexistante ou non accessible");
	afficherErreurs($tabErreurs);
	exit();
}

if ( !isset($_GET['id']) )
{
	ajouterErreur($tabErreurs, "Absence d'identifiant pour le stage Ã  dÃ©tailler");
	afficherErreurs($tabErreurs);
}
else
{

	$id=$_GET['id'];
	if(strlen($id)==0 || !is_numeric($id) || !idStageExiste($connexion, $id))
	{		
		ajouterErreur($tabErreurs, "Stage demandé invalide ou inexistant");
		afficherErreurs($tabErreurs);
	}
	else
	{
		// OBTENIR LE DÃ‰TAIL DU STAGE SÃ‰LECTIONNÃ‰

		$lg=obtenirDetailOrgaStage($connexion, $id);

		$nomOrga=htmlspecialchars($lg['nom']);
		$rue=htmlspecialchars($lg['rue']);
		$cp=htmlspecialchars($lg['cp']);
		$ville=htmlspecialchars($lg['ville']);
		$tel=htmlspecialchars($lg['tel']);
		$email=htmlspecialchars($lg['email']);
		$urlSiteWeb= htmlspecialchars($lg['urlSiteWeb']);
		$libelleCat=htmlspecialchars($lg['libelleCategorie']);

		$lg=obtenirDetailRespStage($connexion, $id);
		$identiteRespStage=htmlspecialchars($lg['identite']);
		$fonctionRespStage=htmlspecialchars($lg['fonction']);
		$telRespStage=htmlspecialchars($lg['tel']);
		$emailRespStage=htmlspecialchars($lg['email']);

		$lg=obtenirDetailMaitreStage($connexion, $id);
		$identiteMaitreStage=htmlspecialchars($lg['identite']);
		$fonctionMaitreStage=htmlspecialchars($lg['fonction']);
		$telMaitreStage=htmlspecialchars($lg['tel']);
		$emailMaitreStage=htmlspecialchars($lg['email']);

		$lg=obtenirDetailEtudStage($connexion, $id);
		$nomEtud=htmlspecialchars($lg['nomEtud']);
		$prenomEtud=htmlspecialchars($lg['prenomEtud']);
		$anneeStage=htmlspecialchars($lg['anneeStage']);
		$libelle=htmlspecialchars($lg['libelle']);
		$motsCles=htmlspecialchars($lg['motsCles']);


		echo '
		<table width="90%" cellspacing="0" cellpadding="0" class="tabNonQuadrille">

		<tr class="enteteTabNonQuad">
		<td colspan="2">Stage effectuÃ© par '.$prenomEtud. ' ' . $nomEtud . ' (' . $anneeStage . ') - ' . $nomOrga.'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> Adresse organisation: </td>
		<td>'.$rue.'<br />'.$cp . '&nbsp;' . $ville .'
		</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> LibellÃ© catÃ©gorie:</td>
		<td>'.$libelleCat.'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> TÃ©lÃ©phone: </td>
		<td>'.$tel.'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> Email:</td>
		<td>'.$email.'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> Site Web: </td>
		<td>';
		if (!empty($urlSiteWeb)) {
			echo  '<a href="http://'.$urlSiteWeb.'">'. $urlSiteWeb . '</a>';
		}
		echo '</td>
		</tr>
		<tr class="enteteTabNonQuad">
		<td colspan="2">Suivi de stage </td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> Responsable de stage: </td>
		<td>' . $identiteRespStage . ' - '. $fonctionRespStage . ' - '. $telRespStage . ' - ' . $emailRespStage .'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> MaÃ®tre de stage: </td>
		<td>' . $identiteMaitreStage .' - '. $fonctionMaitreStage . ' - '. $telMaitreStage . ' - ' . $emailMaitreStage . '</td>
		</tr>
		<tr class="enteteTabNonQuad">
		<td colspan="2">Sujet de stage</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> LibellÃ©: </td>
		<td>' . $libelle .'</td>
		</tr>
		<tr class="ligneTabNonQuad">
		<td> Mots-cles: </td>
		<td>' . $motsCles .'</td>
		</tr>
		</table>
		<p class="liensFinPage">
		<a href="accueil.php?page=rechercheStagesCriteres">Retour</a>
		</p>';
	}
}
?>
