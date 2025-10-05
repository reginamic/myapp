<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Prevent caching of protected pages
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$loggedInUser = $_SESSION['firstname'] ?? '';
?>
