<?php

    session_start();
    require_once './connect.php';
    if(!isset($_SESSION["user_id"])) header("location:login.php");
    if($_SESSION["status"] === "admin") header("location:index.php");
    
    if( isset($_GET['id']) && !empty($_GET['id']) ){
        $update_status_work = mysqli_query($con, " UPDATE tb_work SET w_status = 'proceed' WHERE w_id = '{$_GET['id']}' ");
        
        if($update_status_work) echo "<script>alert('รับงานสำเร็จ')</script>";
        else echo "<script>alert('เกิดข้อผิดพลาด')</script>";
    }

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
    <div id="content" class="wrapper-work">
        <div class="wrapper-work-me">
            <?php 
               $new_work = mysqli_query($con, "SELECT * FROM tb_work 
               INNER JOIN tb_member ON tb_work.w_commander = tb_member.m_id
               WHERE tb_work.w_worker = '{$_SESSION['user_id']}' AND w_status = 'send' ");
            ?>
            <div>
                <div class="title-work-me">
                    <p>งานใหม่</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ชื่อเรื่อง</th>
                            <th>สั่งโดย</th>
                            <th>กำหนดส่ง</th>
                            <th>รายละเอียด</th>
                            <th>รับงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($new_work)): ?>
                        <tr>
                            <td><?= $row['w_id'] ?></td>
                            <td><?= $row['w_title'] ?></td>
                            <td><?= $row['m_firstname']." ".$row['m_lastname'] ?></td>
                            <td><?= empty($row['w_deadline'])? "ไม่มีกำหนด":date("d-m-Y", strtotime($row['w_deadline']))?></td>
                            <td>
                                <a class="btn primary border-primary" href="work_detail.php?id=<?= $row['w_id'] ?>&name=<?= $row['m_firstname']." ".$row['m_lastname'] ?>" class="btn primary border-primary">เปิด</a>
                            </td>
                            <td>
                                <a href="work_me.php?id=<?=$row['w_id']?>" class="btn primary border-primary">รับงาน</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        
            <div>
                <?php 
                $proceed_work = mysqli_query($con, "SELECT * FROM tb_work 
                INNER JOIN tb_member ON tb_work.w_commander = tb_member.m_id
                WHERE tb_work.w_worker = '{$_SESSION['user_id']}' AND w_status = 'proceed' ");
                ?>
                <div class="title-work-me">
                    <p>งานที่กำลังดำเนินการ</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ชื่อเรื่อง</th>
                            <th>สั่งโดย</th>
                            <th>กำหนดส่ง</th>
                            <th>รายละเอียด</th>
                            <th>ส่งงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($proceed_work)): ?>
                        <tr>
                            <td><?= $row['w_id'] ?></td>
                            <td><?= $row['w_title'] ?></td>
                            <td><?= $row['m_firstname']." ".$row['m_lastname'] ?></td>
                            <td><?= empty($row['w_deadline'])? "ไม่มีกำหนด":date("d-m-Y", strtotime($row['w_deadline'])) ?></td>
                            <td>
                                <a class="btn primary border-primary" href="work_detail.php?id=<?= $row['w_id'] ?>&name=<?= $row['m_firstname']." ".$row['m_lastname'] ?>" class="btn primary border-primary">เปิด</a>
                            </td>
                            <td>
                                <?php 
                                $datetime1 = date_create($row['w_deadline']);
                                $datetime2 = date_create(date("Y-m-d"));

                                if(date_diff($datetime2, $datetime1)->format('%R') === "+"){ 
                                ?>
                                <a href="work_submit.php?id=<?= $row['w_id'] ?>&title=<?= $row['w_title'] ?>&detail=<?= $row['w_detail'] ?>&by=<?= $row['m_firstname']." ".$row['m_lastname'] ?>" class="btn success border-success">
                                    ส่งงาน
                                </a>
                                <?php 
                                }
                                else echo "<p style='color:red;'>หมดกำหนด</p>"
                                ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con) ?>