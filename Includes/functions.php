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

function uploadFileToServer($target_dir,$file_to_upload,$imgSize){

    //$target_dir = "images/";
    $target_file = $target_dir . basename($_FILES[$file_to_upload]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file_to_upload]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > $imgSize) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certains file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$file_to_upload]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES[$file_to_upload]["name"]). " has been uploaded.";
           return $target_dir.basename($_FILES[$file_to_upload]['name']);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    
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
 
