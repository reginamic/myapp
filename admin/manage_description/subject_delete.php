<?php
require_once "../../backend/db_connect.php";

if (!isset($_GET['id'])) die("Invalid subject ID");

$subject_id = intval($_GET['id']);

$sql = "DELETE FROM subject_description WHERE ID = $subject_id";
if (mysqli_query($conn, $sql)) {
    header("Location: subject_manager.php");
    exit;
} else {
    echo "Error deleting subject: " . mysqli_error($conn);
}
?>
