<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 15:03
 */
?>
<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un menu</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_parent']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['parent']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_libele']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['libele']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_liens']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['liens']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_order']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['order']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_banniere']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['banniere']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['banniere_image']; ?><?php echo $variables['form']['cacher_fid']; ?></div>
    </div><br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_actifs']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['actifs']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
        <div class="col-md-3"></div>
    </div>

    <?php echo $variables['form']['fin_form']; ?>
</div>

