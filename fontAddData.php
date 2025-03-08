<?php
$conn = mysqli_connect('localhost', 'root', '', 'font');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fontFile'])) {
    $filename = basename($_FILES['fontFile']['name']);
    $fileInfo = pathinfo($filename);
    $filenameWithoutExt = mysqli_real_escape_string($conn, $fileInfo['filename']);
    $tempname = $_FILES['fontFile']['tmp_name'];
    $destination = 'uploads/' . $filename;

    if ($fileInfo['extension'] === 'ttf') {
        if (move_uploaded_file($tempname, $destination)) {
            $sql = "INSERT INTO fonts (name, preview) VALUES ('$filenameWithoutExt', '$filenameWithoutExt')";
            if (mysqli_query($conn, $sql)) {
                header("Location: fontviewdata.php?message=success");
                exit();
            } else {
                header("Location: fontinsert.php?message=database_error");
                exit();
            }
        } else {
            header("Location: fontinsert.php?message=upload_error");
            exit();
        }
    } else {
        header("Location: fontinsert.php?message=invalid_file");
        exit();
    }
} else {
    header("Location: fontinsert.php?message=invalid_request");
    exit();
}

mysqli_close($conn);
?>
