<?php
/**
 * REVISAR http://www.php.net/manual/en/function.imagecopyresampled.php
 * class ImgTransformer
 * 
 */
class ImgTool {
    public $output_dir = PATH_ABS_STORAGE_USERS_GALLERIES;
    public $input_dir = "input/";
    public $defaults = array(
        "social_pic_path_32" => array("width" => 32),
        "profile_pic_100" => array("width" => 100),  
        "show_pic_path_360" => array("width" => 360)
    );
        
    function __construct() {

    }
    /**
     * @method __loadImage
     * @param $path
     */
    function __loadImage($path) {
        $img;
        $width;
        $height;
        $type;

        if (!list($width, $height) = getimagesize($path))
            return false;
        //capture extention
        $type = strtolower(substr(strrchr($path, "."), 1));
        switch($type) {
            case 'bmp' :
                $img = imagecreatefromwbmp($path);
                break;
            case 'gif' :
                $img = imagecreatefromgif($path);
                break;
            case 'jpeg' :
            case 'jpg' :
                $img = imagecreatefromjpeg($path);
                break;
            case 'png' :
                $img = imagecreatefrompng($path);
                break;
            default :
                return false;
        }
        return array("img" => $img, "width" => $width, "height" => $height);
    }

    /**
     * @descruption :
     * @method: resizeToFormat
     * @param $dimensions array => width height
     * @param $path is the string file path
     */
    function resizeToFormat($dimensions, $path) {
        $img = $this -> __loadImage($path);
        if ($img) {
            header("image/jpg");
            echo $img;          
            imagedestroy($img);
        }
    }

    /**
     * @description : This method would resize to all the defined sizes
     * @param $path is the string of the file path
     */
    function resizeAll($path, $name) {
        foreach ($this->defaults as $key => $value) {
            $imgeResized = $this -> resizeByWidth($path, $value["width"]);
            imagejpeg($imgeResized, $this -> output_dir . $key . "_result.jpeg", 100);          
            imagedestroy($imgeResized);
        }
    }

    function resizeByWidth($path, $width) {
        //obtiene  la imagen e inserta la firma.
        $img = $this -> insertSignature($path);
        if ($img) {
            //calcula la altura de resize
            $height = $img["height"] / $img["width"] * $width;
            $imageResized = imagecreatetruecolor($width, $height);
            imagecopyresampled($imageResized, $img["img"], 0, 0, 0, 0, $width, $height, $img["width"], $img["height"]);         
            imagedestroy($img["img"]);
            return $imageResized;
        }
        imagedestroy($imageResized);
        return false;
    }

    function resizeByHeight($path, $height) {
        //obtiene  la imagen e inserta la firma.
        $img = $this -> insertSignature($path);
        if ($img) {         
            //calcula la altura de resize
            $width = $img["width"] / $img["height"] * $height;
            $imageResized = imagecreatetruecolor($width, $height);
            imagecopyresampled($imageResized, $img["img"], 0, 0, 0, 0, $width, $height, $img["width"], $img["height"]);         
            imagedestroy($img["img"]);
            return $imageResized;
        }
        imagedestroy($imageResized);
        return false;
    }

    function insertSignature($path) {
        $img = $this -> __loadImage($path);
        $signature = $this -> __loadImage('input/signature.png');
        if ($img && $signature) {
            imagecopymerge($img["img"], $signature["img"], $img["width"] - 
                $signature["width"], $img["height"] - $signature["height"], 0, 0, $signature["width"], $signature["height"], 75);       
            imagedestroy($signature["img"]);            
            return $img;
        }
        return false;
    }

    /**
     * @description: this function takes the image and crops certain area
     * @method cropImage
     * @param $dimensions
     * @param $image
     */
    function cropImage($cropArea, $path) {
        $img = $this -> __loadImage($path);     
        $cropImg = imagecreatetruecolor($cropArea["width"], $cropArea["height"]);
        if ($img) {         
            imagecopy($cropImg, $img["img"], 0, 0, $cropArea["x"], $cropArea["y"], $img["width"], $img["height"]);      
            imagedestroy($img["img"]);
            return $cropImg;
        }
        return FALSE;
    }
}
?>