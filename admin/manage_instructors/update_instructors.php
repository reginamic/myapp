<?php
require_once "../../backend/crud.php";

$table = "instructors";

//  Fetch instructor data if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM $table WHERE instructor_id = $id");
    $instructor = mysqli_fetch_assoc($result);

    if (!$instructor) {
        header("Location: instructors_list.php");
        exit;
    }
}

//  Update instructor data
if (isset($_POST['update'])) {
    $data = [
        "full_name" => $_POST['full_name'],
        "role"      => $_POST['role'],
        "bio"       => $_POST['bio']
    ];

    $where = ["instructor_id" => $_POST['instructor_id']];
    updateRecord($table, $data, $where);

    header("Location: instructors_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Instructor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-warning mb-4">Update Instructor</h2>

    <form method="POST" class="p-4 bg-white rounded shadow">
        <input type="hidden" name="instructor_id" value="<?= $instructor['instructor_id'] ?>">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" 
                   value="<?= htmlspecialchars($instructor['full_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" name="role" class="form-control" 
                   value="<?= htmlspecialchars($instructor['role']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control" rows="4" required><?= htmlspecialchars($instructor['bio']) ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-warning">Update Instructor</button>
        <a href="instructors_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
