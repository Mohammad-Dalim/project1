<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Our Fonts</h3>
    <small>Browse a list of uploaded fonts</small>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>FONT NAME</th>
                <th>PREVIEW</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'font');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM fonts";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['name']); ?></td>
                        <td class="preview" style="font-family: <?php echo htmlspecialchars($result['name']); ?>;"><?php echo htmlspecialchars($result['preview']); ?></td>
                        <td class="text-center">
                            <a href="fontdelete.php?id=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" class="text-center">No data found.</td>
                </tr>
                <?php
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
