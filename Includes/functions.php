<?php
/**.
 * User: pahima
 * Date: 23/08/16
 * Time: 20:39
 * Contient les fonctions php necéssaires
 */

// Fonction pour debugger les erreurs
   function debug($var){
            echo '<pre>' . print_r($var,true) . '</pre>';
    }

//Fonction pour se reconnecter à partir des cookies (A adapter a notre architecture )
function reconnect_from_cookie(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
        require_once 'db.php';
        if(!isset($pdo)){
            global $pdo;
        }
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ratonlaveurs');
            if($expected == $remember_token){
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
    }
}

//Fonction de deconnexion de la session
function deconecter() {

    // Détruisez les variables de session
    $_SESSION = array();

    // Retournez les paramètres de session
    $params = session_get_cookie_params();
    // Effacez le cookie.
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    // Détruisez la session
    session_start();
    session_destroy();
}
//Verifier l'expiration de la session
function isLoginSessionExpired() {
    $login_session_duration = 60;
    $current_time = time();
    if(isset($_SESSION['loggedin_time']) and isset($_SESSION["nomUtilisateur"])){
        if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
            return true;
        }
    }
    return false;
}

function deleteSessionVars(){

    unset($_SESSION['frais']);
    unset($_SESSION['id_benef']);
    unset($_SESSION['ref']);
    unset($_SESSION['canal']);
    unset($_SESSION['nomBenef']);
    unset($_SESSION['prenomBenef']);
    unset($_SESSION['telBenef']);
    unset($_SESSION['mailBenef']);
    unset($_SESSION['typeBenef']);

    return null;
}

// Fonction pour generer le token pour l'envoi de mail et l'activation du compte

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

 
//Fonction pour uploader un fichier sur le serveur

/*$target_dir: chemin du dossier dans le projet, utiliser chemin relatif
$file_to_upload: attribut name du fichier dans html
$imgSize: taille maximale du fichier à uploader
*/

//Code de retour:
/*

0->File is not an image
1->Upload OK
2->Sorry, file is not selected.
3->Sorry, your file is too large
4->Sorry, only JPG, JPEG, PNG & GIF files are allowed.
5->Sorry, there was an error uploading your file.

*/
function uploadFileToServer($target_dir,$file_to_upload,$imgSize){

    //$target_dir = "images/";
    $target_file = $target_dir . basename($_FILES[$file_to_upload]["name"]);
    $uploadOk = 1;
    $errCod=1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file_to_upload]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
            $errCod=0;
            return $errCod;
        }
    }
    //Verifier si aucune image n'est selectionnée
    if(empty($_FILES[$file_to_upload]['name'])){
            //echo "File is not an image.";
            $uploadOk = 0;
            $errCod=2;
            return $errCod;
    }   
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
        return $target_dir.basename($_FILES[$file_to_upload]['name']);
    }
    // Check file size
    if ($_FILES[$file_to_upload]["size"] > $imgSize) {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
        $errCod=3;
    }
    // Allow certains file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG)" 
    && $imageFileType != "JPEG" && $imageFileType != "GIF" ){
        //return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        $errCod=4;
    }
    // if everything is ok, try to upload file
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES[$file_to_upload]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES[$file_to_upload]["name"]). " has been uploaded.";
           return $target_dir.basename($_FILES[$file_to_upload]['name']);
        } else {
            //echo "Sorry, there was an error uploading your file.";
            $errCod=5;
        }
    }
    return $errCod;  //retourner le code erreur en cas d'erreur

    
}
 
//Fonction deconnexion
function deconnecter() {

    // desctruction des variables de session
    $_SESSION = array();

    // Retournez les paramètres de session
    $params = session_get_cookie_params();
    // Effacez le cookie.
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    // Détruisez la session
    session_start();
    session_destroy();
}
 
 // fonction de creation de dossier pour chaque artiste pour l'upload de ses images
function createdossier ($dossier)
{
	if (!file_exists("realisation/$dossier"))
	{
		mkdir("realisation/$dossier", 0777);
		mkdir("realisation/$dossier/miniature", 0777);
		mkdir("realisation/$dossier/document", 0777);
	}
}

