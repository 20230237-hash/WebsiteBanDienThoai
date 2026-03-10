<?php
include("../config/database.php");
include("check_admin.php");

/* Hàm lấy 1 giá trị thống kê an toàn */
function getValue($conn, $sql) {
    $result = $conn->query($sql);

    if (!$result) {
        return 0;
    }

    $row = $result->fetch_assoc();
    return $row ? $row['total'] : 0;
}

/* Tổng đơn */
$order_count = getValue($conn,
    "SELECT COUNT(*) as total FROM orders"
);

/* Tổng doanh thu */
$revenue = getValue($conn,
    "SELECT SUM(total) as total
     FROM orders
     WHERE status='Hoàn thành'"
);

if (!$revenue) {
    $revenue = 0;
}

/* Tổng sản phẩm */
$product_count = getValue($conn,
    "SELECT COUNT(*) as total FROM products"
);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="admin-container">

<h1>📊 ADMIN DASHBOARD</h1>

<div class="admin-cards">

    <div class="admin-card">
        <h3>Tổng đơn</h3>
        <p><?= $order_count ?></p>
    </div>

    <div class="admin-card">
        <h3>Tổng doanh thu</h3>
        <p><?= number_format($revenue,0,",",".") ?> đ</p>
    </div>

    <div class="admin-card">
        <h3>Tổng sản phẩm</h3>
        <p><?= $product_count ?></p>
    </div>

</div>


<div style="margin-top:30px">

<a href="orders/list.php" class="btn-primary">
📦 Quản lý đơn hàng
</a>

<a href="products/list.php" class="btn-primary" style="margin-left:15px">
📱 Quản lý sản phẩm
</a>

<a href="users/list.php" class="btn-primary" style="margin-left:15px">
👤 Quản lý Users
</a>
<a href="brands/list.php" class="btn-primary" style="margin-left:15px">
🏷️ Quản lý thương hiệu
</a>

<a href="categories/list.php" class="btn-primary" style="margin-left:15px">
📂 Quản lý danh mục
</a>
</div>

</div>

</body>
</html>
