<?php
require_once "student_header.php";
require_once "../backend/crud.php"; // DB connection

$success_msg = ""; // message variable

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['course'])) {
    $user_id   = $_SESSION['user_id'];
    $course_id = intval($_POST['course']);

    // Check if already enrolled
    $check = mysqli_query($conn, "SELECT * FROM enrollments WHERE user_id='$user_id' AND course_id='$course_id'");
    if (mysqli_num_rows($check) == 0) {
        $date = date("Y-m-d H:i:s");
        mysqli_query($conn, "INSERT INTO enrollments (course_id, user_id, enroll_date, status) 
                             VALUES ('$course_id', '$user_id', '$date', 'Pending')");
        $success_msg = "✅ You have successfully enrolled in the course!";
    } else {
        $success_msg = "⚠️ You are already enrolled in this course.";
    }
}

// Fetch courses
$courses_result = mysqli_query($conn, "SELECT Id, Name FROM Course");
?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-3">Enroll in a Course</h3>

        <?php if (!empty($success_msg)) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $success_msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>

        <form method="POST">
          <div class="mb-3">
            <label for="course" class="form-label">Select Course</label>
            <select class="form-select" name="course" id="course" required>
              <option value="">-- Select Course --</option>
              <?php while ($course = mysqli_fetch_assoc($courses_result)) { ?>
                <option value="<?= $course['Id'] ?>"><?= htmlspecialchars($course['Name']) ?></option>
              <?php } ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enroll Now</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once "student_footer.php"; ?>
