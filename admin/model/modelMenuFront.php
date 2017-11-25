<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 18/11/2017
 * Time: 18:04
 */
class MenuFront
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerMenuFront($droit,$premiereEntree,$messagesParPage,$uid,$expression_recherche='')
    {
        switch ($droit)
        {
            case 2 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created  FROM menu order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_menu_front']==''))
                    {
                        $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created  FROM menu order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_menu_front']!=''))
                    {
                        $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created FROM menu WHERE (UPPER(libele) LIKE '%$expression_recherche[libele_menu_front]%')  order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                }
                $res = $sql->fetch_all();
                break;
            case 1 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created FROM menu WHERE uid_created=$uid order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_menu_front']==''))
                    {
                        $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created FROM menu WHERE uid_created=$uid order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_menu_front']!=''))
                    {
                        $sql = $this->db->query("SELECT id_menu,libele ,parent,ordre,created,uid_created FROM menu WHERE uid_created=$uid and (UPPER(libele) LIKE '%$expression_recherche[libele_menu_front]%')  order by id_menu DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                }

                $res = $sql->fetch_all();
                break;
            case 0 :
                $res = array();
                break;
            default :
                $res = array();
                break;

        }
        return $res;
    }

    public function NombreTotalMenuFront($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT id_menu FROM menu")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT id_menu FROM menu WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterMenuFront($data)
    {
        $addContent = $this->db->prepare("INSERT INTO menu (libele,parent,actifs,liens,ordre,created,uid_created) VALUES (?,?,?,?,?,?,?)");
        $addContent->bind_param('siisiii',$data['libele'],$data['parent'],$data['actifs'],$data['liens'],$data['order'],$data['created'],$data['uid_created']);
        $addContent->execute();
        $id_menu = $addContent->insert_id;
        $addContent->close();
        $this->AddFileBanniere(array('fid'=>$data['fid'],'id_menu'=>$id_menu));
    }

    private function AddFileBanniere($data)
    {
        $addContent = $this->db->prepare("INSERT INTO field_data_images_banniere (fid,id_menu) VALUES (?,?)");
        $addContent->bind_param('ii',$data['fid'],$data['id_menu']);
        $addContent->execute();
        $addContent->close();
    }


    public function SupprimerMenuFront($id_menu)
    {
        $updateContent = $this->db->prepare("DELETE FROM menu  WHERE id_menu =?");
        $updateContent->bind_param('i',$id_menu);
        $updateContent->execute();
        $updateContent->close();

        $this->DeleteFileBanniere($id_menu);
    }
    public function liens_images_A_supprimer($id_menu)
    {
        $sql = $this->db->query("SELECT fid FROM field_data_images_banniere WHERE id_menu=$id_menu and fid !=0");
        $res = $sql->fetch_all();

        $sortir = array();

        if($res != '')
        {
            foreach ($res as $keys => $value)
            {

                $sortir[] = $value[$keys];
            }

        }

        return $sortir;

    }


    private function DeleteFileBanniere($id_menu)
    {
        $updateContent = $this->db->prepare("DELETE FROM field_data_images_banniere  WHERE id_menu =?");
        $updateContent->bind_param('i',$id_menu);
        $updateContent->execute();
        $updateContent->close();
    }


    public function ModifierMenuFront($data)
    {
        $updateContent = $this->db->prepare("UPDATE menu SET libele=?,parent=?,actifs=?,liens=?,ordre=? WHERE id_menu=?");
        $updateContent->bind_param("siisii", $data['libele'],$data['parent'],$data['actifs'], $data['liens'], $data['order'],$data['id_menu']);
        $updateContent->execute();
        $updateContent->close();
        $this->UpdateFileBanniere(array('fid'=>$data['fid'],'id_menu'=>$data['id_menu']));
    }

    private function UpdateFileBanniere($data)
    {
        $updateContent = $this->db->prepare("UPDATE field_data_images_banniere SET fid=? WHERE id_menu=?");
        $updateContent->bind_param('ii',$data['fid'],$data['id_menu']);
        $updateContent->execute();
        $updateContent->close();
    }

    public function AfficherMenuFrontAmodifier($id_menu)
    {
        $sql = $this->db->query("SELECT libele,parent,actifs,liens,ordre FROM menu WHERE id_menu=$id_menu");
        $res = $sql->fetch_all();
        return $res[0][0];
    }

    public function DetailsMenuFrontAmodifier($id_menu)
    {
        $sql = $this->db->query("SELECT n.id_menu id_menu,n.libele libele,n.parent parent,n.liens liens,n.ordre ordre,n.actifs actifs ,fdb.fid fid FROM menu n INNER JOIN field_data_images_banniere fdb ON n.id_menu = fdb.id_menu  WHERE n.id_menu=$id_menu");
        $res = $sql->fetch_assoc();
        return $res;
    }

    public function ListerMenuForm()
    {
        $sql = $this->db->query("SELECT id_menu,libele FROM menu ");
        $res = $sql->fetch_all();
        //debug($res);

        $pat = array('Aucun');
        foreach ($res as $valeur)
        {

            $pat[$valeur[0]] = $valeur[1];
        }
        //debug($pat);
        return $pat;
    }

    public function ParentMenuFront($id_menu)
    {
        $sql = $this->db->query("SELECT libele FROM menu WHERE id_menu=$id_menu");
        $res = $sql->fetch_assoc();
        return $res['libele'];
    }



}