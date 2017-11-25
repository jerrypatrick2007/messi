<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 12:33
 */
?>
<section class="modif_section_slide">
    <div class="container-fluid">
        <div class="row">
            <!-- <img src="images/img_slide.jpg" class="img-responsive" alt=""> -->


            <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
                    <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper For Slides -->
                <div class="carousel-inner" role="listbox">

                    <!-- Third Slide -->
                    <div class="item active">

                        <!-- Slide Background -->
                        <img src="images/img_slide.jpg" class="img-responsive" alt="">
                        <div class="bs-slider-overlay"></div>

                        <div class="container">
                            <div class="row">
                                <!-- Slide Text Layer -->
                                <div class="slide-text slide_style_left">
                                    <!-- <h1 data-animation="animated zoomInRight">Bootstrap Carousel</h1>
                                    <p data-animation="animated fadeInLeft">Bootstrap carousel now touch enable slide.</p> -->
                                    <!-- <a href="http://bootstrapthemes.co/" target="_blank" class="btn btn-default" data-animation="animated fadeInLeft">select one</a>
                                    <a href="http://bootstrapthemes.co/" target="_blank"  class="btn btn-primary" data-animation="animated fadeInRight">select two</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Slide -->

                    <!-- Second Slide -->
                    <div class="item">

                        <!-- Slide Background -->
                        <img src="images/img_slide2.jpg" class="img-responsive" alt="">
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_center">
                            <h1 data-animation="animated flipInX">ONG MESSI EVENEMENT</h1>
                            <p data-animation="animated lightSpeedIn">Bientôt.</p>
                            <!-- <a href="http://bootstrapthemes.co/" target="_blank" class="btn btn-default" data-animation="animated fadeInUp">select one</a>
                            <a href="http://bootstrapthemes.co/" target="_blank"  class="btn btn-primary" data-animation="animated fadeInDown">select two</a> -->
                        </div>
                    </div>
                    <!-- End of Slide -->

                    <!-- Third Slide -->
                    <div class="item">

                        <!-- Slide Background -->
                        <img src="images/img_slide3.jpg" class="img-responsive" alt="">
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_right">
                            <h1 data-animation="animated zoomInLeft">FAIRE UN DON</h1>
                            <p data-animation="animated fadeInRight">C'est participer à l'avancé de l'humanité.</p>
                            <a href="http://bootstrapthemes.co/" target="_blank" class="btn btn-default" data-animation="animated fadeInLeft">Faire un don</a>
                            <a href="http://bootstrapthemes.co/" target="_blank" class="btn btn-primary" data-animation="animated fadeInRight">Grâce à vos dons</a>
                        </div>
                    </div>
                    <!-- End of Slide -->


                </div><!-- End of Wrapper For Slides -->

                <!-- Left Control -->
                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <!-- Right Control -->
                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div> <!-- End  bootstrap-touch-slider Slider -->


        </div>
    </div>
</section>


<section class="modif_section_actu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Notre actualité</h1>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row modif_block_actu">
            <div class="col-md-4">
                <div class="date_pub_actu">
                    <p><span>18</span> Octobre</p>
                </div>
                <img src="images/img_actu1.jpg" class="img-responsive" alt="">
                <div class="modif_bloc_content_actu_index">
                    <h2 class="modif_title_actu"><a href="#">Séance de dépistage volontaire du VIH de masse au campus</a></h2>
                    <p>Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="date_pub_actu">
                    <p><span>18</span> Octobre</p>
                </div>
                <img src="images/img_actu1.jpg" class="img-responsive" alt="">
                <div class="modif_bloc_content_actu_index">
                    <h2 class="modif_title_actu"><a href="#">Séance de dépistage volontaire du VIH de masse au campus</a></h2>
                    <p>Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="date_pub_actu">
                    <p><span>18</span> Octobre</p>
                </div>
                <img src="images/img_actu1.jpg" class="img-responsive" alt="">
                <div class="modif_bloc_content_actu_index">
                    <h2 class="modif_title_actu"><a href="#">Séance de dépistage volontaire du VIH de masse au campus</a></h2>
                    <p>Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit </p>
                </div>
            </div>

            <div class="col-md-12 modif_block_btn_plus_actu text-right">
                <a href="#" class="btn btn-danger">Voir toutes les actualités  <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <!-- /.row -->

    </div>
</section>

