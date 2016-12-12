<?php
/**
 * User: pahima
 * Date: 25/09/16
 * Time: 14:00
 */

require('../Includes/db.php');
session_start();

 if(isset($_SESSION['id_user'])){
    //Selection de l'artiste
    $idUser=$_SESSION['id_user'];

    //Traitement de la modification
    if(!empty($_POST)) {   
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        $password = password_hash($_POST['mtpasse'], PASSWORD_BCRYPT); 

        // On modifie les informations dans la base de données
        $req = $cnx->prepare("UPDATE t_users set EMAIL=:emailArtist,PASSWORD=:passwordArtist where ID_USER=:idArtist");
        $req->execute([
            ':emailArtist' => $_POST['email'],
            ':passwordArtist' => $password,
            ':idArtist' => $idUser
        ]);
    }
 }else echo "<script type='text/javascript'>document.location.replace('connexion.html');</script>";

?>