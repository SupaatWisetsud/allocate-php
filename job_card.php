<?php
    session_start();
    require_once './connect.php';
    if(!(isset($_GET['id']) && isset($_GET['name']))) header("Location:list_emp.php");

    if(isset($_POST['submit'])){
        $sql = "";
        if($_POST['date'] === ''){
            $sql = "INSERT INTO tb_work(w_title, w_detail, w_worker, w_commander, w_status) 
                    VALUES ('{$_POST['title']}', '{$_POST['detail']}', '{$_GET['id']}', '{$_SESSION['user_id']}', 'send') ";
        }else{
            $datetime1 = date_create($_POST['date']);
            $datetime2 = date_create(date("Y-m-d"));
            if(date_diff($datetime2, $datetime1)->format('%R') === "+"){
                $sql = "INSERT INTO tb_work(w_title, w_detail, w_worker, w_commander, w_deadline, w_status) 
                    VALUES ('{$_POST['title']}', '{$_POST['detail']}', '{$_GET['id']}', '{$_SESSION['user_id']}', '{$_POST['date']}', 'send') ";
            }else{
                echo "<script>
                        if(confirm('กรุณาใส่เวลาให้ถูกต้อง!')) location.replace('list_emp.php');
                        else location.replace('list_emp.php');
                    </script>";
            }
        }
        
        $objQuery = mysqli_query($con, $sql);
        if($objQuery){
            echo "<script>
                    if(confirm('สั่งงานสำเร็จ')) location.replace('list_emp.php');
                    else location.replace('list_emp.php');
                </script>";
        }
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
    <div id="content">
        <div class="wrapper-job-card">
            <div class="title-job-card">
                <p>สั่งงาน</p>
                <p>ถึงคุณ : <?= $_GET['name']?></p>
            </div>
            <div class="wrapper-job-card-form">
                <form method="post">
                    <div>
                        <label for="title">หัวข้อเรื่อง</label>
                        <input type="text" name="title" required>
                    </div>
                    <div>
                        <label for="detail">รายละเอียด</label>
                        <textarea name="detail" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <label for="detail">เวลาส่ง</label>
                        <input type="date" name="date" >
                    </div>
                    <div>
                        <button class="btn success border-success" type="submit" name="submit">ยืนยัน</button>
                        <a class="btn danger border-danger" href="list_emp.php">ยกเลิก</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>