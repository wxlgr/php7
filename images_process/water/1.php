<?php
include './Water.php';
$water = new Water("water.png", 'center center');
try {
  $water->make('xjj.png','res.jpeg');
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