<section class="modif_section_domaines_interv">
    <div class="container">
        <div class="row">
            <h1 class="text-center">Nos domaines d’intervention</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-4 text-justify">
                <h2>-   Soins et soutiens</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <p class="text-right"><a href="#">En savoir <i class="fa fa-plus" aria-hidden="true"></i></a></p>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4 text-justify">
                <h2>-   Préventions</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <p class="text-right"><a href="#">En savoir <i class="fa fa-plus" aria-hidden="true"></i></a></p>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4 text-justify">
                <h2>-   genres</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <p class="text-right"><a href="#">En savoir <i class="fa fa-plus" aria-hidden="true"></i>²</a></p>
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-12 modif_block_btn_plus_actu text-right">
                <a href="#" class="btn btn-danger btn_plus_service">Voir touts les services <i class="fa fa-plus"></i></a>
            </div>

        </div>
        <!-- /.row -->

    </div>
</section>

<section class="modif_section_edito">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edito</h1>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-6">
                <p><img src="images/img_edito.jpg" class="img-responsive" alt=""></p>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-6 text-justify">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <p>Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit </p>
                <p>Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor
                    in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit </p>
                <h4 class="modif_name_edito"><span> Dr. Deborah Persaud </span> virologue au Centre pédiatrique</h4>
            </div>
        </div>
        <!-- /.row -->

    </div>
</section>

<section class="modif_section_qui_som_ns">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Qui sommes nous ?</h3>
                <h1>Rencontrez notre equipe</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem Ipsum dummy text ever since dummy text of the printing and usings 1500s,Duis aute irure dolor in reprehenderit in voluptate velit esse when an. Duis aute irure dolor in reprehenderit</p>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">

                <div class="carousel slide" id="myCarousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <ul class="thumbnails">
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img1_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Matthew Dix</h4>
                                            <p>RESPONSABLE INFORMATIQUE</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img2_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Christopher Campbell</h4>
                                            <p>COMPTABLE</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img3_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Tenin Traoré</h4>
                                            <p>Responsable communication</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img4_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Rachel Kouamé</h4>
                                            <p>CHARGEE RELATIONS EXTERIEURES</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- /Slide1 -->
                        <div class="item">
                            <ul class="thumbnails">
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img3_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Praesent commodo</h4>
                                            <p>Nullam Condimentum Nibh Etiam Sem</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img1_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Praesent commodo</h4>
                                            <p>Nullam Condimentum Nibh Etiam Sem</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="#"><img src="images/img2_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Praesent commodo</h4>
                                            <p>Nullam Condimentum Nibh Etiam Sem</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-3">
                                    <div class="fff">
                                        <div class="thumbnail">
                                            <a href="index.php?parcours=details_equipe"><img src="images/img4_equipe.jpg" class="img-responsive" alt=""></a>
                                        </div>
                                        <div class="caption text-center">
                                            <h4>Praesent commodo</h4>
                                            <p>Nullam Condimentum Nibh Etiam Sem</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- /Slide2 -->
                    </div>

                    <nav>
                        <ul class="control-box pager">
                            <li><a data-slide="prev" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                            <li><a data-slide="next" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                    <!-- /.control-box -->

                </div><!-- /#myCarousel -->
            </div>
        </div>
        <!-- /.row -->

    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Nos Evénements</h1>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3 text-center">
                <p class="modif_date_event"> <span>18</span> Octobre</p>
                <h4>Lorem Ipsum is simply</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>

                <a href="#" class="btn btn-default modif_btn_event">Plus</a>
            </div>
            <div class="col-md-3 text-center">
                <p class="modif_date_event"> <span>18</span> Octobre</p>
                <h4>Lorem Ipsum is simply</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>

                <a href="#" class="btn btn-default modif_btn_event">Plus</a>
            </div>
            <div class="col-md-3 text-center">
                <p class="modif_date_event"> <span>18</span> Octobre</p>
                <h4>Lorem Ipsum is simply</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>

                <a href="#" class="btn btn-default modif_btn_event">Plus</a>
            </div>
            <div class="col-md-3 text-center">
                <p class="modif_date_event"> <span>18</span> Octobre</p>
                <h4>Lorem Ipsum is simply</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>

                <a href="#" class="btn btn-default modif_btn_event">Plus</a>
            </div>
        </div>
        <!-- /.row -->

    </div>
</section>
