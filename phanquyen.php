<?php
session_start();
if(empty($_SESSION["id"])){
	header('Location: ../mypro/index.php');
}
if($_SESSION["pos"] == 1){
    header('Location: ../mypro/nhanvien.php');
}
if($_SESSION["pos"] == 2){
    header('Location: ../mypro/show.php');
}


?>