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
        <div class="logo">
            <a href="/WEBSITEBANDIENTHOAI/index.php">📱 Mobile Store</a>
        </div>

        <nav class="menu">
            <a href="/WEBSITEBANDIENTHOAI/index.php">Trang chủ</a>
            <a href="/WEBSITEBANDIENTHOAI/cart.php">Giỏ hàng</a>

            <?php if(isset($_SESSION['user'])): ?>
                <a href="#">Xin chào <?=$_SESSION['user']?></a>
                <a href="/WEBSITEBANDIENTHOAI/auth/logout.php">Đăng xuất</a>
            <?php else: ?>
                <a href="/WEBSITEBANDIENTHOAI/auth/login.php">Đăng nhập</a>
                <a href="/WEBSITEBANDIENTHOAI/auth/register.php">Đăng ký</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<div class="container">