<?php
require_once "../../backend/crud.php";

$table = "events";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: event_list.php");
    exit;
}

$id = intval($_GET['id']); // Secure: ensure integer
global $conn;
$result = mysqli_query($conn, "SELECT * FROM $table WHERE id=$id");

if (!$result || mysqli_num_rows($result) == 0) {
    // If event not found
    header("Location: event_list.php");
    exit;
}

$event = mysqli_fetch_assoc($result);

// Update event
if (isset($_POST['update'])) {
  $data = [
    "title" => $_POST['title'],
    "description" => $_POST['description'],
    "event_date" => $_POST['event_date'],
    "branch" => $_POST['branch']
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
    <title>Update Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-warning mb-4">Update Event</h2>
    <form method="POST" class="p-4 bg-white rounded shadow">
        <input type="hidden" name="id" value="<?= htmlspecialchars($event['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

       <div class="mb-3">
    <label class="form-label">Event Date</label>
    <input type="date" name="event_date" class="form-control" value="<?= htmlspecialchars($event['event_date']) ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Branch</label>
    <input type="text" name="branch" class="form-control" value="<?= htmlspecialchars($event['branch']) ?>" required>
</div>


        <button type="submit" name="update" class="btn btn-warning">Update Event</button>
        <a href="event_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
