<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 18/11/2017
 * Time: 09:40
 */

?>


<h3 class="panel panel-heading"> Profile utilisateur</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div><br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Civilité</div>
        <div class="col-md-3"><?php if($variables['details']['civilite'] == 0){echo 'Mr';}elseif ($variables['details']['civilite'] == 1){echo 'Mme';}else{ echo 'Mlle';} ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Email : </div>
        <div class="col-md-3"><?php echo $variables['details']['email']; ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Roles : </div>
        <div class="col-md-3"><?php echo $ModelUtilisateur->AfficherRolesAssocier($variables['details']['roles']); ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Nom : </div>
        <div class="col-md-3"><?php echo $variables['details']['nom']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Prénom</div>
        <div class="col-md-3"><?php echo $variables['details']['prenom']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Tel</div>
        <div class="col-md-3"><?php echo $variables['details']['tel']; ?></div>
        <div class="col-md-3"></div>
    </div><br>




