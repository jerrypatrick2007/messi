<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 11/11/2017
 * Time: 07:28
 */
?>
<h3 class="panel panel-heading"> <?php echo $variables['action']; ?>  un menu d'administration</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <?php echo $variables['form']['form']; ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['label_libele']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['libelle']; ?></div>
        <div class="col-md-3"><?php echo $variables['form']['cacher']; ?></div>
    </div><br>
    <div class="row">
        <div class="col-md-3">
            <div id="dropBox">
                <p>Select file to upload</p>
            </div>
            <input type="file" name="fileInput" id="fileInput" /> </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
        <div class="col-md-3"></div>
    </div>

    <?php echo $variables['form']['fin_form']; ?>
</div>
