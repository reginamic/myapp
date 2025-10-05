<?php
require_once "../../backend/crud.php";

$table = "users";

// Fetch student data if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $table WHERE id=$id AND role='student'");
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        header("Location: manage_students.php");
        exit;
    }
}

// Update student data
if (isset($_POST['update'])) {
    $data = [
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "email" => $_POST['email'],
        "contact_no" => $_POST['contact_no'],
        "dob" => $_POST['dob']
    ];

    if (!empty($_POST['password'])) {
        $data["password"] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $where = ["id" => $_POST['id']];
    updateRecord($table, $data, $where);

    header("Location: manage_students.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-warning mb-4">Update Student</h2>

    <form method="POST" class="p-4 bg-white rounded shadow">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($student['first_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($student['last_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input type="text" name="contact_no" class="form-control" value="<?= htmlspecialchars($student['contact_no']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?= $student['dob'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-warning">Update Student</button>
        <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include "../admin_footer.php"; ?>
</body>
</html>
