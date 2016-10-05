<?php

// inclure le fichier de connexion à la bd
require('../Includes/db.php');

// inclure le fichier des fonctions
require('../Includes/functions.php');
 
// Vérification des erreurs lors du remplissage du formulaire

 if(!empty($_POST)){

    $errors=array();

    if(empty($_POST['register_form_name_input'])|| !preg_match('/^[a-zA-Z-9_]+$/',$_POST['register_form_name_input'])){
        $errors['register_form_name_input']="Veuillez entrer un nom correct";
    }
   /* if(empty($_POST['register_form_firstname_input'])|| !preg_match('/^[a-zA-Z-9_]+$/',$_POST['register_form_username_input'])){
        $errors['register_form_firstname_input']="Veuillez entrer un prenom correct";
    }
   if(empty($_POST['register_form_username_input'])|| !preg_match('/^[a-zA-Z-9_]+$/',$_POST['register_form_username_input'])){
        $errors['register_form_username_input']="Veuillez entrer un nom d'artiste correct";
    }
    if(empty($_POST['register_form_gender_input'])){
        $errors['register_form_gender_input']="Veuillez choisir votre genre";
    }*/
    if(empty($_POST['register_form_categorie_input'])){
        $errors['register_form_categorie_input']="Veuillez choisir un type";
    }
    if(empty($_POST['register_form_mail_input'])|| !filter_var($_POST["register_form_mail_input"],FILTER_VALIDATE_EMAIL)){

        $errors['register_form_mail_input']=" Veuillez entrer un email valide";

    }else{
        $req=$cnx->prepare('SELECT ID_USER FROM t_users WHERE email = ?');
        $req->execute([$_POST['register_form_mail_input']]);
        $user= $req->fetch();
        if($user){
            $errors['email']= 'Cette adresse email est dejà utilisée pour un autre compte';
        }

    }

    if(empty($_POST['register_form_password_input'])){

        $errors['passwd']="Veuillez entrer un mot de passe valide";

    }
      if($_POST['register_form_password_input'] != $_POST['register_form_confirmpassword_input']){
        $errors['confirmpasswd']="Veuillez entrer un meme mot de passe";
      
    }
 
    if(empty($errors)){
       

        // On enregistre les informations dans la base de données
        $req = $cnx->prepare("INSERT INTO t_users (email,password,salt,create_date,update_date,last_name,blog_name,prof_artistique,first_name,category,language,tel,genre,gender,born_date,address,zip_code,city,country,photo,photo_thumb,statut_compte,artiste_name) 
                                        values (:email,:password,:salt,:create_date,:update_date,:last_name,:blog_name,:prof_artistique,:first_name,:category,:language,:tel,:genre,:gender,:born_date,:address,:zip_code,:city,:country,:photo,:photo_thumb,:statut_compte,:artiste_name)");
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        $password = password_hash($_POST['register_form_password_input'], PASSWORD_BCRYPT);
        //$password = password_hash('azerty', PASSWORD_BCRYPT);
        // On génère le token qui servira à la validation du compte
        $token = str_random(60);
        $req->execute([
 
            ':email'        => $_POST['register_form_mail_input'],
            ':password'     => $password,
            ':salt'         => $token,
            ':create_date'  => date('Y-m-d H:i:s'),
            ':update_date'  => null,
            ':last_name'    => $_POST['register_form_name_input'],
            ':blog_name'    => null,
            ':prof_artistique' => null,
            ':first_name'   => $_POST['register_form_firstname_input'],
            ':category'     => $_POST['register_form_categorie_input'],
            ':language'     => null,
            ':tel'          => null,
            ':genre'        => null,
            ':gender'       => $_POST['register_form_gender_input'],
            ':born_date'    => null,
            ':address'      => null,
            ':zip_code'     => null,
            ':city'         => null,
            ':country'      => null,
            ':photo'        => null,
            ':photo_thumb'  => null,
            ':statut_compte' => 0,
            ':artiste_name' => $_POST['register_form_username_input']
        ]);
        $user_id = $cnx->lastInsertId();
        // On envoit l'email de confirmation
        mail($_POST['register_form_mail_input'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_Zaidiart/artisteAdmin/confirm_compte.php?id=$user_id&token=$token");
          
       if($_POST['register_form_categorie_input']="Particulier"){

            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
        else {
            echo "<script type='text/javascript'>document.location.replace('login.php');</script>";
        }

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
            echo "<script type='text/javascript'>document.location.replace('inscription.html');</script>";
        }  
    }

}

