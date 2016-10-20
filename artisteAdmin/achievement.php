<?php
/**
 * User: Fred
 * Date: 05/10/16
 */
 require('../Includes/db.php');
 require('../Includes/functions.php');
  session_start();
  
 $id_artist = $_GET['idUser'];
 $image = $_GET['id'];
 $vue = $_GET['vue']+1;

//mise à jour du nombre de vue de l'image
	$req0=$cnx->prepare("UPDATE `t_achievements` SET VUE =:vue  where ID_ACHIEV=:image_num");
	$req0->execute([':vue' => $vue,':image_num' => $image]);
//recuperation des données relatives à l'image
	$req1=$cnx->prepare("Select * from `t_achievements` where ID_ACHIEV=:image_num");
	$req1->execute([':image_num' => $image]);
	$achiev = $req1->fetch();
//recuperation des infos relatives à l'artiste
	$req2=$cnx->prepare("Select * from `t_users` where ID_USER=:id_artist");
	$req2->execute([':id_artist' => $id_artist]);
	$artiste = $req2->fetch();
//Affichage de l'image avec tous les infos tels que spécifié dans les specs
	echo '<center><table>';
	echo '<tr><td><center><h1>'.$achiev['TITLE'].' '.$achiev['YEAR'].'</h1></center></td></tr>';
	echo '<tr><td><center><h1>'.$artiste['LAST_NAME'].' '.$artiste['FIRST_NAME'].'</h1><h3>'.$artiste['PROF_ARTISTIQUE'].'</h3></center></td></tr>';
	echo '<tr><td><img  width=500 height=500 src="realisation/'.$id_artist.'/'.$image.'"/></td></tr>';
	if(!empty($achiev['LENGTH']) && !empty($achiev['WIDTH']))
	{
		echo '<tr><td><center><h3>'.$achiev['LENGTH'].'X'.$achiev['WIDTH'].'cm, // '.$achiev['TECHNIQUE'].'</h3></center></td></tr>';
	}
	else echo '<tr><td><center><h3>'.$achiev['TECHNIQUE'].'</h3></center></td></tr>';
	
	echo '<tr><td width=300 height=50> <div><h3>'.$achiev['DESCRIPTION1'].'</h3></div></td></tr>';
	
	
	echo '</table></center>';
 
 ?>