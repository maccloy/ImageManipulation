<?php

class ImageManipulation {
    
    private $image = "";
    private $filename = "";
    public $width = 0;
    public $height = 0;

    function __construct($image) {
        $sanitized = filter_var($image, FILTER_SANITIZE_STRING);
        $type = exif_imagetype($sanitized);

        if (is_string($sanitized) && file_exists($sanitized) && ($type != FALSE)) {
            $this->filename = $sanitized; 
            $this->open($sanitized, $type);
            list($width, $height, $type, $attr) = getimagesize($sanitized);
            $this->width = $width;
            $this->height = $height;
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
        // Image can be of type GIF, JPEG, PNG only
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
    }

    function rotate($degrees) {
        // Rotate and then saves the image
        $transparent = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
        $this->image = imagerotate($this->image, $degrees, $transparent);
    }
    
    function monochrome() {
        // Removes colour
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
    }

    function blur() {
        // Gaussian blur
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
    }

    function pixelate($blockSize) {
            imagefilter($this->image, IMG_FILTER_PIXELATE, $blockSize, true);
    }

    function smooth($smoothness) {
            imagefilter($this->image, IMG_FILTER_SMOOTH, $smoothness);
    }

    function save($filename) {
        // Saves the image as a PNG file
        imagepng($this->image, $filename);
    }
    

    
    function crop($centreX, $centreY, $width, $height, $filename) {
        /*
        Need to check that width and height are not too big for the centre co-ordinates. cannot go off edges of image
        where in the image is the origin? need to work this out and document it
        */
        $this->image = imagecrop($this->image, ['x' => $centreX, 'y' => $centreY, 'width' => $width, 'height' => $height]);
    }

}


?>