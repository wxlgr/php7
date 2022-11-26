<?php 
$file = '1.txt';
// 文件流（指针）
$handle = fopen($file, 'r');
// 文件字符数
echo filesize($file);
// 读取2个字符
echo fread($handle,2).'<hr>';
// 读完剩下
echo fread($handle,9999).'<hr>';
// 光标指向开头
fseek($handle,0);

// 读完剩下
echo fread($handle,9999);


// 直接读取
echo "<hr>".file_get_contents($file);