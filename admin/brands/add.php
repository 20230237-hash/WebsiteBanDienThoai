<?php
include("../../config/database.php");
include("../check_admin.php");

if(isset($_POST['add'])){

$name = $_POST['name'];

$conn->query("
INSERT INTO brands(name)
VALUES('$name')
");

header("Location:list.php");
exit();
}
?>

<h2>➕ Thêm thương hiệu</h2>

<form method="post">

<label>Tên thương hiệu</label>

<input type="text" name="name" required>

<br><br>

<button type="submit" name="add" class="btn-primary">
Thêm
</button>

</form>
