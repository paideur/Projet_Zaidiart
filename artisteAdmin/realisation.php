<?php
/**
 * User: Fred
 * Date: 20/09/16
 */
 require('../Includes/functions.php');
 session_start();
 //initialisation de la variable session
 $_SESSION['id_user'] =32;

//Selection de l'artiste
$idUser=$_SESSION['id_user'];

	createdossier($idUser);
	$upload_fichier = upload_files('document',"realisation/$idUser/document/",500000000, array('png','gif','jpg','jpeg','pdf') );
	
	if ($upload_fichier =="vide" || $upload_fichier =="ok" )
	{
	$upload_image1 = upload_image('image',"realisation/$idUser/",500000000, array('png','gif','jpg','jpeg') );
	echo $upload_image1;
	}
	else
	{
	echo $upload_fichier;
	}

	
?>