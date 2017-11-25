<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 12:36
 */
switch ($_GET['parcours'])
{
    case 'edito' :
        include ('edito.php');
        break;
    case 'equipe' :
        include ('equipe.php');
        break;
    case 'details_equipe' :
        include ('details_equipe.php');
        break;
    case 'actualite' :
        include ('actualite.php');
        break;
    case 'detail_actualite' :
        include ('detail_actualite.php');
        break;
    case 'notre_histoire' :
        include ('notre_histoire.php');
        break;
    case 'domaines_interventions' :
        include ('domaines_interventions.php');
        break;
    case 'detail_domaines_intervention' :
        include ('detail_domaines_interventions.php');
        break;
    case 'siege_social' :
        include ('siege_social.php');
        break;
    case 'annexes' :
        include ('annexes.php');
        break;
    case 'phototheque':
        include ('phototheque.php');
        break;
    case 'detail_phototheque' :
        include ('detail_phototheque.php');
        break;
    case 'videotheque' :
        include ('videotheque.php');
        break;
    case 'nous_contacter' :
        include ('nous_contacter.php');
        break;
    case 'ressources' :
        include ('ressources.php');
        break;
    default :
        include ('home.php');
        break;
}

?>