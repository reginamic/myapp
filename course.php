<?php
require_once "backend/db_connect.php"; // Connect to database

// Fetch distinct values for filters dynamically
$modes    = mysqli_query($conn, "SELECT DISTINCT Mode FROM Course WHERE Mode != '' ORDER BY Mode ASC");
$durations = mysqli_query($conn, "SELECT DISTINCT Duration FROM Course WHERE Duration != '' ORDER BY Duration ASC");
$branches  = mysqli_query($conn, "SELECT DISTINCT Branch FROM Course WHERE Branch != '' ORDER BY Branch ASC");

// Collect filters from GET
$name     = $_GET['name'] ?? '';
$mode     = $_GET['mode'] ?? '';
$duration = $_GET['duration'] ?? '';
$branch   = $_GET['branch'] ?? '';

$sql = "SELECT c.*, s.ID as SubjectID 
        FROM Course c
        LEFT JOIN subject_description s ON c.Id = s.CourseID
        WHERE 1=1";

// Apply filters
if (!empty($name)) {
    $sql .= " AND c.Name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
}
if (!empty($mode)) {
    $sql .= " AND c.Mode = '" . mysqli_real_escape_string($conn, $mode) . "'";
}
if (!empty($duration)) {
    $sql .= " AND c.Duration = '" . mysqli_real_escape_string($conn, $duration) . "'";
}
if (!empty($branch)) {
    $sql .= " AND c.Branch = '" . mysqli_real_escape_string($conn, $branch) . "'";
}

$result = mysqli_query($conn, $sql);
?>

<?php include "header.php"; ?>

<!-- Hero Section -->
<section class="bg-primary text-white text-center py-5 mb-5">
 <div class="container">
    <h1 class="fw-bold">Our Courses</h1>
    <p class="lead">Explore our professional training programs and find the right course for your career growth.</p>
    <p class="fw-light">Search and filter courses to find the perfect one for you.</p>
  </div>
</section>

<!-- 🔍 Search + Filter Form -->
<section class="pb-4">
  <div class="container">
    <form method="GET" class="row g-3 align-items-end bg-light p-3 rounded shadow-sm">
      
      <div class="col-md-3">
        <label class="form-label">Course Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" placeholder="e.g. Web Development">
      </div>

      <div class="col-md-2">
        <label class="form-label">Mode</label>
        <select name="mode" class="form-select">
          <option value="">All</option>
          <?php while($m = mysqli_fetch_assoc($modes)): ?>
            <option value="<?= htmlspecialchars($m['Mode']) ?>" <?= ($mode == $m['Mode'] ? "selected" : "") ?>>
              <?= htmlspecialchars($m['Mode']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="col-md-2">
        <label class="form-label">Duration</label>
        <select name="duration" class="form-select">
          <option value="">All</option>
          <?php while($d = mysqli_fetch_assoc($durations)): ?>
            <option value="<?= htmlspecialchars($d['Duration']) ?>" <?= ($duration == $d['Duration'] ? "selected" : "") ?>>
              <?= htmlspecialchars($d['Duration']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Location / Branch</label>
        <select name="branch" class="form-select">
          <option value="">All</option>
          <?php while($b = mysqli_fetch_assoc($branches)): ?>
            <option value="<?= htmlspecialchars($b['Branch']) ?>" <?= ($branch == $b['Branch'] ? "selected" : "") ?>>
              <?= htmlspecialchars($b['Branch']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="col-md-2 text-end">
        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Search</button>
      </div>
    </form>
  </div>
</section>

<!-- Courses Grid -->
<section class="courses-section pb-5">
  <div class="container">
    <div class="row g-4">

      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm border-0 course-card position-relative">


            <!-- Card clickable area -->
            <a href="course_description.php?id=<?= !empty($row['SubjectID']) ? $row['SubjectID'] : 0 ?>" 
              class="stretched-link text-decoration-none text-dark">

              <?php if(!empty($row['Img'])) { ?>
                <img src="images/course/<?= $row['Img'] ?>" class="card-img-top" alt="<?= $row['Name'] ?>" style="height:220px; object-fit:cover;">
              <?php } else { ?>
                <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="No Image">
              <?php } ?>

            </a>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold"><?= htmlspecialchars($row['Name']) ?></h5>
              <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($row['Branch']) ?> Branch</p>
              <p class="card-text"><?= substr($row['Description'], 0, 100) ?>...</p>
              
              <ul class="list-unstyled small mt-2">
                <li><strong>Mode:</strong> <?= htmlspecialchars($row['Mode']) ?></li>
                <li><strong>Duration:</strong> <?= htmlspecialchars($row['Duration']) ?></li>
              </ul>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-white d-flex justify-content-between align-items-center position-relative z-3">

              <span class="fw-bold text-primary">LKR <?= number_format($row['Fees']) ?></span>
              <a href="register.php" class="btn btn-sm btn-success">Enroll Now</a>
            </div>
          </div>
        </div>
        <?php } ?>
      <?php else: ?>
        <p class="text-center text-muted">No courses found. Try adjusting your search filters.</p>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php include "footer.php"; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .course-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 20px rgba(0,0,0,0.15);
  }
</style>
