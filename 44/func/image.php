<?php
header("Content-Type: image/png");
$im = imagecreate(25, 25);
imagecolorallocate($im, 200, 200, 244);
imagestring($im, 5, 7, 5, $_GET["number"], 1);
imagepng($im);
?>