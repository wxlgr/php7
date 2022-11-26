<?php
$rw = 400;
$rh = 500;
// 画布
$res = imagecreatetruecolor($rw, $rh);

$image = imagecreatefromjpeg('xjj.jpg');

$iw = imagesx($image);
$ih = imagesy($image);

if ($iw / $rw > $ih / $rh) {
  $iw = $ih / $rh * $rw;
} else {
  $ih = $iw / $rw * $rh;
}

imagecopyresampled($res, $image, 0, 0, 0, 0, $rw, $rh, $iw, $ih);
header('content-type: image/jpeg');
imagejpeg($res);
