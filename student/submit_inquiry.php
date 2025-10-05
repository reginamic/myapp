<?php
require_once "student_header.php";
require_once "../backend/crud.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['subject'], $_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date    = date("Y-m-d H:i:s");

    $insert = mysqli_query($conn, "INSERT INTO inquiries (user_id, subject, message, status, created_at) 
                                   VALUES ('$user_id', '$subject', '$message', 'Pending', '$date')");

    if ($insert) {
        $_SESSION['flash_success'] = "Inquiry submitted successfully!";
    } else {
        $_SESSION['flash_error'] = "Error submitting inquiry: " . mysqli_error($conn);
    }

    // Redirect back to SAME page (not my_inquiry.php)
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-3">Submit Inquiry</h3>

        <?php if (!empty($_SESSION['flash_success'])): ?>
          <div class="alert alert-success">
            <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_error'])): ?>
          <div class="alert alert-danger">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
          </div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label for="subject" class="form-label">Select Subject</label>
            <select name="subject" id="subject" class="form-select" required>
              <option value="">-- Choose Subject --</option>
              <option value="Course Content">Course Content</option>
              <option value="Payment Issue">Payment Issue</option>
              <option value="Technical Support">Technical Support</option>
              <option value="General Question">General Question</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write your inquiry..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100">Submit Inquiry</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once "student_footer.php"; ?>
