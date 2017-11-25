<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 08/11/2017
 * Time: 15:32
 */
?>
<h3 class="panel panel-heading">Gestion des Droits</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <form enctype="multipart/form-data" method="post">
        <table class="table table-bordered table-striped table-responsive">
            <thead>

            <tr>
                <th></th>
                <?php
                foreach ($variables['rolelister'] as $listerrole){
                    ?>
                    <th class="text-center">
                        <?php echo $listerrole[1]; ?>
                    </th>
                <?php }; ?>
            </tr>

            </thead>
            <tbody>

            <?php
            foreach ($variables['entitylister'] as $listerentity){
                ?>
                <tr>

                    <th class="text-nowrap" scope="row"><?php echo $listerentity[1]; ?></th>
                    <?php foreach ($variables['rolelister'] as $listerrole){ ?>
                        <td>
                            <span>voir la page</span><input type="checkbox" <?php echo droitCocher("page_page_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?>  name="page_page_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>voir son contenu</span><input type="checkbox" <?php echo droitCocher("show_own_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?>  name="show_own_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>voir tous contenu</span><input type="checkbox"  <?php echo droitCocher("show_all_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="show_all_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>supprimer son contenu</span><input type="checkbox"  <?php echo droitCocher("delete_own_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="delete_own_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>supprimer tous contenu</span><input type="checkbox"  <?php echo droitCocher("delete_all_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="delete_all_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>modifier son contenu</span><input type="checkbox"   <?php echo droitCocher("update_own_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="update_own_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>modifier tous contenu</span><input type="checkbox" <?php echo droitCocher("update_all_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="update_all_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                            <span>Creer contenu</span><input type="checkbox" <?php echo droitCocher("create_all_".$listerentity[0].'_'.$listerrole[0],$mysqli); ?> name="create_all_<?php echo $listerentity[0]; ?>_<?php echo $listerrole[0]; ?>">
                            <br>
                        </td>
                    <?php }; ?>

                </tr>
            <?php }; ?>
            </tbody>
        </table>
        <input type="submit" name="droit_access" value="valider">
    </form>
</div>

