<?php
require_once "backend/db_connect.php"; // Connect to database

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim(mysqli_real_escape_string($conn, $_POST['first_name']));
    $last_name  = trim(mysqli_real_escape_string($conn, $_POST['last_name']));
    $email      = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $contact_no = trim(mysqli_real_escape_string($conn, $_POST['contact_no']));
    $dob        = trim(mysqli_real_escape_string($conn, $_POST['dob']));
    $role       = isset($_POST['role']) ? trim(mysqli_real_escape_string($conn, $_POST['role'])) : "";
    $password   = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $cpassword  = trim(mysqli_real_escape_string($conn, $_POST['confirm-password']));

    // Validation
    if (empty($first_name) && empty($last_name) && empty($email) && empty($contact_no) && empty($dob) && empty($role) && empty($password) && empty($cpassword)) {
    $error = "Please fill in all required fields before registering.";
} elseif (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
    $error = "First and last name must contain only letters.";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'")) > 0) {
        $error = "Email already registered.";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact_no)) {
        $error = "Contact number must be exactly 10 digits.";
    } elseif (strtotime($dob) > time()) {
        $error = "Date of Birth cannot be in the future.";
    } elseif (!in_array($role, ["admin", "student"])) {
        $error = "Invalid role selected.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } elseif ($password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (first_name, last_name, email, contact_no, dob, role, password) 
                  VALUES ('$first_name', '$last_name', '$email', '$contact_no', '$dob', '$role', '$hashedPassword')";

        if (mysqli_query($conn, $query)) {
            $success = "Account created successfully! You can now login.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkillPro Institute - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"; ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-lg rounded-4">
        <div class="card-body p-4">
          <h2 class="text-center mb-4">Create Your Account</h2>

          <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
          <?php endif; ?>
          <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form action="register.php" method="POST" class="needs-validation" novalidate>
            
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="row g-3 mt-3">
              <div class="col-md-6">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contact_no" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label">Choose Role</label>
              <select name="role" class="form-select" required>
                <option value="" disabled selected>Select your role</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
              </select>
            </div>

            <div class="mt-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mt-3">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="confirm-password" class="form-control" required>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </div>
          </form>

          <p class="text-center mt-3">
            Already have an account? <a href="login.php">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>