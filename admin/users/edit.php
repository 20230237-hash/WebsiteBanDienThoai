<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

$user = $conn->query("
SELECT * FROM users WHERE id=$id
")->fetch_assoc();

if(isset($_POST['update'])){

    $role = $_POST['role'];

    $conn->query("
    UPDATE users
    SET role='$role'
    WHERE id=$id
    ");

    header("Location:list.php");
}
?>

<h2>Sửa quyền user</h2>

<form method="post">

<p><b>Username:</b> <?=$user['username']?></p>

<select name="role">

<option value="user" <?=$user['role']=="user"?'selected':''?>>
User
</option>

<option value="admin" <?=$user['role']=="admin"?'selected':''?>>
Admin
</option>

</select>

<br><br>

<button name="update">Cập nhật</button>

</form>
