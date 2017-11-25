<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 07/11/2017
 * Time: 10:04
 */
/*
require 'google-translate-php/vendor/autoload.php';
use Stichoza\GoogleTranslate\TranslateClient;
$tr = new TranslateClient('en', 'fr');

echo $tr->translate('World!');
*/
include_once('admin/secure/connect.php');
include ('model_front/RestituerData.php');
$RestituerData = new RestituerData($mysqli);
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="degny_steph" content="">

    <title>ONG MESSI</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/fonts/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/mystyles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<header>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="index.php"><img src="images/logo_ong_messi.png" class="img-responsive" alt="Logo ONG MESSI CÔTE D'IVOIRE"></a>
                </div>
                <div class="col-md-offset-5 col-md-4 text-right">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-5 text-center">

                            <ul class="list-inline modif_social_icon_header">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                            <a href="#" class="btn btn-danger">Faire un don</a>
                        </div>
                        <div class="col-md-5">
                            <ul class="list-inline">
                                <li>
                                    <a href="" class=""><img src="images/icon_drap_angl.png" class="img-responsive" alt="" width="20"/></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/icon_drap_fr.png" class="img-responsive" alt="" width="20"/></a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-danger">Grâce à vos dons</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->

    <?php include('menu.php'); ?>

</header>
<!-- Page Content -->

<?php include('parcours.php'); ?>

<section class="modif_section_partners">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Nos partenaires</h2>

                <div id="Carousel" class="carousel slide">

                    <ol class="carousel-indicators">
                        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#Carousel" data-slide-to="1"></li>
                    </ol>

                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <div class="item active">
                            <div class="row">
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn1.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn2.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn3.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn4.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn5.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn6.png" class="img-responsive" alt="Image" style="max-width:100%;"></a></div>
                            </div><!--.row-->
                        </div><!--.item-->

                        <div class="item">
                            <div class="row">
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn7.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn8.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn5.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn1.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn4.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                                <div class="col-md-2"><a href="#" class="thumbnail"><img src="images/img_partn3.png" class="img-responsive alt="Image" style="max-width:100%;"></a></div>
                            </div><!--.row-->
                        </div><!--.item-->

                    </div><!--.carousel-inner-->
                    <!-- <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                    <a data-slide="next" href="#Carousel" class="right carousel-control">›</a> -->
                </div><!--.Carousel-->


            </div>
        </div>
    </div><!--.container-->

</section>

<!-- Footer -->
<footer class="modif_footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">Akouaba</a>
                    </li>
                    <li>
                        <a href="#">Notre histoire</a>
                    </li>
                    <li>
                        <a href="#">Nos domaines d'interventions</a>
                    </li>
                    <li>
                        <a href="#">Nos bureaux</a>
                    </li>
                    <li>
                        <a href="#">Les ressources</a>
                    </li>
                    <li>
                        <a href="#">Médiathèque</a>
                    </li>
                    <li>
                        <a href="#">Nous contacter</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                <label>Nous suivre</label>
                <ul class="list-inline modif_social_icon">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="col-md-offset-2 col-md-3">
                <label>Newsletter</label>
                <form id="newsletter">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Entrer votre email"/>
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-danger">S'inscrire</button>
                                </span>
                    </div>
                </form>

            </div>

            <div class="col-md-offset-1 col-md-3 text-right">
                <label>Nous contacter</label>
                <address>
                    Adresse <br/>
                    tel: 00 012 345
                </address>
            </div>
        </div>

        <hr/>


        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright &copy; Ong MESSI 2017 Tous droits réservés</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="admin/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="admin/js/bootstrap.min.js"></script>

</body>

</html>

