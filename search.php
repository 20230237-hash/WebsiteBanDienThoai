<?php
include("includes/header.php");
include("config/database.php");

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

$sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
$result = $conn->query($sql);
?>



<?php if($result->num_rows > 0): ?>

<div class="product-grid">

<?php while($row = $result->fetch_assoc()): ?>

<div class="product-card">

<div class="product-img">
<img src="uploads/<?=$row['image']?>" alt="<?=$row['name']?>">
</div>

<h3 class="product-name"><?=$row['name']?></h3>

<p class="product-price">
<?=number_format($row['price'])?> VNĐ
</p>

<a href="product.php?id=<?=$row['id']?>" class="btn-view">
Xem chi tiết
</a>

</div>

<?php endwhile; ?>

</div>

<?php else: ?>

<p class="no-result">
Không tìm thấy sản phẩm phù hợp.
</p>

<?php endif; ?>

<?php include("includes/footer.php"); ?>
