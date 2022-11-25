<?php
header('content-type:image/png');
$width=500;
$height=500;
$res = imagecreatetruecolor($width, $height);

$red = imagecolorallocate($res, 255, 0, 0);
$white = imagecolorallocate($res, 255, 255, 255);

imagefill($res, 0, 0, $white);
$font = realpath('font.otf');
$text = "201921111365 hello world";
$size = 20;
$box = imagettfbbox($size ,0,$font,$text);
/*
·坐标x,y
  67  45
  01  23 
 */
$boxwidth=$box[2]-$box[0];
$boxheight=$box[1]-$box[7];
// var_dump($boxwidth,$boxheight);die; //178 20


// 右下角
$x=$width-$boxwidth;
$y=$height;
// 居中
$x=$width/2-$boxwidth/2;
$y=$height/2+$boxheight/2;
imagettftext($res,$size,0,$x,$y,$red,$font,$text);
imagepng($res);
