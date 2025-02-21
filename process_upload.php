<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require 'vendor/autoload.php'; // Required for PHPSpreadsheet (Excel support)

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_types = ['csv', 'xlsx'];
        $file_name = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_size = $_FILES["file"]["size"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_types)) {
            die("<div class='alert alert-danger text-center'>❌ Invalid file type! Only CSV and XLSX files are allowed.</div>");
        }

        if ($file_size > 2 * 1024 * 1024) {
            die("<div class='alert alert-danger text-center'>❌ File is too large! Maximum size is 2MB.</div>");
        }

        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $destination = $upload_dir . basename($file_name);
        if (!move_uploaded_file($file_tmp, $destination)) {
            die("<div class='alert alert-danger text-center'>❌ Error uploading file.</div>");
        }

        $num_rows = 0;
        $preview_data = [];

        if ($file_ext === 'csv') {
            $file = fopen($destination, "r");
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num_rows++;
                if ($num_rows <= 5) {
                    $preview_data[] = $data;
                }
            }
            fclose($file);
        } elseif ($file_ext === 'xlsx') {
            $spreadsheet = IOFactory::load($destination);
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($sheet->getRowIterator() as $row) {
                $num_rows++;
                if ($num_rows <= 5) {
                    $row_data = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $row_data[] = $cell->getValue();
                    }
                    $preview_data[] = $row_data;
                }
            }
        }

        echo "<div class='alert alert-success text-center'><h2>✅ File Uploaded Successfully!</h2></div>";
        echo "<div class='card shadow p-3'><p><strong>File Name:</strong> $file_name</p>";
        echo "<p><strong>File Size:</strong> " . round($file_size / 1024, 2) . " KB</p>";
        echo "<p><strong>File Type:</strong> " . strtoupper($file_ext) . "</p>";
        echo "<p><strong>Number of Rows:</strong> $num_rows</p></div>";

        if (!empty($preview_data)) {
            echo "<h3 class='mt-4 text-center'>📄 File Preview (First 5 Rows)</h3>";
            echo "<div class='table-responsive'><table class='table table-striped table-hover mt-3'>";
            foreach ($preview_data as $row) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table></div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>❌ No file uploaded or an error occurred.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4 text-center">
            <h2 class="text-primary">📂 Upload File (CSV/XLSX)</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="mt-4" id="uploadForm">
                <div class="mb-3">
                    <input type="file" class="form-control" name="file" required>
                </div>
                <div class="progress mb-3 d-none" id="progressBarContainer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%"></div>
                </div>
                <button type="submit" class="btn btn-success w-100">Upload & Process</button>
            </form>
        </div>
        
        <div id="uploadResult" class="mt-4"></div>
    </div>

    <script>
        $("#uploadForm").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $("#progressBarContainer").removeClass("d-none");
            $(".progress-bar").css("width", "50%");
            
            $.ajax({
                url: "", // Self-submitting
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#uploadResult").html(response);
                    $(".progress-bar").css("width", "100%");
                },
                error: function() {
                    $("#uploadResult").html('<div class="alert alert-danger text-center">Error uploading file.</div>');
                }
            });
        });
    </script>
</body>
</html>