<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 16/11/2017
 * Time: 11:27
 */
?>

<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un Utilisateur</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_civilite']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['civilite']; ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_password']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['password']; ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_email']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['email']; ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_roles']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['roles']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_nom']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['nom']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_prenom']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['prenom']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_tel']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['tel']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
    </div><br>

    <div class="row">
        <div class="col-md-3">

        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
        <div class="col-md-3"></div>
    </div>

    <?php echo $variables['form']['fin_form']; ?>
</div>

