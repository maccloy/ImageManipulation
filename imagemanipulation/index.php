<?php
include("ImageManipulation.php");

$imgname = "img/tulips.png";

$image = new ImageManipulation($imgname);
$image->rotate(30);

?>
<style>
img {
    width: 250px;
    border: 2px solid blue;
    margin: 5px;
}

body {
    background-color: green;
}
</style>

<img src="img/tulips.png"><br>
<img src="img/new.png">