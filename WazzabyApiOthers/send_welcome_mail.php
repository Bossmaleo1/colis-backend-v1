<?php
	header('Access-Control-Allow-Origin: http://localhost:4200'); 
	$element=rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
	$destinataire = $_GET['email'];
	
	if ( $_GET['sexe'] === 'H' ) {
		$nom = 'Mr. '.$_GET['prenom'].' '.$_GET['nom'];
	} else {
		$nom = 'Mme. '.$_GET['prenom'].' '.$_GET['nom'];
	}
	
	$emmeteur = "wazzaby@wazzaby.com";
	$messagedenvoie ="Bienvenue dans Wazzaby ".$nom.", votre compte a ete cree avec succes , veuillez vous connectez sur <a href='Wazzaby.com'>Wazzaby</a> <br/> 
	Pour Rappel , votre nom d'utilisateur est : ".$_GET['email']." et votre mot de passe : ".$_GET['password'];
	
	echo json_encode(array('succes' => $element,'email'=>$destinataire));	
?>
