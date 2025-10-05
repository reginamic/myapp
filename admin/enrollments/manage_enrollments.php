<?php
require_once "../../backend/db_connect.php";

// Fetch all enrollments with student name and course name
$sql = "SELECT e.id, u.first_name, u.last_name, c.Name AS course_name, e.status
        FROM enrollments e
        JOIN users u ON e.user_id = u.id
        JOIN course c ON e.course_id = c.id";
$result = mysqli_query($conn, $sql);
?>

<?php include "../admin_header.php"; ?>

<div class="container my-5">
    <h2 class="text-primary mb-4">Manage Enrollments</h2>

    <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Actions</th>
                <th>Enrollment ID</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="d-flex gap-2">
                            <!-- Approve -->
                            <a href="./update_enrollment_status.php?status=Accepted&id=<?= $row['id'] ?>" 
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Are you sure you want to approve this enrollment?');">
                               Approve
                            </a>

                            <!-- Reject -->
                            <a href="./update_enrollment_status.php?status=Rejected&id=<?= $row['id'] ?>" 
                               class="btn btn-warning btn-sm"
                               onclick="return confirm('Are you sure you want to reject this enrollment?');">
                               Reject
                            </a>

                            <!-- Delete -->
                            <a href="delete_enrollment.php?id=<?= $row['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this enrollment?');">
                               Delete
                            </a>
                        </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['course_name']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $row['status'] === 'Accepted' ? 'bg-success' : ($row['status'] === 'Rejected' ? 'bg-danger' : 'bg-warning') ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No enrollments found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "../admin_footer.php"; ?>
