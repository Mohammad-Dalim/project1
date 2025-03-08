<?php
$conn = mysqli_connect('localhost', 'root', '', 'font');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($conn, $_REQUEST['id']);

$sql = "DELETE FROM fonts WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Data is deleted successfully.');
            window.location.href='fontviewdata.php';
          </script>";
} else {
    echo "<script>
            alert('Data is not deleted.');
            window.location.href='fontviewdata.php';
          </script>";
}

mysqli_close($conn);
?>
