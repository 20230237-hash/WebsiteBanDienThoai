<?php
include("../config/database.php");
session_start();

$message = "";

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if($username == "" || $password == ""){
        $message = "Vui lòng nhập đầy đủ thông tin";
    }
    elseif($password != $repassword){
        $message = "Mật khẩu nhập lại không đúng";
    }
    else{

        // kiểm tra username tồn tại
        $check = $conn->query("SELECT * FROM users WHERE username='$username'");

        if($check->num_rows > 0){
            $message = "Tên đăng nhập đã tồn tại";
        }else{

           $pass_hash = $password;

$sql = "INSERT INTO users(username,password,role)
        VALUES('$username','$pass_hash','user')";

            if($conn->query($sql)){
                header("Location: login.php");
                exit();
            }else{
                $message = "Đăng ký thất bại";
            }

        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Đăng ký</title>
<link rel="stylesheet" href="../assets/css/style.css">

<style>

.register-box{
    width:400px;
    margin:80px auto;
    background:#fff;
    padding:30px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.register-box h2{
    text-align:center;
    margin-bottom:20px;
}

.register-box input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

.register-box button{
    width:100%;
    padding:10px;
    background:#ff4d4d;
    border:none;
    color:#fff;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
}

.register-box button:hover{
    background:#e60000;
}

.message{
    color:red;
    text-align:center;
    margin-bottom:10px;
}

.login-link{
    text-align:center;
    margin-top:10px;
}

</style>

</head>
<body>

<div class="register-box">

<h2>📝 Đăng ký tài khoản</h2>

<?php if($message!=""): ?>
<p class="message"><?=$message?></p>
<?php endif; ?>

<form method="post">

<input type="text" name="username" placeholder="Tên đăng nhập" required>

<input type="password" name="password" placeholder="Mật khẩu" required>

<input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required>

<button type="submit" name="register">
Đăng ký
</button>

</form>

<div class="login-link">
Đã có tài khoản? <a href="login.php">Đăng nhập</a>
</div>

</div>

</body>
</html>
