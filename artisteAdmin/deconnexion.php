<?php

// inclure le fichier des fonctions
require('../Includes/functions.php');

session_start();
 
deconnecter();
echo "<script type='text/javascript'>document.location.replace('connexion.html');</script>";
 

