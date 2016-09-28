<?php
/**.
 * User: pahima
 * Date: 23/08/16
 * Time: 20:39
 * Contient les fonctions php necéssaires
 */

// Fonction pour debugger les erreurs
   function debug($var){
            echo '<pre>' . print_r($var,true) . '</pre>';
    }

//Fonction pour se reconnecter à partir des cookies (A adapter a notre architecture )
function reconnect_from_cookie(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
        require_once 'db.php';
        if(!isset($pdo)){
            global $pdo;
        }
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ratonlaveurs');
            if($expected == $remember_token){
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
    }
}

//Fonction de deconnexion de la session
function deconecter() {

    // Détruisez les variables de session
    $_SESSION = array();

    // Retournez les paramètres de session
    $params = session_get_cookie_params();
    // Effacez le cookie.
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    // Détruisez la session
    session_start();
    session_destroy();
}
//Verifier l'expiration de la session
function isLoginSessionExpired() {
    $login_session_duration = 60;
    $current_time = time();
    if(isset($_SESSION['loggedin_time']) and isset($_SESSION["nomUtilisateur"])){
        if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
            return true;
        }
    }
    return false;
}

function deleteSessionVars(){

    unset($_SESSION['frais']);
    unset($_SESSION['id_benef']);
    unset($_SESSION['ref']);
    unset($_SESSION['canal']);
    unset($_SESSION['nomBenef']);
    unset($_SESSION['prenomBenef']);
    unset($_SESSION['telBenef']);
    unset($_SESSION['mailBenef']);
    unset($_SESSION['typeBenef']);

    return null;
}

// Fonction pour generer le token pour l'envoi de mail et l'activation du compte

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
