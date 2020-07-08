<?php
include("ImageManipulation.php");

$imgname = "img/tulips.png";

/*
Can currently only do a single operation per instance of the class
*/

$image = new ImageManipulation($imgname);
$image->rotate(10);
$image->save("img/new.png");

$image2 = new ImageManipulation($imgname);
$image2->monochrome();
$image2->save("img/new2.png");

$image3 = new ImageManipulation($imgname);
$image3->blur();
$image3->save("img/new3.png");

$image4 = new ImageManipulation($imgname);
$image4->pixelate(5);
$image4->save("img/new4.png");

$image5 = new ImageManipulation($imgname);
$image5->pixelate(5);
$image5->blur();
$image5->blur();
$image5->save("img/new5.png");




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

<img src="img/tulips.png"><br><br>
<img src="img/new.png">
<img src="img/new2.png">
<img src="img/new3.png"><br><br>
<img src="img/new4.png"><img src="img/new5.png"><img src="img/new6.png">


