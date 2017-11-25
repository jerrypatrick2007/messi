<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 24/11/2017
 * Time: 16:10
 */
?>
<h3 class="panel panel-heading">Edito détail : <?php  echo $variables['details']['titre']?></h3>
<div class="caption modif_btn_admin">

    <div class="row">
        <div class="col-md-12"><?php  echo $variables['details']['banniere']?></div>
    </div><br>

    <div class="row">
        <div class="col-md-12"><?php echo $variables['details']['body']; ?></div>
    </div><br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Autheur : </div>
        <div class="col-md-3"><?php echo $variables['details']['author']; ?></div>
        <div class="col-md-3"></div>
    </div><br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">date de creation : </div>
        <div class="col-md-3"><?php echo ConvertirTimestampDate($variables['details']['created']); ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Status : </div>
        <div class="col-md-3"><?php
            if($variables['details']['status'] == 1)
            {
                echo 'Publier';
            }
            else
            {
                echo 'Non Publier';
            }
            ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"><a href="index2.php?action=content">Retour</a></div>
        <div class="col-md-3"></div>
    </div><br>

