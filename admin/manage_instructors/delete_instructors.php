<?php
require_once "../../backend/crud.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input

    // Direct SQL for instructors table
    global $conn;
    $sql = "DELETE FROM instructors WHERE instructor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "deleted";
    } else {
        echo "error: " . $stmt->error;
    }
    $stmt->close();
}
?>
