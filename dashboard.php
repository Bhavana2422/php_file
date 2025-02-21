<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

echo "<h1>Welcome to the Dashboard, " . htmlspecialchars($_SESSION['user']) . "!</h1>";
?>

<a href="logout.php">Logout</a>
