<?php
 
$user_id = $_GET['id'];
$token = $_GET['token'];

$req = $cnx->query("SELECT * FROM t_users WHERE ID_USER = $user_id");
$user = $req->fetch();
$date1 = date("Y-m-d");
//$date=datefr2en($date1);


if($user && $user['SALT']== $token ){

    $cnx->query("UPDATE t_users SET UPDATE_DATE ='$date1', token= null, STATUT_COMPTE= true WHERE ID_USER = $user_id");
    // $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $user;
	if($user['CATEGORY']="Particulier"){

            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
        else {
            echo "<script type='text/javascript'>document.location.replace('login.php');</script>";
        }

}