//Fonction d'upload des fichiers
function upload_image($index,$record,$maxsize,$extensions)
{
	//session_start();
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
   else 
   {	
   
		$temp =$_FILES[$index]['tmp_name'];
		$nom  =$_FILES[$index]['name'];
		$description =$_POST['description'];
		$createdate = $_POST['createdate'];
		$title = $_POST['title'];
		$longueur = $_POST['longueur'];
		$largeur = $_POST['largeur'];
		$hauteur = $_POST['hauteur'];
		$poids = $_POST['poids'];
		$technique = $_POST['technique'];
		$idUser=$idUser=$_SESSION['id_user'];
		//$usedata = $_GET['usedata'];
		$usedata="oui";
		$date = date('Y-m-d- H:i');
		
		//connexion et enregistrement des infos dans la BD
			$cnx = new PDO('mysql:host=localhost;dbname=zaidiart', 'root', 'root', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$pdoReq = $cnx->prepare("INSERT INTO `t_achievements` (ID_ARTIST, TITLE, IMAGE, IMAGE_THUMB,DESCRIPTION1,CREATE_DATE,UPDATE_DATE,
			`PATH`, `YEAR`, `CHARACTERISTICS`, `LENGTH`, `HEIGHT`, `WIDTH`, `TECHNIQUE`, `POIDS`, `CATEGORY`,`MEDIA`,`USE_DATA`)
			VALUES (:id_artist,:image_name,:image,:mini,:description,:create_date,:update_date,:path,:year,:carac,:length,:height,:width,:tech,:poids,:categ,:media,:usedata)");
			
			$pdoExec = $pdoReq->execute(array(":id_artist"=>$idUser,":image_name"=>$title,":image"=>$record,":mini"=>$record."miniature"."/",":description"=>$description,":create_date"=>$date,":update_date"=>$date,
											  ":path"=>$record,":year"=>$createdate,":carac"=>$nom,":length"=>$longueur,":height"=>$hauteur,"width"=>$largeur,":tech"=>$technique,
											  ":poids"=>$poids,":categ"=>"tableau",":media"=>"tableau",":usedata"=>$usedata));

			if (!$pdoExec)
			{
			$statut = "Enregistrement non effectué, veuillez recommencer ! <br/>";
			return $statut;
			}
			
			else
			{
				$last = $cnx->lastInsertId();
				$file_name = $last.'.'.$ext;
				if (move_uploaded_file($temp,$record.$file_name))				
		        {
					 // creation de l'image en fontion de l'extension
					if ($ext == "jpg" or $ext == "jpeg" ) $source = imagecreatefromjpeg($record.$file_name);
					else if ($ext == "png") $source = imagecreatefrompng($record.$file_name); 
					else if ($ext == "gif") $source = imagecreatefromgif($record.$file_name);
					$destination = imagecreatetruecolor(200, 150); // On crée la miniature vide

					// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
					$largeur_source = imagesx($source);
					$hauteur_source = imagesy($source);
					$largeur_destination = imagesx($destination);
					$hauteur_destination = imagesy($destination);

					// On crée la miniature
					imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

					// On enregistre la miniature sous le même nom dans le dossier miniature de l'artiste"
					imagejpeg($destination,$record."/"."miniature"."/".$file_name);	
						
					$statut = "Enregistrement effectué avec succès";
					return $statut;
				
				}
		
				else
				{
					$statut = "upload non effectué, veuillez recommencer ! <br/>";
					return $statut;
				}
		}
	  
   }
    

}

//Fonction d'upload des fichiers
function upload_files($doc,$save,$file_maxsize,$extension)

{
	
   //presence de document à uploader
    if (empty($_FILES[$doc]['tmp_name']))
	 {	$statut = "vide";
		 return $statut;}
   //fichier non uploadé correctement 
     if ($_FILES[$doc]['error'] > 0)
	 {	$statut = "Erreur lors du transfert de votre document";
		 return $statut;}
   //taille limite
     if ($_FILES[$doc]['size'] > $file_maxsize) 
		{	$statut = "Document trop volumineux, veuillez reduire sa taille ou choisissez un autre document ";
		 return $statut;}
   //verification de l'extension du fichier
     $ext = strtolower (substr(strrchr($_FILES[$doc]['name'],'.'),1));
     if (!in_array($ext,$extension)) 
		{	$statut = "Votre document doit être une image ou être de type pdf";
		 return $statut;}
   //Déplacement sur le serveur
		$temp =$_FILES[$doc]['tmp_name'];
		$nom  =$_FILES[$doc]['name'];
		move_uploaded_file($temp,$save.$nom);
		$statut="ok";
		return $statut; 

}


?>
 
