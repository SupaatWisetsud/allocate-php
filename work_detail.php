<?php

    session_start();
    require_once './connect.php';
    if(!isset($_SESSION["user_id"])) header("location:login.php");
    if(!(isset($_GET['id']) && isset($_GET['name']))) header("Location:work.php");

    $resutl = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_work WHERE w_id = '{$_GET['id']}' "));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Document</title>
</head>

<body>

    <?php include_once('./components/sidebar.php') ?>
    <div id="content">
        <div class="wrapper-wrok-detail">
            <div class="title-work-detail">
                <a class="btn danger border-danger" href="<?= $_SESSION['status'] === 'admin'? 'work.php':'work_me.php'?>"> <- กลับไปหน้าเดิม </a>
                <p>สั่งงาน</p>
            </div>
            <div class="box-work-detail">
                <p>ถึงคุณ : <?= $_GET['name']?></p>
            </div>
            <div class="box-work-detail">
                <p>หัวเรื่อง : <?= $resutl['w_title'] ?></p>
                <p>รายละเอียด : <?= $resutl['w_detail'] ?></p>
                <p>กำหนดส่ง : <?= date("d-m-Y", strtotime($resutl['w_deadline'])) ?></p>
            </div>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con) ?>