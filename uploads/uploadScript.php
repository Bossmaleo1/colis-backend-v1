<?php 
	$dossier = 'upload/';
	$file_name = $_POST['name_file'];
	$extension = strrchr($_FILES['photostatus']['name'], '.');
	$name = $file_name.$extension;
	move_uploaded_file($_FILES['photostatus']['tmp_name'], $dossier . $name);
?>