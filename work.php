<?php

    session_start();
    require_once './connect.php';
    if(!isset($_SESSION["user_id"])) header("location:login.php");

    $sql = "SELECT * FROM tb_work
            INNER JOIN tb_member ON tb_work.w_worker = tb_member.m_id
            WHERE w_status = 'success' ";

    $work_success = mysqli_query($con, $sql);

    $sql = "SELECT * FROM tb_work
            INNER JOIN tb_member ON tb_work.w_worker = tb_member.m_id
            WHERE tb_work.w_commander = '{$_SESSION['user_id']}'";

    $work_order = mysqli_query($con, $sql);

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
    <div id="content" class="work <?= $_SESSION['status'] === 'admin'? "wrapper-work-admin":"wrapper-work-user" ?>">
        <!-- งานทั้งหมดที่เสร็จแล้ว -->
        <div class="work-all">
            <div class="title-work">
                <p>งานทั้งหมด</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>หัวข้อ</td>
                        <td>สั่งโดย</td>
                        <td>คนรับ</td>
                        <td>เวลาส่ง</td>
                        <td>เวลาหมดกำหนด</td>
                        <td>ไฟล์</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($work_success)): ?>
                        <tr>
                            <td><?= $row['w_id'] ?></td>
                            <td><?= $row['w_title'] ?></td>
                            <td>
                                <?php
                                    $x = mysqli_fetch_assoc(mysqli_query($con, "SELECT tb_member.m_firstname, tb_member.m_lastname 
                                    FROM tb_work INNER JOIN tb_member ON tb_work.w_commander = tb_member.m_id
                                    WHERE tb_work.w_id = '{$row['w_id']}'"));
                                    echo $x['m_firstname']." ".$x['m_lastname'];
                                ?>
                            </td>
                            <td><?= $row['m_firstname']." ".$row['m_lastname'] ?></td>
                            <td><?= date("d-m-Y h:i:sa", strtotime($row['w_datesubmit'])) ?></td>
                            <td><?= date("d-m-Y", strtotime($row['w_deadline'])) ?></td>
                            <td>
                                <?php 
                                    foreach (explode(",", $row['w_path']) as $key => $value) :
                                    if($key === (count(explode(",", $row['w_path']))-1)) break;
                                ?>
                                    <p><a target="_blank" href="<?=$value?>">
                                        <?= explode("upload/", $value)[1] ?>
                                    </a></p>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- งานที่สั่งเขา -->
        <?php if($_SESSION['status'] === "admin"): ?>
        <div class="work-order">
            <div class="title-work">
                <p>งานที่สั่ง</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>หัวข้อ</td>
                        <td>คนรับ</td>
                        <td>เวลาหมดกำหนด</td>
                        <td>สถานะ</td>
                        <td>รายละเอียด</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($work_order)): ?>
                        <tr>
                            <td><?= $row['w_id'] ?></td>
                            <td><?= $row['w_title'] ?></td>
                            <td><?= $row['m_firstname']." ".$row['m_lastname'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row['w_deadline'])) ?></td>
                            <td>
                                <?php 
                                    $datetime1 = date_create($row['w_deadline']);
                                    $datetime2 = date_create(date("Y-m-d"));
                                    if(date_diff($datetime2, $datetime1)->format('%R') !== "+"){
                                        echo "<p style='color:red;'>หมดกำหนด</p>";
                                    }else{
                                        if($row['w_status'] === "send") echo "ส่ง";
                                        else if($row['w_status'] === "proceed") echo "ดำเนินการ";
                                        else echo "<p style='background-color:#58D68D;color:white'>สำเร็จ</p>";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="work_detail.php?id=<?= $row['w_id'] ?>&name=<?= $row['m_firstname']." ".$row['m_lastname'] ?>" class="btn primary border-primary">เปิด</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>

</html>
<?php mysqli_close($con) ?>