<?php
require_once "../../backend/db_connect.php";
include "../../backend/header.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the enrollment
    $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to manage_enrollments.php
header("Location: manage_enrollments.php");
exit();
?>
