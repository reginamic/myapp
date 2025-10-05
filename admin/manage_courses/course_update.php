<?php
require_once "../../backend/crud.php";

$table = "Course";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $table WHERE Id=$id");
    $course = mysqli_fetch_assoc($result);
}

// Update data
if (isset($_POST['update'])) {
    $data = [
        "Name" => $_POST['name'],
        "Description" => $_POST['description'],
        "Branch" => $_POST['branch'],
        "fees" => $_POST['fees'],
        "mode" => $_POST['mode'],
        "Duration" => $_POST['duration'],
        "img" => $_POST['img']
    ];
    $where = ["Id" => $_POST['id']];
    updateRecord($table, $data, $where);
    header("Location: course_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-warning mb-4">Update Course</h2>
  <form method="POST" class="p-4 bg-white rounded shadow">
    <input type="hidden" name="id" value="<?= $course['Id'] ?>">

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="<?= $course['Name'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"><?= $course['Description'] ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Branch</label>
      <input type="text" name="branch" class="form-control" value="<?= $course['Branch'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Fees</label>
      <input type="number" name="fees" class="form-control" value="<?= $course['Fees'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Mode</label>
      <input type="text" name="mode" class="form-control" value="<?= $course['Mode'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Duration</label>
      <input type="text" name="duration" class="form-control" value="<?= $course['Duration'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Image URL</label>
      <input type="text" name="img" class="form-control" value="<?= $course['Img'] ?>">
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update Course</button>
    <a href="course_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
