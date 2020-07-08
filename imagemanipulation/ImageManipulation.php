<?php


class ImageManipulation {

    private $image = "";
    private $filename = "";
    
    function __construct($image) {
        $sanitized = filter_var($image, FILTER_SANITIZE_STRING);
        $type = exif_imagetype($sanitized);

        if (is_string($sanitized) && file_exists($sanitized) && ($type != FALSE)) {
            $this->filename = $sanitized; 
            $this->image = $this->open($sanitized, $type);
        } else {
            throw new Exception("$sanitized is not a suitable target");
        }
    }

    function __destruct() {
        if (is_resource($this->image)) {
            imagedestroy($this->image);
        }
    }

    function open($image, $type) {
        switch($type) {
            case 1:
                $this->image = imagecreatefromgif($image);
                break;
            case 2:
                $this->image = imagecreatefromjpeg($image);
                break;
            case 3:
                $this->image = imagecreatefrompng($image);
                break;
            default:
                throw new Exception("Only gif, jpeg, and png images are supported");
                break;
        }
        return true;
    }

    function rotate($degrees) {
        $transparent = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
        $rotate = imagerotate($this->image, $degrees, $transparent);
        imagepng($rotate, "img/new.png");
        imagedestroy($rotate);
    }

    function square($size, $centre) {

    }

    function circle($radius, $centre) {

    }
    
    function monochrome() {

    }

}


?>