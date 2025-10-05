<?php
require_once "../../backend/crud.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input
    $table = "notices";

    if (deleteRecord($table, ["id" => $id])) {
        header("Location: event_list.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID specified.";
}
?>
