<?php
session_start();
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
        
        echo "Hãy điền đầy đủ thông tin";
    }else{
        $sql="SELECT * FROM `acc` WHERE email='$logmail' and password='$logpass'";
        $query=mysqli_query($connect, $sql);
        $num_rows=mysqli_num_rows($query);
        if($num_rows!=0){
            $row=mysqli_fetch_assoc($query);
            $_SESSION['id']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['password']=$row['password'];
            header('Location:../mypro/show.php');
            die();
        }
        else{
            // header('Location: ../mainhtml/login.php');
            // die();
            echo "dang nhap that bai";
        }
    }
}
//Đóng database
$connect->close();
?>