<?php

function idStageExiste($connexion, $idStage)
{
	$req="select id from stage where id='" . $idStage ."'";
	$rs=mysql_query($req, $connexion);
	return mysql_num_rows($rs) > 0;
}

function insertEtudFromCSV($nom, $prenom, $option, $connexion) {
	$req = "insert into etudiant(numero, nom, prenom, libelleOption) values('".(recupererIdMaxEtudiant($connexion)+1)."','".$prenom."','".$nom."','".$option."')";
	$rs = mysql_query($req, $connexion);
	return $rs;
}

function recupererIdMaxEtudiant($connexion){
	$req = "select max(numero) as max from etudiant";
	$rs = mysql_query($req, $connexion);
	$lg= mysql_fetch_assoc($rs);
	return $lg["max"];
}
// FONCTIONS DE CONNEXION

function connect()
{
	$hote="localhost";
	$login="stssio";
	$mdp="stssio";
	return mysql_connect($hote, $login, $mdp);
}

function selectBase($connexion)
{
	$bd="HistoStages";
	$query="SET CHARACTER SET utf8";
	// Modification du jeu de caract�res de la connexion
	$res=mysql_query($query, $connexion);
	$ok=mysql_select_db($bd, $connexion);
	return $ok;
}

/**
 * La fonction filtreChaineBD �chappe les caract�res sp�ciaux ayant
 * une signification pr�cise pour le serveur MySQL
 * @param string $value : cha�ne de caract�res � �chapper
 * @return string : cha�ne de caract�res �chapp�e
 */
function filtreChaineBD($value)
{
	// Stripslashes
	if (! get_magic_quotes_gpc()) {
		$value = addslashes($value);
	}

	return $value;
}

// FONCTIONS DE GESTION DES ORGANISATIONS
function obtenirNbOrganisations($connexion)
{
	$req = "select count(*) as nbOrga from organisation";
	$rs=mysql_query($req, $connexion);
	$lg = mysql_fetch_array($rs);
	return $lg['nbOrga'];
}

function obtenirReqOrganisations()
{
	$req="select numero, nom, rue, cp, ville, count(numeroOrganisation) as nbStages
	from organisation o left join stage s on o.numero = s.numeroOrganisation
	group by numero, nom, rue, cp, ville
	order by nom";
	//   echo '***' . $req . '***<br />';
	return $req;
}

function obtenirReqAnneesScolaires()
{
	$req="select distinct annee from stage where annee is not null order by annee desc";
	return $req;
}

function obtenirReqDepts()
{
	$req="select numero, nom from dept order by numero";
	return $req;
}

function obtenirDetailOrganisation($connexion, $num)
{

	$req="select * from organisation o left join categorie c on o.idCategorie=c.id where numero=" . $num . "";
	$rs=mysql_query($req, $connexion);

	return mysql_fetch_array($rs);
}

function verifierIdOrganisation($connexion, $idOrganisation)
{
	$req="select numero from organisation where numero='". $idOrganisation . "';";
	$rs=mysql_query($req, $connexion);
	return mysql_num_rows($rs) > 0;
	 
}

function obtenirReqStages()
{
	$req = "select s.id as idStage, o.nom as nomOrga, e.nom as nomEtud, e.prenom as prenomEtud, concat( year( p.dateFin ) , '-', 'IG', p.numAnneeForm ) AS anneeStage
	from stage s inner join (organisation o inner join etudiant e inner join periodeStage p)
	on (s.numeroOrganisation=o.numero and s.numeroEtudiant=e.numero and idPeriodeStage = p.id) ";
	return $req;
}

function obtenirDetailOrgaStage($connexion, $id)
{
	$req="select o.*, c.libelle as libelleCategorie from stage s inner join organisation o on s.numeroOrganisation=o.numero
	left join categorie c on o.idCategorie=c.id where s.id=" . $id . "";
	$rs=mysql_query($req, $connexion);
	return mysql_fetch_array($rs);
}

function obtenirDetailRespStage($connexion, $id)
{
	$req="select concat(c1.civilite, ' ', c1.prenom, ' ', c1.nom) as identite, fonction, tel, email
	from jouerRole j inner join contact c1 on j.idContact=c1.id
	where j.idStage=" . $id  . " and idRole=1";
	$rs=mysql_query($req, $connexion);
	return mysql_fetch_array($rs);
}

function obtenirDetailMaitreStage($connexion, $id)
{
	$req="select concat(c2.civilite, ' ', c2.prenom, ' ', c2.nom) as identite, fonction, tel, email
	from jouerRole j inner join contact c2 on j.idContact=c2.id
	where j.idStage=" . $id . " and idRole=2";
	$rs=mysql_query($req, $connexion);
	return mysql_fetch_array($rs);
}

function obtenirDetailEtudStage($connexion, $id)
{
	$req="select libelle, theme as motsCles, annee as anneeStage, nom as nomEtud, prenom as prenomEtud
	from stage s inner join etudiant e on s.numeroEtudiant=e.numero
	where s.id=" . $id . "";
	$rs=mysql_query($req, $connexion);
	return mysql_fetch_array($rs);
}

?>
