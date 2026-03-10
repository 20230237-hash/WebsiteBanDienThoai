<?php
include("../../config/database.php");
include("../check_admin.php");

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"../../uploads/".$image);

    $conn->query("
        INSERT INTO products(name,price,description,image)
        VALUES('$name','$price','$description','$image')
    ");

    header("Location:list.php");
}
?>

<h2>➕ Thêm sản phẩm</h2>

<form method="post" enctype="multipart/form-data">

Tên sản phẩm<br>
<input type="text" name="name" required>
<br><br>

Giá sản phẩm<br>
<input type="number" name="price" required>
<br><br>

Mô tả<br>
<textarea name="description"></textarea>
<br><br>

Hình ảnh<br>
<input type="file" name="image">
<br><br>

<button type="submit" name="add_product" class="btn">
Thêm sản phẩm
</button>

</form>
