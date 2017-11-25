<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 09/11/2017
 * Time: 15:25
 */

class ModelMenuAdmin
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerMenu($droit,$premiereEntree,$messagesParPage,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT id_entity_access,libele,uid_created,created FROM entity_access order by id_entity_access DESC  LIMIT $premiereEntree, $messagesParPage");
                $res = $sql->fetch_all();
                break;
            case 1 :
                $sql = $this->db->query("SELECT id_entity_access,libele,uid_created,created FROM entity_access WHERE uid_created=$uid order by id_entity_access DESC  LIMIT $premiereEntree, $messagesParPage");
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

    public function NombreTotalMenu($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT id_entity_access FROM entity_access")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT id_entity_access FROM entity_access WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterMenu($data)
    {
        $addContent = $this->db->prepare("INSERT INTO entity_access(uid_created,libele,created) VALUES (?,?,?)");
        $addContent->bind_param('isi',$data['uid_created'],$data['libele'],$data['created']);
        $addContent->execute();
        $addContent->close();
    }

    public function AfficherDetailsMenu()
    {

    }

    public function SupprimerContenu()
    {

    }

    public function ModifierContenu($data)
    {
        $updateContent = $this->db->prepare("UPDATE entity_access SET libele=? WHERE id_entity_access =?");
        $updateContent->bind_param("si", $data['libele'],$data['id_entity_access']);
        $updateContent->execute();
        $updateContent->close();

    }

    public function AfficherContenuAmodifier($id)
    {
        $sql = $this->db->query("SELECT libele FROM entity_access WHERE id_entity_access=$id");
        $res = $sql->fetch_all();
        return $res[0][0];
    }


}
?>
