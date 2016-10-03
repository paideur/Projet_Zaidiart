<?php
/**
 * User: pahima
 * Date: 25/09/16
 * Time: 14:00
 */

require('../Includes/db.php');

//Selection de l'artiste
$idUser=$_POST['id'];
$req=$cnx->prepare("Select * from t_users where ID_USER=:idUser");
$req->execute([':idUser' => $idUser]);
$artiste= $req->fetch();

//Traitement de la modification
if(!empty($_POST)) {
    $errors = array();
    if (empty($_POST['email']) ) {
        $errors['email'] = "Veuillez entrer un email correct";
        //echo "OK2";
    }
    if (empty($_POST['mtpasse'])) {
        $errors['mtpasse'] = "Veuillez entrer un mot de passe correct";
        //echo "OK3";
    }
    
    if (empty($errors)) {
        // On modifie les informations dans la base de données
        $req = $cnx->prepare("UPDATE t_users set EMAIL=:emailArtist,PASSWORD=:passwordArtist where ID_USER=:idArtist");
        $req->execute([
            ':emailArtist' => $_POST['email'],
            ':passwordArtist' => $_POST['mtpasse'],
            ':idArtist' => $idUser
        ]);

        // On redirige l'utilisateur vers la page index avec un message flash
        //$_SESSION['flash']['success'] = 'Informations modifiées avec succès';

        //echo "<script type='text/javascript'>document.location.replace('listerBeneficiaire.php');</script>";
        //exit();
    }
}

?>