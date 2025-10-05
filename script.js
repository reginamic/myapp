document.addEventListener("DOMContentLoaded", () => {
    const tabNotices = document.getElementById('tabNotices');
    const tabEvents = document.getElementById('tabEvents');
    const noticesSection = document.getElementById('noticesSection');
    const eventsSection = document.getElementById('eventsSection');

    // Default: show notices
    noticesSection.classList.remove('hidden');
    eventsSection.classList.add('hidden');
    tabNotices.classList.add('active');
    tabEvents.classList.remove('active');

    // Tab click events
    tabNotices.addEventListener('click', () => {
        noticesSection.classList.remove('hidden');
        eventsSection.classList.add('hidden');
        tabNotices.classList.add('active');
        tabEvents.classList.remove('active');
    });

    tabEvents.addEventListener('click', () => {
        eventsSection.classList.remove('hidden');
        noticesSection.classList.add('hidden');
        tabEvents.classList.add('active');
        tabNotices.classList.remove('active');
    });
});




document.addEventListener("DOMContentLoaded", () => {
    const enrollButton = document.getElementById("enrollButton");

    enrollButton.addEventListener("click", () => {
        const courseSelect = document.getElementById("course");
        const selectedValue = courseSelect.value;

        if (!selectedValue) {
            alert("⚠ Please select a course before enrolling.");
            courseSelect.focus();
            return false;
        }

        alert(" You have successfully enrolled in the course! You can see it in your dashboard.");
        window.location.href = "dashboard.php"; // same folder now
    });
});
