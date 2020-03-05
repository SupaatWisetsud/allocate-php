<?php
session_start();
require_once './connect.php';
if (isset($_POST["submit"])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confrim_password = $_POST['confrim_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $number_phone = $_POST['number_phone'];

    $sql = "SELECT * FROM tb_member WHERE m_username = '{$username}' OR m_email = '{$email}' ";
    $objQuery = mysqli_query($con, $sql);
    
    if(!mysqli_num_rows($objQuery)){
        if($password === $confrim_password){
            
            $new_password = $password;

            if(file_exists($_FILES['file']["tmp_name"]) && is_uploaded_file($_FILES['file']['tmp_name'])){
                
                $path_file = 'assets/img/'.$_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $path_file);

                $sql = "INSERT INTO tb_member(m_username, m_password, m_firstname, m_lastname, m_email, m_numberphone, m_status, m_img) 
                VALUES ('{$username}', '{$new_password}', '{$first_name}', '{$last_name}', '{$email}', '{$number_phone}', '{$status}', '$path_file')";
                
            }else{
                $sql = "INSERT INTO tb_member(m_username, m_password, m_firstname, m_lastname, m_email, m_numberphone, m_status) 
                VALUES ('{$username}', '{$new_password}', '{$first_name}', '{$last_name}', '{$email}', '{$number_phone}', '{$status}')"; 
            }

            $objQuery = mysqli_query($con, $sql);
 
            if($objQuery) header("location:list_emp.php");
            else echo "<script> alert('ไม่สามารถเพิ่มผู้ใช้ได้') </script>";
        }
        else echo "<script> alert('Password ไม่ตรงกัน') </script>";
    }else echo "<script> alert('Username หรือ Email นี่มีอยู่แล้ว') </script>";
    
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
        <div class="wrapper-add-emp">
            <div class="title-add-emp">
                <a class="btn danger border-danger" href="list_emp.php">
                    <- กลับไป 
                </a>
                <p>เพิ่มพนักงาน</p>
            </div> 
            <div class="warpper-form-add-emp">
                <form method="post" enctype="multipart/form-data">
                    <div class="items-add-emp-form">
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <div class="items-add-emp-form">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div class="items-add-emp-form">
                        <input type="password" name="confrim_password" placeholder="Confrim Password">
                    </div>
                    <div class="items-add-emp-form2">
                        <input type="text" name="first_name" placeholder="First Name">
                        <input type="text" name="last_name" placeholder="Last Name">
                    </div>
                    <div class="items-add-emp-form">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="items-add-emp-form">
                        <select name="status">
                            <option value="user" selected>พนักงาน</option>
                            <option value="admin">ผู้ดูแล</option>
                        </select>
                    </div>
                    <div class="items-add-emp-form">
                        <input type="number" name="number_phone" placeholder="Number Phone">
                    </div>
                    <div class="items-add-emp-form">
                        <button class="btn primary border-primary" type="submit" name="submit">ตกลง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php mysqli_close($con); ?>