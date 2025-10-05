<?php
require_once "../../backend/crud.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = "Course";

    if (deleteRecord($table, ["Id" => $id])) {
        header("Location: course_list.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID specified.";
}
?>
