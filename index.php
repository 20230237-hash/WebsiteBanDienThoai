<?php include("includes/header.php"); ?>

<section class="hero-slider">

<div class="slide active">

<a href="#" class="btn-primary">Mua ngay</a>
</div>

<div class="slide">

<a href="#" class="btn-primary">Xem ngay</a>
</div>

<div class="slide">

<a href="#" class="btn-primary">Mua ngay</a>
</div>

</section>

<h2 class="section-title">SẢN PHẨM MỚI NHẤT</h2>

<div class="product-grid">
<?php
$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()):
?>
    <div class="product-card">
        <img src="uploads/<?=$row['image']?>" alt="">
        <h3><?=$row['name']?></h3>
        <p class="price"><?=formatPrice($row['price'])?></p>
        <a class="btn" href="product.php?id=<?=$row['id']?>">Xem chi tiết</a>
    </div>
<?php endwhile; ?>
</div>

<?php include("includes/footer.php"); ?>
