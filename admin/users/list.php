<?php
include("../../config/database.php");
include("../check_admin.php");

$result = $conn->query("
    SELECT * FROM users
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Quản lý người dùng</title>

<style>

body{
    font-family: Arial;
    background:#f4f6f9;
}

.container{
    width:90%;
    margin:auto;
    margin-top:40px;
}

h2{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

th{
    background:#2c3e50;
    color:white;
}

tr:hover{
    background:#f1f1f1;
}

.btn{
    padding:6px 12px;
    border-radius:5px;
    text-decoration:none;
    color:white;
}

.edit{
    background:#3498db;
}

.delete{
    background:#e74c3c;
}

.role-admin{
    color:#e74c3c;
    font-weight:bold;
}

.role-user{
    color:#27ae60;
}

</style>
</head>

<body>

<div class="container">

<h2>👥 Quản lý người dùng</h2>

<table>

<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Role</th>
    <th>Thao tác</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td>#<?=$row['id']?></td>

<td><?=$row['username']?></td>

<td>

<?php
if($row['role']=="admin"){
    echo "<span class='role-admin'>Admin</span>";
}else{
    echo "<span class='role-user'>User</span>";
}
?>

</td>

<td>

<a class="btn edit" href="edit.php?id=<?=$row['id']?>">Sửa</a>

<a class="btn delete"
href="delete.php?id=<?=$row['id']?>"
onclick="return confirm('Bạn chắc chắn muốn xoá user này?')">
Xoá
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>
