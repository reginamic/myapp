<?php include "admin_header.php"; ?>

<div class="dashboard-container container mt-4">
    <div class="row g-4 justify-content-center">

            <!-- Dashboard Cards -->
            <div class="dashboard-container">
                <div class="row g-4 justify-content-center">

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_students/manage_students.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                                <h5 class="card-title">Manage Students</h5>
                                <p class="text-muted">Add, update, or remove student records.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_courses/course_list.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-journal-bookmark-fill display-4 text-success mb-3"></i>
                                <h5 class="card-title">Manage Courses</h5>
                                <p class="text-muted">Add or edit course details and descriptions.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_description/subject_manager.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-book-fill display-4 text-warning mb-3"></i>
                                <h5 class="card-title">Manage Subjects</h5>
                                <p class="text-muted">Create, update, or delete subject descriptions.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="enrollments/manage_enrollments.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-card-checklist display-4 text-info mb-3"></i>
                                <h5 class="card-title">Manage Enrollments</h5>
                                <p class="text-muted">View and manage student course enrollments.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_events/event_list.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-calendar-event-fill display-4 text-danger mb-3"></i>
                                <h5 class="card-title">Manage Events & Notices</h5>
                                <p class="text-muted">Post events and institute announcements.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_instructors/instructors_list.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-person-badge-fill display-4 text-secondary mb-3"></i>
                                <h5 class="card-title">Manage Instructors</h5>
                                <p class="text-muted">Add or update instructor information.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="manage_inquiries/manage_inquiry.php" class="text-decoration-none">
                            <div class="card manager-card shadow-sm border-0 text-center p-4">
                                <i class="bi bi-chat-dots-fill display-4 text-purple mb-3"></i>
                                <h5 class="card-title">Manage Inquiries</h5>
                                <p class="text-muted">Respond to student or visitor inquiries.</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include "admin_footer.php"; ?>
</body>
</html>
