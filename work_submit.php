<?php 
    session_start();
    require_once './connect.php';
    if(!isset($_SESSION["user_id"])) header("location:login.php");
    if($_SESSION["status"] === "admin") header("location:index.php");
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
        <div class="wrapper-work-submit">
            <div class="title-work-submit">
                <p>ส่งงาน</p>
            </div>
            <div class="upload-work-submit">
                <div>
                    <div>
                        <p>หัวข้อ : <?= $_GET['title'] ?> </p>
                    </div>
                    <div>
                        <p>สั่งโดย : <?= $_GET['by'] ?> </p>
                    </div>
                    <div>
                        <p>รายละเอียด : <?= $_GET['detail'] ?> </p>
                    </div>
                </div>
                <div>
                    <div class="dropzone" id="dropzone">
                        Upload File
                    </div>
                    <div class="upload" id="upload"></div>
                </div>
            </div>

            <div class="btn-work-submit">
                <button class="btn primary border-primary" onclick="upload(<?= $_GET['id'] ?>)">ส่ง</button>
                <button class="btn danger border-danger" onclick="clearUpload()">ยกเลิก</button>
            </div>
        </div>
    </div>
    <script>
        var fileUpload;

        var dropzone = document.getElementById("dropzone");
        dropzone.ondragover = function () {
            this.className = "dropzone dragover";
            return false;
        }
        dropzone.ondragleave = function () {
            this.className = "dropzone";
            return false;
        }
        dropzone.ondrop = function (e) {
            e.preventDefault();
            this.className = "dropzone";
            fileUpload = e.dataTransfer.files;
            displayUplaod();
        }

        function displayUplaod() {
            var upload = document.getElementById('upload');
            upload.innerHTML = "";
            let tag;
            for (let x of fileUpload) {
                tag = document.createElement("p");
                tag.innerText = x.name;
                upload.appendChild(tag);
            }
        }

        function upload(id) {
            
            if (fileUpload === undefined) {
                alert("ไม่มีไฟล์ที่จะ upload!");
            } else {
                var xhr = new XMLHttpRequest();

                var fd = new FormData();

                for (let x of fileUpload) {
                    fd.append("file[]", x);
                }
                fd.append("id", id);
                xhr.open("post", "server/upload.php");
                xhr.send(fd);
                xhr.onload = function () {
                    if (confirm(this.responseText)) {
                        location.replace("work.php");
                    } else {
                        location.replace("work.php");
                    }

                }

            }
        }

        function clearUpload() {
            document.getElementById('upload').innerHTML = "";
            fileUpload = undefined;
        }
    </script>
</body>
</html>