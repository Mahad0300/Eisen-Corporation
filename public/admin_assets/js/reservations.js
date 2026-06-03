document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Countdown Timers Logic (Ticking)
    // ==========================================
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
            
            // Urgency indicators
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

    if (timerElements.length > 0) {
        startTimerTick();
        setInterval(startTimerTick, 1000);
    }

    // ==========================================
    // 2. Call Log Modal Management
    // ==========================================
    const modal = document.getElementById('callLogModal');
    const closeBtn = document.getElementById('closeCallLogModalBtn');
    const cancelBtn = document.getElementById('cancelCallLogModalBtn');
    const form = document.getElementById('callLogForm');

    // Inputs inside modal
    const logResIdInput = document.getElementById('log_res_id');
    const logCarNameInput = document.getElementById('log_car_name');
    const logCustomerNameInput = document.getElementById('log_customer_name');
    const logCallStatusSelect = document.getElementById('log_call_status');
    const logCallNoteTextarea = document.getElementById('log_call_note');

    function openModal(resId, name, car, status) {
        if (modal) {
            logResIdInput.value = resId;
            logCustomerNameInput.value = name;
            logCarNameInput.value = car;
            logCallStatusSelect.value = status;
            logCallNoteTextarea.value = '';
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal() {
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
            form.reset();
        }
    }

    document.querySelectorAll('.log-call-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const resId = this.getAttribute('data-res-id');
            const name = this.getAttribute('data-name');
            const car = this.getAttribute('data-car');
            const status = this.getAttribute('data-status');
            openModal(resId, name, car, status);
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }

    // ==========================================
    // 3. Form Submission (Simulated Save & Log Appending)
    // ==========================================
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const resId = logResIdInput.value;
            const newStatus = logCallStatusSelect.value;
            const noteText = logCallNoteTextarea.value;
            
            // Locate target card elements
            const card = document.querySelector(`.res-card[data-res-id="${resId}"]`);
            if (!card) {
                closeModal();
                return;
            }

            // Update status badge
            const badge = card.querySelector('td:nth-child(3) .badge') || card.querySelector('.badge:not(.badge-info)');
            if (badge) {
                badge.textContent = newStatus;
                
                // Set appropriate badge class
                let badgeClass = 'badge badge-draft';
                if (newStatus === 'Deposit Received - Booking Locked') badgeClass = 'badge badge-success';
                else if (newStatus === 'Contacted - Awaiting Wire Deposit') badgeClass = 'badge badge-warning';
                else if (newStatus === 'Pending Call') badgeClass = 'badge badge-danger';
                
                badge.className = badgeClass;
            }

            // Update status data-attribute on the trigger button
            const logBtn = card.querySelector('.log-call-btn');
            if (logBtn) {
                logBtn.setAttribute('data-status', newStatus);
            }

            // Format current timestamp
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            const timeStr = `${year}-${month}-${day} ${String(hours).padStart(2, '0')}:${minutes} ${ampm}`;

            // Append new log item to timeline
            const timeline = card.querySelector('.res-history-timeline');
            if (timeline) {
                const logItem = document.createElement('div');
                logItem.style.display = 'flex';
                logItem.style.gap = '10px';
                logItem.style.fontSize = '12.5px';
                logItem.style.animation = 'slideUp var(--transition-fast)';
                logItem.innerHTML = `
                    <div style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--color-gold-500); margin-top: 5px; flex-shrink: 0;"></div>
                    <div style="flex: 1;">
                        <span style="font-size: 11px; color: var(--color-text-muted); font-weight: 500;">${timeStr} · <strong>Eisen Admin</strong></span>
                        <p style="margin: 2px 0 0 0; color: var(--color-navy-950); line-height: 1.35;">${escapeHtml(noteText)}</p>
                    </div>
                `;
                timeline.insertBefore(logItem, timeline.firstChild);
            }

            closeModal();
            
            toastr.options = { "closeButton": true, "progressBar": true };
            toastr.success(`Call status updated to "${newStatus}"! Log notes saved.`, 'Hold Logged');
        });
    }

    // Helper to escape HTML tags
    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

});
