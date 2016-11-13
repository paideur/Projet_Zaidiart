<?php
/**
 * User: pahima
 * Date: 30/09/16
 * Time: 14:00
 */

require('../Includes/db.php');
require('../Includes/functions.php');
session_start();

//Selection de l'artiste
$idUser=$_SESSION['id_user'];

//Traitement de l'enregistrement du fichier image
if(!empty($_POST)) {

	//Taille image: 25Mo
    $resultat=uploadFileToServer("images/","fileToUpload",25000000);
    if(is_string($resultat)){
    	// On enregistre le nouveau chemin du profil dans la base de données
	    $req = $cnx->prepare("UPDATE t_users set photo=:photoArtist where ID_USER=:idArtist");
	    $req->execute([
	        ':photoArtist' => $resultat,
	        ':idArtist' => $idUser
	    ]);
	    ?>
		 <script language="javascript">
				alert("Photo de profil mise à jour");
				window.location="editerprofil.html";				
		</script>
<?php 
	}else{
		if($resultat==0){
?>
		 <script language="javascript">
				alert("Le fichier n'est pas une image");
				window.location="editerprofil.html";				
		</script>
<?php 
		}else if($resultat==2){
?>
		 <script language="javascript">
				alert("Aucun fichier selectionné");
				window.location="editerprofil.html";				
		</script>
<?php 
		}else if($resultat==3){
?>
		 <script language="javascript">
				alert("Le fichier selectionné est trop grand(MAX:25Mo)");
				window.location="editerprofil.html";				
		</script>
<?php 
		}else if($resultat==4){
?>
		 <script language="javascript">
				alert("Format autorisé JPG, JPEG, PNG & GIF ");
				window.location="editerprofil.html";				
		</script>
<?php 
		}else if($resultat==5){
?>
		 <script language="javascript">
				alert("Il y'a eu une erreur lors de l'upload");
				window.location="editerprofil.html";				
		</script>
<?php 
		}
		

   }
   
    

}

?>