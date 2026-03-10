<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

/* ================= CẬP NHẬT TRẠNG THÁI ================= */

if (isset($_POST['update_status'])) {

    $status = $_POST['status'];

    $conn->query("
        UPDATE orders 
        SET status='$status' 
        WHERE id=$id
    ");

    header("Location: list.php");
    exit();
}

/* ================= LẤY THÔNG TIN ĐƠN ================= */

$order = $conn->query("
    SELECT * 
    FROM orders 
    WHERE id=$id
")->fetch_assoc();

/* ================= LẤY CHI TIẾT SẢN PHẨM ================= */

$details = $conn->query("
    SELECT order_details.*, products.name 
    FROM order_details
    JOIN products ON order_details.product_id = products.id
    WHERE order_details.order_id = $id
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Chi tiết đơn hàng</title>

<style>

body{
    font-family: Arial;
    background:#f4f6f9;
}

/* container */

.container{
    width:900px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

/* tiêu đề */

h2{
    margin-bottom:20px;
}

/* thông tin đơn */

.order-info{
    background:#f9f9f9;
    padding:15px;
    border-radius:6px;
    margin-bottom:25px;
}

.order-info p{
    margin:6px 0;
}

/* bảng sản phẩm */

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

table th{
    background:#007bff;
    color:white;
    padding:10px;
}

table td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

/* trạng thái */

.status{
    font-weight:bold;
}

/* form */

select{
    padding:8px;
    margin-top:10px;
}

/* nút */

button{
    padding:8px 16px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:4px;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

/* quay lại */

.back{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#007bff;
}

</style>
</head>

<body>

<div class="container">

<h2>📦 Chi tiết đơn hàng #<?=$id?></h2>

<div class="order-info">

<p><b>Địa chỉ:</b> <?=$order['address']?></p>

<p><b>Điện thoại:</b> <?=$order['phone']?></p>

<p><b>Tổng tiền:</b> 
<?=number_format($order['total'],0,",",".")?> đ
</p>

<p class="status">
<b>Trạng thái:</b>

<?php
if($order['status']=="pending") echo "🟡 Chờ xử lý";
elseif($order['status']=="shipping") echo "🔵 Đang giao";
elseif($order['status']=="completed") echo "🟢 Hoàn thành";
elseif($order['status']=="cancelled") echo "🔴 Đã hủy";
?>

</p>

</div>

<h3>🛒 Sản phẩm trong đơn</h3>

<table>

<tr>
<th>Tên sản phẩm</th>
<th>Giá</th>
<th>Số lượng</th>
<th>Thành tiền</th>
</tr>

<?php 
$total = 0;
while($row = $details->fetch_assoc()): 
$thanhtien = $row['price'] * $row['quantity'];
$total += $thanhtien;
?>

<tr>

<td><?=$row['name']?></td>

<td><?=number_format($row['price'],0,",",".")?> đ</td>

<td><?=$row['quantity']?></td>

<td><?=number_format($thanhtien,0,",",".")?> đ</td>

</tr>

<?php endwhile; ?>

</table>

<h3>Cập nhật trạng thái</h3>

<form method="post">

<select name="status">

<option value="pending" <?=$order['status']=="pending"?'selected':''?>>
Chờ xử lý
</option>

<option value="shipping" <?=$order['status']=="shipping"?'selected':''?>>
Đang giao
</option>

<option value="completed" <?=$order['status']=="completed"?'selected':''?>>
Hoàn thành
</option>

<option value="cancelled" <?=$order['status']=="cancelled"?'selected':''?>>
Hủy
</option>

</select>

<br><br>

<button type="submit" name="update_status">
Cập nhật trạng thái
</button>

</form>

<a class="back" href="list.php">← Quay lại danh sách đơn</a>

</div>

</body>
</html>
