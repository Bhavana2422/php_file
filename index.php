<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirects to login instead of index.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; background: #f9f9f9; }
        input, button { margin-top: 10px; padding: 10px; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h2>Upload a CSV or Excel File</h2>
    <form action="process_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv, .xlsx" required>
        <button type="submit">Upload</button>
    </form>

</body>
</html>
