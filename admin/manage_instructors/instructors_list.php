<?php
session_start();
require_once "../../backend/crud.php";

$table = "instructors";
$result = getAllRecords($table);
?>

<?php include "../admin_header.php"; ?>

<body class="bg-light">

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">Instructor Management</h2>
    <a href="add_instructors.php" class="btn btn-success">+ Add New Instructor</a>
  </div>

  <table class="table table-striped table-bordered shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Actions</th>
        <th>ID</th>
        <th>Full Name</th>
        <th>Role</th>
        <th>Bio</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td class="d-flex gap-2">
      <a href="update_instructors.php?id=<?= $row['instructor_id'] ?>" 
         class="btn btn-warning btn-sm">Update</a>
      <button onclick="confirmDelete(<?= $row['instructor_id'] ?>, this)" 
              class="btn btn-danger btn-sm">Delete</button>
    </td>
    <td><?= $row['instructor_id'] ?></td>
    <td><?= htmlspecialchars($row['full_name']) ?></td>
    <td><?= htmlspecialchars($row['role']) ?></td>
    <td><?= htmlspecialchars($row['bio']) ?></td>
  </tr>
<?php } ?>

    </tbody>
  </table>
</div>

<script>
function confirmDelete(id, button) {
    if (confirm("⚠️ Are you sure you want to delete this instructor?")) {
     fetch("/myapp/admin/manage_instructors/delete_instructors.php?id=" + encodeURIComponent(id))



            .then(response => response.text())
            .then(data => {
                if (data.trim() === "deleted") {
                    button.closest("tr").remove();
                    alert("✅ Instructor deleted successfully.");
                } else {
                    alert("❌ Error deleting instructor: " + data);
                }
            })
            .catch(error => {
                console.error(error);
                alert("❌ Error deleting instructor.");
            });
    }
}
</script>
<?php include "../admin_footer.php"; ?>
</body>
</html>
