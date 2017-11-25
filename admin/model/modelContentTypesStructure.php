<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 21/11/2017
 * Time: 00:00
 */

class ContentTypesStructure
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerContentTypesStructure($droit,$premiereEntree,$messagesParPage,$uid,$expression_recherche='')
    {
        switch ($droit)
        {
            case 2 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types_structure order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_types_structure']==''))
                    {
                        $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types  FROM content_types_structure order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_types_structure']!=''))
                    {
                        $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types_structure WHERE (UPPER(label) LIKE '%$expression_recherche[libele_content_types_structure]%')  order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                }
                $res = $sql->fetch_all();
                break;
            case 1 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types_structure WHERE uid_created=$uid order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['libele_content_types_structure']==''))
                    {
                        $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types WHERE uid_created=$uid order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['libele_content_types_structure']!=''))
                    {
                        $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types_structure WHERE uid_created=$uid and (UPPER(label) LIKE '%$expression_recherche[libele_content_types_structure]%')  order by id_content_types_structure DESC  LIMIT $premiereEntree, $messagesParPage");
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

    public function NombreTotalContentTypesStructure($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT id_content_types_structure FROM content_types_structure")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT id_content_types_structure FROM content_types_structure WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterContentTypesStructure($data)
    {
        $addContent = $this->db->prepare("INSERT INTO content_types_structure (id_content_types,label,machine_name,types,uid_created) VALUES (?,?,?,?,?)");
        $addContent->bind_param('issii',$data['id_content_types'],$data['label'],$data['machine_name'],$data['types'],$data['types']);
        $addContent->execute();
        $addContent->close();
    }

    public function SupprimerContentTypesStructure($id_content_types)
    {
        $updateContent = $this->db->prepare("DELETE FROM content_types_structure  WHERE id_content_types_structure =?");
        $updateContent->bind_param('i',$id_content_types);
        $updateContent->execute();
        $updateContent->close();
    }

    public function ModifierContentTypesStructure($data)
    {
        $updateContent = $this->db->prepare("UPDATE content_types_structure SET id_content_types=?,label=?,machine_name=?,types=? WHERE id_content_types_structure=?");
        $updateContent->bind_param("ssii", $data['label'],$data['machine_name'],$data['types'],$data['id_content_types_structure']);
        $updateContent->execute();
        $updateContent->close();

    }
    public function AfficherContentTypesStructureAmodifier($id_content_types_structure)
    {
        $sql = $this->db->query("SELECT id_content_types_structure,id_content_types,label,machine_name,types FROM content_types_structure WHERE id_content_types_structure=$id_content_types_structure");
        $res = $sql->fetch_all();
        return $res[0][0];
    }

    public function DetailsContentTypesStructureAmodifier($id_content_types_structure)
    {
        $sql = $this->db->query("SELECT * FROM content_types_structure WHERE id_content_types_structure=$id_content_types_structure");
        $res = $sql->fetch_assoc();
        return $res;
    }

    public  function TypesChamps()
    {
        return array('text'=>'Texte','textarea'=>'Body','file'=>'Fichier','checkbox'=>'checkbox','radio'=>'Bouton radio','password'=>'Mot de passe');
    }

    public function ListerTypeMenu()
    {
        $sql = $this->db->query("SELECT id_content_types,libele FROM content_types ");
        $res = $sql->fetch_all();
        //debug($res);

        $pat = array();
        foreach ($res as $valeur)
        {

            $pat[$valeur[0]] = $valeur[1];
        }
        //debug($pat);
        return $pat;
    }


}
