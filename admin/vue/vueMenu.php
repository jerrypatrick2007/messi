<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 09/11/2017
 * Time: 15:27
 */

?>

<h3 class="panel panel-heading">Gestion des menus d'administration</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="row">
        <div class="col-md-12">
            <label><a href="index2.php?action=menu_admin_add">Ajouter un menu</a> </label>
            <table class="table table-responsive table-striped table-bordered">
                <thead>
                <tr>
                    <th>Libelé </th>
                    <th>Auteur</th>
                    <th>date creation</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($variables['listermenu'] as $listerconetu){ ?>
                    <tr>
                        <td><?php echo $listerconetu[1]; ?></td>
                        <td><?php echo AuteurContenu($mysqli,(int)$listerconetu[2])[0][0]; ?></td>
                        <td><?php echo ConvertirTimestampDate($listerconetu[3]); ?></td>
                        <td class="text-center"><a class='btn btn-info btn-xs' href="index2.php?action=menu_admin_add&update_menu=<?php echo $listerconetu[0]; ?>"><span class="fa fa-edit"></span> Modifier</a> <a href="#" class="btn btn-danger btn-xs"><span class="fa fa-remove"></span> supprimer</a> <a href="#" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Voir</a></td>
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
