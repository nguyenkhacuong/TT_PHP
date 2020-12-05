<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location:../mypro/index.html');
}
require_once ("connect.php");
$query = "SELECT thongtin.idacc, thongtin.name , thongtin.info , acc.email, acc.pos FROM thongtin INNER JOIN acc ON thongtin.idacc = acc.id";
$sql = $connect->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1 style="margin-top: 20px">Danh sách nhân viên</h1>
    <?php echo($_SESSION['pos']); ?>
    <form action="out.php" method="post">
	<button type="submit" name="logout" style="position: absolute; right: 12px; top: 4px" class="btn btn-info">Đăng xuất</button>
    </form>
    <table spacing="1" border="0">
        <tbody>
            <tr>
                <th style="width:10%;">ID</th>
                <th style="width: 20%;">Tên Nhân Viên</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 10%;">Chức vụ</th>
                <th style="width: 20%;">Thông Tin</th>
                <th></th>
                <th></th>
            </tr>
            <?php
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
            ?>
            <tr>
                <th style="width:10%;"><?php echo($nv_id); ?></th>
                <th style="width: 20%;"><?php echo($nv_name); ?></th>
                <th style="width: 20%;"><?php echo($nv_email); ?></th>
                <th style="width: 20%;"><?php echo($chuc); ?></th>
                <th style="width: 20%;"><?php echo($nv_info) ?></th>
                <th style="width: 5%;"><a href="edit.php?id=<?php echo($nv_id) ?>" class="btn btn-info" onclick="openAny('hidden')">Sửa</a></th>
                <th style="width: 5%;"><a href="dele.php?id=<?php echo($nv_id) ?>" class="btn btn-warning" onclick="openAny('hidden2')">Xóa</a></th>
            </tr>
            <?php }; ?>
        </tbody>
    </table>
    <div id="manChan"></div>
    <div class="contain hidden" id="hidden">
    <button style="position: absolute; right: 4px;" onclick="closeAny('hidden')">x</button>
        <form action="edit.php" method="post" >
            <input type="email" name="email" placeholder="Nhap email" />
            <input type="password" name="pass" placeholder="Nhap password" />
            <input type="password" name="newpass" placeholder="Nhap password moi" />
            <input type="submit" value="Đăng nhập" name="submit" style="width: 212px;">
        </form>
    </div>
    <div>

    </div>
    <script src="script.js"></script>
</body>
</html>