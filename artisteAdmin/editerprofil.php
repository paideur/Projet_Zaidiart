<?php
/**
 * User: pahima
 * Date: 25/08/16
 * Time: 10:00
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
    if (empty($_POST['nom']) ) {
        $errors['nom'] = "Veuillez entrer un nom correct";
        //echo "OK2";
    }
    if (empty($_POST['prenom'])) {
        $errors['prenom'] = "Veuillez entrer un prenom correct";
        //echo "OK3";
    }
    if (empty($_POST['adresse'])) {
        $errors['adresse'] = "Veuillez entrer une adresse correcte";
    }
    if (empty($_POST['codePostal'])) {
        $errors['codePostal'] = "Veuillez entrer un code postal correct";
    }
    if (empty($_POST['ville']) ) {
        $errors['ville'] = "Veuillez entrer une ville correcte";
    }
    if (empty($_POST['tel'])) {
        $errors['tel'] = "Veuillez entrer un numero de telephone correct";
    }
    
    if (empty($errors)) {
        //Creation de la date de naissance
        $jour=$_POST['dateNaissJour'];
        $mois=$_POST['dateNaissMois'];
        $annee=$_POST['dateNaissAnnee'];
        $dateNaiss = $annee.'-'.$mois.'-'.$jour;
        
        // On modifie les informations dans la base de données
        $req = $cnx->prepare("UPDATE t_users set GENDER=:genderArtist, LAST_NAME=:nomArtist,FIRST_NAME=:prenomArtist,BORN_DATE=:dateNaissArtist,ADDRESS=:adressArtist,ZIP_CODE=:codePostalArtist,
            CITY=:villeArtist,TEL=:telArtist,LANGUAGE=:langueArtist,BLOG_NAME=:blogNameArtist,PROF_ARTISTIQUE=:profArtist,COUNTRY=:countryArtist where ID_USER=:idArtist");
        $req->execute([
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

        // On redirige l'utilisateur vers la page index avec un message flash
        //$_SESSION['flash']['success'] = 'Informations modifiées avec succès';

        //echo "<script type='text/javascript'>document.location.replace('listerBeneficiaire.php');</script>";
        //exit();
    }
}

?>