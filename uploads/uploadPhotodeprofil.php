<?php 
	header('Access-Control-Allow-Origin: http://localhost:4200'); 
	$dossier = 'photo_de_profil/';
	$file_name = $_POST['name_file'];
	$extension = strrchr($_FILES['photostatus']['name'], '.');
	move_uploaded_file($_FILES['photostatus']['tmp_name'], $dossier . $file_name);
?>