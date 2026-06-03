document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // 1. Sidebar Toggle Panel
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            document.body.classList.toggle('collapsed-sidebar');
        });
    }

    // 2. User Profile Dropdown Panel
    const profileToggle = document.getElementById('userProfileToggle');
    const userDropdown = document.getElementById('userDropdown');
    
    if (profileToggle && userDropdown) {
        profileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !profileToggle.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }
});
