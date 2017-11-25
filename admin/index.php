<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 07/11/2017
 * Time: 11:33
 */

include_once('secure/connect.php');
include_once('secure/secure.php');

sec_session_start(); // Our custom secure way of starting a PHP session.
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $password = $_POST['password']; // The hashed password.

    if (login($email, $password, $mysqli) == true) {
        // Login success
        header("Location: index2.php");
        echo'on nest ici';
        exit();
    } else {
        // Login failed
        $reponse=1;
    }

}

/*$password='admin';



$pitt=openssl_random_pseudo_bytes(16);

$random_salt = hash('sha512', uniqid($pitt, TRUE));

// Create salted password
$password2 = hash('sha512', $password . $random_salt);

echo 'password : '.$password2.'salt : '.$random_salt;
*/
?>
<!DOCTYPE html>
<html lang="Fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Portail UNION AFRICAINE" content="">
    <meta name="Degny Stephane" content="">
    <title>Connexion | ONG MESSI</title>

    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="fonts/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/connexion.css" media="all">


    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<section class="modif_section_about_us">
    <div class="container">
        <div class="row text-justify">

            <div class=" col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 modif_block_connexion">

                <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-3 col-xs-5">
                    <img src="images/logo.png" class="img-responsive" alt="Logo STANE"/>
                    <br/>
                </div>

                <hr/>

                <br/>

                <div class="col-md-12">
                    <h2>Connectez-vous</h2>
                    <form class="col-md-offset-1 col-md-11 formulaire_connexion" id="formulaire_connexion" name="formulaire_connexion" action="index.php" method="post">

                        <p>
                            <input type="email" name="email" id="inputEmail" class="form-control modif_form_conect_email" placeholder="Email" required/>
                            <span id="email_connexion_erreur" class="erreur_message"></span>
                        </p>

                        <p>
                            <input type="password" name="password" id="inputPassword" class="form-control modif_form_conect_pw" placeholder="Mot de passe" required/>
                            <span id="mot_de_passe_connexion_erreur" class="erreur_message"></span>
                        </p>

                        <p class="text-center"><button class="btn btn-success modif_button_login" type="submit">Connexion</button></p>
                    </form><!-- /form -->
                </div>

                <p class="text-center">
                    <a href="#" class="forget_password">Mot de passe oublié ?</a>
                    <span class="sep_link_user"> | </span>
                    <a href="#" class="inscription">Inscription</a>
                </p>
            </div><!-- /col block connexion -->

        </div>
    </div>
</section><!--/#portfolio-item-->

<footer class="modif_footer">
    <div class="container modif_container_inner">

        <div class="row text-right">
            <div class="col-md-12">
                <p class="copyright"> &copy; 2017. ONG MESSI. Tous droits réservés</p>
            </div>
        </div>
    </div>
</footer><!--/#footer-->

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
