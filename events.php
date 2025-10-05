<?php
require_once "backend/db_connect.php";

// Fetch notices
$notices = [];
$notice_result = mysqli_query($conn, "SELECT * FROM notices ORDER BY created_at DESC");
if ($notice_result) {
    while ($row = mysqli_fetch_assoc($notice_result)) {
        $notices[] = $row;
    }
}

// Fetch events
$events = [];
$event_result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC");
if ($event_result) {
    while ($row = mysqli_fetch_assoc($event_result)) {
        $events[] = $row;
    }
}
?>
<?php include "header.php"; ?>
<!-- Hero Section -->
<section class="py-5 text-white text-center" style="background: url('images/home.jpg') center/cover no-repeat; min-height: 450px;">
  <div class="container">
    <h1 class="fw-bold">Notices & Events</h1>
    <p class="lead">
      Stay updated with the latest announcements from SkillPro Institute. 
      Explore workshops, seminars, examinations, and important updates.
    </p>
  </div>
</section>
 <link rel="stylesheet" href="styles.css">
<!-- Notices & Events -->
<section class="py-5">
  <div class="container">
    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4" id="noticesEventsTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="notices-tab" data-bs-toggle="pill" data-bs-target="#noticesSection" type="button" role="tab">Notices</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="events-tab" data-bs-toggle="pill" data-bs-target="#eventsSection" type="button" role="tab">Events</button>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
      <!-- Notices -->
      <div class="tab-pane fade show active" id="noticesSection" role="tabpanel">
        <?php if (!empty($notices)): ?>
          <div class="row g-4">
            <?php foreach ($notices as $notice): ?>
              <div class="col-md-6">
                <div class="card shadow-sm h-100 border-0">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($notice['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($notice['description']); ?></p>
                    <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($notice['branch']); ?></p>
                    <p class="text-muted"><i class="bi bi-calendar"></i> <?php echo htmlspecialchars($notice['notice_date']); ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-center">No notices available.</p>
        <?php endif; ?>
      </div>

      <!-- Events -->
      <div class="tab-pane fade" id="eventsSection" role="tabpanel">
        <?php if (!empty($events)): ?>
          <div class="row g-4">
            <?php foreach ($events as $event): ?>
              <div class="col-md-6">
                <div class="card shadow-sm h-100 border-0">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                    <p class="text-muted mb-1">
                      <i class="bi bi-calendar-event"></i> <?php echo date("d M Y", strtotime($event['event_date'])); ?>
                      | <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($event['branch']); ?>
                    </p>
                    <p class="card-text"><?php echo htmlspecialchars($event['description']); ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-center">No upcoming events.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>

<!-- Bootstrap JS (needed for tabs) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
