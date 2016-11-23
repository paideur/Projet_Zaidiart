<?php
/**
 * User: Fred
 * Date: 05/10/16
 */
 require('../Includes/db.php');
 require('../Includes/functions.php');
 session_start();
 
 if(isset($_SESSION['id_user'])){  
	 $id_artist = $_GET['idUser'];
	 $image = $_GET['id'];
	 $vue = $_GET['vue']+1;
		echo '<a href="printmini.php" class="list-group-item text-center"> <button class="btn btn-primary" type="button"> <font color ="0000ff">Precedent</font></button></a> <br/>'; 

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
		echo '<tr><td><center><h2>'.$achiev['TITLE'].', '.$achiev['YEAR'].'</h2></center></td></tr>';
		echo '<tr><td><center><h2>'.$artiste['LAST_NAME'].' '.$artiste['FIRST_NAME'].'</h2><h3>'.$artiste['PROF_ARTISTIQUE'].'</h3></center></td></tr>';
		echo '<tr><td><center><img  width=300 src="realisation/'.$id_artist.'/'.$image.'"/></center></td></tr>';
		if(!empty($achiev['LENGTH']) && !empty($achiev['WIDTH']))
		{
			echo '<tr><td><center><h3>'.$achiev['LENGTH'].'X'.$achiev['WIDTH'].'cm, // '.$achiev['TECHNIQUE'].'</h3></center></td></tr>';
		}
		else echo '<tr><td><center><h3>'.$achiev['TECHNIQUE'].'</h3></center></td></tr>';
		
		echo '<tr><td width=600 height=50> <div><h3>'.$achiev['DESCRIPTION1'].'</h3></div></td></tr>';
		
		
		echo '</table></center>';
	}
 else echo "<script type='text/javascript'>document.location.replace('connexion.html');</script>";
 ?>