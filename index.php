<?php
include "./classes/config.php";
include "./classes/get_users_infos.php";
include "./classes/insert_poll.php";
include "./classes/get_poll_infos.php";
function check_poll($user_check){
$poll_infos = new get_poll();
$poll_infos = $poll_infos -> get_poll();
foreach($poll_infos as $poll){
    if($poll['poll_user'] == $user_check){
        echo "شما قبلا نظر خود را ثبت کرده اید";
        exit();
    }
}
}
?>
<!DOCTYPE html>
<html lang="fa_IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/font-awesome/fontawesome.css">
    <link rel="stylesheet" href="./assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>خوش آمدید</title>
</head>
<body>
    <section class="panel-container d-flex justify-content-start flex-column flex-lg-row">
    <section class="right-menu col-12 col-lg-4 text-white">
        <section class="menu-panel">
            <?php
            session_start();
            $user_session_name = $_SESSION['user_name'];
            $user_session_password = $_SESSION['user_password'];
            if(!isset($user_session_name) && !isset($user_session_password)){
                header('location:login.php');
            }
            $users_infos = new get_users_infos();
            $users_infos = $users_infos -> get_users_infos($user_session_name , $user_session_password);
            foreach($users_infos as $user_info):
            ?>
            <p class="panel-username" dir="ltr"><?= "@" . $user_info['user_name']?></p>
            <?php
            endforeach;
            ?>
            <img src="./assets/img/user.png" alt="user-image" class="panel-user-image">
            <h5>سلام کاربر عزیز</h5>
        </section>
        <section class="menu-list-container">
            <ul class="menu-list">
                <li class="menu-list-item"><a href="?polls"><i class="fa fa-pencil-alt"></i> نظر سنجی ها </a></li>
                <li class="menu-list-item exit-item"><a href="?exit"><i class="fas fa-power-off"></i> خروج</a></li>
            </ul>
        </section>
    </section>
    <section class="left-part col-12 col-lg-8">
        <?php
        if(isset($_GET['polls'])){
        ?>
        <form method="post">
            <h3 class="text-center">نظر سنجی ها</h3>
        <section class="poll card d-flex justify-content-around">

            <section class="poll-item">
                گزینه1
                <input type="radio" name="ask" value="1">
            </section>
            <section class="poll-item">
                گزینه 2
                <input type="radio" name="ask" value="2">
            </section>
        </section>
        <?php
        if(isset($_POST['send-btn'])){
            $get_user = new get_users_infos();
            $get_user = $get_user->get_users_infos($user_session_name , $user_session_password);
            $poll_value = $_POST['ask'];
            $insert_poll = new inset_poll();
            foreach($get_user as $user){
                check_poll($user['user_id']);
                $insert_poll = $insert_poll -> insert_poll($poll_value , $user['user_id']);
                echo "نظر شما با موفقیت ثبت شد";
                }
        }
        ?>
        <button name="send-btn" class="send-btn col-4 mx-auto my-3">ارسال</button>
        </form>
        <?php
        }
        ?>
    </section>
</section>
    <script src="./assets/js/font-awesome/all.js"></script>
    <script src="./assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>
<?php
if(isset($_GET['exit'])){
    session_destroy();
    header('location:login.php');
}

?>