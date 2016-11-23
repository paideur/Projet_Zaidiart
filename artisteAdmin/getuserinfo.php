<?php

require('../Includes/db.php');
session_start();
//$idUser=$_SESSION['id_user'];
//Selection de l'artiste
	if(isset($_SESSION['id_user'])){
		$idUser=$_SESSION['id_user'];
		$req=$cnx->prepare("Select BLOG_NAME,photo from t_users where ID_USER=:idUser");
		$req->execute([':idUser' => $idUser]);
		$artiste= $req->fetch();

		echo json_encode($artiste);

	}
	else 
		echo json_encode("Veuillez vous connecter");

?>