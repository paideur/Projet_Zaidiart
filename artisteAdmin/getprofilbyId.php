<?php
/**
 * User: pahima
 * Date: 25/08/16
 * Time: 10:00
 */

require('../Includes/db.php');

//Selection de l'artiste
$idUser=$_POST['idArtist'];
//$idUser='32';
$req=$cnx->prepare("Select * from t_users where ID_USER=:idUser");
$req->execute([':idUser' => $idUser]);
$artiste= $req->fetch();

print json_encode($artiste);

return $artiste;
?>