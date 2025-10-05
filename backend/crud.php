<?php
require_once "db_connect.php";

// Insert record
function insertRecord($table, $data) {
    global $conn;
    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($data), $conn), array_values($data))) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return mysqli_query($conn, $sql);
}

// Update record
function updateRecord($table, $data, $where) {
    global $conn;
    $updates = [];
    foreach ($data as $col => $val) {
        $updates[] = "$col='" . mysqli_real_escape_string($conn, $val) . "'";
    }
    $updates = implode(", ", $updates);

    $conditions = [];
    foreach ($where as $col => $val) {
        $conditions[] = "$col='" . mysqli_real_escape_string($conn, $val) . "'";
    }
    $conditions = implode(" AND ", $conditions);

    $sql = "UPDATE $table SET $updates WHERE $conditions";
    return mysqli_query($conn, $sql);
}

// Delete record
function deleteRecord($table, $where) {
    global $conn;
    $conditions = [];
    foreach ($where as $col => $val) {
        $conditions[] = "$col='" . mysqli_real_escape_string($conn, $val) . "'";
    }
    $conditions = implode(" AND ", $conditions);

    $sql = "DELETE FROM $table WHERE $conditions";
    return mysqli_query($conn, $sql);
}

// Fetch all records
function getAllRecords($table) {
    global $conn;
    $sql = "SELECT * FROM $table";
    return mysqli_query($conn, $sql);
}
?>