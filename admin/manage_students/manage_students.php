<?php
require_once "../../backend/crud.php";

$table = "users"; // students are stored in users table
$result = getAllRecords($table);
?>

<?php include "../admin_header.php"; ?>

<body class="bg-light">

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">Student Management</h2>
    <a href="add_student.php" class="btn btn-success">+ Add New Student</a>
  </div>

  <table class="table table-striped table-bordered shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Actions</th>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>DOB</th>
        <th>Role</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { 
        if ($row['role'] !== "student") continue; // only show students
      ?>
        <tr>
          <td class="d-flex gap-2">
            <a href="update_student.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Update</a>
            <button onclick="confirmDelete(<?= $row['id'] ?>, this)" class="btn btn-danger btn-sm">Delete</button>
          </td>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['first_name']) ?></td>
          <td><?= htmlspecialchars($row['last_name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['contact_no']) ?></td>
          <td><?= $row['dob'] ?></td>
          <td><?= $row['role'] ?></td>
          <td><?= $row['created_at'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
function confirmDelete(id, button) {
    if (confirm("⚠️ Are you sure you want to delete this student?")) {
        fetch("delete_student.php?id=" + id)
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "deleted") {
                    button.closest("tr").remove();
                    alert(" Student deleted successfully.");
                } else {
                    alert(" Error deleting student: " + data);
                }
            })
            .catch(error => {
                console.error(error);
                alert(" Error deleting student.");
            });
    }
}
</script>
<?php include "../admin_footer.php"; ?>
</body>
</html>
