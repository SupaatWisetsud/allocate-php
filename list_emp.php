<?php
    session_start();
    require_once './connect.php';

    $sql = "SELECT * FROM tb_member WHERE m_status NOT IN('admin') ";

    $objQeury = mysqli_query($con, $sql);

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
        <div class="list-emp m-horizontal-auto">
            <div class="list_title">
                <p>รายชื่อพนักงาน</p>
                <a href="add_emp.php" class="btn success border-success">เพิ่มพนักงาน</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Name</td>
                        <td>email</td>
                        <td>Profile</td>
                        <td>Number Phone</td>
                        <td>Work</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($objQeury)): ?>
                    <tr>
                        <td>1</td>
                        <td> <?= $row["m_firstname"]." ".$row["m_lastname"] ?> </td>
                        <td> <?= $row["m_email"] ?> </td>
                        <td> <?= $row["m_numberphone"] ?> </td>
                        <td>
                            <img src="<?= $row['m_img'] ?>" width="80px" height="80px" style="border-radius: 50%;object-fit: cover">
                        </td>
                        <td>
                            <a class="btn success border-success" href="job_card.php?id=<?=$row['m_id']?>&name=<?=$row['m_firstname']." ".$row['m_lastname']?>">สั่งงาน</a>
                        </td>
                        <td>
                            <a class="btn danger border-danger" href="delete_emp.php?id=<?=$row['m_id']?>">ลบ</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>