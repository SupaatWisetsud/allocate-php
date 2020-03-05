<?php 
    session_start();
    require_once './dist/timeAgo.php';
    require_once './connect.php';

    if(!isset($_SESSION["user_id"])) header("location:login.php");

    $sql = "SELECT * FROM tb_work
            INNER JOIN tb_member ON tb_work.w_worker = tb_member.m_id
            WHERE w_status NOT IN('send') ORDER BY tb_work.w_datestatus desc";
    
    $post = mysqli_query($con, $sql);

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
        <div class="wrapper_post">
            <header class="title_index">
                <i class="fas fa-newspaper"></i> <span>ฟิดข่าว</span>
            </header>

            <div>
                <?php while($row = mysqli_fetch_assoc($post)):?>
                <div id="post">
                    <div class="post_header">
                        <p>คุณ : <?= $row['m_firstname']." ".$row['m_lastname'] ?> </p>
                        <p>สถานะ :  <?= $row['w_status'] === "proceed"? "รับงาน":"ส่งงาน" ?> </p>
                    </div>
                    <div class="post_body">
                        <p>เรื่อง : <?= $row['w_title'] ?> </p>
                        <p>รายละเอียด : <?= $row['w_detail'] ?> </p>
                    </div>
                    <div class="post_footer">
                        <p> <?= timeAgo($row['w_datestatus']) ?> </p>
                    </div>
                </div>
                <?php endwhile; ?>

            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>