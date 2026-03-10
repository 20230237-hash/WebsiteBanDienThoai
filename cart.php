<?php
include("includes/header.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ===== THÊM VÀO GIỎ ===== */
if (isset($_POST['add_cart'])) {

    $id  = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    if ($qty < 1) $qty = 1;

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    header("Location: cart.php");
    exit();
}

/* ===== CẬP NHẬT GIỎ ===== */
if (isset($_POST['update_cart'])) {

    if (!empty($_POST['qty'])) {

        foreach ($_POST['qty'] as $id => $qty) {

            $id = intval($id);
            $qty = intval($qty);

            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = $qty;
            }

        }
    }
}

/* ===== XÓA SẢN PHẨM ===== */
if (isset($_GET['remove'])) {

    $id = intval($_GET['remove']);

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

}
?>

<h2 class="cart-title">🛒 GIỎ HÀNG CỦA BẠN</h2>

<?php if (empty($_SESSION['cart'])): ?>

<div class="empty-cart">
    <p>Giỏ hàng của bạn đang trống.</p>
    <a href="index.php" class="btn-primary">Tiếp tục mua sắm</a>
</div>

<?php else: ?>

<form method="post">

<table class="cart-table">

<tr>
<th>Sản phẩm</th>
<th>Giá</th>
<th>Số lượng</th>
<th>Tổng</th>
<th>Xóa</th>
</tr>

<?php

$total = 0;

foreach ($_SESSION['cart'] as $id => $qty):

$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) continue;

$row = $result->fetch_assoc();

$sub = $row['price'] * $qty;

$total += $sub;

?>

<tr>

<td class="cart-product">

<?php if(!empty($row['image'])): ?>
<img src="uploads/<?=$row['image']?>" width="60">
<?php endif; ?>

<?=$row['name']?>

</td>

<td><?=formatPrice($row['price'])?></td>

<td>
<input
type="number"
name="qty[<?=$id?>]"
value="<?=$qty?>"
min="1"
class="cart-qty"
>
</td>

<td class="cart-sub">
<?=formatPrice($sub)?>
</td>

<td>
<a
href="cart.php?remove=<?=$id?>"
class="cart-remove"
onclick="return confirm('Xóa sản phẩm này?')"
>
❌
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

<div class="cart-summary">

<h3>
Tổng tiền:
<span class="price">
<?=formatPrice($total)?>
</span>
</h3>

<div class="cart-buttons">

<button type="submit" name="update_cart" class="btn">
Cập nhật giỏ hàng
</button>

<a href="checkout.php" class="btn-primary">
Thanh toán
</a>

</div>

</div>

</form>

<?php endif; ?>

<?php include("includes/footer.php"); ?>
