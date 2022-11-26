<?php
include("./classes/config.php");
include ("./classes/insert_users.php");
include("./classes/get_unique_user_name.php");
?>
<!DOCTYPE html>
<html lang="fa_IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/font-awesome/fontawesome.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>ساخت حساب کاربری</title>
</head>
<body>
    <div class="login-form-container col-11 col-lg-4">
        <img src="./assets/img/user.png" class="login-image">
        <h4 class="my-3">خوش آمدید</h4>
        <p class="text-secondary my-2">برای ساخت حساب در سایت ، اطلاعات را تکمیل کنید</p>
        <?php
                if(isset($_GET['null_err'])){
                    ?>
                <p class="err">مقادیر شما خالی هستند.</p>
                <?php 
                }
                elseif(isset($_GET['not_unique'])){
                    ?>
                    <p class="err">این نام کاربری قبلا ثبت شده است</p>
                    <?php
                }
                ?>
        <div class="form-container">
            <form method="post">
                <div class="login-form d-flex">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="نام کاربری خود را وارد کنید" autocomplete="off" name="user_name" class="col-12">
                </div>
                <div class="login-form d-flex">
                    <i class="fas fa-pencil-alt"></i>
                    <input type="text" placeholder="نام خود را وارد کنید" autocomplete="off" name="user_fn_name" class="col-12">
                </div>
                <div class="login-form d-flex">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="ایمیل خود را وارد کنید" name="user_email" class="col-12">
                </div>
                <div class="login-form d-flex">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="رمز خود را وارد کنید" name="user_password" class="col-12">
                </div>
    
                <button class="login-btn col-6" name="submit-btn">ورود</button>
            </form>
            <p class="text-secondary m-3">حساب کاربری دارید ؟</p>
            <a href="login.php" class="login-link">وارد شوید</a>
        </div>
    </div>
    <script src="./assets/js/bootstrap/bootstrap.js"></script>
    <script src="./assets/js/font-awesome/all.js"></script>
</body>
</html>
<?php
if(isset($_POST['submit-btn'])){
$user_name = htmlspecialchars($_POST['user_name']);
$user_fn_name = htmlspecialchars($_POST['user_fn_name']);
$user_email = htmlspecialchars($_POST['user_email']);
$user_password = htmlspecialchars($_POST['user_password']);
if(empty($user_name) || empty($user_fn_name) || empty($user_email) || empty($user_password)){
    header('location:?null_err');
}
else{
    $unique_user = new unique_user();
    $unique_user = $unique_user -> unique_user();
    foreach($unique_user as $user){
        if($user['user_name'] == $user_name){
            header('location:?not_unique');
            exit();
        }
    }
    $insert_users = new insert_users();
$insert_users -> insert_user($user_name , $user_fn_name , $user_email , $user_password);
header('location:login.php');
    }
}
?>