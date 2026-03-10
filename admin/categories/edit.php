<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

$category = $conn->query("
SELECT * FROM categories
WHERE id=$id
")->fetch_assoc();

if(isset($_POST['update'])){

$name = $_POST['name'];

$conn->query("
UPDATE categories
SET name='$name'
WHERE id=$id
");

header("Location:list.php");
exit();
}
?>

<h2>✏️ Sửa danh mục</h2>

<form method="post">

<label>Tên danh mục</label>

<input type="text"
name="name"
value="<?=$category['name']?>"
required>

<br><br>

<button type="submit"
name="update"
class="btn-primary">
Cập nhật
</button>

</form>
