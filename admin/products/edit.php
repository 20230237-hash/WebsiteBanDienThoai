<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

$product = $conn->query("
    SELECT * FROM products WHERE id=$id
")->fetch_assoc();

if(isset($_POST['update_product'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp,"../../uploads/".$image);

        $conn->query("
            UPDATE products
            SET name='$name',
                price='$price',
                description='$description',
                image='$image'
            WHERE id=$id
        ");

    }else{

        $conn->query("
            UPDATE products
            SET name='$name',
                price='$price',
                description='$description'
            WHERE id=$id
        ");
    }

    header("Location:list.php");
}
?>

<h2>✏️ Sửa sản phẩm</h2>

<form method="post" enctype="multipart/form-data">

Tên sản phẩm<br>
<input type="text" name="name" value="<?=$product['name']?>" required>
<br><br>

Giá<br>
<input type="number" name="price" value="<?=$product['price']?>" required>
<br><br>

Mô tả<br>
<textarea name="description"><?=$product['description']?></textarea>
<br><br>

Ảnh hiện tại<br>
<img src="../../uploads/<?=$product['image']?>" width="120">
<br><br>

Đổi ảnh<br>
<input type="file" name="image">
<br><br>

<button type="submit" name="update_product" class="btn">
Cập nhật
</button>

</form>
