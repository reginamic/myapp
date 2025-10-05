<?php
session_start();
require_once "../../backend/crud.php";

// Fetch all notices
$notice_result = getAllRecords("notices");

// Fetch all events
$event_result = getAllRecords("events");
?>

<?php include "../admin_header.php"; ?>

  <script>
    // Confirm delete for notices
    function confirmDeleteNotice(id) {
        if (confirm(" Are you sure you want to delete this notice?")) {
            window.location.href = "delete_notices.php?id=" + id;
        }
    }

    // Confirm delete for events
    function confirmDeleteEvent(id) {
        if (confirm(" Are you sure you want to delete this event?")) {
            window.location.href = "delete_events.php?id=" + id;
        }
    }
  </script>
</head>
<body class="bg-light">

<div class="container my-5">

  <!-- Notices Section -->
  <div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary">Notice Management</h2>
      <a href="add_notices.php" class="btn btn-success">+ Add New Notice</a>
    </div>

    <table class="table table-striped table-bordered shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>Actions</th>
          <th>ID</th><th>Title</th><th>Description</th><th>Notice date</th><th>Branch</th><th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($notice_result)) { ?>
          <tr>
            <td class="d-flex gap-2">
              <a href="update_notices.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Update</a>
              <button onclick="confirmDeleteNotice(<?= $row['id'] ?>)" class="btn btn-danger btn-sm">Delete</button>
            </td>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
             <td><?= $row['notice_date'] ?></td>
            <td><?= $row['branch'] ?></td>
           

            
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Events Section -->
  <div>
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary">Event Management</h2>
      <a href="add_events.php" class="btn btn-success">+ Add New Event</a>
    </div>

    <table class="table table-striped table-bordered shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>Actions</th>
          <th>ID</th><th>Title</th><th>Description</th><th>Event Date</th>
          <th>Branch</th><th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($event_result)) { ?>
          <tr>
            <td class="d-flex gap-2">
             <a href="update_events.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Update</a>

              <button onclick="confirmDeleteEvent(<?= $row['id'] ?>)" class="btn btn-danger btn-sm">Delete</button>
            </td>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= $row['event_date'] ?></td>
            <td><?= htmlspecialchars($row['branch']) ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>
<?php include "../admin_footer.php"; ?>
</body>
</html>
