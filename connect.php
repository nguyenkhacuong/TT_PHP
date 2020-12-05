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
?>