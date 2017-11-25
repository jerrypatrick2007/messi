<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 21/11/2017
 * Time: 01:19
 */
?>

<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un champs champs </h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_libele']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['label']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_types_content']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['types_content']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_machine_name']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['machine_name']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_types']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['types']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
    </div><br>

    <div class="row">
        <div class="col-md-12"><?php echo $variables['form']['body']; ?></div>
    </div><br>


    <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
                <div class="col-md-3"></div>
    </div>

            <?php echo $variables['form']['fin_form']; ?>
</div>

