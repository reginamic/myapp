<?php include "header.php"; ?>

<!-- Hero Section -->
<section class="position-relative w-100" style="height:450px;">
    <img src="images/home.jpg" alt="Hero Background" class="w-100 h-100" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center text-center text-white px-3">
        <div class="max-w-75">
            <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
            <p class="lead">
                Have questions or need more information? At <strong>SkillPro Institute</strong>, we are here to assist you. 
                Reach out regarding courses, registrations, certifications, or other inquiries, and our team will guide you.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">

            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="h4 mb-4">Send Us a Message</h2>
                    <form id="inquiryForm" action="#" method="POST">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <select name="subject" class="form-select" required>
                                <option value="" disabled selected>Select Subject</option>
                                <option value="Course Inquiry">Course Inquiry</option>
                                <option value="Certification">Certification</option>
                                <option value="Job Opportunities">Job Opportunities</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" rows="5" class="form-control" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Branch Info -->
            <div class="col-md-6">
                <h2 class="h4 mb-4">Our Branches</h2>

                <div class="card mb-3 shadow-sm p-3">
                    <h5 class="fw-bold">Colombo Branch</h5>
                    <p class="mb-1">123 Main Street, Colombo</p>
                    <p class="mb-1">Phone: +94 11 123 4567</p>
                    <p>Email: <a href="mailto:colombo@skillpro.lk">colombo@skillpro.lk</a></p>
                </div>

                <div class="card mb-3 shadow-sm p-3">
                    <h5 class="fw-bold">Kandy Branch</h5>
                    <p class="mb-1">45 Temple Road, Kandy</p>
                    <p class="mb-1">Phone: +94 81 234 5678</p>
                    <p>Email: <a href="mailto:kandy@skillpro.lk">kandy@skillpro.lk</a></p>
                </div>

                <div class="card mb-3 shadow-sm p-3">
                    <h5 class="fw-bold">Matara Branch</h5>
                    <p class="mb-1">78 Ocean Avenue, Matara</p>
                    <p class="mb-1">Phone: +94 41 345 6789</p>
                    <p>Email: <a href="mailto:matara@skillpro.lk">matara@skillpro.lk</a></p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include "footer.php"; ?>
</body>
</html>