<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security: only logged-in students allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== "student") {
    header("Location: ../login.php");
    exit();
}

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$loggedInUser = $_SESSION['firstname'] ?? "Student";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkillPro Student Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .navbar-nav .nav-link { color: #fff; }
    .navbar-nav .nav-link:hover { text-decoration: underline; }
    .welcome-banner { background: #e9ecef; padding: 3rem; border-radius: .75rem; margin-bottom: 2rem; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">
      <i class="bi bi-mortarboard-fill"></i> SkillPro Student
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#studentNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="studentNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="enroll_course.php"><i class="bi bi-pencil-square"></i> Enroll Course</a></li>
        <li class="nav-item"><a class="nav-link" href="instructors_details.php"><i class="bi bi-person"></i> Instructors</a></li>
        <li class="nav-item"><a class="nav-link" href="my_inquiry.php"><i class="bi bi-envelope-open"></i> My Inquiries</a></li>
        <li class="nav-item"><a class="nav-link" href="submit_inquiry.php"><i class="bi bi-question-circle"></i> Submit Inquiry</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
          <span class="navbar-text text-white">👋 Welcome, <?= htmlspecialchars($loggedInUser) ?></span>
        </li>
        <li class="nav-item">
          <a href="../logout.php" class="btn btn-sm btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
