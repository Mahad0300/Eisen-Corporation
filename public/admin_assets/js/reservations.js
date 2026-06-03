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
    // 2. Master-Detail Interactivity
    // ==========================================
    const listItems = document.querySelectorAll('.res-list-item');
    const detailsPanes = document.querySelectorAll('.res-details-pane');

    listItems.forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            // Toggle active list item
            listItems.forEach(li => li.classList.remove('active'));
            this.classList.add('active');

            // Switch details pane
            detailsPanes.forEach(pane => {
                if (pane.getAttribute('data-res-id') === id) {
                    pane.style.display = 'block';
                } else {
                    pane.style.display = 'none';
                }
            });
        });
    });

    // ==========================================
    // 3. Search and Status Filtering Logic
    // ==========================================
    const searchInput = document.getElementById('resSearchInput');
    const filterPills = document.querySelectorAll('.filter-pill');

    let currentSearch = '';
    let currentFilter = 'all';

    function applyFilters() {
        listItems.forEach(item => {
            const searchStr = item.getAttribute('data-search-str') || '';
            const status = item.getAttribute('data-status') || '';
            
            const matchesSearch = searchStr.includes(currentSearch);
            const matchesStatus = (currentFilter === 'all' || status === currentFilter);

            if (matchesSearch && matchesStatus) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Auto-select the first visible item if the currently active one is hidden
        const activeItem = document.querySelector('.res-list-item.active');
        if (activeItem && activeItem.style.display === 'none') {
            const firstVisible = Array.from(listItems).find(li => li.style.display !== 'none');
            if (firstVisible) {
                firstVisible.click();
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.trim().toLowerCase();
            applyFilters();
        });
    }

    filterPills.forEach(pill => {
        pill.addEventListener('click', function() {
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.getAttribute('data-filter');
            applyFilters();
        });
    });

    // ==========================================
    // 4. Call Log Modal Management
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

    // Set listener on body to handle dynamically/statically created details pane buttons
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.log-call-btn');
        if (btn) {
            const resId = btn.getAttribute('data-res-id');
            const name = btn.getAttribute('data-name');
            const car = btn.getAttribute('data-car');
            const status = btn.getAttribute('data-status');
            openModal(resId, name, car, status);
        }
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
    // 5. Form Submission (Simulated Save & Log Appending)
    // ==========================================
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const resId = logResIdInput.value;
            const newStatus = logCallStatusSelect.value;
            const noteText = logCallNoteTextarea.value;
            
            // Locate target card elements in Right Detail Pane
            const card = document.querySelector(`.res-details-pane[data-res-id="${resId}"]`);
            // Locate target list item in Left Master List
            const listItem = document.querySelector(`.res-list-item[data-id="${resId}"]`);

            if (!card) {
                closeModal();
                return;
            }

            // 1. Update Details Pane Status Badge
            const detailsBadge = card.querySelector('.badge:not(.badge-info)');
            if (detailsBadge) {
                detailsBadge.textContent = newStatus;
                
                let badgeClass = 'badge badge-draft';
                if (newStatus === 'Deposit Received - Booking Locked') badgeClass = 'badge badge-success';
                else if (newStatus === 'Contacted - Awaiting Wire Deposit') badgeClass = 'badge badge-warning';
                else if (newStatus === 'Pending Call') badgeClass = 'badge badge-danger';
                
                detailsBadge.className = badgeClass;
            }

            // 2. Update Details Pane button status attribute
            const logBtn = card.querySelector('.log-call-btn');
            if (logBtn) {
                logBtn.setAttribute('data-status', newStatus);
            }

            // 3. Update Left List Item status badge & data attributes
            if (listItem) {
                const listBadge = listItem.querySelector('.badge');
                if (listBadge) {
                    listBadge.textContent = newStatus === 'Deposit Received - Booking Locked' ? 'Locked' : (newStatus === 'Contacted - Awaiting Wire Deposit' ? 'Contacted' : 'Pending');
                    
                    let badgeClass = 'badge badge-draft';
                    if (newStatus === 'Deposit Received - Booking Locked') badgeClass = 'badge badge-success';
                    else if (newStatus === 'Contacted - Awaiting Wire Deposit') badgeClass = 'badge badge-warning';
                    else if (newStatus === 'Pending Call') badgeClass = 'badge badge-danger';
                    
                    listBadge.className = badgeClass;
                }
                listItem.setAttribute('data-status', newStatus);
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
                logItem.style.gap = '12px';
                logItem.style.fontSize = '13px';
                logItem.style.animation = 'fadeIn var(--transition-fast) ease-out';
                logItem.innerHTML = `
                    <div style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--color-gold-500); margin-top: 6px; flex-shrink: 0;"></div>
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: var(--color-text-muted); font-weight: 500;">
                            ${timeStr} · <strong style="color: var(--color-navy-900);">Eisen Admin</strong>
                        </div>
                        <p style="margin: 4px 0 0 0; color: var(--color-navy-950); line-height: 1.45;">${escapeHtml(noteText)}</p>
                    </div>
                `;
                timeline.insertBefore(logItem, timeline.firstChild);
            }

            closeModal();
            
            // Re-apply filters in case the status filter was active and this item is now filtered out
            applyFilters();
            
            if (window.toastr) {
                toastr.options = { "closeButton": true, "progressBar": true };
                toastr.success(`Call status updated to "${newStatus}"! Log notes saved.`, 'Hold Logged');
            }
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
