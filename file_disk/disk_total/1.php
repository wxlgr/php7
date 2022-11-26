<?php
include './helper.php';
$total =  disk_total_space(".");
$free =  diskfreespace(".");
echo '磁盘总大小：' . size($total) . '<br>';
echo '磁盘可用大小：' . size($free);
