<?php
include("../../config/database.php");
include("../check_admin.php");

$result = $conn->query("
    SELECT orders.*, users.username 
    FROM orders 
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Danh sách đơn hàng</title>
<link rel="stylesheet" href="../../assets/css/style.css">

<style>

.admin-box{
    width:90%;
    margin:auto;
}

.admin-title{
    margin-bottom:20px;
}

.order-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.order-table th{
    background:#222;
    color:white;
    padding:12px;
}

.order-table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

.order-table tr:hover{
    background:#f7f7f7;
}

.btn-view{
    padding:6px 12px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.btn-view:hover{
    background:#0056b3;
}

.status-pending{
    color:orange;
    font-weight:bold;
}

.status-completed{
    color:green;
    font-weight:bold;
}

.status-cancel{
    color:red;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="admin-box">

<h2 class="admin-title">📦 Danh sách đơn hàng</h2>

<table class="order-table">

<tr>
    <th>Mã đơn</th>
    <th>Khách hàng</th>
    <th>Tổng tiền</th>
    <th>Trạng thái</th>
    <th>Ngày</th>
    <th>Chi tiết</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td>#<?=$row['id']?></td>

<td><?=$row['username']?></td>

<td><?=number_format($row['total'],0,",",".")?> đ</td>

<td>

<?php
if($row['status']=="pending"){
    echo "<span class='status-pending'>Chờ xử lý</span>";
}
elseif($row['status']=="completed"){
    echo "<span class='status-completed'>Hoàn thành</span>";
}
else{
    echo "<span class='status-cancel'>Đã hủy</span>";
}
?>

</td>

<td><?=$row['created_at']?></td>

<td>
<a class="btn-view" href="detail.php?id=<?=$row['id']?>">Xem</a>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>
