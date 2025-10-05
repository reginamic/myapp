<?php
require_once "../../backend/crud.php";

$table = "notices";

// Fetch existing notice data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $table WHERE id=$id");
    $notice = mysqli_fetch_assoc($result);
}

// Update notice
if (isset($_POST['update'])) {
   $data = [
        "title"       => $_POST['title'],
        "description" => $_POST['description'],
         "notice_date" => $_POST['notice_date'],
        "branch"      => $_POST['branch'],
       
    ];
    $where = ["id" => $_POST['id']];
    updateRecord($table, $data, $where);
    header("Location: event_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Notice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-warning mb-4">Update Notice</h2>
  <form method="POST" class="p-4 bg-white rounded shadow">
    <input type="hidden" name="id" value="<?= $notice['id'] ?>">

    <div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" name="title" class="form-control" value="<?= $notice['title'] ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control"><?= $notice['description'] ?></textarea>
</div>




<div class="mb-3">
  <label class="form-label">Notice Date</label>
  <input type="date" name="event_date" class="form-control" value="<?= $notice['notice_date'] ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Branch</label>
  <input type="text" name="branch" class="form-control" value="<?= $notice['branch'] ?>" required>
</div>


    <button type="submit" name="update" class="btn btn-warning">Update Notice</button>
    <a href="event_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>
