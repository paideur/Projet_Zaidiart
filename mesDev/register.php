<?php
$page_title="Page d'inscription";
$page_description="Page permettant d'inscrire un nouvel utilisateur";

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

        <h1 align="center">Inscription</h1>

        <form class="form-horizontal" role="form" action="" method="post">

            <div class="form-group">
                <label class="control-label col-sm-3" for="civilite">&nbsp;&nbsp;Civilité:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="civilite">
                        <option value="">Choisir votre civilité</option>
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">&nbsp;&nbsp;Nom:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" placeholder="Veuillez Entrer votre nom">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="prenom">&nbsp;&nbsp;Prénom:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" placeholder="Veuillez Entrer votre prénom">
                </div>
            </div>
 
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">&nbsp;&nbsp;Adresse email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" placeholder="Veuillez Entrer votre adresse email">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="passwd">&nbsp;&nbsp;Mot de passe:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="passwd" placeholder="Veuillez Entrer votre mot de passe">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="confrm_passwd">&nbsp;&nbsp;Confirmer mot de passe:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="confrm_passwd" placeholder="Confirmer votre mot de passe">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">&nbsp;&nbsp;Adresse:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse" placeholder="Veuillez Entrer votre adresse ">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="civilite">&nbsp;&nbsp;Pays:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="pays">
                        <option value="">Choisissez votre pays</option>
                        <option value="Barbade">Barbade </option>
                        <option value="Bahrein">Bahrein </option>
                        <option value="Belgique">Belgique </option>
                        <option value="Belize">Belize </option>
                        <option value="Benin">Benin </option>
                        <option value="Bermudes">Bermudes </option>
                        <option value="Bielorussie">Bielorussie </option>
                        <option value="Bolivie">Bolivie </option>
                        <option value="Botswana">Botswana </option>
                        <option value="Bhoutan">Bhoutan </option>
                        <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                        <option value="Bresil">Bresil </option>
                        <option value="Brunei">Brunei </option>
                        <option value="Bulgarie">Bulgarie </option>
                        <option value="Burkina_Faso">Burkina_Faso </option>
                        <option value="Burundi">Burundi </option>
                        <option value="Caiman">Caiman </option>
                        <option value="Cambodge">Cambodge </option>
                        <option value="Cameroun">Cameroun </option>
                        <option value="Canada">Canada </option>
                        <option value="Canaries">Canaries </option>
                        <option value="Cap_vert">Cap_Vert </option>
                        <option value="Chili">Chili </option>
                        <option value="Chine">Chine </option>
                        <option value="Chypre">Chypre </option>
                        <option value="Colombie">Colombie </option>
                        <option value="Comores">Colombie </option>
                        <option value="Congo">Congo </option>
                        <option value="Congo_democratique">Congo_democratique </option>
                        <option value="Cook">Cook </option>
                        <option value="Coree_du_Nord">Coree_du_Nord </option>
                        <option value="Coree_du_Sud">Coree_du_Sud </option>
                        <option value="Costa_Rica">Costa_Rica </option>
                        <option value="Cote_d_Ivoire">CÃ´te_d_Ivoire </option>
                        <option value="Croatie">Croatie </option>
                        <option value="Cuba">Cuba </option>
                        <option value="Danemark">Danemark </option>
                        <option value="Djibouti">Djibouti </option>
                        <option value="Dominique">Dominique </option>
                        <option value="Egypte">Egypte </option>
                        <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                        <option value="Equateur">Equateur </option>
                        <option value="Erythree">Erythree </option>
                        <option value="Espagne">Espagne </option>
                        <option value="Estonie">Estonie </option>
                        <option value="Etats_Unis">Etats_Unis </option>
                        <option value="Ethiopie">Ethiopie </option>
                        <option value="Falkland">Falkland </option>
                        <option value="Feroe">Feroe </option>
                        <option value="Fidji">Fidji </option>
                        <option value="Finlande">Finlande </option>
                        <option value="France">France </option>
                        <option value="Gabon">Gabon </option>
                        <option value="Gambie">Gambie </option>
                        <option value="Georgie">Georgie </option>
                        <option value="Ghana">Ghana </option>
                        <option value="Gibraltar">Gibraltar </option>
                        <option value="Grece">Grece </option>
                        <option value="Grenade">Grenade </option>
                        <option value="Groenland">Groenland </option>
                        <option value="Guadeloupe">Guadeloupe </option>
                        <option value="Guam">Guam </option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernesey">Guernesey </option>
                        <option value="Guinee">Guinee </option>
                        <option value="Jan Mayen">Jan Mayen </option>
                        <option value="Japon">Japon </option>
                        <option value="Jersey">Jersey </option>
                        <option value="Jordanie">Jordanie </option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">&nbsp;&nbsp;Ville:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ville" placeholder="Veuillez Entrer votre ville de résidence">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">&nbsp;&nbsp;Code postal:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="codepostal" placeholder="Veuillez Entrer votre code postale">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">&nbsp;&nbsp;Photo:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="telephone" placeholder="Veuillez Entrer votre numero de telephone ">
                </div>
            </div>
 

            <div class="form-group">
                <div class="col-ms-3">
                    <button type="submit" class="btn btn-success center-block">S'inscrire</button>
                </div>
            </div>
        </form>


    </div>

<?php 


