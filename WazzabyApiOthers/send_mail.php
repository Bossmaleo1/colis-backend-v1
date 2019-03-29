<?php
	header('Access-Control-Allow-Origin: http://localhost:4200'); 
	$element=rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
	$destinataire = $_GET['email'];
	$emmeteur = "wazzaby@wazzaby.com";
	$messagedenvoie ='Votre code de verification est : '.$element;
    /*mail($destinataire,
     'Code de validation',
     $messagedenvoie,
     "From: $emmeteur\r\n".
        "Reply-To: $reponse\r\n".
        "Content-Type: text/html; charset=\"UTF-8\"\r\n");*/
	echo json_encode(array('succes' => $element,'email'=>$destinataire));	
?>
