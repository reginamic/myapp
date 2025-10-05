<?php
require_once "../../backend/db_connect.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    // Allow only specific values
    $allowed = ["Accepted", "Rejected"];
    if (in_array($status, $allowed)) {
        $stmt = $conn->prepare("UPDATE enrollments SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back to manage_enrollments.php so changes are visible
header("Location: manage_enrollments.php");
exit();
?>
