<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost"; // Change if necessary
$dbname = "testt_db"; // Ensure this matches your database name
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP (leave empty)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
