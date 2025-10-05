<?php
require_once "../../backend/db_connect.php";

// Fetch all subjects
$sql = "SELECT sd.*, c.Name AS CourseName 
        FROM subject_description sd
        JOIN Course c ON sd.CourseID = c.Id
        ORDER BY sd.Id DESC";   //  use Id instead of ID
$result = mysqli_query($conn, $sql);
?>

<?php include "../admin_header.php"; ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Course Subjects Manager</h2>
        <a href="subject_add.php" class="btn btn-success">Add New Subject</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Title</th>
                <th>Banner</th>
                <th>Sub Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['Id'] ?></td> <!--  changed from ID to Id -->
                <td><?= htmlspecialchars($row['CourseName']) ?></td>
                <td><?= htmlspecialchars($row['Title']) ?></td>
                <td>
                    <?php if(!empty($row['BannerImg'])): ?>
                        <img src="../../images/course/<?= $row['BannerImg'] ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(!empty($row['SubImg'])): ?>
                        <img src="../../images/course/<?= $row['SubImg'] ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="subject_edit.php?id=<?= $row['Id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="subject_delete.php?id=<?= $row['Id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this subject?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include "../admin_footer.php"; ?>
