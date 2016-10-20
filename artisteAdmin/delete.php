<?php
  session_start();
 require('../Includes/db.php');
 require('../Includes/functions.php');
 $id_artist = $_GET['idUser'];
 $id_image = $_GET['id'];
 $ext = $_GET['ext'];
 $req=$cnx->prepare("DELETE FROM `t_achievements` WHERE `t_achievements`.`ID_ACHIEV` =:id_image");
 $req->execute([':id_image' => $id_image]);
	 if($req)
	 {
		 unlink ('realisation/'.$id_artist.'/'.$id_image.'.'.$ext); 
		 unlink ('realisation/'.$id_artist.'/miniature/'.$id_image.'.'.$ext);
			
			echo "<script type='text/javascript'>document.location.replace('printmini.php');</script>";
	 }
	else{
		echo "erreur lors de la suppression de l'image";
	}
?>