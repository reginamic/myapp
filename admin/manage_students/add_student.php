<?php
require_once "../../backend/crud.php";

$table = "users";
$message = "";

if (isset($_POST['add'])) {
    // Basic validation
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password'])) {
        $message = "⚠️ Please fill in all required fields.";
    } else {
        $data = [
            "first_name" => trim($_POST['first_name']),
            "last_name" => trim($_POST['last_name']),
            "email" => trim($_POST['email']),
            "contact_no" => trim($_POST['contact_no']),
            "dob" => $_POST['dob'],
            "role" => "student", // fixed role
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT) // hashed password
        ];

        if (insertRecord($table, $data)) {
            header("Location: manage_students.php");
            exit;
        } else {
            $message = "❌ Failed to add student. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-success mb-4">Add New Student</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" class="p-4 bg-white rounded shadow">
        <div class="mb-3">
            <label class="form-label">First Name *</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name *</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input type="text" name="contact_no" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password *</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Save Student</button>
        <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
