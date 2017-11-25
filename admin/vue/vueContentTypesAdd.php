<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 18/11/2017
 * Time: 12:38
 */?>
<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un type de contenu</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_libele']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['libele']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
     <div class="row">
        <div class="col-md-3">

            <div class="col-md-3"></div>
            <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
            <div class="col-md-3"></div>
        </div>

        <?php echo $variables['form']['fin_form']; ?>
    </div>
