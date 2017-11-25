<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 22/11/2017
 * Time: 22:55
 */
?>

<h3 class="panel panel-heading">Gestion des contenus</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="row">
        <?php echo $variables['form_rechercher']['form']; ?>
        <div class="col-lg-3"><?php echo $variables['form_rechercher']['libelle']; ?></div><div class="col-lg-3"><?php  echo $variables['form_rechercher']['submit']; ?></div><div class="col-lg-3"></div><div class="col-lg-3"></div>
        <?php echo $variables['form_rechercher']['fin_form'] ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label><a href="index2.php?action=content_add">Ajouter un contenu</a> </label>
            <table class="table table-responsive table-striped table-bordered">
                <thead>
                <tr>
                    <th>titre </th>
                    <th>types contenu </th>
                    <th>Status </th>
                    <th>Date creation</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($variables['listerutilisateur'] as $listerconetu){
                    if($listerconetu[2]==3)
                    {
                        $modifs_liens ="edito_add";
                        $voir_liens = "edito_show";
                    }
                    else
                    {
                        $modifs_liens="content_add";
                    }
                    ?>
                    <tr>
                        <td><?php echo chaineProtegerRetirer($listerconetu[1]); ?></td>
                        <td><?php echo $ModelContent->DetailsContentTypes($listerconetu[2]); ?></td>
                        <td><?php   if($listerconetu[3] == 1){ echo 'Publier'; } else{echo 'Non publier' ;}  ?></td>
                        <td><?php echo ConvertirTimestampDate($listerconetu[5]); ?></td>
                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="index2.php?action=<?php echo $modifs_liens; ?>&update_content=<?php echo $listerconetu[0]; ?>"><span class="fa fa-edit" title="modifier"></span></a>
                            <a href="index2.php?action=content_delete&delete_content=<?php echo $listerconetu[0]; ?>" class="btn btn-danger btn-xs"><span class="fa fa-remove" title="supprimer"></span></a> <a href="index2.php?action=<?php echo $voir_liens; ?>&content_show=<?php echo $listerconetu[0]; ?>"  class="pirobox btn btn-success btn-xs"><span class="fa fa-eye" title="afficher details"></span> </a>
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


