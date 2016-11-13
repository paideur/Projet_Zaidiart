<?php
/**
 * User: pahima
 * Date: 25/08/16
 * Time: 10:00
 */

require('../Includes/db.php');
session_start();

//Selection de l'artiste
$idUser=$_SESSION['id_user'];

//Traitement de la modification
if(!empty($_POST)) {
    
    //Creation de la date de naissance
    $jour=$_POST['dateNaissJour'];
    $mois=$_POST['dateNaissMois'];
    $annee=$_POST['dateNaissAnnee'];
    $dateNaiss = $annee.'-'.$mois.'-'.$jour;
    
    //echo $_POST['prenom'];
    // On modifie les informations dans la base de données
    $req = $cnx->prepare("UPDATE t_users set UPDATE_DATE=:updateDate,GENDER=:genderArtist, LAST_NAME=:nomArtist,FIRST_NAME=:prenomArtist,BORN_DATE=:dateNaissArtist,ADDRESS=:adressArtist,ZIP_CODE=:codePostalArtist,
        CITY=:villeArtist,TEL=:telArtist,LANGUAGE=:langueArtist,BLOG_NAME=:blogNameArtist,PROF_ARTISTIQUE=:profArtist,COUNTRY=:countryArtist where ID_USER=:idArtist");
    $req->execute([
        ':updateDate' => date('Y-m-d H:i:s'),
        ':genderArtist' => $_POST['gender'],
        ':nomArtist' => $_POST['nom'],
        ':prenomArtist' => $_POST['prenom'],
        ':dateNaissArtist' => $dateNaiss,
        ':adressArtist' => $_POST['adresse'],
        ':codePostalArtist' => $_POST['codePostal'],
        ':villeArtist' => $_POST['ville'],
        ':telArtist' => $_POST['tel'],
        ':langueArtist' => $_POST['langue'],
        ':blogNameArtist' => $_POST['blog_name'],
        ':profArtist' => $_POST['prof_artistique'],
        ':countryArtist' => $_POST['country'],
        ':idArtist' => $idUser
    ]);

}

?>