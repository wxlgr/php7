<?php
include './Thumb.php';
$thumb = new Thumb;
try {
  $thumb->make('xjj.jpg',"thumb.gif", 209, 200,3);
} catch (Exception $e) {
  echo "Exception:" . $e->getMessage();
}
