<html>
        <head>
                <title>Ajout des étudiants</title>
                <script type="text/javascript">
                function redirection(s, url)
                {
                        ms = s * 1000; // conversion des secondes en microseconde
                        self.setTimeout("self.location.href = '" + url + "';", ms) ;
                }
                function ecrireTexteRedirection(temps) {
                        var p = document.getElementById('paragraphe');                  
                        p.innerHTML=" Vous serez automatiquement redirigé vers le formulaire dans "+ temps + " secondes.";
                        console.log(temps);
                }
                </script>
        </head>
<?php 
include ('../_gestionBase.inc.php');
$nomFichierUploade = $_FILES["caseUpload"]["name"];
if (substr($nomFichierUploade, strlen($nomFichierUploade)-3, 3) === "csv" && move_uploaded_file($_FILES["caseUpload"]["tmp_name"], "etudiant.csv")) {
		$uploaded=true;
        $connexion=connect();
        selectBase($connexion);
        $fichier = "etudiant.csv";
        $fic = fopen($fichier, 'r');
        $indices= array("nom","prenom","libOption");
        $ligne=array();
        if ($fic !== FALSE) {
                while(($data = fgetcsv($fic, 1000, ";")) !== false) {
                        for ($i = 0; $i < 3; $i++) {
                                $ligne[$indices[$i]] = $data[$i];
                        }
                        insertEtudFromCSV($ligne["nom"],$ligne["prenom"],$ligne["libOption"],$connexion);
                }
                fclose($fic);
                unlink($fichier);//supprime le fichier uploadé après avoir fait les actions
        }
}
else {
        $uploaded=false;
}?>
        <body onload="redirection(5, 'formAjoutEtudiant.php');">       
                <p id="paragraphe"><?php $msg=$uploaded?"Etudiants ajoutés":"Echec de l'ajout des étudiants"; echo $msg ?></p>
                <script type="text/javascript">
                var unTemps = 4;                
                timer = setInterval("ecrireTexteRedirection(unTemps);unTemps--", 1000);
                </script>
        </body>
</html>