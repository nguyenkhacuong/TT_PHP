<?php
session_start();
if(empty($_SESSION["id"])){
	header('Location: ../mypro/index.php');
}
require_once ("connect.php");
$id=$_REQUEST['idsp'];
$query = "SELECT * from sanpham where id='$id'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['edsubmit'])){
    $info = $_POST['infosp'];
    $ten = $_POST['tensp'];
    $sl = $_POST['slsp'];
    $queryed = "UPDATE `sanpham` SET `ten` = '$ten', `soluong` = '$sl', `info` = '$info' WHERE `sanpham`.`id` = '$id'";
    $result2=mysqli_query($connect, $queryed);
    if($result2){
        $_SESSION['tb'] = 'Sửa thông tin sản phẩm thành công';
        header('Location: ../mypro/nhanvien.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .nvtabcon{
            margin-left: 50%;
            transform: translateX(-50%);
        }
        .s_input{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Sửa sản phẩm</h1>
    <div class="nvtabcon">
        <form method="post">
            <div class="inputemp" id="inputpro">
                <div class="s_input">
                    <div>
                        <span>Tên sản phẩm:</span><br>
                        <input type="text" name="tensp" required value="<?php echo $row['ten'];?>">
                    </div>
                    <div >
                        <span>Số lương:</span><br>
                        <input type="text" name="slsp" required value="<?php echo $row['soluong'];?>">
                    </div>
                </div>
                <div>
                    <span>Thông tin:</span><br>
                    <textarea style="width: 100%; height: 200px;" type="text" name="infosp" required><?php echo $row['info'];?></textarea>
                </div>
            </div>
            <input type="submit" name="edsubmit" class="btn btn-info" value="Sửa thông tin">
        </form>
    </div>
</body>
</html>