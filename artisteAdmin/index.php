<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 10/11/15
 * Time: 15:45
 */
 $page_title="Transfert d'argent vers l'Afrique et services mobiles associés";
 $page_description="Transfert d'argent moins cher vers le Burkina Faso";

/* Inclusion de l'entete */
require "Includes/header.php";
?>

<div id="corps">
    <div id="corps-main">

         <?php
         if(!empty($_SESSION['flash']['danger'])){
         ?>
             <div class="alert alert-danger">
         <?php
             echo $_SESSION['flash']['danger'];
             $_SESSION['flash']['danger'] ="";
         ?>
           </div>
         <?php }
         else{
             $_SESSION['flash']['danger'] ="";
         }
        if(!empty($_SESSION['flash']['success'])){

            ?>
            <div class="alert alert-success">
                <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION['flash']['success'];
                $_SESSION['flash']['success'] ="";
                ?>
            </div>
        <?php }
        else{
            $_SESSION['flash']['success'] ="";
        }
        ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li style="background: red" data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li style="background: red" data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="border-bottom:solid 1px;">
                <div class="item active">
                    <img src="/Projet_BFCash/BFCash/Ressources/img/slide1.png" alt="slide1">
                </div>

                <div class="item">
                    <img src="/Projet_BFCash/BFCash/Ressources/img/slide2.png" alt="slide2">
                </div>

            </div>

        </div>
        </p></br>
        <div class="col-lg-4">
            <img class="img-circle" src="/Projet_BFCash/BFCash/Ressources/img/icon-rapid.png" alt="icone2" width="140" height="140">
            <h2>Rapide</h2>
            <p>Envoi en quelques minutes votre argent vers l'Afrique.</br>Vous voulez rester en contact avec vos proches , plus d'inquiétudes.</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" src="/Projet_BFCash/BFCash/Ressources/img/icon-securise.png" alt="icone2" width="140" height="140">
            <h2>Sécurisé</h2>
            <p>Processus de paiement sécurisé</br>Nous vous assurons toute la sécurité dans vos transferts </p>

        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" src="/Projet_BFCash/BFCash/Ressources/img/icon-cout2.png" alt="icone3" width="140" height="140">
            <h2>Moins cher</h2>
            <p>Frais d'envoi à faible cout </br>Nous avons pensé à vous et reduisons considérablement vos frais d'envoie</p>

        </div><!-- /.col-lg-4 -->
    </div>
    <div id="corps-right">
        </p>
        <?php require("Includes/login.php");?>
    </div>
    <?php
  ?>

</div>

<?php
    /*Inclusion du pied de page*/
    include("Includes/footer.php");
?>

</body>
</html>
