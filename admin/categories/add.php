<?php
include("../../config/database.php");
include("../check_admin.php");

if(isset($_POST['add'])){

$name = $_POST['name'];

$conn->query("
INSERT INTO categories(name)
VALUES('$name')
");

header("Location:list.php");
exit();
}
?>

<h2>➕ Thêm danh mục</h2>

<form method="post">

<label>Tên danh mục</label>

<input type="text" name="name" required>

<br><br>

<button type="submit" name="add" class="btn-primary">
Thêm
</button>

</form>
