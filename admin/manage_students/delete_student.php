<?php
require_once "../../backend/crud.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = "users";

    if (deleteRecord($table, ["id" => $id])) {
        echo "deleted"; // respond with "deleted" so JS can detect success
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID specified.";
}
?>
