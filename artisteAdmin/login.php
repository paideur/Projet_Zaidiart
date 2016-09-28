<?php
// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php');

if(!empty($_POST['login_mail']) && !empty($_POST['login_password'])){
    $req = $cnx->prepare('SELECT * FROM t_users WHERE EMAIL = :login_mail');
    $req->execute(['login_mail' => $_POST['login_mail']]);
    $user = $req->fetch();
        if(password_verify($_POST['login_password'], $user['PASSWORD'])){
            if($user['CATEGORY']="Professionel"){
                echo "<script type='text/javascript'>document.location.replace('index.html');</script>";
            }
            else {
                echo "<script type='text/javascript'>document.location.replace('login.html');</script>";
            }
        } 
        else{
                echo 'desolé';
                echo "<script type='text/javascript'>document.location.replace('login.html');</script>";
             }

}