<?php
require_once "../../backend/crud.php";

$table = "instructors";

if (isset($_POST['add'])) {
    $data = [
        "full_name" => $_POST['full_name'],
        "role"      => $_POST['role'],
        "bio"       => $_POST['bio'],
       
    ];
    insertRecord($table, $data);
    header("Location: instructors_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Instructor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-success mb-4">Add New Instructor</h2>
  <form method="POST" class="p-4 bg-white rounded shadow">
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <input type="text" name="role" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Bio</label>
      <textarea name="bio" class="form-control" required></textarea>
    </div>

   
    <button type="submit" name="add" class="btn btn-success">Save Instructor</button>
    <a href="instructors_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
