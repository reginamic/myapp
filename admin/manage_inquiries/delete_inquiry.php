<?php
require_once "../../backend/db_connect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the inquiry safely using prepared statement
    $stmt = $conn->prepare("DELETE FROM inquiries WHERE inquiry_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to manage_inquiry.php
header("Location: manage_inquiry.php");
exit();
?>
