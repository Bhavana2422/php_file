<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV/Excel File</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f7f6;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            background: #fff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn-upload {
            background: #007bff;
            color: white;
        }
        .btn-upload:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Upload a CSV or Excel File</h2>

    <form action="process_upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control" name="file" accept=".csv, .xlsx" required>
        </div>
        <button type="submit" class="btn btn-upload">Upload</button>
    </form>

    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
