<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 11/11/2017
 * Time: 07:22
 */

class modelForm
{
    private $_select;

    public function label($name)
    {
        return '<label>'.$name.'</label>';
    }
    public function input($types,$nom,$valeur='')
    {
        return '<input class="form-control" type="'.$types.'" name="'.$nom.'" value="'.$valeur.'" id="'.$nom.'"/>';
    }
    public function checkbox($nom,$valeur,$valide)
    {
        if($valide== 1)
        {
            $checked=" checked='checked'";
        }
        else
        {
            $checked=" ";
        }

        return '<input class="form-control" type="checkbox" name="'.$nom.'" value="'.$valeur.'"'. $checked.' "/>';
    }
    public function textarea($name,$value="")
    {
        return '<textarea class="form-control"  name="'.$name.'" id="'.$name.'">'.$value.'</textarea>';
    }
    public function teatareaCkeditor($name,$value,$id='editor1')
    {
        return '<textarea class="ckeditor" cols="80" id="'.$id.'" name="'.$name.'" rows="10">'.$value.'</textarea>';
    }
    public function fieldset_prefix($fieldset)
    {
        return '<fieldset>';
    }
    public function fieldset_sufix()
    {
        return '</fieldset>';
    }
    public function groupeprefix()
    {
        return '<div class="form-group">';
    }

    public function groupesurfix()
    {
        return '</div>';
    }
    public function form($name,$chemin,$method='post',$enctype='multipart/form-data')
    {
        return'<form id="'.$name.'" action="'.$chemin.'"  method="'.$method.'" enctype="'.$enctype.'">';

    }
    public function formsurfix()
    {
        return'</form>';
    }
    public function alerteform()
    {
        return '<span class="erreur_message"></span>';
    }
    public function submitform($submitform)

    {
        return '<button type="submit" class="btn btn-primary">'.$submitform.'</button>';
    }
    public function submitform2($submitform)

    {
        return '<button type="submit" class="btn btn-success">'.$submitform.'</button>';
    }
    public function inputDate($name)
    {
        return '<input type="text"  name="'.$name.'" class="form-control" id="datetimepicker8"/>';
    }

    public function select($req,$firstValue,$secondValue,$name,$valeur=0)
    {
        $options = "";
        $select = "";
        foreach($req as $values)
        {
            if($values[$firstValue] == $valeur)
            {
                $select = "selected";
            }

            $options .= '<option value="'.$values[$firstValue].'"'.$select.'> '.$values[$secondValue].'</option>';
        }
        return '<select class="form-control" name="'.$name.'">'.$options.'</select>';

    }

    public function selectClassique($req,$name,$valeur)
    {
        $options = '';

        foreach($req as $kley => $value )
        {
            if($kley == $valeur)
            {
                $select = "selected ";
            }
            else
            {
                $select = " ";
            }
            $options .= '<option '.$select.' value='.$kley.'> '.$value.'</option>';
        }
        return '<select class="form-control" name="'.$name.'">'.$options.'</select>';
    }



}

?>