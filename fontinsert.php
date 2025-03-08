<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .upload-box {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            text-align: center;
            background-color: #f1f1f1;
            cursor: pointer;
        }
        .upload-box.dragover {
            background-color: #e3e3e3;
        }
        .upload-box img {
            width: 50px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <form id="uploadForm" action="fontAddData.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="fontFile" name="fontFile" accept=".ttf" hidden>
        
        <div class="upload-box" id="dropZone">
            <img src="images/cloud.png" alt="Upload">
            <p><strong>Click to upload</strong> or drag and drop</p>
            <p><small>Only TTF File Allowed</small></p>
        </div>
    </form>

    <script>
        const dropZone = document.getElementById("dropZone");
        const fileInput = document.getElementById("fontFile");
        const form = document.getElementById("uploadForm");

        dropZone.addEventListener("click", () => fileInput.click());

        fileInput.addEventListener("change", function() {
            uploadFile(this.files[0]);
        });

        dropZone.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZone.classList.add("dragover");
        });

        dropZone.addEventListener("dragleave", () => {
            dropZone.classList.remove("dragover");
        });

        dropZone.addEventListener("drop", (e) => {
            e.preventDefault();
            dropZone.classList.remove("dragover");
            let file = e.dataTransfer.files[0];
            uploadFile(file);
        });

        function uploadFile(file) {
            if (file && file.name.split('.').pop().toLowerCase() === "ttf") {
                let formData = new FormData(form);
                formData.set("fontFile", file);

                fetch("fontAddData.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    window.location.href = "fontviewdata.php";
                })
                .catch(error => console.error("Error:", error));
            } else {
                alert("Only TTF files are allowed!");
            }
        }
    </script>

</body>
</html>
