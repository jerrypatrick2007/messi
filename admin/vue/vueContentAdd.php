<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 21/11/2017
 * Time: 17:09
 */
?>
<h3 class="panel panel-heading"> Choisissez Le type</h3>
<div><?php if(isset($reponse)){ ?><div class="alert alert-success" role="alert"><?php echo $reponse; ?> ...</div><?php }; ?> </div>
<div class="caption modif_btn_admin">
    <div class="list-group">
        <a href="index2.php?action=edito_add" class="list-group-item list-group-item-action">Edito</a>
        <a href="index2.php?action=notre_equipe_add" class="list-group-item list-group-item-action">Notre Equipe</a>
        <a href="index2.php?action=actualite_add" class="list-group-item list-group-item-action">Actualité</a>
        <a href="index2.php?action=domaines_intervention_add" class="list-group-item list-group-item-action">Domaines d'intervention</a>
        <a href="index2.php?action=evenements_add" class="list-group-item list-group-item-action ">Evènements</a>
        <a href="index2.php?action=nos_partenaires_add" class="list-group-item list-group-item-action ">Nos partenaires</a>
        <a href="index2.php?action=page_statique_add" class="list-group-item list-group-item-action ">Page statique</a>
        <a href="index2.php?action=nos_bureaux_add" class="list-group-item list-group-item-action ">Nos bureaux</a>
    </div>
</div>
