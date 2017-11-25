<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 10/11/2017
 * Time: 10:40
 */

class modelSystemeContenu
{
    public function PagginationContenu($nombretotal,$get=0,$messagesParPage=10)
    {
        $nombreDePages=ceil($nombretotal/$messagesParPage);

        if($get != 0) // Si la variable $_GET['page'] existe...
        {


            if ( is_numeric ( $get))
            {

                $pageActuelle=(int)$get;
                $page=(int)$get;


            }
            else
            {
                $pageActuelle=1;
                $page=1;
            }

            if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $titrebreDePages...
            {
                $pageActuelle=$nombreDePages;
            }
        }
        else // Sinon
        {
            $pageActuelle=1; // La page actuelle est la n°1
            $page=1;
        }

        $premiereEntree=($pageActuelle-1)*$messagesParPage;
        if($premiereEntree < 0)
        {
            $premiereEntree=0;
        }// On calcul la première entrée à lire

        return array(
            'premiereEntree'=> $premiereEntree,
            'messagesParPage'=> $messagesParPage,
            'pageActuelle' => $pageActuelle,
            'page' => $page,
            'nombreDePages' => $nombreDePages,

            );

    }

    public function Paggination($page,$nombreDePages)
    {
        $long=strlen($page);

        if($long < 2)
        {
            $debut=1;

            if($debut + 9> $nombreDePages)
            {
                $fin=$nombreDePages;
            }
            else
            {
                $fin=$debut + 9;
            }

        }
        elseif($long >= 2)
        {
            $debut=$page-substr($page, -1);
            if($debut + 9> $nombreDePages)
            {
                $fin=$nombreDePages;
            }
            else
            {
                $fin=$debut + 9;
            }

        }
        return array(
            'debut' => $debut,
            'fin' => $fin,
        );
    }

    public function AfficherPaggination($action,$debut,$fin,$page,$nombreDePages,$expression_recherche='')
    {
        if($expression_recherche != '')
        {
            $rechercher = '';
            foreach ($expression_recherche as $key =>$valeurs)
            {
                $rechercher .= '&'.$key.'='.$valeurs;
            }

        }

        $morceau1 = '<ul class="pagination">';
        if($debut > 1)
        {
            $depart = $debut - 1;
            if($expression_recherche=='')
            {
                $morceau1 .= '<li><a href=index2.php?action='.$action.'&page=$depart>&laquo;</a></li>';
            }
            else
            {

                $morceau1 .= '<li><a href=index2.php?action='.$action.'&page=$depart'.$rechercher.'>&laquo;</a></li>';
            }

        }
        $x=$debut;
        if($expression_recherche=='')
        {
            while ($x <= $fin)
            {
                if($page == $x )
                {
                    $active = 'active';
                }
                else
                {
                    $active = '';
                }
                $morceau1 .= '<li class='.$active.'><a href=index2.php?action='.$action.'&page='.$x.'>'.$x.'</a></li>';
                $x++;
            }

        }
        else
        {
            while ($x <= $fin) {
                if ($page == $x) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                $morceau1 .= '<li class=' . $active . '><a href=index2.php?action=' . $action . '&page=' . $x . $rechercher . '>' . $x . '</a></li>';
                $x++;
            }
        }

        if($nombreDePages != $fin)
        {
            $finalite = $fin + 1;
            if($expression_recherche=='')
            {

                $morceau1 .= '<li><a href=index2.php?action=' . $action . '&page='. $finalite .'>&raquo;</a></li>';
            }
            else
            {
                $morceau1 .= '<li><a href=index2.php?action=' . $action . '&page='. $finalite .$rechercher.'>&raquo;</a></li>';
            }

        }

        $morceau1 .= '</ul>';

        return $morceau1;
    }
}