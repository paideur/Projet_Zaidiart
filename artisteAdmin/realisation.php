<?php
/**
 * User: Fred
 * Date: 20/09/16
 */

//Selection de l'artiste
//$idUser=$_POST['idArtist'];
$idUser=15;
//print_r($idUser);

	createdossier($idUser);
	$upload_fichier = upload('image',"realisation/$idUser/",5000000, array('png','gif','jpg','jpeg') );
	echo $upload_fichier;

// fonction de creation de dossier pour chaque artiste pour l'upload de ses images
function createdossier ($dossier)
{
	if (!file_exists("realisation/$dossier"))
	{
		mkdir("realisation/$dossier", 0777);
		mkdir("realisation/$dossier/miniature", 0777);
	}
}

//Fonction d'upload des fichiers
function upload($index,$record,$maxsize,$extensions)

{
   //presence d'image à uploader
    if (empty($_FILES[$index]['tmp_name']))
	 {	$statut = "Veuillez selectionner une image";
		 return $statut;}
   //fichier non uploadé correctement 
     if ($_FILES[$index]['error'] > 0)
	 {	$statut = "Erreur lors du transfert";
		 return $statut;}
   //taille limite
     if ($_FILES[$index]['size'] > $maxsize) 
		{	$statut = "Fichier trop volumineux ";
		print_r($_FILES[$index]);
		 return $statut;}
   //verification de l'extension du fichier
     $ext = strtolower (substr(strrchr($_FILES[$index]['name'],'.'),1));
     if (!in_array($ext,$extensions)) 
		{	$statut = "Votre fichier n'est pas une image";
		 return $statut;}
   //Déplacement sur le serveur
   {	
   
		$temp =$_FILES[$index]['tmp_name'];
		$nom  =$_FILES[$index]['name'];
		$description =$_POST['description'];
		//$path = "/realisation";
		$length = 50;
		$date = date('Y-m-d- H:i');
		
		if (move_uploaded_file($temp,$record.$nom))
		{
			 // creation de l'image en fontion de l'extension
			if ($ext == "jpg" or $ext == "jpeg" ) $source = imagecreatefromjpeg($record.$nom);
			else if ($ext == "png") $source = imagecreatefrompng($record.$nom); 
			else if ($ext == "gif") $source = imagecreatefromgif($record.$nom);
			$destination = imagecreatetruecolor(200, 150); // On crée la miniature vide

			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);

			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

			// On enregistre la miniature sous le même nom dans le dossier miniature de l'artiste"
			imagejpeg($destination,$record."/"."miniature"."/".$nom);

			//connexion et enregistrement des infos dans la BD
			$cnx = new PDO('mysql:host=localhost;dbname=zaidiart', 'root', 'root', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$pdoReq = $cnx->prepare("INSERT INTO `t_achievements` (TITLE, IMAGE, IMAGE_THUMB,DESCRIPTION1,CREATE_DATE,UPDATE_DATE,
			`PATH`, `YEAR`, `CHARACTERISTICS`, `LENGTH`, `HEIGHT`, `WIDTH`, `TECHNIQUE`, `POIDS`, `CATEGORY`,`MEDIA`)
			VALUES (:image_name,:image,:mini,:description,:create_date,:update_date,:path,:year,:carac,:length,:height,:width,:tech,:poids,:categ,:media)");
			
			$pdoExec = $pdoReq->execute(array(":image_name"=>$nom,":image"=>$record,":mini"=>$record."miniature"."/",":description"=>$description,":create_date"=>$date,":update_date"=>$date,
											  ":path"=>$record,":year"=>"2016",":carac"=>$nom,":length"=>$length,":height"=>$length,"width"=>$length,":tech"=>"technique mixte",
											  ":poids"=>$length,":categ"=>"tableau",":media"=>"tableau"));

			if (!$pdoExec)
			{
			$statut = "Enregistrement non effectué, veuillez recommencer ! <br/>";
			return $statut;
			}
			else
			{
				$statut = "Enregistrement effectué avec succès";
				return $statut;
			}
		}
		else
		{
			$statut = "upload non effectué, veuillez recommencer ! <br/>";
			return $statut;
		}
	  
   }
    

}
	
?>