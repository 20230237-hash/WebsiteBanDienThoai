<?php 
include("includes/header.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0){
    echo "<h2>Không tìm thấy sản phẩm</h2>";
    include("includes/footer.php");
    exit();
}

$product = $result->fetch_assoc();
?>

<div class="product-detail">
    
    <div class="product-image">
        <img src="uploads/<?=$product['image']?>" alt="">
    </div>

    <div class="product-info">
        <h2><?=$product['name']?></h2>
        <p class="detail-price"><?=formatPrice($product['price'])?></p>

        <p class="stock">
            Còn hàng: <strong><?=$product['stock']?></strong>
        </p>

        <form method="post" action="cart.php">
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="number" name="quantity" value="1" min="1" class="qty-input">
            <button type="submit" name="add_cart" class="btn-add">
                🛒 Thêm vào giỏ
            </button>
        </form>

        <div class="description">
            <h3>Mô tả sản phẩm</h3>
            <p><?=$product['description']?></p>
        </div>
    </div>

</div>

<?php include("includes/footer.php"); ?>
