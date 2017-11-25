<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 22/11/2017
 * Time: 22:04
 */

class File
{
    private $target_dir = '../images/files/';
    private $db;
    private $fid;
    public function __construct(mysqli $con) {
        $this->db = $con;
    }


    public function File_upload($fileToUpload)
    {
        if (move_uploaded_file($fileToUpload["tmp_name"], $this->target_dir.basename($fileToUpload["name"]))) {
         $this->fid = $this->File_save(array(
                'filename'=>basename($fileToUpload["name"]),
                'uri'=>$this->target_dir.basename($fileToUpload["name"]),
                'filesize' =>basename($fileToUpload["size"])
            ));
        }
        debug($this->fid);
        return $this->fid;
    }

    private function File_save($data)
    {
        $addContent = $this->db->prepare("INSERT INTO file_managed (filename,uri,filesize ) VALUES (?,?,?)");
        $addContent->bind_param('ssi',$data['filename'],$data['uri'],$data['filesize']);
        $addContent->execute();
        $retoun = $addContent->insert_id;
        $addContent->close();
        return $retoun;
    }
    public function Url_images($fid)
    {
        $sql = $this->db->query("SELECT uri FROM file_managed WHERE fid=$fid");
        $res = $sql->fetch_assoc();
        return $res['uri'];
    }

    public function Supprimer_images($uri)
    {
        if (file_exists($uri)) {
            unlink($uri);
        }
    }
    public function DeleteFieldsFilemanaged($fid)
    {
        $updateContent = $this->db->prepare("DELETE FROM file_managed  WHERE fid =?");
        $updateContent->bind_param('i',$fid);
        $updateContent->execute();
        $updateContent->close();

    }
    private function RedimensionnerImages($img, $to, $width = 0, $height = 0, $useGD = TRUE){

        $dimensions = getimagesize($img);
        $ratio      = $dimensions[0] / $dimensions[1];

        // Calcul des dimensions si 0 passé en paramètre
        if($width == 0 && $height == 0){
            $width = $dimensions[0];
            $height = $dimensions[1];
        }elseif($height == 0){
            $height = round($width / $ratio);
        }elseif ($width == 0){
            $width = round($height * $ratio);
        }

        if($dimensions[0] > ($width / $height) * $dimensions[1]){
            $dimY = $height;
            $dimX = round($height * $dimensions[0] / $dimensions[1]);
            $decalX = ($dimX - $width) / 2;
            $decalY = 0;
        }
        if($dimensions[0] < ($width / $height) * $dimensions[1]){
            $dimX = $width;
            $dimY = round($width * $dimensions[1] / $dimensions[0]);
            $decalY = ($dimY - $height) / 2;
            $decalX = 0;
        }
        if($dimensions[0] == ($width / $height) * $dimensions[1]){
            $dimX = $width;
            $dimY = $height;
            $decalX = 0;
            $decalY = 0;
        }

        // Création de l'image avec la librairie GD
        if($useGD){
            $pattern = imagecreatetruecolor($width, $height);
            $type = mime_content_type($img);
            switch (substr($type, 6)) {
                case 'jpeg':
                    $image = imagecreatefromjpeg($img);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($img);
                    break;
                case 'png':
                    $image = imagecreatefrompng($img);
                    break;
            }
            imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
            imagedestroy($image);
            imagejpeg($pattern, $to, 100);

            return TRUE;

            // Création de l'image avec ImageMagick
        }else{
            $cmd = '/usr/bin/convert -resize '.$dimX.'x'.$dimY.' "'.$img.'" "'.$dest.'"';
            shell_exec($cmd);

            $cmd = '/usr/bin/convert -gravity Center -quality '.self::$quality.' -crop '.$largeur.'x'.$hauteur.'+0+0 -page '.$largeur.'x'.$hauteur.' "'.$dest.'" "'.$dest.'"';
            shell_exec($cmd);
        }
        return TRUE;
    }
}