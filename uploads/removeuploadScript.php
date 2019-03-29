<?php 
	$dossier = 'upload/';
	$nomdufichier = $_GET['nomdufichier'];
	$target = $dossier.$nomdufichier;
	unlink($target);
?>