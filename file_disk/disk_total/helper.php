<?php
// 将磁盘大小转为醒目格式
function size(int $total){
  $arr = [3=>'GB',2=>'MB',1=>'KB'];
  foreach($arr as $num=>$unit){
    $level =pow(1024,$num);
    if($total >$level){
      return sprintf("%.1f",($total/$level)).$unit;
    }
  }
}