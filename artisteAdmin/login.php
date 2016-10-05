<?php
session_start();
// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php');

if(!empty($_POST['login_mail']) && !empty($_POST['login_password'])){
    $req = $cnx->prepare('SELECT * FROM t_users WHERE EMAIL = :login_mail AND STATUT_COMPTE=1');
    $req->execute(['login_mail' => $_POST['login_mail']]);
    $user = $req->fetch();
        if(password_verify($_POST['login_password'], $user['PASSWORD'])){
        // Declarer ici les variables de sessions

            $_SESSION['id_user']= $user['ID_USER'];

            if($user['CATEGORY']="Professionel"){
                echo "<script type='text/javascript'>document.location.replace('index.html');</script>";
            }
            else {
                echo "<script type='text/javascript'>document.location.replace('login.html');</script>";
            }
        } 
        else{
                echo "<script type='text/javascript'>alert('Mot de passe ou nom utilisateur incorrect'); document.location.replace('connexion.html');</script>";
                 //echo '<script>alert("Mot de passe ou nom utilisateur incorrect");</script>';
             }

}