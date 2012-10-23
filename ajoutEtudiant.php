<?php 
include ('histo/_gestionBase.inc.php');
connect();
$fichier = "etudiant.csv";
$fic = fopen($fichier, 'r');
$indices= array("nom","prenom","libOption");
$ligne=array();
echo "<pre>";
if ($fic !== FALSE) {
    while(($data = fgetcsv($fic, 1000, ";")) !== false) {
    	var_dump($data);
    	for ($i = 0; $i < 3; $i++) {
    		//echo $indices[$i]."\n";
    		/*$ligne[$indices[$i]] = */echo $data[$i];
    		
    	} 
    	echo $ligne["nom"]." ".$ligne["prenom"]." ".$ligne["libOption"];	
    }
    fclose($fic);
}
echo "</pre>"
?>