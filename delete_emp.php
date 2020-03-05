<?php
    session_start();
    require_once './connect.php';

    if(!isset($_SESSION["user_id"])) header("location:index.php");
    if($_SESSION["status"] !== "admin") header("location:index.php");
    if(!isset($_GET['id'])) header("location:list_emp.php");

    // echo "DELETE FROM tb_member WHERE m_id = '{$_GET['id']}' ";
    // exit();
    if(mysqli_query($con, "DELETE FROM tb_member WHERE m_id = '{$_GET['id']}' ")){
        echo "<script>
                if(confirm('ลบพนักงานเสร็จสิ้น!')) location.replace('list_emp.php');
                else location.replace('list_emp.php');
            </script>";
    }else{
        echo "<script>
                if(confirm('เกิดข้อผิดพลาด!')) location.replace('list_emp.php');
                else location.replace('list_emp.php');
            </script>";
    }
?>