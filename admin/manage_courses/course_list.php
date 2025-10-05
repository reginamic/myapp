<?php
session_start();
require_once "../../backend/crud.php";


$table = "Course";
$result = getAllRecords($table);
?>

<?php include "../admin_header.php"; ?>

  <script>

    function confirmDelete(id) {
        if (confirm("⚠️ Are you sure you want to delete this course?")) {
            window.location.href = "course_delete.php?id=" + id;
        }
    }

  </script>
</head>
<body class="bg-light">

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">Course Management</h2>
    <a href="course_add.php" class="btn btn-success">+ Add New Course</a>
  </div>

  <table class="table table-striped table-bordered shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Actions</th>
        <th>ID</th><th>Name</th><th>Description</th><th>Branch</th>
        <th>Fees</th><th>Mode</th><th>Duration</th><th>Image</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td class="d-flex gap-2">
            <a href="course_update.php?id=<?= $row['Id'] ?>" class="btn btn-warning btn-sm">Update</a>
            <button onclick="confirmDelete(<?= $row['Id'] ?>)" class="btn btn-danger btn-sm">Delete</button>
          </td>
          <td><?= $row['Id'] ?></td>
          <td><?= $row['Name'] ?></td>
          <td><?= $row['Description'] ?></td>
          <td><?= $row['Branch'] ?></td>
          <td><?= $row['Fees'] ?></td>
          <td><?= $row['Mode'] ?></td>
          <td><?= $row['Duration'] ?></td>
          <td>
              <a href="uploads/<?= $row['Img'] ?>" target="_blank">
                  <?= $row['Img'] ?>
              </a>
          </td>

        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<?php include "../admin_footer.php"; ?>

</body>
</html>
