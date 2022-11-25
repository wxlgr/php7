<?php
session_start();
include './Captcha.php';
$code = new Captcha(100,30,5);
$codetext = $code->render();
file_put_contents('./code.txt',$codetext);

$_SESSION["captcha"] = $codetext;
