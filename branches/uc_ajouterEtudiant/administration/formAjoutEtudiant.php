<html>
<title>Ajouter un étudiant</title>
<body>
	<section>
		<form enctype="multipart/form-data" action="ajoutEtudiant.php" method="post">
			<label for="caseUpload">Fichier à importer</label>
			<input type="file" name="caseUpload" id="caseUpload" /><br />
			<input type="submit" id="btnEnvoyer" value="Importer"/>
		</form>
	</section>
</body>
</html>