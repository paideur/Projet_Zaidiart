<?php
/**
 * User: Fred
 * Date: 05/10/16
 */
  session_start();
 
 require('../Includes/db.php');
 require('../Includes/functions.php');
//$idUser=$_POST['idArtist'];
$idUser=$_SESSION['id_user'];
createdossier($idUser);
// on déclare un tableau qui contiendra le nom des fichiers de nos miniatures
$tableau = array();
$dir = "realisation/$idUser/miniature/";
// on ouvre notre dossier contenant les miniatures
$dossier = opendir ($dir);
while ($fichier = readdir ($dossier)) {
	$allow_ext = array('png','gif','jpg','jpeg','pdf');
	$ext = strtolower (substr($fichier,-3));
	if (in_array($ext,$allow_ext)) {
	// on stocke le nom des fichiers des miniatures sans les extensions dans un tableau
	$tableau [] = substr($fichier,0,-4);
	$extension[] = $ext; 
	}
}

closedir ($dossier);

// on défini le nombre de colonne sur lesquelles vont s'afficher nos miniatures
$nbcol=3;
// on compte le nombre de miniatures
$nbpics = count($tableau);

// si on a au moins une miniature, on les affiche toutes
if ($nbpics != 0) {
	echo '<center><table>';
	for ($i=0; $i<$nbpics; $i++){
	if($i%$nbcol==0) echo '<tr>';

	
	$req=$cnx->prepare("Select TITLE,YEAR,VUE from `t_achievements` where ID_ACHIEV=:photo");
	$req->execute([':photo' => $tableau[$i]]);
	$title = $req->fetch();

	
	// pour chaque miniature, on affiche la miniature munie d'un lien vers la photo en taille réelle

echo '<td width=300 height=200>';
//echo			'<a href="realisation/'.$idUser.'/'.$tableau[$i].'">';
echo			'<a href="achievement.php?id='.$tableau[$i].'&idUser='.$idUser.'&vue='.$title['VUE'].'" >';
echo				'<img src="realisation/'.$idUser.'/miniature/'.$tableau[$i].'"/>';
echo '<table><tr><td width=20%><small>'.$title['VUE'].' vues: </small></td> <td width=80%><small>'.$title['TITLE'].' '.$title['YEAR'].'</small></td></tr></table>';
echo			'</a>';
echo '<a href="delete.php?id='.$tableau[$i].'&idUser='.$idUser.'&ext='.$extension[$i].'"> <font color = "ff3333">Suppprimer</font></a>';
echo	'</td>';
	if($i%$nbcol==($nbcol-1)) echo '</tr>';
	}
	echo '</table></center>';
}
// si on a aucune miniature, on affiche un petit message 
else echo '<center><h1> Aucune image à afficher</></center>';
?>