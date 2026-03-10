<?php
include("../../config/database.php");
include("../check_admin.php");

$result = $conn->query("
    SELECT * FROM products
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Quản lý sản phẩm</title>

<link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body>

<div class="admin-container">

<h2>📦 Quản lý sản phẩm</h2>

<a href="add.php" class="btn-primary">
➕ Thêm sản phẩm
</a>

<br><br>

<table class="cart-table">

<tr>
<th>ID</th>
<th>Ảnh</th>
<th>Tên sản phẩm</th>
<th>Giá</th>
<th>Thao tác</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td>#<?=$row['id']?></td>

<td>
<img src="../../uploads/<?=$row['image']?>" width="80">
</td>

<td><?=$row['name']?></td>

<td>
<?=number_format($row['price'],0,",",".")?> đ
</td>

<td>

<a href="edit.php?id=<?=$row['id']?>" class="btn">
Sửa
</a>

<a href="delete.php?id=<?=$row['id']?>"
class="btn"
onclick="return confirm('Bạn chắc chắn muốn xóa?')">
Xóa
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>
