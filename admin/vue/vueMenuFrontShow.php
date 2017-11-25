<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 17:44
 */
?>

<h3 class="panel panel-heading"> Détails Menu</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Menu</div>
        <div class="col-md-3"><?php  echo $variables['details']['libele']?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Parent : </div>
        <div class="col-md-3"><?php echo $ModelMenuFront->ParentMenuFront($variables['details']['parent']); ?></div>
        <div class="col-md-3"> </div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Actifs : </div>
        <div class="col-md-3"><?php
            if($variables['details']['actifs'] == 1)
            {
                echo 'oui';
            }
            else
            {
                echo 'non';
            }
            ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Liens : </div>
        <div class="col-md-3"><?php echo $variables['details']['liens']; ?></div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"><a href="index2.php?action=menu_front">Retour</a></div>
        <div class="col-md-3"></div>
    </div><br>


