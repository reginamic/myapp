<?php
require_once "../../backend/crud.php";

$table = "notices";

if (isset($_POST['add'])) {
    $data = [
        "title"       => $_POST['title'],
        "description" => $_POST['description'],
         "notice_date" => $_POST['notice_date'],
        "branch"      => $_POST['branch'],
       
    ];
    insertRecord($table, $data);
    header("Location: event_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Notice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-success mb-4">Add New Notice</h2>
  <form method="POST" class="p-4 bg-white rounded shadow">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>

    
     <div class="mb-3">
  <label class="form-label">Notice Date</label>
  <input type="date" name="notice_date" class="form-control" required>
</div>

    <div class="mb-3">
      <label class="form-label">Branch</label>
      <input type="text" name="branch" class="form-control" required>
    </div>



    <button type="submit" name="add" class="btn btn-success">Save Notice</button>
    <a href="event_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
