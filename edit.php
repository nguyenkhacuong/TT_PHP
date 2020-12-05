<?php
session_start();
$id=$_REQUEST['id'];
?>
<?php
require_once( "connect.php" );
$query = "SELECT thongtin.idacc, thongtin.name , thongtin.info , acc.email, acc.pos FROM thongtin INNER JOIN acc ON thongtin.idacc = acc.id";
$sql = $connect->query($query);
while($row=$sql->fetch_array(MYSQLI_ASSOC)){
    $nv_id = $row['idacc'];
    $nv_name = $row['name'];
    $nv_info = $row['info'];
    $nv_email = $row['email'];
    $nv_pos = $row['pos'];
    if($nv_pos == 1){
        $chuc = 'Nhân viên';
    }else{
        $chuc = 'Quản lý';
    }
}
if(isset($_POST['submit'])){
    $logmail = $_POST['email'];
    $logpass = $_POST['pass'];
    $newpass = $_POST['newpass'];
    if($logmail==""||$logpass==""){
        header('Location: ../index.html');
        echo "Hãy điền đầy đủ thông tin";
    }else{
        $sql2="SELECT * FROM `acc` WHERE email='$logmail' and password='$logpass'";
        $query2=mysqli_query($connect, $sql2);
        $num_rows=mysqli_num_rows($query2);
        if($num_rows!=0){
            $newsql="UPDATE `acc` SET `password` = '$newpass' WHERE `acc`.`id` = '$id'";
            $newquery=mysqli_query($connect, $newsql);
            $newrows=mysqli_num_rows($newquery);
            if($newrows!=0){
                $row=mysqli_fetch_assoc($query);
                $_SESSION['password']=$row['password'];
                header('Location:../mypro/show.php');
                die();
            }
        }
        else{;
            echo "dang nhap that bai";
        }
    }
}
?>
<form action="" method="post">
    <input type="email" name="" id="">
</form>