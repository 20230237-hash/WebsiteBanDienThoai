<?php
include("../../config/database.php");
include("../check_admin.php");

$result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
?>

<style>

body{
font-family: Arial;
background:#f5f6fa;
padding:30px;
}

/* Title */

.title{
font-size:28px;
font-weight:bold;
margin-bottom:20px;
}

/* Add button */

.add-btn{
display:inline-block;
padding:10px 18px;
background:#ff4d4f;
color:white;
text-decoration:none;
border-radius:6px;
margin-bottom:20px;
}

.add-btn:hover{
background:#e84142;
}

/* Table */

.admin-table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.admin-table th{
background:#f1f2f6;
padding:12px;
text-align:left;
}

.admin-table td{
padding:12px;
border-top:1px solid #eee;
}

.admin-table tr:hover{
background:#fafafa;
}

/* Buttons */

.btn-edit{
color:#0984e3;
text-decoration:none;
font-weight:bold;
}

.btn-delete{
color:#e84118;
text-decoration:none;
font-weight:bold;
margin-left:10px;
}

</style>

<div class="title">📂 Quản lý danh mục</div>

<a href="add.php" class="add-btn">➕ Thêm danh mục</a>

<table class="admin-table">

<tr>
<th>ID</th>
<th>Tên danh mục</th>
<th>Thao tác</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td>#<?=$row['id']?></td>

<td><?=$row['name']?></td>

<td>

<a class="btn-edit" href="edit.php?id=<?=$row['id']?>">✏️ Sửa</a>

<a class="btn-delete"
href="delete.php?id=<?=$row['id']?>"
onclick="return confirm('Bạn chắc chắn muốn xóa?')">
🗑️ Xóa
</a>

</td>

</tr>

<?php endwhile; ?>

</table>
