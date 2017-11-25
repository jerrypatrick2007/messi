<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 07/11/2017
 * Time: 12:01
 */

include_once('secure/connect.php');
include_once('secure/secure.php');

sec_session_start();

$roles = $_SESSION['roles'];
$id_users = $_SESSION['id_users'];

$affiche_users = $mysqli->prepare("SELECT civilite,name,name2 FROM users WHERE uid=?");
/* bind parameters for markers */
$affiche_users->bind_param("i", $id_users);
/* execute query */
$affiche_users->execute();
/* bind result variables */
$affiche_users->bind_result($civilite,$nom,$prenom);
/* fetch value */
$affiche_users->fetch();
/* close statement */
$affiche_users->close();



if (login_check($mysqli) == true) :
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <meta name="viewport" content="max-width=1024"/>
        <meta name="viewport" content="max-width=600"/>

        <title>ADMINISTRATION ONG MESSI</title>

        <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="css/mystyle_n1.css"/>

        <link href="fonts/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- <link rel="SHORTCUT ICON" href="images/logo_favicon.png" /> -->

        <style type="text/css">a:link{text-decoration:none}</style>

        <!--<style>
          body { background:url(images/bg_fixed1.jpg) no-repeat center fixed;}
        </style>-->
        <script
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="js/ckeditor/samples/sample.css">
    </head>

    <body>
    <div id="wrapper"><!--debut wrapper-->

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">

                <li class="sidebar-brand">
                    Menu de gestion
                </li>

                <br/>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Structure<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index2.php?action=content_types">Types de contenu</a></li>
                        <li><a href="index2.php?action=content_types_structure">Types de contenu structure</a></li>
                        <li><a href="index2.php?action=content">Contenu</a></li>
                        <li><a href="index2.php?action=menu_front">Menu</a></li>
                        <li><a href="#">Mediathèque</a></li>
                     </ul>
                </li>

                <li><a href="index2.php?action=menu_admin">Menu administration</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"> Nous joindre</a></li>
                        <li><a href="#">grace à vos dons</a></li>
                    </ul>
                </li>

                <li><a href="#">Traduction</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuration<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index2.php?action=configdroit"> Gestion des droits</a></li>
                        <li><a href="#">Paramètrage</a></li>
                    </ul>
                </li>



            </ul>


        </div>
        <!-- /#sidebar-wrapper -->

        <a href="#menu-toggle" class="btn btn-success modif_btn_toggle" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <div class="row modif_header"><!--Debut row header-->
                    <div class="col-md-2"><!--Debut col-md-2 logo-->
                        <p><a href="index2.php"><img src="images/logo.png" alt="Logo ONG MESSI CÔTE D'IVOIRE" class="img-responsive"/></a></p>
                    </div><!--Fin col-md-2 logo-->
                    <div class=" col-md-10 modif_titre_page">
                        <h2 class="text-center"> ESPACE ADMINISTRATION</h2>
                    </div>

                </div><!--Fin row header-->

                <div class="row"><!-- debut/row beadcrumb -->
                    <div class="col-md-12">


                        <nav class="navbar navbar-default" role="navigation">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                                        class="icon-bar"></span><span class="icon-bar"></span>
                                </button>
                                <!-- <a class="navbar-brand" href="http://www.jquery2dotnet.com">Brand</a> -->
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#"><span class="fa fa-home"></span>Dashboard</a></li>
                                    <!-- <li><a href="#"><span class="fa fa-calendar"></span>Calendar</a></li> -->

                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                                class="fa fa-search"></span>Recherche <b class="caret"></b></a>
                                        <ul class="dropdown-menu" style="min-width: 300px;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="navbar-form navbar-left" role="search">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Rechercher" />
                                                                <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                Go!</button>
                                        </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                                class="fa fa-user"></span>Personne <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="index2.php?action=profile"><span class="fa fa-user"></span>Profil</a></li>
                                            <li><a href="index2.php?action=utilisateur"><span class="fa fa-user"></span>Utilisateur</a></li>
                                            <li><a href="#"><span class="fa fa-cog"></span>Réglage</a></li>
                                            <li class="divider"></li>
                                            <li><a href="index2.php?action=deconnect"><span class="fa fa-off"></span>Déconnexion</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>

                    </div>
                </div> <!-- fin/row beadcrumb -->
                <div class="row">

                    <div class="col-md-12 col-sm-6 hero-feature">

                        <div class="thumbnail">
                                <?php
                                include ('controller.php');
                                ?>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div><!--Fin wrapper-->


    <footer>
        <div class="container">
            <div class="row text-center">

                <div class="col-md-12 modif_foot">
                    <p>Copyright &copy; 2017 ONG MESSI </p>
                </div>
            </div>
        </div>
    </footer>


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <!-- <script type="text/javascript" src="js/myscript.js"></script> -->

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <!--<script>
    $(document).ready(function(){
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');
        }
    );
});

</script>-->

    </body>
</html>
    <?php
 else :

     header("Location: index.php?reponse=2");
     exit();

 endif; ?>