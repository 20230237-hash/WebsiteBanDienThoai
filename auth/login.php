<?php
session_start();
include("../config/database.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){

        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: ../index.php");
        exit();

    }else{
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>

<style>

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f3f4f6;
}

.login-box{
    width:400px;
    margin:100px auto;
    background:#fff;
    padding:35px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.login-box h2{
    text-align:center;
    margin-bottom:25px;
    font-size:22px;
}

.login-box input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #dcdcdc;
    border-radius:6px;
    font-size:14px;
    transition:0.2s;
}

.login-box input:focus{
    border-color:#ff4d4d;
    outline:none;
    box-shadow:0 0 0 2px rgba(255,77,77,0.1);
}

.login-box button{
    width:100%;
    padding:12px;
    background:#ff2d2d;
    border:none;
    color:#fff;
    font-size:16px;
    border-radius:6px;
    cursor:pointer;
    transition:0.2s;
}

.login-box button:hover{
    background:#e60000;
}

.error{
    color:#ff2d2d;
    text-align:center;
    margin-bottom:10px;
}

.register-link{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}

.register-link a{
    color:#6c3cff;
    text-decoration:none;
}

.register-link a:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="login-box">

<h2>🔑 Đăng nhập</h2>

<?php
if(isset($error)){
    echo "<p class='error'>$error</p>";
}
?>

<form method="post">

<input type="text" name="username" placeholder="Tên đăng nhập" required>

<input type="password" name="password" placeholder="Mật khẩu" required>

<button type="submit" name="login">
Đăng nhập
</button>

</form>

<div class="register-link">
Chưa có tài khoản? <a href="register.php">Đăng ký</a>
</div>

</div>

</body>
</html>
