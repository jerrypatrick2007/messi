<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 12/11/2017
 * Time: 18:59
 */
class modelUtilisateur
{
    private $db;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }

    public function ListerUtilisateur($droit,$premiereEntree,$messagesParPage,$uid,$expression_recherche='')
    {
        switch ($droit)
        {
            case 2 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['nom_utilisateur']=='')&&($expression_recherche['rid_utilisateur'] == 0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif(($expression_recherche['nom_utilisateur']=='')&&($expression_recherche['rid_utilisateur'] != 0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE roles=$expression_recherche[rid_utilisateur]  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['nom_utilisateur']!='')&&($expression_recherche['rid_utilisateur'] ==0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE (UPPER(name) LIKE '%$expression_recherche[nom_utilisateur]%')  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                        debug($sql);
                    }
                    elseif (($expression_recherche['nom_utilisateur']!='')&&($expression_recherche['rid_utilisateur'] !=0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE roles=$expression_recherche[rid_utilisateur] and (UPPER(name) LIKE '%$expression_recherche[nom_utilisateur]%')  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");

                    }
                }
                $res = $sql->fetch_all();
                break;
            case 1 :
                if($expression_recherche == '')
                {
                    $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE uid_created=$uid order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                }
                else
                {
                    if(($expression_recherche['nom_utilisateur']=='')&&($expression_recherche['rid_utilisateur'] == 0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE uid_created=$uid order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif(($expression_recherche['nom_utilisateur']=='')&&($expression_recherche['rid_utilisateur'] != 0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE uid_created=$uid and roles=$expression_recherche[rid_utilisateur]  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                    }
                    elseif (($expression_recherche['nom_utilisateur']!='')&&($expression_recherche['rid_utilisateur'] ==0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE uid_created=$uid and (UPPER(name) LIKE '%$expression_recherche[nom_utilisateur]%')  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
                        debug($sql);
                    }
                    elseif (($expression_recherche['nom_utilisateur']!='')&&($expression_recherche['rid_utilisateur'] !=0))
                    {
                        $sql = $this->db->query("SELECT uid,email,roles,name,name2,tel,uid_ceated,created FROM users WHERE uid_created=$uid and roles=$expression_recherche[rid_utilisateur] and (UPPER(name) LIKE '%$expression_recherche[nom_utilisateur]%')  order by uid DESC  LIMIT $premiereEntree, $messagesParPage");
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

    public function NombreTotalUtilisateur($droit,$uid)
    {
        switch ($droit)
        {
            case 2 :
                $sql = $this->db->query("SELECT uid FROM users")->num_rows;
                break;
            case 1 :
                $sql = $this->db->query("SELECT uid FROM users WHERE uid_created=$uid")->num_rows;
                break;
            default :
                $sql = 0;
                break;
        }

        return $sql;
    }

    public function AjouterUtilisateur($data)
    {
        debug($data);
        $motDePasse = $this->formaterPasse($data['password']);
        $addContent = $this->db->prepare("INSERT INTO users(civilite,password,salt,email,roles,name,name2,tel,uid_ceated,created) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $addContent->bind_param('isssisssii',$data['civilite'],$motDePasse['password'],$motDePasse['random_salt'],$data['email'],$data['roles'],$data['name'],$data['name2'],$data['tel'],$data['uid_created'],$data['created']);
        $addContent->execute();
        $addContent->close();
    }

    public function AfficherDetailsUtilisateur()
    {

    }

    public function SupprimerUtilisateur($uid)
    {
        $updateContent = $this->db->prepare("DELETE FROM users  WHERE uid =?");
        $updateContent->bind_param('i',$uid);
        $updateContent->execute();
        $updateContent->close();
    }

    public function ModifierUtilisateur($data)
    {
        debug($data);
        if($data['password'] == $this->ComparePass($data['uid']))
        {
            $updateContent = $this->db->prepare("UPDATE users SET civilite=?,email=?,roles=?,name=?,name2=?,tel=? WHERE uid =?");
            $updateContent->bind_param("isisssi", $data['civilite'], $data['email'], $data['roles'], $data['name'], $data['name2'], $data['tel'],$data['uid']);

        }
        else
        {
            $motDePasse = $this->formaterPasse($data['password']);
            $updateContent = $this->db->prepare("UPDATE users SET civilite=?,password=?,salt=?,email=?,roles=?,name=?,name2=?,tel=? WHERE uid =?");
            $updateContent->bind_param("isssisssi", $data['civilite'], $motDePasse['password'], $motDePasse['random_salt'], $data['email'], $data['roles'], $data['name'], $data['name2'], $data['tel'],$data['uid']);

        }

        $updateContent->execute();
        $updateContent->close();

    }
    private function ComparePass($uid)
    {
        $sql = $this->db->query("SELECT password FROM users WHERE uid = $uid");
        $compar = $sql ->fetch_assoc();
        return $compar['password'];
    }

    public function AjusterCompte()
    {
        $sql = "Seigneur tu me formes  chaque jour et j'apprends avec passion car tu es le meilleur prof, mon coeur est à toi et tu le sais";
    }
    public function AfficherUtilisateurAmodifier($id)
    {
        $sql = $this->db->query("SELECT civilite,email,name,name2,tel FROM users WHERE uid=$id");
        $res = $sql->fetch_all();
        return $res[0][0];
    }
    public function AfficherRolesAssocier($rid)
    {
        $sql = $this->db->query("SELECT libele FROM role WHERE rid=$rid");
        $res = $sql->fetch_all();
        return $res[0][0];
    }
    public function ListerRoleRecherche()
    {
        $sql = $this->db->query("SELECT rid,libele FROM role ");
        $res = $sql->fetch_all();
        //debug($res);

        $pat = array(' ');
        foreach ($res as $valeur)
        {

            $pat[$valeur[0]] = $valeur[1];
        }
        //debug($pat);
        return $pat;
    }

    public function DetailsUtilisateurAmodifier($uid)
    {
        $sql = $this->db->query("SELECT * FROM users WHERE uid=$uid");
        $res = $sql->fetch_assoc();
        return $res;
    }
    private function formaterPasse($motDePasse)
    {

        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        return array('random_salt'=>$random_salt,'password'=>hash('sha512', $motDePasse . $random_salt));
    }


}