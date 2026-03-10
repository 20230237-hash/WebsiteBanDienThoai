<?php
session_start();
include(__DIR__ . "/config/database.php"); // FIX ĐÚNG ĐƯỜNG DẪN

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    echo "<h3>Giỏ hàng trống!</h3>";
    exit();
}

// Tính tổng tiền
$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {

    $id = (int)$id;
    $qty = (int)$qty;

    $result = $conn->query("SELECT price FROM products WHERE id = $id");

    if ($result && $row = $result->fetch_assoc()) {
        $total += $row['price'] * $qty;
    }
}

// ================== XỬ LÝ ĐẶT HÀNG ==================
if (isset($_POST['place_order'])) {

    $user_id = (int)$_SESSION['user_id'];
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $note = $conn->real_escape_string($_POST['note']);

    if (empty($phone) || empty($address)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin');</script>";
    } else {

        $sql = "INSERT INTO orders
                (user_id,total,phone,address,payment_method,payment_status,status,note,created_at)
                VALUES
                ($user_id,$total,'$phone','$address','cod','unpaid','pending','$note',NOW())";

        if (!$conn->query($sql)) {
            die("Lỗi tạo đơn hàng: " . $conn->error);
        }

        $order_id = $conn->insert_id;

        // Lưu chi tiết đơn hàng
        foreach ($_SESSION['cart'] as $id => $qty) {

            $id = (int)$id;
            $qty = (int)$qty;

            $result = $conn->query("SELECT price FROM products WHERE id = $id");
            $row = $result->fetch_assoc();
            $price = $row['price'];

            $conn->query("
                INSERT INTO order_details(order_id,product_id,price,quantity)
                VALUES($order_id,$id,$price,$qty)
            ");

            $conn->query("
                UPDATE products 
                SET stock = stock - $qty 
                WHERE id = $id
            ");
        }

        unset($_SESSION['cart']);

        header("Location: order_success.php?id=$order_id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <style>
        body { font-family: Arial; padding: 40px; }
        .box { width: 400px; margin: auto; }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: green;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>💳 THANH TOÁN</h2>

    <p><strong>Tổng tiền:</strong>
        <?=number_format($total,0,",",".")?> đ
    </p>

    <form method="post">
        <input type="text" name="phone" placeholder="Số điện thoại" required>
        <textarea name="address" placeholder="Địa chỉ nhận hàng" required></textarea>
        <textarea name="note" placeholder="Ghi chú (nếu có)"></textarea>
        <button type="submit" name="place_order">ĐẶT HÀNG</button>
    </form>

</div>

</body>
</html>
