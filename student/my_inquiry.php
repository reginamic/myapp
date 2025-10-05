<?php
require_once "student_header.php";
require_once "../backend/crud.php";

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM inquiries WHERE user_id='$user_id' ORDER BY created_at DESC");
?>

<h3 class="mb-4">My Inquiries</h3>

<?php if (mysqli_num_rows($result) > 0): ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= $row['inquiry_id'] ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td>
              <span class="badge bg-<?=
                strtolower($row['status']) === "resolved" ? "success" :
                (strtolower($row['status']) === "pending" ? "warning text-dark" : "secondary")
              ?>">
                <?= htmlspecialchars($row['status']) ?>
              </span>
            </td>
            <td><?= date("d-m-Y H:i", strtotime($row['created_at'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <p>You have not submitted any inquiries yet.</p>
<?php endif; ?>

<?php require_once "student_footer.php"; ?>
