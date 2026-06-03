document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // 1. Countdown Timers Logic for Customer Holds
    const timerElements = document.querySelectorAll('[data-countdown]');
    
    function formatTime(seconds) {
        if (seconds <= 0) return "Expired";
        
        const hrs = Math.floor(seconds / 3600);
        const mins = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        
        const pad = (n) => String(n).padStart(2, '0');
        return `${pad(hrs)}:${pad(mins)}:${pad(secs)}`;
    }

    function startTimerTick() {
        timerElements.forEach(el => {
            let seconds = parseInt(el.getAttribute('data-countdown'), 10);
            if (isNaN(seconds) || seconds <= 0) {
                el.textContent = "Expired";
                el.style.backgroundColor = "rgba(239, 68, 68, 0.15)";
                el.style.color = "var(--color-danger)";
                return;
            }
            
            seconds--;
            el.setAttribute('data-countdown', seconds);
            el.textContent = formatTime(seconds);
            
            // Adjust styling based on urgency (less than 3 hours remaining)
            if (seconds < 3 * 3600) {
                el.style.backgroundColor = "var(--color-danger-soft)";
                el.style.color = "var(--color-danger)";
            } else if (seconds < 12 * 3600) {
                el.style.backgroundColor = "var(--color-warning-soft)";
                el.style.color = "var(--color-warning)";
            } else {
                el.style.backgroundColor = "rgba(16, 185, 129, 0.08)";
                el.style.color = "var(--color-success)";
            }
        });
    }

    // Run tick every second
    if (timerElements.length > 0) {
        startTimerTick();
        setInterval(startTimerTick, 1000);
    }

    // 2. Sync Auction API Simulation (with SweetAlert2 & Toastr loaders)
    const syncBtn = document.getElementById('syncAuctionsBtn');
    if (syncBtn) {
        syncBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Synchronizing Auctions',
                html: 'Connecting to <strong>jpcenter.ru</strong> API feeds...',
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            }).then((result) => {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "4000"
                };
                toastr.success('Synchronized 142 new Japan auction lots successfully!', 'API Sync Complete');
            });
        });
    }
});
