<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location:../mypro/index.php');
}
if(isset($_GET['idsp'])){
    $id_de =  $_GET['idsp'];
}
$tb = "Chờ thực hiện thao tác";
$my_id = $_SESSION['id'];
require_once ("connect.php");
$query = "SELECT thongtin.idacc, thongtin.name , thongtin.info , acc.email, acc.pos FROM thongtin INNER JOIN acc ON acc.id = '$my_id'";
$sql = $connect->query($query);
$query2 = "SELECT * FROM `sanpham`";
$sql2 = $connect->query($query2);
if(isset($_POST['submitsb'])){
    $ten_sp = $_POST['ten_sp'];
    $soluong = $_POST['soluong'];
    $info_sp = $_POST['info_sp'];
    $sqltsp="INSERT INTO `sanpham` (`id`, `ten`, `soluong`, `info`) VALUES (NULL, '$ten_sp', '$soluong', '$info_sp')"; 
    $querytsp = $connect->query($sqltsp);
    if($querytsp){
        $tb = "Thêm sản phẩm thành công";
    }
}
if(isset($_SESSION['tb'])){
    $tb = $_SESSION['tb'];
}
if(isset($_POST['submit_search'])){
    if(empty($_POST['name_s'])&&empty($_POST['sl_s'])&&empty($_POST['if_s'])){
        $tb = "Chưa nhập giá trị tìm kiếm !";
    }else{
        $query_s = "SELECT * FROM sanpham WHERE 1 = 1 ";
        if (isset($_POST['name_s'])) {
            $name_s = preg_replace('/\s+/', '', $_POST['name_s']);
            $query_s.="AND REPLACE(sanpham.ten , ' ','') LIKE '%$name_s%' ";
        }
        if (isset($_POST['sl_s'])) {
            $sl_s = preg_replace('/\s+/', '', $_POST['sl_s']);
            $query_s.="AND REPLACE(sanpham.soluong , ' ','') LIKE '%$sl_s%' ";
        }
        if (isset($_POST['if_s'])) {
            $if_s = preg_replace('/\s+/', '', $_POST['if_s']);
            $query_s.="AND REPLACE(sanpham.info , ' ','') LIKE '%$if_s%' ";
        }
        
        $sql_s = $connect->query($query_s);
        if($sql_s){
            $sql2 = $sql_s;
            $tb = "Hoàn tất tìm kiếm !";
        }
    }
}
if (isset($_POST['showall'])) {
    $query_s = "SELECT * FROM sanpham";
    $sql_s = $connect->query($query_s);
    if($sql_s){
        $sql2 = $sql_s;
        $tb = "Hiển thị tất cả !";
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
</head>
<body>
    <h1>Sản phẩm</h1>
    <div class="tb">Thông báo : <span style="font-style: italic; color: hotpink; margin: 0px;"><?php echo($tb); ?></span></div>
    <div style="display: flex; flex-direction: row; justify-content: space-between;">
        <button class="btn btn-info" onclick="openAny('hidden2')">My info</button>
        <button class="btn btn-info" onclick="openAny('themsanpham')">Thêm sản phẩm</button>
        <form action="out.php" method="post">
        <button  class="btn btn-info" type="submit" name="logout" >Đăng xuất</button>
        </form>
    </div>
    <?php  
    $query_count = mysqli_query($connect, "SELECT COUNT(id) AS total FROM sanpham");
    $row_count = mysqli_fetch_assoc($query_count);
    $total_record = $row_count['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $total_page = ceil($total_record / $limit);
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    if(isset($query_s)){
        $query_s .= " LIMIT $start, $limit";
        $sql2 = $connect->query($query_s);
    }else{
        $query2 .= " LIMIT $start, $limit";
        $sql2 = $connect->query($query2);
    } 
    ?>
    <table spacing="1" border="0">
    <tbody>
            <tr>
                <th style="width:5%;">ID</th>
                <th style="width: 15%;">Tên Sản Phẩm</th>
                <th style="width: 10%;">Số Lương</th>
                <th style="width: 60%;">Thông Tin</th>
                <th colspan="2" style="width: 10%;">Thao tác</th>
                <!-- <th style="width: 5%;"></th> -->
            </tr>
            <tr>
                <form action="" method="post">
                    <th style="width:5%;"></th>
                    <th style="width: 15%;">
                        <input class="oin3" type="text" name="name_s" placeholder="Tên sản phẩm"/>
                    </th>
                    <th style="width: 10%;">
                        <input class="oin3" type="text" name="sl_s" placeholder="Số lượng"/>
                    </th>
                    <th style="width: 60%;">
                        <input class="oin3" type="text" name="if_s" placeholder="Thông tin"/>
                    </th>
                    <th th style="width: 5%;">
                        <input class="btn btn-info" type="submit" name="submit_search" value="Tìm kiếm" />
                    </th>
                    <th>
                        <input class="btn btn-info" type="submit" name="showall" value="All" />
                    </th>
                </form>
            </tr>
            <?php
            while($rowsp=$sql2->fetch_array(MYSQLI_ASSOC)){
                $sp_id = $rowsp['id'];
                $sp_sl = $rowsp['soluong'];
                $sp_name = $rowsp['ten'];
                $sp_info = $rowsp['info'];
            ?>
            <tr>
                <th style="width:5%;"><?php echo($sp_id); ?></th>
                <th style="width: 15%;"><?php echo($sp_name); ?></th>
                <th style="width: 10%;"><?php echo($sp_sl); ?></th>
                <th style="width: 60%;"><?php echo($sp_info); ?></th>
                <th style="width: 5%;"><a href="editsp.php?idsp=<?php echo($sp_id) ?>" class="btn btn-info">Sửa</a></th>
                <th style="width: 5%;"> <a href="nhanvien.php?idxoa=<?php echo($sp_id) ?>" class="btn btn-warning">Xóa</a> </th>       
            </tr>
            <?php }; ?>
        </tbody>
    </table>
    <div id="manChan"></div>
   
    <div class="hidden2" id='hidden2'>
        <h3 style="margin-top: 20px">Thông tin cá nhân</h3>
        <button class="btn btn-info" onclick="closeAny('hidden2')" style="padding: 3px; position: absolute; right: 2px; top:4px">x</button>
        <table spacing="1" border="0">
            <tbody>
                <tr>
                    <th style="width:10%;">ID</th>
                    <th style="width: 20%;">Tên Nhân Viên</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 10%;">Chức vụ</th>
                    <th style="width: 20%;">Thông Tin</th>
                </tr>
                <?php
                $num_rows=mysqli_num_rows($sql);
                if($num_rows!=0){
                // while($row=$sql->fetch_array(MYSQLI_ASSOC)){
                    $row=mysqli_fetch_assoc($sql);
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
                </tr>
                <?php }; 
                ?>
                
            </tbody>
        </table>
        <button class="btn btn-info cnt" onclick="openEdit('hidden')">Sửa thông tin</button>
    </div>
    
    <div class="contain hidden" id="hidden">
        <button style="position: absolute; right: 4px;" onclick="closeEdit('hidden')">x</button>
        <form action="edit.php" method="post" >
            <input class="oinput" type="email" name="email" required value="<?php echo($nv_email); ?>"/>
            <input class="oinput" type="text" name="name" required value="<?php echo($nv_name); ?>"/>
            <input class="oinput" type="password" name="pass" required value="<?php echo($nv_info); ?>"/>
            <input class="osubmit" type="submit" value="Thay đổi" name="doitk" style="width: 212px;">
        </form>
    </div>
    <div class="hidden2" id="themsanpham">
        <form method="post">
            <input class="oin2" type="text" name="ten_sp" placeholder="Tên sản phẩm" required />
            <input class="oin2" type="text" name="soluong" placeholder="Số lượng" required />
            <input class="oin2" type="text" name="info_sp" placeholder="Thông tin" required />
            <input class="btn btn-info" type="submit" name="submitsb" value="Thêm" />
            <button class="btn btn-warning" type="button" onclick="closeAny('themsanpham')">x</button>
        </form>
        
    </div>
    <div style="position: absolute; left: 50%; transform: translateX(-50%); bottom: 10px;">
    <?php
    if ($current_page > 1 && $total_page > 1){
        echo '<a href="nhanvien.php?page='.($current_page-1).'">Prev</a> | ';
    }
     
    // Lặp khoảng giữa
    for ($i = 1; $i <= $total_page; $i++){
        // Nếu là trang hiện tại thì hiển thị thẻ span
        // ngược lại hiển thị thẻ a
        if ($i == $current_page){
            echo '<span>'.$i.'</span> | ';
        }
        else{
            echo '<a href="nhanvien.php?page='.$i.'">'.$i.'</a> | ';
        }
    }
     
    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
    if ($current_page < $total_page && $total_page > 1){
        echo '<a href="nhanvien.php?page='.($current_page+1).'">Next</a>';
    }
    ?>
    </div>
    <script src="script.js"></script>
</body>
</html>

<?php


?>