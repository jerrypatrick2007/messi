<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 17/11/2017
 * Time: 15:49
 */?>
<h3 class="panel panel-heading"> Cette action est Irréversible !!!</h3>
<div class="caption modif_btn_admin">
    <?php if($variables['details']['droitDeSupprimer'] == 1 ): ?>
    <?php echo $variables['form']['form']; ?>

    <div class="row">
        <div class="col-md-3">

            <div class="col-md-3"><a href="index2.php?action=utilisateur">Annuler</a></div>
            <div class="col-md-3"><?php echo $variables['form']['submit']; ?></div>
            <div class="col-md-3"><?php echo $variables['form']['uid']; ?></div>
        </div>

        <?php echo $variables['form']['fin_form']; ?>
        <?php else: ?>

        <div class="alert alert-warning" role="alert"><?php echo $variables['details']['reponse']; ?> ...</div>
        <?php endif; ?>
    </div>

