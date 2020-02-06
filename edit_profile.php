<?php 
    session_start();
    require_once './connect.php';
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
        <div class="wrapper-edit-profile">
            <div class="title-edit-profile">
                <p>แก้ไขโปรไฟล์</p>
            </div>
            <div class="form-edit-profile">
                <form method="post">
                    <div class="items-edit-profile-form">
                        <label for="username">Username</label>
                        <input type="text" value="<?= $row['m_username'] ?>">
                    </div>
                    <div class="items-edit-profile-form">
                        <label for="password">Password</label>
                        <input type="text" placeholder="******">
                    </div>
                    <div class="items-edit-profile-form">
                        <label for="password">Confrim Password</label>
                        <input type="text" placeholder="******">
                    </div class="items-edit-profile-form">
                    <div class="items-edit-profile-form2">
                        <div>
                            <label for="password">First Name</label>
                            <input type="text" value="<?= $row['m_firstname'] ?>">
                        </div>
                        <div>
                            <label for="password">Last Name</label>
                            <input type="text"  value="<?= $row['m_lastname'] ?>">
                        </div>
                    </div>
                    <div class="items-edit-profile-form">
                        <label for="email">Email</label>
                        <input type="email"  value="<?= $row['m_email'] ?>">
                    </div>
                    <div class="items-edit-profile-form">
                        <label for="profile">Profile</label>
                        <input type="file">
                    </div>
                    <div class="items-edit-profile-form">
                        <label for="number_phone">Number Phone</label>
                        <input type="number"  value="<?= $row['m_numberphone'] ?>">
                    </div>
                    <div class="items-edit-profile-form-btn">
                        <button type="submit" class="btn primary border-primary">อัพเดท</button>
                        <a href="index.php" class="btn danger border-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con) ?>