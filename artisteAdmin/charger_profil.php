<?php
/**
 * User: pahima
 * Date: 30/09/16
 * Time: 14:00
 */

require('../Includes/db.php');
require('../Includes/functions.php');

//Selection de l'artiste
//$idUser=$_POST['id'];
$idUser='32';
$req=$cnx->prepare("Select * from t_users where ID_USER=:idUser");
$req->execute([':idUser' => $idUser]);
$artiste= $req->fetch();

//Traitement de l'enregistrement du fichier image
if(!empty($_POST)) {

    $photo=uploadFileToServer("images/","fileToUpload",5000000);
   
    // On enregistre le nouveau chemin du profil dans la base de données
    $req = $cnx->prepare("UPDATE t_users set photo=:photoArtist where ID_USER=:idArtist");
    $req->execute([
        ':photoArtist' => $photo,
        ':idArtist' => $idUser
    ]);

    header('Location: editerprofil.html');
    exit;

}

?>