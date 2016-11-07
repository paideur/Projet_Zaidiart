<?php
/**
 * User: pahima
 * Date: 23/08/16
 * Time: 20:39
 * Contient la variable globale de connexion à la BD ( à inclure dans les fichiers php utilisant cette variable)
 */

$cnx = new PDO('mysql:host=localhost;dbname=zaidiart', 'root', 'root', array(1002 => 'SET NAMES utf8')); //SET NAMES permet d'ouvrir la connexion à la BD sous l'encodage UTF8

?>
