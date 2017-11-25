<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 09/11/2017
 * Time: 15:29
 */

class modelDroitAcces
{
    private $db;

    public function __construct(mysqli $con) {
        $this->db = $con;
    }


    public function DroitDeVoir($role,$entites)
    {
        if($this->PeutVoir($role,$entites) == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }

    public function DroitSurContenu($role,$entites,$table)
    {
        if($this->TousAction($role,$entites,$table,'tous')== 1)
        {
            return 2; //peut voir tous les contenus
        }
        elseif ($this->TousAction($role,$entites,$table,'son') == 1)
        {
            return 1;// peut voir son contenu
        }
        else
        {
            return 0; // ne peut voir aucun contenu
        }
    }


    public function DroitDeVoirCeContenu($id_content,$uid)
    {
        $sql = $this->db->query("SELECT id_entity_access FROM entity_access WHERE uid_created=$uid and id_entity_access=$id_content")->num_rows;
        return $sql;
    }

    public function DroitDeModifier()
    {

    }

    public function DroitDeSupprimer()
    {

    }

    public function DroitDeCree()
    {

    }

    private function TousAction($roles,$entites,$action,$champs)
    {
        $table = 'access_'.$action;
        $sql = $this->db->query("SELECT $champs FROM $table WHERE rid=$roles and id_entity_access=$entites and $champs=1  LIMIT 0,1");
        $res = $sql->fetch_assoc();

            return $res[$champs];

    }
     private function Sevoir($roles,$entites)
    {
        $sql = $this->db->query("SELECT son FROM access_show WHERE rid=$roles and id_entity_access=$entites and son=1 LIMIT 0,1");
        $res = $sql->fetch_assoc();
        return $res['son'];


    }

    private function PeutVoir($roles,$entites)
    {
        $sql = $this->db->query("SELECT page FROM access_page WHERE rid=$roles and id_entity_access=$entites LIMIT 0,1");
        $res = $sql->fetch_assoc();
        if($res['page'] != '')
        {
            return $res['page'];
        }
        else
        {
            return 0;
        }
    }
}