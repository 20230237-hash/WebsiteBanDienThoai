<?php
include("includes/header.php");
include("config/database.php");

if(!isset($_GET['id'])){
    echo "Không có danh mục!";
    exit();
}

$category_id = intval($_GET['id']);

$sql = "SELECT * FROM products WHERE category_id = $category_id";
$result = $conn->query($sql);
?>

<h2>Sản phẩm theo danh mục</h2>

<div class="product-grid">

<?php while($row = $result->fetch_assoc()): ?>

<div class="product-card">

<img src="uploads/<?=$row['image']?>" width="150">

<h3><?=$row['name']?></h3>

<p><?=number_format($row['price'])?> VNĐ</p>

<a href="product.php?id=<?=$row['id']?>" class="btn">Xem chi tiết</a>

</div>

<?php endwhile; ?>

</div>

<?php include("includes/footer.php"); ?>
