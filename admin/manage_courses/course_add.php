<?php
require_once "../../backend/crud.php";

$table = "Course";

if (isset($_POST['add'])) {
    $data = [
        "Name" => $_POST['name'],
        "Description" => $_POST['description'],
        "Branch" => $_POST['branch'],
        "fees" => $_POST['fees'],
        "mode" => $_POST['mode'],
        "Duration" => $_POST['duration'],
        "img" => $_POST['img']
    ];
    insertRecord($table, $data);
    header("Location: course_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-success mb-4">Add New Course</h2>
  <form method="POST" class="p-4 bg-white rounded shadow">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Branch</label>
      <input type="text" name="branch" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Fees</label>
      <input type="number" name="fees" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Mode</label>
      <input type="text" name="mode" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Duration</label>
      <input type="text" name="duration" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Image URL</label>
      <input type="text" name="img" class="form-control">
    </div>
    <button type="submit" name="add" class="btn btn-success">Save Course</button>
    <a href="course_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
