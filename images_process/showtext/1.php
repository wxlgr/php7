<?php
header('content-type:image/png');
$res = imagecreatetruecolor(500, 500);

$red = imagecolorallocate($res, 255, 0, 0);
$white = imagecolorallocate($res, 255, 255, 255);

imagefill($res, 0, 0, $white);
$font = realpath('font.otf');
$text = "201921111365";

for ($i = 0; $i < mb_strlen($text, "utf-8"); $i++) {
  imagettftext($res, 24, mt_rand(-45, 45), 40 * $i, 50, $red, $font, mb_substr($text, $i, 1, "utf-8"));
}
imagepng($res);
