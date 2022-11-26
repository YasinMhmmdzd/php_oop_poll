<?php
include ("./classes/config.php");
include("./classes/get_users.php");

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
    <title>ورود به پنل نظر سنجی</title>
</head>
<body>
    <div class="login-form-container col-11 col-lg-4">
        <img src="./assets/img/user.png" class="login-image">
        <h4 class="my-3">خوش آمدید</h4>
        <p class="text-secondary my-2">برای ورود به سایت ، اطلاعات زیر را پر کنید</p>
        <?php
        if(isset($_GET['null_data'])){
            ?>
        <p class="err">مقادیر ورودی خالی است</p>
        <?php
        }
        elseif(isset($_GET['not_correct'])){
        ?>
        <p class="err">نام کاربری یا رمز عبور اشتباه است</p>
        <?php
        }
        ?>
        <div class="form-container">
            <form method="post">
                <div class="login-form d-flex">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="نام کاربری خود را وارد کنید" autocomplete="off" name="user_name">
                </div>
                <div class="login-form d-flex">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="رمز خود را وارد کنید" name="user_password">
                </div>
                <button class="login-btn col-6" name="login-btn">ورود</button>
            </form>
            <p class="text-secondary m-3">حساب کاربری ندارید؟</p>
            <a href="signup.php" class="login-link">ثبت نام کنید</a>
        </div>
    </div>
    <script src="./assets/js/bootstrap/bootstrap.js"></script>
    <script src="./assets/js/font-awesome/all.js"></script>
</body>
</html>
<?php
if(isset($_POST['login-btn'])){
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_password = htmlspecialchars($_POST['user_password']);
    if(empty($user_name) || empty($user_password)){
        header('location:?null_data');
    }
    else{
    $get_users = new get_users();
    $get_users = $get_users->get_user($user_name , $user_password);
    while($user = $get_users->fetch()){
        if($user_name == $user['user_name'] && $user_password == $user['user_password']){
            session_start();
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_password'] = $user_password;
            header('location:index.php');
        }
        elseif($user_name != $user['user_name'] || $user_password != $user['user_password']){
            header('location:?not_correct');
        }
    }
    }
}
?>