<?php
if(!empty($_POST)){
    $errors=array();

    if(empty($_POST['civilite'])){

        $errors['civilite']="Veuillez choisir votre civilité";

    }
    if(empty($_POST['nom'])|| !preg_match('/^[a-zA-Z-9_]+$/',$_POST['nom'])){

        $errors['nom']="Veuillez entrer un nom correct";
    }
    if(empty($_POST['prenom'])|| !preg_match('/^[a-zA-Z-9_]+$/',$_POST['nom'])){
        $errors['prenom']="Veuillez entrer un prenom correct";
    }
    if(empty($_POST['dateNaiss'])){

        $errors['dateNaiss']="Veuillez entrer une date de naissance correct";

    }

    if(empty($_POST['adresse'])){

        $errors['adresse']="Veuillez entrer une adresse correcte";

    }

    if(empty($_POST['ville'])){

        $errors['ville']="Veuillez entrer une ville correcte";

    }
    if(empty($_POST['codepostal'])){

        $errors['codepostal']="Veuillez entrer un codepostal correct";

    }
    if(empty($_POST['pays'])){

        $errors['pays']="Veuillez entrer un pays correct";

    }
    if(empty($_POST['telephone'])){
        $errors['telephone']="Veuillez entrer un numero de telephone correct";

    }else{
        $req=$cnx->prepare('SELECT idUser FROM utilisateurs WHERE telephoneUser = ?');
        $req->execute([$_POST['telephone']]);
        $user= $req->fetch();
        if($user){
            $errors['telephone']= 'Ce numéro de téléphone est dejà utilisé pour un autre compte';
        }

    }
    if(empty($_POST['profession'])){

        $errors['profession']="Veuillez entrer une profession correcte";

    }

    if(empty($_POST['email'])|| !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){

        $errors['email']=" Veuillez entrer un email valide";

    }else{
        $req=$cnx->prepare('SELECT idUser FROM utilisateurs WHERE adresseMailUser = ?');
        $req->execute([$_POST['email']]);
        $user= $req->fetch();
        if($user){
            $errors['email']= 'Cette adresse email est dejà utilisée pour un autre compte';
        }

    }

    if(empty($_POST['passwd'])|| $_POST['passwd'] != $_POST['confrm_passwd']){

        $errors['passwd']="Veuillez entrer un mot de passe valide";

    }

    if(empty($errors)){

        // On enregistre les informations dans la base de données
        $req = $cnx->prepare("INSERT INTO utilisateurs (civiliteUser,nomUser,prenomUser,dateNaissUser,adresseMailUser,passwdUser,adresseUser,villeUser,codePostalUser,paysUser,telephoneUser,professionUser,statutCompte,recevoirNotif,typeUser,token,confirm_date) values (:civiliteUser,:nomUser,:prenomUser,:dateNaissUser,:adresseMailUser,:passwdUser,:adresseUser,:villeUser,:codePostalUser,:paysUser,:telephoneUser,:professionUser,:statutCompte,:recevoirNotif,:typeUser,:token,:confirm_date)");
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        $password = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
        // On génère le token qui servira à la validation du compte
        $token = str_random(60);

        $req->execute([
            ':civiliteUser'    => $_POST['civilite'],
            ':nomUser'         => $_POST['nom'],
            ':prenomUser'      => $_POST['prenom'],
            ':dateNaissUser'   => $_POST['dateNaiss'],
            ':adresseMailUser' => $_POST['email'],
            ':passwdUser'      => $password,
            ':adresseUser'     => $_POST['adresse'],
            ':villeUser'       => $_POST['ville'],
            ':codePostalUser'  => $_POST['codepostal'],
            ':paysUser'        => $_POST['pays'],
            ':telephoneUser'   => $_POST['telephone'],
            ':professionUser'  => $_POST['profession'],
            ':statutCompte'    => 0,
            ':recevoirNotif'   => $_POST['recevoirNotif'],
            ':typeUser'        => 'Internaute',
            ':token'           => $token,
            ':confirm_date'    => null

        ]);

        $user_id = $cnx->lastInsertId();
        // On envoit l'email de confirmation
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_BFCash/BFCash/confirm_compte.php?id=$user_id&token=$token");
        // On redirige l'utilisateur vers la page index avec un message flash
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';

        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

        exit();
    }

}

