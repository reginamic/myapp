<?php
require_once "student_header.php";
require_once "../backend/crud.php";

$table = "instructors";
$instructors = getAllRecords($table);
?>

<h3 class="mb-4">Our Instructors</h3>
<div class="row">
  <?php if ($instructors && mysqli_num_rows($instructors) > 0): ?>
    <?php while ($instructor = mysqli_fetch_assoc($instructors)): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($instructor['full_name']) ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($instructor['role']) ?></h6>
            <p class="card-text"><?= nl2br(htmlspecialchars($instructor['bio'])) ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No instructor details found.</p>
  <?php endif; ?>
</div>

<?php require_once "student_footer.php"; ?>
