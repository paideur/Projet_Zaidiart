<?php

// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php'); 
require('../Includes/PHPMailer_v5.1/class.phpmailer.php');
require('../Includes/PHPMailer_v5.1/class.smtp.php');
 
// Vérification des erreurs lors du remplissage du formulaire
  
 if(!empty($_POST)){

    $errors=array();
 
    if(empty($_POST['login_email'])|| !filter_var($_POST["login_email"],FILTER_VALIDATE_EMAIL)){

        $errors['login_email']=" Veuillez entrer un email valide";

    }else{
        $req=$cnx->prepare('SELECT ID_USER FROM t_users WHERE email = ?');
        $req->execute([$_POST['login_email']]);
        $user= $req->fetch();
        $idU=$user['ID_USER'];
        
        if(!$user){
            $errors['email']= 'Cette adresse email inexistante';
        }

    }


    if(strlen($_POST['login_password']) < 8){

        $errors['lgpwd']="Longueur du mot de passe incorrecte";

    }

    if(empty($_POST['login_password'])){

        $errors['passwd']="Veuillez entrer un mot de passe valide";

    }
      if($_POST['login_password'] != $_POST['login_confirm_password']){
        $errors['confirmpasswd']="Veuillez entrer un meme mot de passe";
      
    }
 
    if(empty($errors)){
     
        $password = password_hash($_POST['login_password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $date1=date('Y-m-d H:i:s');
  
        $reqq = $cnx->prepare("UPDATE t_users SET PASSWORD =:pwd , UPDATE_DATE =:day, SALT=:token, STATUT_COMPTE=:statut WHERE ID_USER =:idUser");
        $reqq->execute([
            ':pwd'      => $password,
            ':day'      => $date1 ,
            ':token'    => $token,
            ':statut'   => false,
            ':idUser'   => $idU 
        ]);

         $email=$_POST['login_email'];
        // On envoit l'email de confirmation
        //mail($_POST['login_email'], 'Confirmation nouveau mot de passe ', "Afin de valider votre mot de passe  merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_Zaidiart/artisteAdmin/confirm_password.php?email=$email&token=$token&id=$idU");
      
     $adresse=$_POST["login_email"];
     $mail = new PHPmailer();
     $mail->IsSMTP(); 
     $mail->SetLanguage("en", "../phpmailer/language/");
     
     $mail->SMTPAuth   = true;                  // enable SMTP authentication
     $mail->SMTPSecure = "ssl"; 
     
    /* $mail->Host='smtp.gmail.com';
     $mail->Port = 465;
     $mail->Username   = "zaidiartinternational@gmail.com";  // GMAIL username
     $mail->Password   = "Zaidiart1234";            // GMAIL password
     $mail->From= 'zaidiartinternational@gmail.com'; */

     $reqMail=$cnx->prepare('SELECT * FROM t_config_mail WHERE id = ?');
     $reqMail->execute([1]);
     $configMail= $reqMail->fetch();

     $mail->Host=$configMail['HOST'];
     $mail->Port = $configMail['PORT'];
     $mail->Username   = $configMail['USERNAME'];  // GMAIL username
     $mail->Password   = $configMail['PASSWORD'];            // GMAIL password
     $mail->From=  $configMail['FROM']; 


     //$mail ->IsMail();

     $mail->FromName= 'ZAIDIART' ;
     $mail->AddAddress ($adresse);
     $mail->AddReplyTo('zaidiartinternational@gmail.com');   
     $mail->Subject= 'Mail de modification de votre mot de passe'; 
     $mail->Body= "Afin de valider votre modification merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_Zaidiart/artisteAdmin/confirm_password.php?email=$email&token=$token&id=$idU";
       
    if(!$mail->Send()){ //Teste le return code de la fonction
      echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
      echo "<script type='text/javascript'>alert('ErrorInfo : ''".$mail->ErrorInfo."');document.location.replace('../accueil/index.html');</script>";
  
    }
    else{     
                
       echo "<script type='text/javascript'>alert('Un email de confirmation vous a été envoyé');document.location.replace('../accueil/index.html');</script>";
  
    }

    $mail->SmtpClose();
    unset($mail);
    exit(); 

 
    }
    else
    {
        // Affichage des erreurs

        if(!empty($errors)){
             foreach($errors as $error){
                echo '<script>alert("Formulaire incorrect \n \n '. $error .'");</script>';
               
             }
             $errors=array();
            echo "<script type='text/javascript'>document.location.replace('1Forget.html');</script>";
        }  
    }

}

