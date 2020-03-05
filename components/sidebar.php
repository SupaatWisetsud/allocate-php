<?php 
    $route = array();
    if($_SESSION["status"] === "admin"){
        $route = array(
            array("link"=>"index.php", "display"=>"หน้าหลัก", "icon"=>"fas fa-home"),
            array("link"=>"edit_profile.php", "display"=>"แก้ไขโปรไฟล์", "icon"=>"far fa-id-badge"),
            array("link"=>"work.php", "display"=>"รายการงาน", "icon"=>"far fa-file-word"),
            array("link"=>"list_emp.php", "display"=>"พนักงาน", "icon"=>"fas fa-users"),
            array("link"=>"logout.php", "display"=>"ออกจากระบบ", "icon"=>"fas fa-sign-out-alt"),
        );
    }else{
        $route = array(
            array("link"=>"index.php", "display"=>"หน้าหลัก", "icon"=>"fas fa-home"),
            array("link"=>"edit_profile.php", "display"=>"แก้ไขโปรไฟล์", "icon"=>"far fa-id-badge"),
            array("link"=>"work.php", "display"=>"รายการงาน", "icon"=>"far fa-file-word"),
            array("link"=>"work_me.php", "display"=>"งานของฉัน", "icon"=>"far fa-file-word"),
            array("link"=>"logout.php", "display"=>"ออกจากระบบ", "icon"=>"fas fa-sign-out-alt"),
        );
    }
    $sql = "SELECT * FROM tb_member WHERE m_id = {$_SESSION['user_id']} LIMIT 1";
    
    $objQuery = mysqli_query($con, $sql);
    if(!mysqli_num_rows($objQuery)) header("Location:logout.php");
    $row = mysqli_fetch_assoc($objQuery);
?>
<div class="sidebar">
    <div class="logo">
        <p>LOGO</p>
    </div>
    <div class="profile">
        <img src="<?= $row['m_img'] ?>" alt="<?= $row['m_id'] ?>" style="border: 3px solid <?= $row['m_status']==="admin"? "#A569BD":"#5DADE2" ?>">
        <p>คุณ : <?= $row['m_firstname']." ".$row['m_lastname'] ?></p>
        <p>สถานะ : <?= $row['m_status']==="admin"? "ผู้ดูแล":"พนักงาน" ?></p>
    </div>
    <nav class="navigation">
     <ul>
        <?php foreach($route as $value) : ?>
            <a href="<?= $value["link"] ?>">
                <li>
                    <i class="<?= $value["icon"] ?>"></i> <span><?= $value["display"] ?></span>
                </li>
            </a>
        <?php endforeach;?>
     </ul>
    </nav>
</div>