?>
    <script>
        $(function() {
            $( "#dateNaiss").datepicker();
        });
    </script>


    <div id="inscription">
        <?php
        // Affichage des erreurs
        if(!empty($errors)):?>
            <div class="alert alert-danger">
                <p> Vous n'avez pas bien rempli le formulaire</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>





<!DOCTYPE html>
<html lang="en" 


class="js websockets placeholder indexeddb indexeddb-deletedatabase draganddrop gr__deezer_com" xml:lang="fr" xmlns:fb="http://www.facebook.com/2008/fbml">



<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="content-language" content="en">
	<meta property="fb:app_id" content="241284008322">
	
<title>ZaidiArt - Marché de l'art</title>

	<!--[if gte IE 9]> Link CSS Liés au site zaidiart.com. -->

<link href="./css/bootstrap-zaidiconnins.css" rel="stylesheet" type="text/css">
<link href="./css/zaidiconnins1.css" rel="stylesheet" type="text/css">
<link href="./css/zaidiconnins2.css" rel="stylesheet" type="text/css">


<!-- a font from the Adobe Edge Web Fonts server for use within the web page.-->

<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/open-sans:n3:default.js" type="text/javascript"></script>


<!-- Partie HEADER -->

</head>
<body background="img/1Vies by boltabaieva.jpg" class="dir-ltr" data-gr-c-s-loaded="true" data-pinterest-extension-installed="cr1.39.1">

	<div class="page-login" id="page_index">
		<header class="index-header" id="index-header">
		<div class="index-container">
			<span class="index-header-logo logo logo-zaidiart-hp"></span>
			<div class="index-header-actions index-header-discover pull-left hidden-phone hidden-tablet">
				<a class="btn btn-shadow" href="http://www.zaidiart.com">
					<span class="label">Découvrir Art Directory by ZaidiArt</span>
				</a>
			</div>
		  <div class="index-header-actions hidden-phone">
										<button class="btn btn-shadow" id="signup_button">Connexion</button>
		  </div>
		</div>
	</header>
	
	<!-- Fin Partie HEADER -->
	
		<!-- Debut Section Inscription -->
	
	<section class="index-body">
		<div class="index-container">
			<div class="index-headings">
						<h1 class="heading-1">Boostez votre visibilité internationale, <br class="visible-phone">Inscrivez vous gratuitement</h1>
		<h2 class="heading-2">
			Annuaire de référence des artistes (arts visuels : peintures, sculptures, dessins, arts numériques, streets arts...)<br class="hidden-phone">
			Inscrivez-vous gratuitement.		</h2>
			</div>
			<div class="index-form " id="index_form">
				<div class="index-social clearfix" id="social_form">
	<div class="index-social-col">
		<button id="home_account_fb" class="btn btn-facebook btn-block evt-click" type="button" data-login-redirect="{&quot;type&quot;:&quot;refresh&quot;,&quot;link&quot;:&quot;\/&quot;}" data-tracking="1" data-tracking-tag="unlogged_home_click" data-tracking-params="{&#39;type&#39;: &#39;facebook&#39;}">
			<span class="label">Facebook</span>
		</button>
	</div>
	<div class="index-social-col">
		<button id="home_account_gp" class="btn btn-googleplus btn-block evt-click" type="button" data-redirect="{&quot;type&quot;:&quot;refresh&quot;,&quot;link&quot;:&quot;\/&quot;}" data-tracking="1" data-tracking-tag="unlogged_home_click" data-tracking-params="{&#39;type&#39;: &#39;google&#39;}" data-gapiattached="true">
			<span class="label">Google+</span>
		</button>
	</div>
</div

	<!-- 1.3) S'inscrire avec ArtCall -->
	
