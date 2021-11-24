<?php 
//退出

session_start();//只要用到SESSION就必须要session_start
session_destroy();
echo "<script>location.href='../';</script>";
?>