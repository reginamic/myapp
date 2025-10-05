<?php
require_once "backend/db_connect.php";

$subject_id = intval($_GET['id'] ?? 0);

// Join Course and Subject Description
$sql = "SELECT sd.*, c.Name AS CourseName, c.Fees, c.Mode, c.Duration, c.Img AS CourseImg
        FROM subject_description sd
        JOIN Course c ON sd.CourseID = c.Id
        WHERE sd.ID = $subject_id";

$result = mysqli_query($conn, $sql);

// Show “Page Not Found” if ID is invalid or no result
if ($subject_id <= 0 || mysqli_num_rows($result) == 0) {
    echo "<div style='text-align:center; padding:20px; font-family:Arial; color:#555;'>
            <h2>Page Not Found Right Now</h2>
            <p>We are working to update this course information. Please try again later.</p>
            <p>If you need details urgently, please contact our institute directly.</p>
            <p><small>You will be redirected to the course list in 5 seconds...</small></p>
          </div>";
    echo "<meta http-equiv='refresh' content='5;url=course.php'>";
    exit;
}

$subject = mysqli_fetch_assoc($result);
?>

<?php include "header.php"; ?>

<!-- Banner Section -->
<section class="position-relative" style="height:400px; overflow:hidden;">
    <img src="images/Course/<?= !empty($subject['BannerImg']) ? $subject['BannerImg'] : 'default-banner.jpg' ?>" 
         alt="<?= htmlspecialchars($subject['Title']) ?>" class="img-fluid w-100 h-100" style="object-fit:cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="display-4 fw-bold"><?= htmlspecialchars($subject['Title']) ?></h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">

            <!-- Left Column: Sub Image + Course Info -->
            <div class="col-lg-4">
                <img src="images/course/<?= !empty($subject['BannerImg']) ? $subject['SubImg'] : $subject['CourseImg'] ?>" 
                     alt="<?= htmlspecialchars($subject['CourseName']) ?>" class="img-fluid rounded mb-3">

                <div class="card shadow-sm p-3">
                    <h4 class="card-title"><?= htmlspecialchars($subject['CourseName']) ?></h4>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Fees:</strong> LKR <?= number_format($subject['Fees']) ?></li>
                        <li><strong>Mode:</strong> <?= htmlspecialchars($subject['Mode']) ?></li>
                        <li><strong>Duration:</strong> <?= htmlspecialchars($subject['Duration']) ?></li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Subject Details -->
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">What You Will Learn</h2>
                <ul>
                    <?php foreach (explode("\n", $subject['WhatYouWillLearn']) as $item): ?>
                        <?php if(trim($item) !== ''): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <h2 class="fw-bold mt-4">Course Features & Benefits</h2>
                <ul>
                    <?php foreach (explode("\n", $subject['FeaturesBenefits']) as $item): ?>
                        <?php if(trim($item) !== ''): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <h2 class="fw-bold mt-4">Entry Qualification</h2>
                <ul>
                    <?php foreach (explode("\n", $subject['EntryQualification']) as $item): ?>
                        <?php if(trim($item) !== ''): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <h2 class="fw-bold mt-4">Description</h2>
                <p><?= nl2br(htmlspecialchars($subject['Content'])) ?></p>
            </div>

        </div>
    </div>
</section>

<?php include "footer.php"; ?>
