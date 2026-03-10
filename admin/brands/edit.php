<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

$brand = $conn->query("
SELECT * FROM brands
WHERE id=$id
")->fetch_assoc();

if(isset($_POST['update'])){

$name = $_POST['name'];

$conn->query("
UPDATE brands
SET name='$name'
WHERE id=$id
");

header("Location:list.php");
exit();
}
?>

<h2>✏️ Sửa thương hiệu</h2>

<form method="post">

<label>Tên thương hiệu</label>

<input type="text" name="name"
value="<?=$brand['name']?>" required>

<br><br>

<button type="submit" name="update" class="btn-primary">
Cập nhật
</button>

</form>
