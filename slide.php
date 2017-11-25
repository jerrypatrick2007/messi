<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 12:22
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
