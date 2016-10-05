<?php
 
// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php');

$user_id = $_GET['id'];
$token = $_GET['token'];

$req = $cnx->query("SELECT * FROM t_users WHERE ID_USER = $user_id");
$user = $req->fetch();
$date1 = date("Y-m-d");
 
if($user && $user['SALT']== $token ){    

        $reqq = $cnx->prepare("UPDATE t_users SET UPDATE_DATE =:day, SALT=:token, STATUT_COMPTE=:statut WHERE ID_USER =:idUser");
        $reqq->execute([
            ':day'      => $date1 ,
            ':token'    => null,
            ':statut'   => true,
            ':idUser'   => $user_id 
        ]);

        	if($user['CATEGORY']=="Particulier"){

                    echo "<script type='text/javascript'>document.location.replace('index.html');</script>";
                }
            else 
            {
                    echo "<script type='text/javascript'>document.location.replace('inscription.html');</script>";
                }

}
else{
	echo "<script type='text/javascript'>alert('Erreur de confirmation de compte. Veuillez vous inscrire');document.location.replace('incription.php');</script>";
}
 