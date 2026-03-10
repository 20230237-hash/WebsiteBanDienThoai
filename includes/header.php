<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . "/../config/database.php");
include_once(__DIR__ . "/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mobile Store</title>
<link rel="stylesheet" href="/WEBSITEBANDIENTHOAI/assets/css/style.css">
</head>
<body>

<header class="topbar">
<div class="container flex">

<!-- LOGO -->
<div class="logo">
<a href="/WEBSITEBANDIENTHOAI/index.php">📱 Mobile Store</a>
</div>

<!-- DANH MỤC -->
<div class="category-menu">

<button class="category-btn">
☰ Danh mục 
</button>

<div class="category-dropdown">

<?php
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()):
?>

<a href="/WEBSITEBANDIENTHOAI/category.php?id=<?=$row['id']?>">
<?=$row['name']?>
</a>

<?php endwhile; ?>

</div>

</div>

<!-- THANH TÌM KIẾM -->
<div class="search-box">
<form action="/WEBSITEBANDIENTHOAI/search.php" method="GET">
<input type="text" name="keyword" placeholder="Bạn muốn mua gì hôm nay?" required>
<button type="submit">🔍</button>
</form>
</div>

<!-- MENU -->
<nav class="menu">

<a href="/WEBSITEBANDIENTHOAI/index.php">Trang chủ</a>

<a href="/WEBSITEBANDIENTHOAI/cart.php">🛒 Giỏ hàng</a>
<a href="/WEBSITEBANDIENTHOAI/orders.php">🛒 Đơn hàng</a>
<?php if(isset($_SESSION['user_id'])): ?>

<span class="user-name">
Xin chào <b><?=$_SESSION['username']?></b>
</span>

<?php if($_SESSION['role'] == 'admin'): ?>
<a href="/WEBSITEBANDIENTHOAI/admin/dashboard.php">⚙ Admin</a>
<?php endif; ?>

<a href="/WEBSITEBANDIENTHOAI/auth/logout.php">Đăng xuất</a>

<?php else: ?>

<a href="/WEBSITEBANDIENTHOAI/auth/login.php">Đăngnhập</a>


<?php endif; ?>

</nav>

</div>
</header>

<div class="container">