<div id="register_form">
	<form data-type="form-page">
		<div class="index-form-groups clearfix">
			<div class="form-group">
				<input id="register_form_username_input" class="form-control" placeholder="Nom" type="text" data-check="blogname" value="">
			</div>
			<div class="form-group">
				<input id="register_form_username_input" class="form-control" placeholder="Prénom" type="text" data-check="blogname" value="">
			</div>
			<div class="form-group">
				<input id="register_form_username_input" class="form-control" placeholder="Nom artistique/Utilisateur" type="text" data-check="blogname" value="">
			</div>
			<div class="form-group">
				<input id="register_form_mail_input" class="form-control" placeholder="Adresse email" type="text" data-check="emailuniq">
			</div>
			<div class="form-group">
				<input id="register_form_password_input" class="form-control" placeholder="Mot de passe (8 caractères minimum)" type="password" data-check="password">
			</div>
			<div class="form-group">
				<input id="register_form_password_input" class="form-control" placeholder="Confirmez votre mot de passe" type="password" data-check="password">
			</div>
			<div class="form-group">
				<div class="index-form-select">
					<span class="icon icon-chevron-down"></span>
					<span class="form-control">Sexe</span>					<select id="register_form_gender_input" data-check="gender" data-class-error="is-inverse" data-insert-value="true">
						<option value="0">Sexe</option>
						<option value="F">
							Femme						</option>
						<option value="M">
							Homme						</option>
					</select>
				</div>
			</div>
		</div>
		<div class="index-form-error" id="register_form_global_error" style="display: none;">Merci de vérifier tous les champs.</div>
				<div class="index-form-submit">
			<button name="register_form_submit" type="submit" class="btn btn-primary btn-large btn-block" id="register_form_submit">
				<span class="label">Inscription</span>
			</button>
		</div>
		<div class="index-form-legal">
			En cliquant sur "Inscription", vous acceptez les <a class="evt-click" href="http://http://www.zaidiart.com/mentions-l%C3%A9gales.html">Conditions générales d'utilisation</a>.		</div>
			
				<div class="visible-phone">
			<a class="btn btn-shadow btn-large btn-block evt-click" href="http://www.zaidiart.com/login" id="register_form_login_button" data-login="1">
				<span class="label">Connexion</span>
			</a>
		</div>
	</form>
</div>

			</div>
			<div class="index-form-confirm hidden" id="index_confirm">
							</div>
		</div>
	</section>
	    <!-- Menu footer -->
	    
<footer class="index-footer">
						
<div class="index-container">
<div class="visible-phone">
</div>
<div class="index-navbar">
<div class="index-navbar-links">

 <a class="evt-click" href="http://www.zaidiart.com/">
© 2016 ZAIDIART, Tous droits réservés
</a>
									
										<a class="evt-click" href="http://http://www.zaidiart.com/zaidi-art.html/">
						ZaidiArt					</a>
						
						
					<a class="evt-click" href="http://http://www.zaidiart.com/mentions-l%C3%A9gales.html">
						Mentions légales					</a>
						
					<a class="evt-click" href="http://http://www.zaidiart.com/blog.html">
						Blog					</a>
					
					<a class="evt-click" href="http://http://www.zaidiart.com/contact.html">
						  Contact					</a>
										
											<a class="evt-click" href="#">
							Conditions générales d'utilisation						</a>
							
						
</div>
				
				
				<div class="index-navbar-lang">
					<span class="lang-label">Français</span>
					<span class="lang-carret icon icon-chevron-down"></span>
					<select class="lang-select" id="language_select">
																					<option value="en">
									English								</option>
																												<option value="us">
									English (us)								</option>
																												<option value="ar">
									Arabe								</option>
																										                                                                            																											<option value="de">
									Deutsch								</option>
																												<option value="es">
									Español								</option>
																												
																												<option value="fr" selected="selected">
									Français								</option>

																		</select>
				</div>
			</div>
		</div>
		
	</footer>
	
	
	
</div>






</body>

</html>
