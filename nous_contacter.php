<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 13:35
 */
?>
<section class="modif_section_slide">
    <div class="container-fluid">
        <div class="row">
            <img src="images/img_banniere_contact.jpg" class="img-responsive" alt="">
        </div>
    </div>
</section>


<section class=" modif_section_map_contact">
    <div class="container-fluid">

        <div class="row">
            <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=15+Springfield+Way,+Hythe,+CT21+5SH&aq=t&sll=52.8382,-2.327815&sspn=8.047465,13.666992&ie=UTF8&hq=&hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&t=m&z=14&ll=51.077429,1.121722&output=embed"></iframe>

        </div>

    </div>
</section>

<section>
    <div class="container">

        <div class="row">

            <div class="col-md-8">
                <div class="well well-sm">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Nom ou raison social</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span>
                                </span>
                                        <input type="text" class="form-control" id="name" placeholder="Saisir ici" required="required" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email"> Email</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-envelope"></span>
                                </span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subject">
                                        Objet</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Demande d'information</option>
                                        <option value="service">Demande partenariat</option>
                                        <option value="suggestions">Suggestions</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                              placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Envoyer Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    <legend><span class="fa fa-globe"></span> ONG MESSI</legend>
                    <address>
                        <strong>Rue L55 Riviéra 2</strong><br>
                        non loin de la mosquée - <br>
                        Abidjan - Côte d'ivoire<br>
                        <abbr title="Phone">
                            TEL.:</abbr>
                        (+225) - 00 - 012 - 345 <br /> (+225) 07 - 512 - 345
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:#">ong-messi@contact.ci</a>
                    </address>
                </form>
            </div>

        </div>

        <!-- <div class="row">
            <div class="main_action text-center">
                <div class="col-md-4">
                    <div class="action_item">
                        <i class="fa fa-map-marker"></i>
                        <h4 class="text-uppercase m-top-20">Address</h4>
                        <p>Rue L55 Riviéra 2 non loin de la mosquée - <br /> Côte d'ivoire </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="action_item">
                        <i class="fa fa-headphones"></i>
                        <h4 class="text-uppercase m-top-20">phone</h4>
                        <p>(+225) - 00 - 012 - 345 <br /> (+225) 07 - 512 - 345</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="action_item">
                        <i class="fa fa-envelope-o"></i>
                        <h4 class="text-uppercase m-top-20">Email</h4>
                        <p>ong-messi@contact.ci</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>

