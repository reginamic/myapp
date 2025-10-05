<?php
include "header.php";
require_once "backend/db_connect.php";

// Start session securely
session_start([
    'cookie_lifetime' => 0, // Session cookie (until browser closes)
    'cookie_httponly' => true, // No JS access to cookies
    'cookie_secure' => isset($_SERVER['HTTPS']), // Only send over HTTPS
    'cookie_samesite' => 'Strict' // Prevent CSRF
]);

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                // Regenerate session ID to prevent fixation attacks
                session_regenerate_id(true);

                $_SESSION['user_id']   = $row['id'];
                $_SESSION['firstname'] = $row['first_name'];
                $_SESSION['role']      = $row['role'];
                $_SESSION['last_activity'] = time(); // Track last activity for timeout

                if ($row['role'] === "student") {
                    header("Location: /myapp/student/dashboard.php");
                    exit();
                } elseif ($row['role'] === "admin") {
                    header("Location: /myapp/admin/dashboard.php");
                    exit();
                }
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "No account found with this email.";
        }
    }
}
?>

<!-- Login Section -->
<section class="vh-100" style="background: linear-gradient(to right, #1e3c72, #2a5298);">
  <div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">

      <h3 class="text-center mb-4 fw-bold">Login to SkillPro</h3>

      <?php if ($error): ?>
        <div class="alert alert-danger">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary fw-bold">Login</button>
        </div>
      </form>

      <p class="text-center mt-3">
        Don't have an account? <a href="register.php">Register</a>
      </p>

    </div>
  </div>
</section>

<?php include "footer.php"; ?>
</body>
</html>
