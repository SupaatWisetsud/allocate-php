<?php 
    session_start();
    
    if(isset( $_SESSION["user_id"])) header("location:index.php");

    if(isset($_POST["submit"])){
        
        require_once "./connect.php";

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tb_member WHERE m_username = '{$username}' AND m_password = '{$password}' LIMIT 1";

        $objQuery = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($objQuery)){
            $objResult = mysqli_fetch_assoc($objQuery);
            
            $_SESSION["user_id"] = $objResult['m_id'];
            $_SESSION["status"] = $objResult['m_status'];

            header("location:index.php");
        }

        else echo "<script> alert('Username หรือ Password ของท่านไม่ถูกต้อง!') </script>";
        mysqli_close($con);
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
    <div class="container-page-login" style="width: 100%; height: 100vh">

        <div class="wrapper-form-login">

            <form class="form-login" method="post">
                <div class="title">
                    <p>Login page</p>
                </div>
                <div>
                    <input type="text" placeholder="Username" autofocus name="username">
                </div>
                <div>
                    <input type="password" placeholder="password" name="password">
                </div>
                <div>
                    <button type="submit" class="btn primary border-primary" name="submit">เข้าสู่ระบบ</button>
                </div>
            </form>

        </div>

    </div>
</body>
</html>