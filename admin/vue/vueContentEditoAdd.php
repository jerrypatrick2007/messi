<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 22/11/2017
 * Time: 16:05
 */
?>

<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un edito</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_title']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['titre']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-12"><?php echo $variables['form']['body']; ?></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_status']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['status']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
            <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
            <div class="col-md-3"></div>
    </div>

            <?php echo $variables['form']['fin_form']; ?>
</div>

