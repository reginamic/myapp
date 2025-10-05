<?php
require_once "student_header.php";
require_once "../backend/db_connect.php";

// Fetch enrolled courses
$sql = "SELECT c.Name, c.Description, c.Branch, c.Duration, c.Mode, c.Fees, e.status
        FROM enrollments e
        JOIN course c ON e.course_id = c.id
        WHERE e.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="welcome-banner">
  <h2>Welcome Back, <?= htmlspecialchars($loggedInUser) ?> 🎉</h2>
  <p>Here's your learning progress and enrolled courses.</p>
</div>

<section>
  <h3 class="mb-3">Enrolled Courses</h3>
  <div class="row">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['Name']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($row['Description']) ?></p>
              <ul class="list-unstyled small">
                <li><strong>Branch:</strong> <?= htmlspecialchars($row['Branch']) ?></li>
                <li><strong>Duration:</strong> <?= htmlspecialchars($row['Duration']) ?></li>
                <li><strong>Mode:</strong> <?= htmlspecialchars($row['Mode']) ?></li>
                <li><strong>Fees:</strong> $<?= htmlspecialchars($row['Fees']) ?></li>
              </ul>
             <span class="badge bg-<?=
    strtolower($row['status']) === "approved" ? "success" :
    (strtolower($row['status']) === "pending" ? "warning text-dark" :
    (strtolower($row['status']) === "rejected" ? "danger" : "secondary"))
?>">
                <?= htmlspecialchars($row['status']) ?>
              </span>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>You haven't enrolled in any courses yet.</p>
    <?php endif; ?>
  </div>
</section>

<?php require_once "student_footer.php"; ?>
