<?php
 
// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php');

$email = $_GET['email'];
$token = $_GET['token'];
$user_id = $_GET['id'];
 


$req = $cnx->query("SELECT * FROM t_users WHERE ID_USER = $user_id");
$user = $req->fetch();
 

$date1 = date("Y-m-d");
$tok=$user['SALT']; 
 
if($user && $user['SALT']== $token ){    
 

        $reqq = $cnx->prepare("UPDATE t_users SET UPDATE_DATE =:day, SALT=:token, STATUT_COMPTE=:statut WHERE ID_USER =:idUser");
        $reqq->execute([
            ':day'      => $date1 ,
            ':token'    => null,
            ':statut'   => true,
            ':idUser'   => $user_id 
        ]);

  echo "<script type='text/javascript'>alert('Mot de passe modifié');document.location.replace('index.html');</script>";
           

}
else{
	echo "<script type='text/javascript'>alert('Erreur de mise à jour de votre mot de passe. Veuillez vous recommenceR');document.location.replace('1Forget.html');</script>";
}
 