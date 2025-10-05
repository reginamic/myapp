<?php
require_once "../../backend/db_connect.php";

if (!isset($_GET['id'])) die("Invalid subject ID");
$subject_id = intval($_GET['id']);

// Fetch subject data
$result = mysqli_query($conn, "SELECT * FROM subject_description WHERE ID = $subject_id");
if (mysqli_num_rows($result) == 0) die("Subject not found");
$subject = mysqli_fetch_assoc($result);

// Fetch courses for dropdown
$courses = mysqli_query($conn, "SELECT Id, Name FROM Course ORDER BY Name ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CourseID = intval($_POST['CourseID']);
    $Title = mysqli_real_escape_string($conn, $_POST['Title']);
    $BannerImg = $_FILES['BannerImg']['name'];
    $SubImg = $_FILES['SubImg']['name'];
    $WhatYouWillLearn = mysqli_real_escape_string($conn, $_POST['WhatYouWillLearn']);
    $FeaturesBenefits = mysqli_real_escape_string($conn, $_POST['FeaturesBenefits']);
    $EntryQualification = mysqli_real_escape_string($conn, $_POST['EntryQualification']);
    $Content = mysqli_real_escape_string($conn, $_POST['Content']);

    $BannerImg = trim($_POST['BannerImg']);
    $SubImg    = trim($_POST['SubImg']);

    // Keep old values if left empty
    if ($BannerImg === '') $BannerImg = $subject['BannerImg'];
    if ($SubImg === '') $SubImg = $subject['SubImg'];

    $sql = "UPDATE subject_description SET 
            CourseID='$CourseID',
            Title='$Title',
            BannerImg='$BannerImg',
            SubImg='$SubImg',
            WhatYouWillLearn='$WhatYouWillLearn',
            FeaturesBenefits='$FeaturesBenefits',
            EntryQualification='$EntryQualification',
            Content='$Content'
            WHERE ID=$subject_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: subject_manager.php");
        exit;
    } else {
        echo "Error updating subject: " . mysqli_error($conn);
    }
}
?>

<?php include "../admin_header.php"; ?>
<div class="container py-5">
    <h2>Edit Subject</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="CourseID" class="form-control" required>
                <?php while($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['Id'] ?>" <?= $c['Id']==$subject['CourseID']?'selected':'' ?>><?= htmlspecialchars($c['Name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Title</label>
            <input type="text" name="Title" class="form-control" value="<?= htmlspecialchars($subject['Title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Banner Image link</label>
            <input type="text" name="BannerImg" class="form-control" 
                value="<?= htmlspecialchars($subject['BannerImg'] ?? '') ?>">
            <?php if(!empty($subject['BannerImg'])): ?>
                <img src="images/subject/<?= htmlspecialchars($subject['BannerImg']) ?>" width="100" class="mt-2">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Sub Image link</label>
            <input type="text" name="SubImg" class="form-control" 
                value="<?= htmlspecialchars($subject['SubImg'] ?? '') ?>">
            <?php if(!empty($subject['SubImg'])): ?>
                <img src="images/subject/<?= htmlspecialchars($subject['SubImg']) ?>" width="100" class="mt-2">
            <?php endif; ?>
        </div>

        <div class="mb-3"><label class="form-label">What You Will Learn</label>
            <textarea name="WhatYouWillLearn" class="form-control" rows="4"><?= htmlspecialchars($subject['WhatYouWillLearn']) ?></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Features & Benefits</label>
            <textarea name="FeaturesBenefits" class="form-control" rows="4"><?= htmlspecialchars($subject['FeaturesBenefits']) ?></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Entry Qualification</label>
            <textarea name="EntryQualification" class="form-control" rows="3"><?= htmlspecialchars($subject['EntryQualification']) ?></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Content</label>
            <textarea name="Content" class="form-control" rows="5"><?= htmlspecialchars($subject['Content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Subject</button>
        <a href="subject_manager.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include "../admin_footer.php"; ?>
