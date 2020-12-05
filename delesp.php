<?php
session_start();
require_once ("connect.php");
$id=$_REQUEST['id'];
$myid=$_SESSION['id'];
if($id == $myid){
    header("Location: ../mypro/posi.php");
}else{
    $query = "DELETE FROM `sanpham` WHERE `sanpham`.`id` = '$id'"; 
    $result = mysqli_query($connect,$query);
    if($result){
        echo("ngon");
    }
    $_SESSION['tb'] = 'Xóa sản phẩm thành công';
    header("Location: ../mypro/phanquyen.php"); 
}
?>