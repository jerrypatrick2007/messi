<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 08/11/2017
 * Time: 15:33
 */
class droitAcess
{
    private $db;

    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerRoles()
    {
        $sql = $this->db->query("SELECT rid,libele FROM role");
        $res =  $sql->fetch_all();
        return $res;

    }

    public function ListerEntite()
    {
        $sql = $this->db->query("SELECT id_entity_access,libele FROM entity_access");
        $res =  $sql->fetch_all();
        return $res;
    }

    public function ViderDdroit()
    {

        $sql = $this->db->prepare('TRUNCATE access_create');
        $sql->execute();

        $sql2 = $this->db->prepare('TRUNCATE access_update');
        $sql2->execute();

        $sql3 = $this->db->prepare('TRUNCATE access_delete');
        $sql3->execute();

        $sql4 = $this->db->prepare('TRUNCATE access_show');
        $sql4->execute();

        $sql5 = $this->db->prepare('TRUNCATE access_page');
        $sql5->execute();

    }

    public function EngisterDroits($cle,$valeur=1)
    {
        $decoupe = explode('_',$cle);
        (int)$entites = $decoupe[2];
        (int)$roles = $decoupe[3];
        $sql = $this->db->prepare('INSERT INTO'.' '.$this->tableAappeler($decoupe[0]).' ( id_entity_access, rid, '.$this->champsAappeler($decoupe[1]).' )VALUES (?,?,?)');
        $sql->bind_param("iii",$entites,$roles,$valeur);
        $sql->execute();

    }
    public function cheickboxActifs($verif)
    {
        $decoupe = explode('_',$verif);
        if(tableAappeler($decoupe[0]) == FALSE):

        $sql = $this->db->query('SELECT son,tous FROM'.' '.$this->tableAappeler($decoupe[0]).' WHERE id_entity_access='.$decoupe[1].'and rid='.$decoupe[2]);
        $res =$sql->num_rows;
        else :
         $res = '';
        endif;
        return $res;

    }
    private  function tableAappeler($valeur)
    {
        $retour = '';
        switch ($valeur)
        {
            case 'show' :
                $retour = 'access_show';
                break;
            case 'delete' :
                $retour = 'access_delete';
                break;
            case 'update' :
                $retour = 'access_update';
                break;
            case 'create' :
                $retour = 'access_create';
                break;
            case 'page' :
                $retour = 'access_page';
                break;
            default :
                $retour = FALSE;

        }
        return $retour;
    }
    private function champsAappeler($valeur)
    {
        $retour = '';
        switch ($valeur)
        {
            case 'own' :
                $retour = 'son';
                break;
            case 'all' :
                $retour = 'tous';
                break;
            case 'page':
                $retour = 'page';
                break;
            default :
                $retour = FALSE;

        }
        return $retour;
    }

}