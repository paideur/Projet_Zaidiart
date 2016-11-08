<?php
/**
 * User: Fred
 * Date: 20/09/16
 */
 require('../Includes/functions.php');
 require('../Includes/db.php');
 session_start();

 //initialisation de la variable session
 //$_SESSION['id_user'] =32;

//Selection de l'artiste
$idUser=$_SESSION['id_user'];

	$req=$cnx->prepare("Select TITLE from `t_achievements` where ID_ARTIST=:id_user");
	$req->execute([':id_user' => $_SESSION['id_user']]);
	$req = $req->fetchAll();
	$number = count($req);
	
	if ($number != 0) 
	{
		for ($i=0; $i<$number; $i++)
		{
			$title[] = $req[$i]['TITLE'];
		}
		if (!in_array($_POST['title'],$title)) 
		{
		createdossier($idUser);
		$upload_fichier = upload_files('document',"realisation/$idUser/document/",25000000, array('png','gif','jpg','jpeg','pdf') );
				
			if ($upload_fichier =="vide" || $upload_fichier =="ok" )
			{
				$upload_image1 = upload_image('image',"realisation/$idUser/",25000000, array('png','gif','jpg','jpeg') );
				echo json_encode($upload_image1);
			}
			else echo json_encode($upload_fichier);
				
		}
		else echo json_encode("Ce titre existe déjà dans vos images, veuillez modifier votre titre");
		
	}
	else
	{
		createdossier($idUser);
		$upload_fichier = upload_files('document',"realisation/$idUser/document/",25000000, array('png','gif','jpg','jpeg','pdf') );
				
			if ($upload_fichier =="vide" || $upload_fichier =="ok" )
			{
				$upload_image1 = upload_image('image',"realisation/$idUser/",25000000, array('png','gif','jpg','jpeg') );
				echo json_encode($upload_image1);
			}
			else echo json_encode($upload_fichier);
	}
	
?>