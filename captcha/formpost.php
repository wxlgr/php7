<?php
session_start();
$code = $_SESSION['captcha'];

$captcha = strtoupper(trim($_POST['captcha']));

if($code==$captcha){
  print_r("验证码正确");
}else{
  print_r("验证码不正确");
}