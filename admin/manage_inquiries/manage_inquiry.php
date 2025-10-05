<?php
session_start();
require_once "../../backend/db_connect.php";

// Admin access check (case-insensitive)
if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) !== "admin") {
    header("Location: ../index.html");
    exit();
}

// Handle status change (Resolve)
if (isset($_GET['resolve_id'])) {
    $resolve_id = intval($_GET['resolve_id']);
    $stmt = $conn->prepare("UPDATE inquiries SET status = 'Resolved' WHERE inquiry_id = ?");
    $stmt->bind_param("i", $resolve_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_inquiry.php");
    exit();
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM inquiries WHERE inquiry_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_inquiry.php");
    exit();
}

// Fetch all inquiries
$sql = "SELECT i.inquiry_id, u.first_name, u.last_name, i.subject, i.message, i.status, i.created_at
        FROM inquiries i
        JOIN users u ON i.user_id = u.id
        ORDER BY i.created_at DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching inquiries: " . mysqli_error($conn));
}
?>

<?php include "../admin_header.php"; ?>

<body class="bg-light">

<div class="container my-5">
    <h2 class="text-primary mb-4">Manage Inquiries</h2>

    <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="d-flex gap-2">
                            <!-- Resolve -->
                            <?php if ($row['status'] !== "Resolved"): ?>
                            <a href="manage_inquiry.php?resolve_id=<?= $row['inquiry_id'] ?>" 
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Mark this inquiry as resolved?');">
                               Resolve
                            </a>
                            <?php endif; ?>

                            <!-- Delete -->
                            <a href="manage_inquiry.php?delete_id=<?= $row['inquiry_id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this inquiry?');">
                               Delete
                            </a>
                        </td>
                        <td><?= $row['inquiry_id'] ?></td>
                        <td><?= htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['subject']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        <td>
                            <span class="badge <?= strtolower($row['status']) === "resolved" ? 'bg-success' : 'bg-warning' ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </td>
                        <td><?= date("d-m-Y H:i", strtotime($row['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No inquiries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include "../admin_footer.php"; ?>
</body>
</html>
