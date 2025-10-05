<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security: check if logged in and admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== "admin") {
    header("Location: /myapp/login.php");
    exit();
}

// Session timeout (30 mins)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: /myapp/login.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time();

// Logged-in admin name (safe default)
$loggedInUser = $_SESSION['firstname'] ?? "Admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .admin-header { background-color: #343a40; color: #fff; padding: 0.75rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .admin-header a { color: #fff; text-decoration: none; }
        .admin-header a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <!-- Brand / Logo -->
    <a class="navbar-brand" href="/myapp/admin/dashboard.php">
      <i class="bi bi-speedometer2"></i> SkillPro Admin
    </a>

    <!-- Navbar toggler (for mobile view) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav me-auto">
        <!-- Dashboard link -->
        <li class="nav-item">
          <a class="nav-link" href="/myapp/admin/dashboard.php">
            <i class="bi bi-house-fill"></i> Dashboard
          </a>
        </li>
        <!-- You can add more nav items here -->
      </ul>

      <!-- Right side: User info + Logout -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
          <span class="navbar-text text-white">
            Welcome, <?= htmlspecialchars($loggedInUser, ENT_QUOTES, 'UTF-8') ?>
          </span>
        </li>
        <li class="nav-item">
          <a href="/myapp/logout.php" class="btn btn-sm btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>