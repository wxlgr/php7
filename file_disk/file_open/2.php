<?php
$p = fopen('1.txt', 'r');
while (feof($p)) {
   echo fread($p,1024);
}