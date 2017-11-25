<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 08/11/2017
 * Time: 12:32
 */

if(isset($_GET['action'])) :
    $action = $_GET['action'];
    include ('model/modelDroitAcces.php');
    $modelDroitAcces = new modelDroitAcces($mysqli);


switch ($action)
{
    case 'role' :
        include ('model/modelRole.php');
        include ('vue/vueRole.php');
        break;
    case 'utilisateur' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],10) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelUtilisateur.php');
            $ModelUtilisateur = new modelUtilisateur($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['nom_utilisateur']))
            {
               $expression_recherche = array(
                   'nom_utilisateur'=>chaineProteger(filter_input(INPUT_GET, "nom_utilisateur", FILTER_SANITIZE_STRING)),
                   'rid_utilisateur' => filter_input(INPUT_GET, "rid_utilisateur", FILTER_VALIDATE_INT)
               );
            }
            elseif(isset($_POST['nom_utilisateur']))
            {
                $expression_recherche = array(
                    'nom_utilisateur'=>chaineProteger(filter_input(INPUT_POST, "nom_utilisateur", FILTER_SANITIZE_STRING)),
                    'rid_utilisateur' => filter_input(INPUT_POST, "rid_utilisateur", FILTER_VALIDATE_INT)

                );

            }
            else
            {
                $expression_recherche = '';
            }

            if(isset($_POST['ajout_cacher_utilisateur']))
            {
                $ModelUtilisateur->AjouterUtilisateur(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'civilite' =>filter_input(INPUT_POST, "civilite", FILTER_VALIDATE_INT),
                    'password' =>filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING),
                    'email' =>filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING),
                    'roles' =>filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT),
                    'name' =>chaineProteger(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)),
                    'name2' =>chaineProteger(filter_input(INPUT_POST, "name2", FILTER_SANITIZE_STRING)),
                    'tel' =>chaineProteger(filter_input(INPUT_POST, "tel", FILTER_SANITIZE_STRING)),
                ));
                $reponse = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';
            }
            elseif(isset($_POST['modif_cacher_utilisateur']))
            {
                $ModelUtilisateur->ModifierUtilisateur(array(
                    'civilite' =>filter_input(INPUT_POST, "civilite", FILTER_VALIDATE_INT),
                    'password' =>filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING),
                    'email' =>filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING),
                    'roles' =>filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT),
                    'name' =>chaineProteger(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)),
                    'name2' =>chaineProteger(filter_input(INPUT_POST, "name2", FILTER_SANITIZE_STRING)),
                    'tel' =>chaineProteger(filter_input(INPUT_POST, "tel", FILTER_SANITIZE_STRING)),
                    'uid' =>filter_input(INPUT_POST, "modif_cacher_utilisateur", FILTER_VALIDATE_INT)
                ));
                $reponse = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }
            elseif(isset($_POST['delete_uid']))
            {
                $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'delete');

                if($DroitDeVoirContenu == 2)
                {
                    $ModelUtilisateur->SupprimerUtilisateur(filter_input(INPUT_POST, "delete_uid", FILTER_VALIDATE_INT));
                    $reponse = 'Utilisateur supprimer avec succes !!!';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_POST, "delete_uid", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ModelUtilisateur->SupprimerUtilisateur(filter_input(INPUT_POST, "delete_uid", FILTER_VALIDATE_INT));
                        $reponse = 'Utilisateur supprimer avec succes !!!';
                    }
                    else
                    {
                        $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                    }

                }
                elseif ($DroitDeVoirContenu == 0)
                {
                    $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                }

            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelUtilisateur->NombreTotalUtilisateur($modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'show'),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listerutilisateur' =>$ModelUtilisateur->ListerUtilisateur($modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'show'),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users'],$expression_recherche),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('utilisateur',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'],$expression_recherche),
                'form_rechercher' =>array(
                    'form' => $form->form('rechercher_utilisateur','index2.php?action=utilisateur'),
                    'libelle' => $form->input('text','nom_utilisateur'),
                    'rid' =>$form->selectClassique($ModelUtilisateur->ListerRoleRecherche(),'rid_utilisateur', 0),
                    'submit' => $form->submitform('Rechercher'),
                    'fin_form' => $form->formsurfix(),)
            );
            include ('vue/vueUtilisateur.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'utilisateur_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],10) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'show');
            include ('model/modelUtilisateur.php');
            $ModelUtilisateur = new modelUtilisateur($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            if(isset($_GET['update_users']))
            {
                if (!filter_input(INPUT_GET, "update_users", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_users", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier(filter_input(INPUT_GET, "update_users", FILTER_VALIDATE_INT));
                        $civilite = $DetailsUtilisateur['civilite'];
                        $password = $DetailsUtilisateur['password'];
                        $email =    $DetailsUtilisateur['email'];
                        $roles =    $DetailsUtilisateur['roles'];
                        $name =     $DetailsUtilisateur['name'];
                        $name2 = $DetailsUtilisateur['name2'];
                        $tel = $DetailsUtilisateur['tel'];
                        $cacher_valeur = $DetailsUtilisateur['uid'];

                    }
                    else{
                        $civilite = '';
                        $password = '';
                        $email =    '';
                        $roles =    '';
                        $name =     '';
                        $name2 = '';
                        $tel = '';
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {
                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_users", FILTER_VALIDATE_INT);
                    $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier($cacher_valeur);
                    $civilite = $DetailsUtilisateur['civilite'];
                    $password = $DetailsUtilisateur['password'];
                    $email =    $DetailsUtilisateur['email'];
                    $roles =    $DetailsUtilisateur['roles'];
                    $name =     $DetailsUtilisateur['name'];
                    $name2 = $DetailsUtilisateur['name2'];
                    $tel = $DetailsUtilisateur['tel'];
                    $cacher_name = 'modif_cacher_utilisateur';
                }
                else{
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher_utilisateur';
                    $civilite = 0;
                    $password = '';
                    $email =    '';
                    $roles =    '';
                    $name =     '';
                    $name2 = '';
                    $tel = '';
                    $cacher_valeur = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_utilisateur';
                $civilite = 0;
                $password = '';
                $email =    '';
                $roles =    '';
                $name =     '';
                $name2 = '';
                $tel = '';
                $cacher_valeur = '';
                $ajouter_ou_modifier = 'Ajouter';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=utilisateur'),
                    'label_civilite' => $form->label('Civilité'),
                    'civilite' => $form->selectClassique(array(0=>'Mr',1=>'Mme',2=>'Mlle'),'civilite', 0),

                    'label_password' => $form->label('Mot de passe'),
                    'password' => $form->input('password','password',$password),

                    'label_email' => $form->label('Email'),
                    'email' => $form->input('text','email',$email),

                    'label_roles' => $form->label('Roles'),
                    'roles' => $form->selectClassique($ModelUtilisateur->ListerRoleRecherche(),'role', $roles),

                    'label_nom' => $form->label('Nom'),
                    'nom' => $form->input('text','name',$name),


                     'label_prenom' => $form->label('Prenom'),
                    'prenom' => $form->input('text','name2',$name2),

                    'label_tel' => $form->label('Tel'),
                    'tel' => $form->input('text','tel',$tel),

                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueUtilisateurAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'utilisateur_show':
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],10) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'show');
            include ('model/modelUtilisateur.php');
            $ModelUtilisateur = new modelUtilisateur($mysqli);

            if(isset($_GET['show_users']))
            {

                if (!filter_input(INPUT_GET, "show_users", FILTER_VALIDATE_INT))
                {
                    $civilite = '';
                    $email =    '';
                    $roles =    '';
                    $name =     '';
                    $name2 = '';
                    $tel = '';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "show_users", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier(filter_input(INPUT_GET, "show_users", FILTER_VALIDATE_INT));
                        $civilite = $DetailsUtilisateur['civilite'];
                        $email =    $DetailsUtilisateur['email'];
                        $roles =    $DetailsUtilisateur['roles'];
                        $name =     $DetailsUtilisateur['name'];
                        $name2 = $DetailsUtilisateur['name2'];
                        $tel = $DetailsUtilisateur['tel'];

                    }
                    else{
                        $civilite = '';
                        $email =    '';
                        $roles =    '';
                        $name =     '';
                        $name2 = '';
                        $tel = '';
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier(filter_input(INPUT_GET, "show_users", FILTER_VALIDATE_INT));
                    $civilite = $DetailsUtilisateur['civilite'];
                    $email =    $DetailsUtilisateur['email'];
                    $roles =    $DetailsUtilisateur['roles'];
                    $name =     $DetailsUtilisateur['name'];
                    $name2 = $DetailsUtilisateur['name2'];
                    $tel = $DetailsUtilisateur['tel'];

                }
                else{
                    $civilite = '';
                    $email =    '';
                    $roles =    '';
                    $name =     '';
                    $name2 = '';
                    $tel = '';

                }

            }
            else
            {

                $civilite = 0;
                $email =    '';
                $roles =    '';
                $name =     '';
                $name2 = '';
                $tel = '';
            }
            $variables = array(
                'details'=>array(
                    'civilite' => $civilite,
                    'email' => $email,
                    'roles' => $roles,
                    'nom' => $name,
                    'prenom' => $name2,
                    'tel' => $tel,
                ),
            );
            include ('vue/vueUtilisateurShow.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'utilisateur_delete':
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],10) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],10,'show');
            include ('model/modelUtilisateur.php');
            $ModelUtilisateur = new modelUtilisateur($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['delete_users']))
            {

                if (!filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT))
                {
                   $uid = 0;
                    $reponse = 'ce lien ne contient rien';
                    $droitDeSupprimer = 0;
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    debug(filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT));
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier(filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT));
                        $uid = filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT);
                        $reponse = 'Voulez vous vraiment vous supprimer '.$DetailsUtilisateur['name'].' de la liste des utilisateurs';
                        $droitDeSupprimer = 1;


                    }
                    else{
                        $uid = 0;
                        $reponse = 'Vous ne pouvez pas supprimer une donnée que vous avez pas créer';
                        $droitDeSupprimer = 0;
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier(filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT));
                    $uid = filter_input(INPUT_GET, "delete_users", FILTER_VALIDATE_INT);
                    $reponse = 'Voulez vous vraiment supprimer '.$DetailsUtilisateur['name'].' de la liste des utilisateurs';
                    $droitDeSupprimer = 1;

                }
                else{
                    $uid = 0;
                    $reponse = 'Vous ne pouvez pas le droit de supprimer une donnée';
                    $droitDeSupprimer = 0;

                }

            }
            else
            {

                $uid = 0;
                $reponse = 'Vous devez selectionner la donnée à supprimer';
                $droitDeSupprimer = 0;

            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=utilisateur'),
                    'uid' => $form->input('hidden','delete_uid',$uid),
                    'submit' => $form->submitform('Confirmer la suppression'),
                    'fin_form' => $form->formsurfix(),
                ),
                'details'=>array(
                    'reponse' => $reponse,
                    'droitDeSupprimer' => $droitDeSupprimer,
                )
            );
            include ('vue/vueUtilisateurDelete.php');
        else:
             include ('vue/erreur_access_page.php');
         endif;

        break;
    case 'profile' :
        include ('model/modelUtilisateur.php');
        $ModelUtilisateur = new modelUtilisateur($mysqli);
        $DetailsUtilisateur = $ModelUtilisateur->DetailsUtilisateurAmodifier($_SESSION['id_users']);
        $variables = array(
            'details'=>array(
                'civilite' => $DetailsUtilisateur['civilite'],
                'email' => $DetailsUtilisateur['email'],
                'roles' => $DetailsUtilisateur['roles'],
                'nom' => $DetailsUtilisateur['name'],
                'prenom' => $DetailsUtilisateur['name2'],
                'tel' => $DetailsUtilisateur['tel'],
            ),
        );
        include ('vue/vueUtilisateurProfile.php');
        break;
    case 'content_types' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],14) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelContentTypes.php');
            $ModelContentTypes = new ContentTypes($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['libele_content_types']))
            {
                $expression_recherche = array(
                    'libele_content_types'=>chaineProteger(filter_input(INPUT_GET, "libele_content_types", FILTER_SANITIZE_STRING)),
                );
            }
            elseif(isset($_POST['libele_content_types']))
            {
                $expression_recherche = array(
                    'libele_content_types'=>chaineProteger(filter_input(INPUT_POST, "libele_content_types", FILTER_SANITIZE_STRING)),

                );

            }
            else
            {
                $expression_recherche = '';
            }
            if(isset($_POST['ajout_cacher_content_types']))
            {
                $ModelContentTypes->AjouterContentTypes(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
               ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';
            }
            elseif(isset($_POST['modif_cacher_content_types']))
            {
                $ModelContentTypes->ModifierContentTypes(array(
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
                    'id_content_types'=>filter_input(INPUT_POST, "modif_cacher_content_types", FILTER_VALIDATE_INT)
                 ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }
            elseif(isset($_POST['delete_content_types']))
            {
                $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'delete');

                if($DroitDeVoirContenu == 2)
                {
                    $ModelContentTypes->SupprimerContentTypes(filter_input(INPUT_POST, "delete_content_types", FILTER_VALIDATE_INT));
                    $reponse = 'Type de contenu supprimer avec succes !!!';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_POST, "delete_content_types", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ModelContentTypes->SupprimerContentTypes(filter_input(INPUT_POST, "delete_content_types", FILTER_VALIDATE_INT));
                        $reponse = 'type de contenu supprimer avec succes !!!';
                    }
                    else
                    {
                        $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                    }

                }
                elseif ($DroitDeVoirContenu == 0)
                {
                    $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                }

            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelContentTypes->NombreTotalContentTypes($modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show'),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listerutilisateur' =>$ModelContentTypes->ListerContentTypes($modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show'),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users'],$expression_recherche),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('content_types',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'],$expression_recherche),
                'form_rechercher' =>array(
                    'form' => $form->form('rechercher_utilisateur','index2.php?action=content_types'),
                    'libelle' => $form->input('text','libele_content_types'),
                    'submit' => $form->submitform('Rechercher'),
                    'fin_form' => $form->formsurfix(),)
            );
            include ('vue/vueContentTypes.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'content_types_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],14) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show');
            include ('model/modelContentTypes.php');
            $ModelContentTypes = new ContentTypes($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            if(isset($_GET['update_content_types']))
            {
                if (!filter_input(INPUT_GET, "update_content_types", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_content_types", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsUtilisateur = $ModelContentTypes->DetailsContentTypesAmodifier(filter_input(INPUT_GET, "update_content_types", FILTER_VALIDATE_INT));
                        $libele = $DetailsUtilisateur['libele'];
                        $cacher_valeur = $DetailsUtilisateur['id_content_types'];

                    }
                    else{
                        $libele = '';
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {
                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_content_types", FILTER_VALIDATE_INT);
                    $DetailsUtilisateur = $ModelContentTypes->DetailsContentTypesAmodifier($cacher_valeur);
                    $libele = $DetailsUtilisateur['libele'];
                    $cacher_name = 'modif_cacher_content_types';
                }
                else{
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher_content_types';
                    $libele = '';
                    $cacher_valeur = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_content_types';
                $libele = '';
                $ajouter_ou_modifier = 'Ajouter';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=content_types'),

                    'label_libele' => $form->label('Libele'),
                    'libele' => $form->input('text','libele',$libele),
                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueContentTypesAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'content_types_delete' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],14) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show');
            include ('model/modelContentTypes.php');
            $ModelContentTypes = new ContentTypes($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['delete_content_types']))
            {

                if (!filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT))
                {
                    $id_content_types = 0;
                    $reponse = 'ce lien ne contient rien';
                    $droitDeSupprimer = 0;
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    debug(filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT));
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsContentTypes = $ModelContentTypes->DetailsContentTypesAmodifier(filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT));
                        $uid = filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT);
                        $reponse = 'Voulez vous vraiment vous supprimer '.$DetailsContentTypes['name'].' de la liste des utilisateurs';
                        $droitDeSupprimer = 1;

                    }
                    else{
                        $id_content_types = 0;
                        $reponse = 'Vous ne pouvez pas supprimer une donnée que vous avez pas créer';
                        $droitDeSupprimer = 0;
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsContentTypes = $ModelContentTypes->DetailsContentTypesAmodifier(filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT));
                    $id_content_types = filter_input(INPUT_GET, "delete_content_types", FILTER_VALIDATE_INT);
                    $reponse = 'Voulez vous vraiment supprimer '.$DetailsContentTypes['libele'].' de la liste des utilisateurs';
                    $droitDeSupprimer = 1;

                }
                else{
                    $id_content_types = 0;
                    $reponse = 'Vous ne pouvez pas le droit de supprimer une donnée';
                    $droitDeSupprimer = 0;

                }

            }
            else
            {

                $id_content_types = 0;
                $reponse = 'Vous devez selectionner la donnée à supprimer';
                $droitDeSupprimer = 0;

            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=content_types'),
                    'id_content_types' => $form->input('hidden','delete_content_types',$id_content_types),
                    'submit' => $form->submitform('Confirmer la suppression'),
                    'fin_form' => $form->formsurfix(),
                ),
                'details'=>array(
                    'reponse' => $reponse,
                    'droitDeSupprimer' => $droitDeSupprimer,
                )
            );
            include ('vue/vueContentTypesDelete.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'content_types_structure' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],14) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelContentTypesStructure.php');
            $ModelContentTypesStructure = new ContentTypesStructure($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['libele_content_types_structure']))
            {
                $expression_recherche = array(
                    'libele_content_types_structure'=>chaineProteger(filter_input(INPUT_GET, "libele_content_types_structure", FILTER_SANITIZE_STRING)),
                );
            }
            elseif(isset($_POST['libele_content_types_structure']))
            {
                $expression_recherche = array(
                    'libele_content_types_structure'=>chaineProteger(filter_input(INPUT_POST, "libele_content_types_structure", FILTER_SANITIZE_STRING)),

                );

            }
            else
            {
                $expression_recherche = '';
            }
            if(isset($_POST['ajout_cacher_content_types_structure']))
            {
                $ModelContentTypesStructure->AjouterContentTypesStructure(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';
            }
            elseif(isset($_POST['modif_cacher_content_types_structure']))
            {
                $ModelContentTypesStructure->ModifierContentTypesStructure(array(
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
                    'id_content_types_structure'=>filter_input(INPUT_POST, "modif_cacher_content_types", FILTER_VALIDATE_INT)
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }
            elseif(isset($_POST['delete_content_types_structure']))
            {
                $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'delete');

                if($DroitDeVoirContenu == 2)
                {
                    $ModelContentTypesStructure->SupprimerContentTypesStructure(filter_input(INPUT_POST, "delete_content_types_structure", FILTER_VALIDATE_INT));
                    $reponse = 'Type de contenu supprimer avec succes !!!';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_POST, "delete_content_types_structure", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ModelContentTypesStructure->SupprimerContentTypesStructure(filter_input(INPUT_POST, "delete_content_types_structure", FILTER_VALIDATE_INT));
                        $reponse = 'type de contenu supprimer avec succes !!!';
                    }
                    else
                    {
                        $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                    }

                }
                elseif ($DroitDeVoirContenu == 0)
                {
                    $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                }

            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelContentTypesStructure->NombreTotalContentTypesStructure($modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show'),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listerutilisateur' =>$ModelContentTypesStructure->ListerContentTypesStructure($modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show'),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users'],$expression_recherche),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('content_types_structure',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'],$expression_recherche),
                'form_rechercher' =>array(
                    'form' => $form->form('rechercher_utilisateur','index2.php?action=content_types_structure'),
                    'libelle' => $form->input('text','libele_content_types_structure'),
                    'submit' => $form->submitform('Rechercher'),
                    'fin_form' => $form->formsurfix(),)
            );
            include ('vue/vueContentTypesStructure.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'content_types_structure_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],14) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'show');
            include ('model/modelContentTypesStructure.php');
            $ModelContentTypesStructure = new ContentTypesStructure($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            if(isset($_GET['update_content_types_structure']))
            {
                if (!filter_input(INPUT_GET, "update_content_types_structure", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_content_types_structure", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsContentTypesStructure = $ModelContentTypesStructure->DetailsContentTypesStructureAmodifier(filter_input(INPUT_GET, "update_content_types_structure", FILTER_VALIDATE_INT));
                        $types_content = $DetailsContentTypesStructure['types_content'];
                        $machine_name = $DetailsContentTypesStructure['machine_name'];
                        $types = $DetailsContentTypesStructure['types'];
                        $label = $DetailsContentTypesStructure['label'];
                        $cacher_valeur = $DetailsContentTypesStructure['id_content_types_structure'];

                    }
                    else{
                        $types_content = '';
                        $machine_name = '';
                        $types = '';
                        $label = '';
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {
                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_content_types_structure", FILTER_VALIDATE_INT);
                    $DetailsContentTypesStructure = $ModelContentTypesStructure->DetailsContentTypesStructureAmodifier($cacher_valeur);
                    $types_content = $DetailsContentTypesStructure['types_content'];
                    $machine_name = $DetailsContentTypesStructure['machine_name'];
                    $types = $DetailsContentTypesStructure['types'];
                    $label = $DetailsContentTypesStructure['label'];
                    $cacher_name = 'modif_cacher_content_types_structure';
                }
                else{
                    $cacher_name = 'ajout_cacher_content_types_structure';
                    $types_content = '';
                    $machine_name = '';
                    $types = '';
                    $label = '';
                    $cacher_valeur = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_content_types_structure';
                $types_content = '';
                $machine_name = '';
                $types = '';
                $label = '';
                $ajouter_ou_modifier = 'Ajouter';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=content_types_structure'),

                    'label_libele' => $form->label('Label'),
                    'label' => $form->input('text','label',$label),
                    'label_types_content' => $form->label('Types contenu'),
                    'types_content' => $form->selectClassique($ModelContentTypesStructure->ListerTypeMenu(),'types_content', $types_content),
                    'label_machine_name' => $form->label('Nom machine'),
                    'machine_name' => $form->input('text','machine_name',$machine_name),
                    'label_types' => $form->label('Types du champs'),
                    'types' => $form->selectClassique($ModelContentTypesStructure->TypesChamps(),'types', $types),
                    'body' =>$form->teatareaCkeditor('body',''),
                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueContentTypesStructureAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'content_types_structure_delete' :
        break;
    case 'menu_front' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelMenuFront.php');
            $ModelMenuFront = new MenuFront($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            include ('model/modelFile.php');
            $file = new File($mysqli);

            if(isset($_GET['libele_menu_front']))
            {
                $expression_recherche = array(
                    'libele_menu_front'=>chaineProteger(filter_input(INPUT_GET, "libele_menu_front", FILTER_SANITIZE_STRING)),
                );
            }
            elseif(isset($_POST['libele_menu_front']))
            {
                $expression_recherche = array(
                    'libele_menu_front'=>chaineProteger(filter_input(INPUT_POST, "libele_menu_front", FILTER_SANITIZE_STRING)),

                );

            }
            else
            {
                $expression_recherche = '';
            }
            if(isset($_POST['ajout_cacher_menu_front']))
            {
                if(isset($_POST['actifs']))
                {
                    $actifs = filter_input(INPUT_POST, "actifs", FILTER_VALIDATE_INT);
                }
                else
                {
                    $actifs = 0;
                }
                if($_FILES['banniere']['name'] == '')
                {
                    $fid_banniere = 0;
                }
                else{
                    $fid_banniere =$file->File_upload($_FILES['banniere']);
                }

                $ModelMenuFront->AjouterMenuFront(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
                    'liens' =>chaineProteger(filter_input(INPUT_POST, "liens", FILTER_SANITIZE_STRING)),
                    'parent' =>filter_input(INPUT_POST, "parent", FILTER_VALIDATE_INT),
                    'actifs' =>$actifs,
                    'fid'=>$fid_banniere,
                    'order' => filter_input(INPUT_POST, "order", FILTER_VALIDATE_INT),
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';
            }
            elseif(isset($_POST['modif_cacher_menu_front']))
            {
                if(isset($_POST['actifs']))
                {
                    $actifs = filter_input(INPUT_POST, "actifs", FILTER_VALIDATE_INT);
                }
                else
                {
                    $actifs = 0;
                }
                if($_FILES['banniere']['name'] == '')
                {
                    if(filter_input(INPUT_POST, "cacher_fid", FILTER_VALIDATE_INT) ==0 )
                    {
                        $fid_banniere = 0;
                    }
                    else{$fid_banniere = filter_input(INPUT_POST, "cacher_fid", FILTER_VALIDATE_INT);}


                }
                else{
                    $fid_banniere =$file->File_upload($_FILES['banniere']);
                }


                $ModelMenuFront->ModifierMenuFront(array(
                    'libele' =>chaineProteger(filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING)),
                    'parent'=>filter_input(INPUT_POST, "parent", FILTER_VALIDATE_INT),
                    'liens' =>chaineProteger(filter_input(INPUT_POST, "liens", FILTER_SANITIZE_STRING)),
                    'actifs' =>$actifs,
                    'fid'=>$fid_banniere,
                    'order' => filter_input(INPUT_POST, "order", FILTER_VALIDATE_INT),
                    'id_menu'=>filter_input(INPUT_POST, "modif_cacher_menu_front", FILTER_VALIDATE_INT)
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }
            elseif(isset($_POST['delete_menu_front']))
            {
                $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],14,'delete');

                if($DroitDeVoirContenu == 2)
                {
                    foreach ($ModelMenuFront->liens_images_A_supprimer(filter_input(INPUT_POST, "delete_menu_front", FILTER_VALIDATE_INT)) as $valueToDelete)
                    {
                        $file->Supprimer_images($file->Url_images($valueToDelete));
                        $file->DeleteFieldsFilemanaged($valueToDelete);
                        $ModelMenuFront->SupprimerMenuFront(filter_input(INPUT_POST, "delete_menu_front", FILTER_VALIDATE_INT));
                    }

                    $reponse = 'Mneu supprimer avec succes !!!';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_POST, "delete_menu_front", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        foreach ($ModelMenuFront->liens_images_A_supprimer(filter_input(INPUT_POST, "delete_menu_front", FILTER_VALIDATE_INT)) as $valueToDelete)
                        {
                            $file->Supprimer_images($file->Url_images($valueToDelete));
                            $file->DeleteFieldsFilemanaged($valueToDelete);
                            $ModelMenuFront->SupprimerMenuFront(filter_input(INPUT_POST, "delete_menu_front", FILTER_VALIDATE_INT));
                        }

                        $reponse = 'type de contenu supprimer avec succes !!!';
                    }
                    else
                    {
                        $reponse = 'Vous ne pouvez pas supprimer ce menu';
                    }

                }
                elseif ($DroitDeVoirContenu == 0)
                {
                    $reponse = 'Vous ne pouvez pas supprimer ce menu';
                }

            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelMenuFront->NombreTotalMenuFront($modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show'),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listerutilisateur' =>$ModelMenuFront->ListerMenuFront($modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show'),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users'],$expression_recherche),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('menu_front',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'],$expression_recherche),
                'form_rechercher' =>array(
                    'form' => $form->form('rechercher_utilisateur','index2.php?action=menu_front'),
                    'libelle' => $form->input('text','libele_menu_front'),
                    'submit' => $form->submitform('Rechercher'),
                    'fin_form' => $form->formsurfix(),)
            );
            include ('vue/vueMenuFront.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'menu_front_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show');
            include ('model/modelMenuFront.php');
            $ModelMenuFront = new MenuFront($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            include ('model/modelFile.php');
            $file = new File($mysqli);

            if(isset($_GET['update_menu_front']))
            {
                if (!filter_input(INPUT_GET, "update_menu_front", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_menu_front", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier(filter_input(INPUT_GET, "update_menu_front", FILTER_VALIDATE_INT));
                        $libele = $DetailsMenuFront['libele'];
                        $cacher_valeur = $DetailsMenuFront['id_menu'];
                        $parent = $DetailsMenuFront['parent'];
                        $liens = $DetailsMenuFront['liens'];
                        $actifs = $DetailsMenuFront['actifs'];
                        $order = $DetailsMenuFront['ordre'];
                        $fid = $DetailsMenuFront['fid'];
                        $banniere = $DetailsMenuFront['fid'];
                        if($banniere != 0)
                        {
                            $banniere_image ='<img  src='.$file->Url_images($banniere).' class="img-responsive" />';
                        }
                        else
                        {
                            $banniere_image ='';
                        }

                    }
                    else{
                        $libele = '';
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                        $parent = '';
                        $liens = '';
                        $actifs = 2;
                        $order = '';
                        $fid = '';
                        $banniere_image ='';

                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {
                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_menu_front", FILTER_VALIDATE_INT);
                    $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier($cacher_valeur);
                    $libele = $DetailsMenuFront['libele'];
                    $parent = $DetailsMenuFront['parent'];
                    $cacher_name = 'modif_cacher_menu_front';
                    $liens = $DetailsMenuFront['liens'];
                    $actifs = $DetailsMenuFront['actifs'];
                    $order = $DetailsMenuFront['ordre'];
                    $banniere = $DetailsMenuFront['fid'];
                    $fid = $DetailsMenuFront['fid'];
                    if($banniere != 0)
                    {
                        $banniere_image ='<img  src='.$file->Url_images($banniere).' class="img-responsive" />';
                    }
                    else
                    {
                        $banniere_image ='';
                    }

                }
                else{
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher_menu_front';
                    $libele = '';
                    $parent = '';
                    $liens = '';
                    $actifs = 2;
                    $cacher_valeur = '';
                    $ajouter_ou_modifier = 'Ajouter';
                    $order = '';
                    $fid = '';
                    $banniere_image ='';
                    $banniere = '';
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_menu_front';
                $libele = '';
                $parent = '';
                $fid = '';
                $banniere_image ='';
                $liens = '';
                $actifs = 2;
                $order = '';
                $ajouter_ou_modifier = 'Ajouter';
                $banniere = '';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=menu_front'),

                    'label_libele' => $form->label('Libele'),
                    'libele' => $form->input('text','libele',$libele),
                    'label_liens' => $form->label('Liens'),
                    'liens' => $form->input('text','liens',$liens),
                    'label_order' => $form->label('Ordre affichage de menu'),
                    'order' => $form->input('text','order',$order),
                    'label_actifs' => $form->label('Actif'),
                    'actifs' => $form->checkbox('actifs',1,$actifs),
                    'label_parent'=>$form->label('Parent'),
                    'parent'=> $form->selectClassique($ModelMenuFront->ListerMenuForm(),'parent',$parent),
                    'label_banniere' => $form->label('Bannière'),
                    'banniere' => $form->input('file','banniere',''),
                    'banniere_image' =>$banniere_image,
                    'cacher_fid' => $form->input('hidden','cacher_fid',$banniere),
                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueMenuFrontAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'menu_front_show' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show');
            include ('model/modelMenuFront.php');
            $ModelMenuFront = new MenuFront($mysqli);

            if(isset($_GET['menu_front_show']))
            {

                if (!filter_input(INPUT_GET, "menu_front_show", FILTER_VALIDATE_INT))
                {
                    $civilite = '';
                    $email =    '';
                    $roles =    '';
                    $name =     '';
                    $name2 = '';
                    $tel = '';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "menu_front_show", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier(filter_input(INPUT_GET, "menu_front_show", FILTER_VALIDATE_INT));
                        $libele = $DetailsMenuFront['libele'];
                        $parent =    $DetailsMenuFront['parent'];
                        $actifs =    $DetailsMenuFront['actifs'];
                        $liens =     $DetailsMenuFront['liens'];
                        $ordre = $DetailsMenuFront['ordre'];

                    }
                    else{
                        $libele = '';
                        $parent = '';
                        $actifs =  '';
                        $liens =  '';
                        $ordre = '';
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier(filter_input(INPUT_GET, "menu_front_show", FILTER_VALIDATE_INT));
                    $libele = $DetailsMenuFront['libele'];
                    $parent =    $DetailsMenuFront['parent'];
                    $actifs =    $DetailsMenuFront['actifs'];
                    $liens =     $DetailsMenuFront['liens'];
                    $ordre = $DetailsMenuFront['ordre'];

                }
                else{
                    $libele = '';
                    $parent = '';
                    $actifs = '';
                    $liens =  '';
                    $ordre = '';

                }

            }
            else
            {

                $libele = '';
                $parent = '';
                $actifs = '';
                $liens =  '';
                $ordre = '';
            }
            $variables = array(
                'details'=>array(
                    'libele' => $libele,
                    'parent' => $parent,
                    'actifs' => $actifs,
                    'liens' => $liens,
                    'ordre' => $ordre,
                ),
            );
            include ('vue/vueMenuFrontShow.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'menu_front_delete' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show');
            include ('model/modelMenuFront.php');
            $ModelMenuFront = new MenuFront($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['delete_menu_front']))
            {

                if (!filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT))
                {
                    $id_menu = 0;
                    $reponse = 'ce lien ne contient rien';
                    $droitDeSupprimer = 0;
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    debug(filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT));
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier(filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT));
                        $uid = filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT);
                        $reponse = 'Voulez vous vraiment vous supprimer '.$DetailsMenuFront['libele'].' de la liste des utilisateurs';
                        $droitDeSupprimer = 1;

                    }
                    else{
                        $id_menu = 0;
                        $reponse = 'Vous ne pouvez pas supprimer une donnée que vous avez pas créer';
                        $droitDeSupprimer = 0;
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsMenuFront = $ModelMenuFront->DetailsMenuFrontAmodifier(filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT));
                    $id_menu = filter_input(INPUT_GET, "delete_menu_front", FILTER_VALIDATE_INT);
                    $reponse = 'Voulez vous vraiment supprimer '.$DetailsMenuFront['libele'].' de la liste des utilisateurs';
                    $droitDeSupprimer = 1;

                }
                else{
                    $id_menu = 0;
                    $reponse = 'Vous ne pouvez pas le droit de supprimer une donnée';
                    $droitDeSupprimer = 0;

                }

            }
            else
            {

                $id_menu = 0;
                $reponse = 'Vous devez selectionner la donnée à supprimer';
                $droitDeSupprimer = 0;

            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('menu_admin','index2.php?action=menu_front'),
                    'id_menu' => $form->input('hidden','delete_menu_front',$id_menu),
                    'submit' => $form->submitform('Confirmer la suppression'),
                    'fin_form' => $form->formsurfix(),
                ),
                'details'=>array(
                    'reponse' => $reponse,
                    'droitDeSupprimer' => $droitDeSupprimer,
                )
            );
            include ('vue/vueMenuFrontDelete.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'content' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],2) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelContent.php');
            $ModelContent = new Content($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();




            if(isset($_GET['libele_content_title']))
            {
                $expression_recherche = array(
                    'libele_content_title'=>chaineProteger(filter_input(INPUT_GET, "libele_content_title", FILTER_SANITIZE_STRING)),
                    'libele_content_types'=>filter_input(INPUT_GET, "libele_content_types", FILTER_VALIDATE_INT)
                );
            }
            elseif(isset($_POST['libele_content_title']))
            {
                $expression_recherche = array(
                    'libele_content_title'=>chaineProteger(filter_input(INPUT_POST, "libele_content_title", FILTER_SANITIZE_STRING)),
                    'libele_content_types'=>filter_input(INPUT_POST, "libele_content_types", FILTER_VALIDATE_INT)

                );

            }
            else
            {
                $expression_recherche = '';
            }

            if(isset($_POST['ajout_cacher_content_edito']))
            {

                 if(isset($_POST['status']))
                {
                    $status = filter_input(INPUT_POST, "status", FILTER_VALIDATE_INT);
                }
                else
                {
                    $status = 0;
                }

               $ModelContent->AjouterContentEdito(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'title' =>chaineProteger(filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING)),
                    'status' =>$status,
                    'body'=>$_POST['body'],
                    'id_content_types'=>3
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';

            }
            elseif(isset($_POST['modif_cacher_content_edito']))
            {

                if(isset($_POST['status']))
                {
                    $status = filter_input(INPUT_POST, "status", FILTER_VALIDATE_INT);
                }
                else
                {
                    $status = 0;
                }

                $ModelContent->ModifierContentEdito(array(
                    'title' =>chaineProteger(filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING)),
                    'status' =>$status,
                    'body'=>$_POST['body'],
                    'nid'=>filter_input(INPUT_POST, "modif_cacher_content_edito", FILTER_VALIDATE_INT)
                ));
                $reponse = filter_input(INPUT_POST, "libele", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }
            elseif(isset($_POST['delete_content']))
            {
                $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'delete');

                if($DroitDeVoirContenu == 2)
                {


                    foreach ($ModelContent->liens_images_A_supprimer(filter_input(INPUT_POST, "delete_content", FILTER_VALIDATE_INT)) as $valueToDelete)
                    {
                        $file->Supprimer_images($file->Url_images($valueToDelete));
                        $file->DeleteFieldsFilemanaged($valueToDelete);
                        $ModelContent->SupprimerContent(filter_input(INPUT_POST, "delete_content", FILTER_VALIDATE_INT));
                    }
                    $reponse = 'contenu supprimer avec succes !!!';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_POST, "delete_content", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        foreach ($ModelContent->liens_images_A_supprimer(filter_input(INPUT_POST, "delete_content", FILTER_VALIDATE_INT)) as $valueToDelete)
                        {
                            $file->Supprimer_images($file->Url_images($valueToDelete));
                            $file->DeleteFieldsFilemanaged($valueToDelete);
                            $ModelContent->SupprimerContent(filter_input(INPUT_POST, "delete_content", FILTER_VALIDATE_INT));
                        }

                        $reponse = 'type de contenu supprimer avec succes !!!';
                    }
                    else
                    {
                        $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                    }

                }
                elseif ($DroitDeVoirContenu == 0)
                {
                    $reponse = 'Vous ne pouvez pas supprimer ce contenu';
                }

            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelContent->NombreTotalContent($modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'show'),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listerutilisateur' =>$ModelContent->ListerContent($modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'show'),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users'],$expression_recherche),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('content',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'],$expression_recherche),
                'form_rechercher' =>array(
                    'form' => $form->form('rechercher_utilisateur','index2.php?action=content'),
                    'libelle' => $form->input('text','libele_content'),
                    'submit' => $form->submitform('Rechercher'),
                    'fin_form' => $form->formsurfix(),)
            );
            include ('vue/vueContent.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'content_add' :
        include ('vue/vueContentAdd.php');
        break;
    case 'edito_show' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],2) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],9,'show');
            include ('model/modelContent.php');
            $ModelContent = new Content($mysqli);
            include ('model/modelUtilisateur.php');
            $ModelUtilisateur = new modelUtilisateur($mysqli);
            include ('model/modelFile.php');
            $file = new File($mysqli);

            if(isset($_GET['content_show']))
            {

                if (!filter_input(INPUT_GET, "content_show", FILTER_VALIDATE_INT))
                {
                    $titre = '';
                    $banniere =    '';
                    $status = '';
                    $created =     '';
                    $author = '';
                    $body = '';
                    $types_content = '';
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "content_show", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsContentEdito = $ModelContent->DetailsContentEditoAmodifier(filter_input(INPUT_GET, "content_show", FILTER_VALIDATE_INT));
                        $titre = $DetailsContentEdito['title'];
                        $banniere =  '<img  src='.$file->Url_images($DetailsContentEdito['fid']).' class="img-responsive" />';;
                        $status = $DetailsContentEdito['status'];
                        $created =    $DetailsContentEdito['created'];
                        $author = $ModelUtilisateur->DetailsUtilisateurAmodifier($DetailsContentEdito['uid_created']);
                        $author = $author['name'];
                        $body = $DetailsContentEdito['data_body_value'];
                        $types_content = 'Edito';
                    }
                    else{
                        $titre = '';
                        $banniere = '';
                        $status = '';
                        $created = '';
                        $author = '';
                        $body = '';
                        $types_content = '';
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsContentEdito = $ModelContent->DetailsContentEditoAmodifier(filter_input(INPUT_GET, "content_show", FILTER_VALIDATE_INT));
                    $titre = $DetailsContentEdito['title'];
                    $banniere =  '<img  src='.$file->Url_images($DetailsContentEdito['fid']).' class="img-responsive" />';
                    $status = $DetailsContentEdito['status'];
                    $created =    $DetailsContentEdito['created'];
                    $author = $DetailsContentEdito['uid_created'];
                    $author = $ModelUtilisateur->DetailsUtilisateurAmodifier($DetailsContentEdito['uid_created']);
                    $author = $author['name'];
                    $body = $DetailsContentEdito['data_body_value'];
                    $types_content = 'Edito';

                }
                else{
                    $titre = '';
                    $banniere = '';
                    $status = '';
                    $created = '';
                    $author = '';
                    $body = '';
                    $types_content = '';

                }

            }
            else
            {
                $titre = '';
                $banniere = '';
                $status = '';
                $created = '';
                $author = '';
                $body = '';
                $types_content = '';
          }
            $variables = array(
                'details'=>array(
                    'titre' => $titre,
                    'banniere' => $banniere,
                    'status' => $status,
                    'created' => $created,
                    'author' => $author,
                    'body' => $body,
                    'type_content' => $types_content,
                ),
            );
            include ('vue/vueContentEditoShow.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'content_delete' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],2) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'show');
            include ('model/modelContent.php');
            $ModelContent = new Content($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();

            if(isset($_GET['delete_content']))
            {

                if (!filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT))
                {
                    $nid = 0;
                    $reponse = 'ce lien ne contient rien';
                    $droitDeSupprimer = 0;
                }
                elseif ($DroitDeVoirContenu == 1)
                {
                    debug(filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT));
                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $DetailsContent = $ModelContent->DetailsContentDelete(filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT));
                        $nid = filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT);
                        $reponse = 'Voulez vous vraiment vous supprimer '.$DetailsContent['title'].' de la liste des contenus';
                        $droitDeSupprimer = 1;

                    }
                    else{
                        $nid = 0;
                        $reponse = 'Vous ne pouvez pas supprimer une donnée que vous avez pas créer';
                        $droitDeSupprimer = 0;
                    }
                }
                elseif ($DroitDeVoirContenu ==2)
                {
                    $DetailsContent = $ModelContent->DetailsContentDelete(filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT));
                    $nid = filter_input(INPUT_GET, "delete_content", FILTER_VALIDATE_INT);
                    $reponse = 'Voulez vous vraiment supprimer '.$DetailsContent['title'].' de la liste des contenus';
                    $droitDeSupprimer = 1;

                }
                else{
                    $nid = 0;
                    $reponse = 'Vous ne pouvez pas le droit de supprimer une donnée';
                    $droitDeSupprimer = 0;

                }

            }
            else
            {

                $nid = 0;
                $reponse = 'Vous devez selectionner la donnée à supprimer';
                $droitDeSupprimer = 0;

            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('content','index2.php?action=content'),
                    'delete_content' => $form->input('hidden','delete_content',$nid),
                    'submit' => $form->submitform('Confirmer la suppression'),
                    'fin_form' => $form->formsurfix(),
                ),
                'details'=>array(
                    'reponse' => $reponse,
                    'droitDeSupprimer' => $droitDeSupprimer,
                )
            );
            include ('vue/vueContentDelete.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'edito_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],2) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'show');
            include ('model/modelContent.php');
            $ModelContent= new Content($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            include ('model/modelFile.php');
            $file = new File($mysqli);

            if(isset($_GET['update_content']))
            {
                if (!filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {

                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsContent = $ModelContent->DetailsContentEditoAmodifier(filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT));
                        $cacher_valeur = $DetailsContent['nid'];

                        $status = $DetailsContent['status'];
                        $title = $DetailsContent['title'];
                        $body = $DetailsContent['data_body_value'];
                        $cacher_name = 'modif_cacher_content_edito';

                    }
                    else{
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                        $status = 0;
                        $title = '';
                        $body = '';
                        $cacher_name = 'ajout_cacher_content_edito';

                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {

                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT);
                    $DetailsContent = $ModelContent->DetailsContentEditoAmodifier($cacher_valeur);
                    $titre = $DetailsContent['title'];
                    $status = $DetailsContent['status'];
                    $body = $DetailsContent['data_body_value'];
                    $cacher_name = 'modif_cacher_content_edito';

                }
                else{
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher_content_edito';
                    $titre = '';

                    $body = '';
                    $ajouter_ou_modifier = 'Ajouter';
                    $status = 0;
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_content_edito';
                $titre = '';
                $body = '';
                $status = 0;
                $ajouter_ou_modifier = 'Ajouter';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('content','index2.php?action=content'),

                    'label_title' => $form->label('Titre'),
                    'titre' => $form->input('text','titre',$titre),
                    'label_body' => $form->label('Description'),
                    'body' => $form->teatareaCkeditor('body',$body),
                    'label_status' => $form->label('Publier'),
                    'status' =>$form->checkbox('status',1,$status),
                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueContentEditoAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'notre_equipe_add' :
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],2) == 1) :
            $DroitDeVoirContenu = $modelDroitAcces->DroitSurContenu($_SESSION['roles'],2,'show');
            include ('model/modelContent.php');
            $ModelContent= new Content($mysqli);
            include ('model/modelForm.php');
            $form = new modelForm();
            include ('model/modelFile.php');
            $file = new File($mysqli);

            if(isset($_GET['update_content']))
            {
                if (!filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT))
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                }
                elseif ($DroitDeVoirContenu == 1)
                {

                    if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                    {
                        $ajouter_ou_modifier = 'Modifier';
                        $DetailsContent = $ModelContent->DetailsContentEditoAmodifier(filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT));
                        $cacher_valeur = $DetailsContent['nid'];
                        $fid = $DetailsContent['fid'];
                        $status = $DetailsContent['status'];
                        $title = $DetailsContent['title'];
                        $body = $DetailsContent['data_body_value'];
                        $cacher_name = 'modif_cacher_content_equipe';
                        if($banniere != 0)
                        {
                            $banniere_image ='<img  src='.$file->Url_images($banniere).' class="img-responsive" />';
                        }
                        else
                        {
                            $banniere_image ='';
                        }

                    }
                    else{
                        $cacher_valeur = '';
                        $ajouter_ou_modifier = 'Ajouter';
                        $fid = '';
                        $status = 0;
                        $title = '';
                        $body = '';
                        $cacher_name = 'ajout_cacher_content_equipe';
                        $banniere_image ='';
                    }
                }
                elseif($DroitDeVoirContenu == 2)
                {

                    $ajouter_ou_modifier = 'Modifier';
                    $cacher_valeur = filter_input(INPUT_GET, "update_content", FILTER_VALIDATE_INT);
                    $DetailsContent = $ModelContent->DetailsContentEditoAmodifier($cacher_valeur);
                    debug($cacher_valeur);
                    $titre = $DetailsContent['title'];
                    $banniere = $DetailsContent['fid'];
                    $status = $DetailsContent['status'];
                    $body = $DetailsContent['data_body_value'];
                    $cacher_name = 'modif_cacher_content_equipe';
                    if($banniere != 0)
                    {
                        $banniere_image ='<img src='.$file->Url_images($banniere).' class="img-responsive" />';
                    }
                    else
                    {
                        $banniere_image ='';
                    }

                }
                else{
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher_content_equipe';
                    $titre = '';
                    $banniere = '';
                    $body = '';
                    $ajouter_ou_modifier = 'Ajouter';
                    $fid = '';
                    $status = 0;
                    $banniere_image = '';
                }

            }
            else
            {
                $cacher_valeur = '';
                $cacher_name = 'ajout_cacher_content_equipe';
                $titre = '';
                $banniere = '';
                $body = '';
                $status = 0;
                $ajouter_ou_modifier = 'Ajouter';
                $banniere_image = '';
            }
            $variables = array(
                'form'=>array(
                    'form' => $form->form('content','index2.php?action=content'),

                    'label_title' => $form->label('Titre'),
                    'titre' => $form->input('text','titre',$titre),
                    'label_banniere' => $form->label('Bannière'),
                    'banniere' => $form->input('file','banniere',''),
                    'banniere_image' =>$banniere_image,
                    'label_body' => $form->label('Description'),
                    'body' => $form->teatareaCkeditor('body',$body),
                    'label_status' => $form->label('Publier'),
                    'status' =>$form->checkbox('status',1,$status),
                    'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                    'cacher_fid' => $form->input('hidden','cacher_fid',$banniere),
                    'submit' => $form->submitform('valider'),
                    'fin_form' => $form->formsurfix(),
                ),
                'action' => $ajouter_ou_modifier,
            );
            include ('vue/vueContentEditoAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'actualite_add' :
        break;
    case 'nos_bureaux_add' :
        break;
    case 'domaines_intervention_add' :
        break;
    case 'evenements_add' :
        break;
    case 'nos_partenaires_add' :
        break;
    case 'page_statique_add' :
        break;
    case  'ajoutrole':
        include ('model/modelRole.php');
        include ('vue/vueAjoutRole.php');
        break;
    case 'modificationrole':
        include ('model/modelRole.php');
        include ('vue/vueModificationRole.php');
        break;
    case 'configdroit' :
        include ('model/modelConfigDroit.php');
        $modelconfigdroit = new droitAcess($mysqli);

        $variables = array(
            'rolelister'=> $modelconfigdroit->ListerRoles(),
            'entitylister' =>$modelconfigdroit->ListerEntite()
        );
        if(isset($_POST['droit_access']))
        {
            $modelconfigdroit->ViderDdroit();
            foreach ($_POST as $keys =>$value)
            {
                if($keys != 'droit_access')
                {

                    $modelconfigdroit->EngisterDroits($keys);
                }
            }
            $reponse= 'Les droits ont été changés avec succes';
        }
        include ('vue/vueConfigDroit.php');
        break;
    case 'menu_admin':
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
            include ('model/modelSystemeContenu.php');
            $modelSystemeContenu = new modelSystemeContenu();
            include ('model/modelMenu.php');
            $ModelMenuAdmin = new ModelMenuAdmin($mysqli);
            if(isset($_POST['ajout_cacher']))
            {
                $ModelMenuAdmin->AjouterMenu(array(
                    'uid_created'=>$_SESSION['id_users'],
                    'created' =>ConvertirDatetimestamp(date('Y-m-d')),
                    'libele' =>filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING),
                ));
                $reponse = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING).' Ajouter avec succes !!!';
            }
            elseif(isset($_POST['modif_cacher']))
            {
                $ModelMenuAdmin->ModifierContenu(array(
                    'libele' =>filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING),
                    'id_entity_access' =>filter_input(INPUT_POST, "modif_cacher", FILTER_VALIDATE_INT)
                ));
                $reponse = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING).' Modifier avec succes !!!';
            }

            if(isset($_GET['page']))
            {
                $get = $_GET['page'];
            }
            else
            {
                $get = 0;
            }
            $PagginationContenu = $modelSystemeContenu->PagginationContenu($ModelMenuAdmin->NombreTotalMenu($modelDroitAcces->DroitDeVoirContenu($_SESSION['roles'],9),$_SESSION['id_users']),$get);
            $Paggination = $modelSystemeContenu->Paggination($PagginationContenu['page'],$PagginationContenu['nombreDePages']);
            $variables = array(
                'listermenu' =>$ModelMenuAdmin->ListerMenu($modelDroitAcces->DroitDeVoirContenu($_SESSION['roles'],9),$PagginationContenu['premiereEntree'],$PagginationContenu['messagesParPage'],$_SESSION['id_users']),
                'afficher_paggination' =>$modelSystemeContenu->AfficherPaggination('menu_admin',$Paggination['debut'],$Paggination['fin'],$PagginationContenu['page'],$PagginationContenu['nombreDePages'])

            );
            include ('vue/vueMenu.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;

        break;
    case 'menu_admin_add':
        if($modelDroitAcces->DroitDeVoir($_SESSION['roles'],9) == 1) :
           $DroitDeVoirContenu = $modelDroitAcces->DroitDeVoirContenu($_SESSION['roles'],9);
                include ('model/modelMenu.php');
                include ('model/modelForm.php');
                $modelMenu = new ModelMenuAdmin($mysqli);
                $form = new modelForm();
                if(isset($_GET['update_menu']))
                {
                    if (!filter_input(INPUT_GET, "update_menu", FILTER_VALIDATE_INT))
                    {
                        $menuAdministration = '';
                        $ajouter_ou_modifier = 'Ajouter';
                    }
                    elseif ($DroitDeVoirContenu == 1)
                    {
                        if($modelDroitAcces->DroitDeVoirCeContenu(filter_input(INPUT_GET, "update_menu", FILTER_VALIDATE_INT),$_SESSION['id_users'])==1)
                        {
                            $ajouter_ou_modifier = 'Modifier';
                            $menuAdministration = $modelMenu->AfficherContenuAmodifier($_GET['update_menu']);

                        }
                        else{
                            $menuAdministration = '';
                            $ajouter_ou_modifier = 'Ajouter';
                        }
                    }
                    else{
                        $ajouter_ou_modifier = 'Modifier';
                        $menuAdministration = $modelMenu->AfficherContenuAmodifier($_GET['update_menu']);
                        $cacher_valeur = filter_input(INPUT_GET, "update_menu", FILTER_VALIDATE_INT);
                        $cacher_name = 'modif_cacher';
                    }

                }
                else
                {
                    $menuAdministration = '';
                    $ajouter_ou_modifier = 'Ajouter';
                    $cacher_valeur = '';
                    $cacher_name = 'ajout_cacher';
                }
                $variables = array(
                    'form'=>array(
                        'form' => $form->form('menu_admin','index2.php?action=menu_admin'),
                        'label_libele' => $form->label('libelle'),
                        'libelle' => $form->input('text','nom',$menuAdministration),
                        'cacher' => $form->input('hidden',$cacher_name,$cacher_valeur),
                        'submit' => $form->submitform('valider'),
                        'fin_form' => $form->formsurfix(),
                    ),
                    'action' => $ajouter_ou_modifier
                );
                include ('vue/vueMenuadminAdd.php');
        else:
            include ('vue/erreur_access_page.php');
        endif;
        break;
    case 'deconnect' :
        include ("model/modelDeconnexion.php");
        $deconn = new Deconnexion();
        $deconn->DetruireSesion();
        echo '<meta http-equiv="refresh" content="1;url='.$deconn->url().'"/>';
        break;
    default :
        include ('model/modelAccueil.php');
        include ('vue/vueAccueil.php');
        break;
}
else:
    include ('vue/vueAccueil.php');
endif;

?>