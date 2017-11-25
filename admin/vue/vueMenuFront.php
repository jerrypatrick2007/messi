<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 18/11/2017
 * Time: 18:03
 */
?>

<h3 class="panel panel-heading">Gestion des Menus</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="row">
        <?php echo $variables['form_rechercher']['form']; ?>
        <div class="col-lg-3"><?php echo $variables['form_rechercher']['libelle']; ?></div><div class="col-lg-3"><?php  echo $variables['form_rechercher']['submit']; ?></div><div class="col-lg-3"></div><div class="col-lg-3"></div>
        <?php echo $variables['form_rechercher']['fin_form'] ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label><a href="index2.php?action=menu_front_add">Ajouter un menu</a> </label>
            <table class="table table-responsive table-striped table-bordered">
                <thead>
                <tr>
                    <th>libele </th>
                    <th>parent </th>
                    <th>order </th>
                    <th>Date creation</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($variables['listerutilisateur'] as $listerconetu){ ?>
                    <tr>
                        <td><?php echo chaineProtegerRetirer($listerconetu[1]); ?></td>
                        <td><?php echo $ModelMenuFront->ParentMenuFront($listerconetu[2]); ?></td>
                        <td><?php echo  $listerconetu[3]; ?></td>
                        <td><?php echo ConvertirTimestampDate($listerconetu[4]); ?></td>
                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="index2.php?action=menu_front_add&update_menu_front=<?php echo $listerconetu[0]; ?>"><span class="fa fa-edit" title="modifier"></span></a>
                            <a href="index2.php?action=menu_front_delete&delete_menu_front=<?php echo $listerconetu[0]; ?>" class="btn btn-danger btn-xs"><span class="fa fa-remove" title="supprimer"></span></a> <a href="index2.php?action=menu_front_show&menu_front_show=<?php echo $listerconetu[0]; ?>"  class="pirobox btn btn-success btn-xs"><span class="fa fa-eye" title="afficher details"></span> </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

    <div align="center">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <?php echo $variables['afficher_paggination'] ;?>
                </div>
            </div>
        </div>

    </div>

</div>
