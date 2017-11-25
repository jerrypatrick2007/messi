<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 21/11/2017
 * Time: 17:47
 */
class Content
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerContent($droit,$premiereEntree,$messagesParPage,$uid,$expression_recherche='')
    {
        switch ($droit)
        {
            case 2 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_title']=='')and($expression_recherche['libele_content_types']==0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created  FROM node order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']=='')and($expression_recherche['libele_content_types']!=0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE id_content_types=$expression_recherche[libele_content_types]  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']!='')and($expression_recherche['libele_content_types']==0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE (UPPER(title) LIKE '%$expression_recherche[libele_content_title]%')  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']!='')and($expression_recherche['libele_content_types']!=0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE id_content_types=$expression_recherche[libele_content_types] and (UPPER(title) LIKE '%$expression_recherche[libele_content]%')  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }


                }
                $res = $sql->fetch_all();
                break;
            case 1 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE uid_created=$uid order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_title']=='')and($expression_recherche['libele_content_types']==0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created  FROM node WHERE uid_created=$uid  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']=='')and($expression_recherche['libele_content_types']!=0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE uid_created=$uid and id_content_types=$expression_recherche[libele_content_types]  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']!='')and($expression_recherche['libele_content_types']==0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE uid_created=$uid and (UPPER(title) LIKE '%$expression_recherche[libele_content_title]%')  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_title']!='')and($expression_recherche['libele_content_types']!=0))
                    {
                        $sql = $this->db->query("SELECT nid,title,id_content_types ,status,uid_created,created FROM node WHERE uid_created=$uid and id_content_types=$expression_recherche[libele_content_types] and (UPPER(title) LIKE '%$expression_recherche[libele_content]%')  order by nid DESC  LIMIT $premiereEntree, $messagesParPage");
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

    public function NombreTotalContent($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT nid FROM node")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT nid FROM node WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterContent($data)
    {
        $addContent = $this->db->prepare("INSERT INTO node (libele,created,uid_created) VALUES (?,?,?)");
        $addContent->bind_param('sii',$data['libele'],$data['created'],$data['uid_created']);
        $addContent->execute();
        $addContent->close();
    }

    public function AjouterContentEdito($data)
    {
        debug($data['body']);
        $addContent = $this->db->prepare("INSERT INTO node (title,id_content_types,status,uid_created,created) VALUES (?,?,?,?,?)");
        $addContent->bind_param('siiii',$data['title'],$data['id_content_types'],$data['status'],$data['uid_created'],$data['created']);
        $addContent->execute();
        $nid = $addContent->insert_id;
        $addContent->close();

        $this->AddBody(array('body'=>$data['body'],'nid'=>$nid));

    }

    private function AddBody($data)
    {
        debug($data['body']);
        $addContent = $this->db->prepare("INSERT INTO field_data_body (data_body_value ,nid) VALUES (?,?)");
        $addContent->bind_param('si',$data['body'],$data['nid']);
        $addContent->execute();
        $addContent->close();
    }



    public function ModifierContentEdito($data)
    {
        $updateContent = $this->db->prepare("UPDATE node SET title=?,status=? WHERE nid=?");
        $updateContent->bind_param("sii", $data['title'],$data['status'],$data['nid']);
        $updateContent->execute();
        $updateContent->close();
        $this->UpdateBody(array('body'=>$data['body'],'nid'=>$data['nid']));

    }


    private function UpdateBody($data)
    {
        $updateContent = $this->db->prepare("UPDATE field_data_body SET data_body_value=? WHERE nid=?");
        $updateContent->bind_param('si',$data['body'],$data['nid']);
        $updateContent->execute();
        $updateContent->close();
    }

    public function SupprimerContent($nid)
    {
        $updateContent = $this->db->prepare("DELETE FROM node  WHERE nid =?");
        $updateContent->bind_param('i',$nid);
        $updateContent->execute();
        $updateContent->close();


        $this->DeleteBody($nid);
    }

    private function DeleteBody($nid)
    {
        $updateContent = $this->db->prepare("DELETE FROM field_data_body  WHERE nid =?");
        $updateContent->bind_param('i',$nid);
        $updateContent->execute();
        $updateContent->close();
    }

    public function liens_images_A_supprimer($nid)
    {
        $sql = $this->db->query("SELECT fid FROM field_data_images WHERE nid=$nid and fid !=0");
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



    public function AfficherContentAmodifier($nid)
    {
        $sql = $this->db->query("SELECT libele FROM node WHERE nid=$nid");
        $res = $sql->fetch_all();
        return $res[0][0];
    }

    public function DetailsContentAmodifier($nid)
    {
        $sql = $this->db->query("SELECT * FROM node WHERE nid=$nid");
        $res = $sql->fetch_assoc();
        return $res;
    }

    public function DetailsContentEditoAmodifier($nid)
    {

        $sql = $this->db->query("SELECT n.nid nid,n.title title,n.uid_created uid_created,n.created created,n.status status ,fdb.data_body_value data_body_value FROM node n INNER JOIN field_data_body fdb ON n.nid = fdb.nid  WHERE n.nid=$nid");
        $res = $sql->fetch_assoc();
        return $res;
    }

    public function DetailsContentTypes($id_content_types)
    {
        $sql = $this->db->query("SELECT libele FROM content_types WHERE id_content_types=$id_content_types");
        $res = $sql->fetch_assoc();
        return $res['libele'];
    }

    public function DetailsContentDelete($nid)
    {
        $sql = $this->db->query("SELECT title FROM node WHERE nid=$nid");
        $res = $sql->fetch_assoc();
        return $res;
    }

}