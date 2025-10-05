<?php
require_once "../../backend/db_connect.php";

// Fetch courses for dropdown
$courses = mysqli_query($conn, "SELECT Id, Name FROM Course ORDER BY Name ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CourseID = isset($_POST['CourseID']) ? intval($_POST['CourseID']) : 0;

    if ($CourseID <= 0) {
        echo "<p style='color:red;'>Please select a valid course before submitting.</p>";
        exit;
    }

    $Title = mysqli_real_escape_string($conn, $_POST['Title']);
    $BannerImg = trim($_POST['BannerImg']);
    $SubImg    = trim($_POST['SubImg']);
    $WhatYouWillLearn = mysqli_real_escape_string($conn, $_POST['WhatYouWillLearn']);
    $FeaturesBenefits = mysqli_real_escape_string($conn, $_POST['FeaturesBenefits']);
    $EntryQualification = mysqli_real_escape_string($conn, $_POST['EntryQualification']);
    $Content = mysqli_real_escape_string($conn, $_POST['Content']);

    $sql = "INSERT INTO subject_description 
            (CourseID, Title, BannerImg, SubImg, WhatYouWillLearn, FeaturesBenefits, EntryQualification, Content)
            VALUES ('$CourseID', '$Title', '$BannerImg', '$SubImg', '$WhatYouWillLearn', '$FeaturesBenefits', '$EntryQualification', '$Content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: subject_manager.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<?php include "../admin_header.php"; ?>
<div class="container py-5">
    <h2>Add New Subject</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="CourseID" class="form-control" required>
                <option value="">Select Course</option>
                <?php while($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['Id'] ?>"><?= htmlspecialchars($c['Name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Title</label>
            <input type="text" name="Title" class="form-control" required>
        </div>
        <div class="mb-3"><label class="form-label">Banner Image link</label>
            <input type="test" name="BannerImg" class="form-control">
        </div>
        <div class="mb-3"><label class="form-label">Sub Image link</label>
            <input type="test" name="SubImg" class="form-control">
        </div>
        <div class="mb-3"><label class="form-label">What You Will Learn</label>
            <textarea name="WhatYouWillLearn" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Features & Benefits</label>
            <textarea name="FeaturesBenefits" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Entry Qualification</label>
            <textarea name="EntryQualification" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3"><label class="form-label">Content</label>
            <textarea name="Content" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Subject</button>
        <a href="subject_manager.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include "../admin_footer.php"; ?>