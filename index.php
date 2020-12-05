<?php
session_start();
$logstate='';
?>
<?php
$server = "localhost";
$username = "root"; // Khai báo username
$password = "";// Khai báo password
$port="3306";
$dbname = "testphp";      // Khai báo database
// Kết nối database tintuc
$connect = new mysqli($server, $username, $password, $dbname, $port);
//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
    die("Không kết nối :" . $conn->connect_error);
    exit();
}
//Lấy giá trị POST từ form vừa submit
if(isset($_POST['submit'])){
    $logmail = $_POST['email'];
    $logpass = $_POST['pass'];
    if($logmail==""||$logpass==""){
        $logstate = "Hãy điền đầy đủ thông tin";
    }else{
        $sql="SELECT * FROM `acc` WHERE email='$logmail' and password='$logpass'";
        $query=mysqli_query($connect, $sql);
        $num_rows=mysqli_num_rows($query);
        if($num_rows!=0){
            $row=mysqli_fetch_assoc($query);
            $_SESSION['id']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['password']=$row['password'];
            $_SESSION['pos'] = $row['pos'];
            header('Location:../mypro/phanquyen.php');
            die();
        }
        else{
            $logstate = "Đăng nhập thất bại";
        }
    }
}
if(isset($_POST['submit2'])){
    $semail = $_POST['semail'];
    $spass = $_POST['spass'];
    if($semail==""||$spass==""){
        $logstate = "Hãy điền đầy đủ thông tin";
    }else{
        $sql="INSERT INTO `acc` (`id`, `email`, `password`, `pos`) VALUES (NULL, '$semail', '$spass', '1')";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Calistoga&display=swap');
</style>
</head>
<body>
<div id="manChan1" class="manChan1"></div>
    <h1>Đăng Nhập</h1>
    <div class="login" id="login">
        <form action="" method="post">
            <input type="email" name="email" placeholder="Nhap email"  class="oinput"/>
            <input type="password" name="pass" placeholder="Nhap password" class="oinput"/>
            <span class="span"><?php echo($logstate) ?></span>
            <button type="submit" name="submit" class="osubmit">Đăng nhập</button>
        </form>
        <button onclick="openAny('hidden')" class="osubmit" style="margin-left: 20px;">Đăng ký</button>
    </div>
    <div id="manChan"></div>
    <div class="login hidden" id="hidden">
        <button style="position: absolute; right: 4px;" onclick="closeAny('hidden')">x</button>
        <form method="post" >
            <input type="email" name="semail" placeholder="Nhap email" class="oinput"/>
            <input type="password" name="spass" placeholder="Nhap password" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
            class="oinput"
            />
            <button type="submit" name="submit2" style="width: 212px;"
            class="osubmit"
            style="width: 250px;"
            >Đăng ký</button>
            
        </form>
    </div>

   

    <script src="script.js"></script>
</body>
</html>