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