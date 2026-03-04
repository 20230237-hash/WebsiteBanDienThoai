<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ql_webbandienthoai"; // ĐÚNG TÊN DATABASE CỦA BẠN

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>