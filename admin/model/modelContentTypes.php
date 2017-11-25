<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 18/11/2017
 * Time: 10:37
 */

class ContentTypes
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerContentTypes($droit,$premiereEntree,$messagesParPage,$uid,$expression_recherche='')
    {
        switch ($droit)
        {
            case 2 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created FROM content_types order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_types']==''))
                    {
                        $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created  FROM content_types order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_types']!=''))
                    {
                        $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created FROM content_types WHERE (UPPER(libele) LIKE '%$expression_recherche[libele_content_types]%')  order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                 }
                $res = $sql->fetch_all();
                break;
            case 1 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created FROM content_types WHERE uid_created=$uid order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_types']==''))
                    {
                        $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created FROM content_types WHERE uid_created=$uid order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_types']!=''))
                    {
                        $sql = $this->db->query("SELECT id_content_types,libele ,created,uid_created FROM content_types WHERE uid_created=$uid and (UPPER(libele) LIKE '%$expression_recherche[libele_content_types]%')  order by id_content_types DESC  LIMIT $premiereEntree, $messagesParPage");
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

    public function NombreTotalContentTypes($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT id_content_types FROM content_types")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT id_content_types FROM content_types WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterContentTypes($data)
    {
        $addContent = $this->db->prepare("INSERT INTO content_types (libele,created,uid_created) VALUES (?,?,?)");
        $addContent->bind_param('sii',$data['libele'],$data['created'],$data['uid_created']);
        $addContent->execute();
        $addContent->close();
    }

    public function SupprimerContentTypes($id_content_types)
    {
        $updateContent = $this->db->prepare("DELETE FROM content_types  WHERE id_content_types =?");
        $updateContent->bind_param('i',$id_content_types);
        $updateContent->execute();
        $updateContent->close();
    }

    public function ModifierContentTypes($data)
    {
        $updateContent = $this->db->prepare("UPDATE content_types SET libele=? WHERE id_content_types=?");
        $updateContent->bind_param("si", $data['libele'],$data['id_content_types']);
        $updateContent->execute();
        $updateContent->close();

    }
     public function AfficherContentTypesAmodifier($id_content_types)
    {
        $sql = $this->db->query("SELECT libele FROM content_types WHERE id_content_types=$id_content_types");
        $res = $sql->fetch_all();
        return $res[0][0];
    }

    public function DetailsContentTypesAmodifier($id_content_types)
    {
        $sql = $this->db->query("SELECT * FROM content_types WHERE id_content_types=$id_content_types");
        $res = $sql->fetch_assoc();
        return $res;
    }


}