document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // 1. Tab Switching
    const tabBtns = document.querySelectorAll('.inventory-tabs .tab-btn');
    const sections = document.querySelectorAll('.tab-section');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Hide all sections
            sections.forEach(sec => sec.style.display = 'none');

            // Show corresponding section
            const tabId = this.getAttribute('data-tab');
            const targetSec = document.getElementById(`section-${tabId}`);
            if (targetSec) {
                targetSec.style.display = 'block';
            }
        });
    });

    // 2. Slip Preview Modal Management
    const slipModal = document.getElementById('slipModal');
    const closeSlipBtn = document.getElementById('closeSlipModalBtn');
    const closeSlipFooterBtn = document.getElementById('closeSlipModalFooterBtn');
    const slipImg = document.getElementById('slipModalImg');
    const slipTitle = document.getElementById('slipModalTitle');

    function openSlipModal(url, name) {
        if (slipModal && slipImg && slipTitle) {
            slipImg.src = url;
            slipTitle.textContent = `Review Receipt: ${name}`;
            slipModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeSlipModal() {
        if (slipModal) {
            slipModal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    document.querySelectorAll('.view-slip-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const name = this.getAttribute('data-name');
            openSlipModal(url, name);
        });
    });

    if (closeSlipBtn) closeSlipBtn.addEventListener('click', closeSlipModal);
    if (closeSlipFooterBtn) closeSlipFooterBtn.addEventListener('click', closeSlipModal);
    if (slipModal) {
        slipModal.addEventListener('click', function(e) {
            if (e.target === slipModal) {
                closeSlipModal();
            }
        });
    }

    // 3. Simulated Deposit Verification Actions (Approve / Reject)
    document.querySelectorAll('.approve-dep-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const row = this.closest('tr');
            const statusCell = row.querySelector('td:nth-child(7) .badge');
            const actionsCell = row.querySelector('td:nth-child(8)');

            Swal.fire({
                title: 'Verify Deposit Payment?',
                text: `Confirm receipt of security payment for ${name}? This unlocks their bidding limit.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-success)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Yes, verify & approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update Status Badge
                    if (statusCell) {
                        statusCell.className = 'badge badge-success';
                        statusCell.textContent = 'Approved';
                    }
                    
                    // Replace actions with disabled label
                    if (actionsCell) {
                        actionsCell.innerHTML = `
                            <button class="btn btn-outline btn-sm" disabled style="opacity: 0.5;">
                                <span>Locked</span>
                            </button>
                        `;
                    }

                    Swal.fire({
                        title: 'Verified!',
                        text: `Security deposit approved. Bidding limits successfully unlocked for ${name}.`,
                        icon: 'success',
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        });
    });

    document.querySelectorAll('.reject-dep-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const row = this.closest('tr');
            const statusCell = row.querySelector('td:nth-child(7) .badge');
            const actionsCell = row.querySelector('td:nth-child(8)');

            Swal.fire({
                title: 'Reject Deposit Reference?',
                text: `Provide the reason for rejecting ${name}'s wire transaction slip:`,
                input: 'textarea',
                inputPlaceholder: 'Enter rejection reason here (e.g. Invalid reference code, amount mismatch)...',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-danger)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Reject Slips',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You must enter a reason for rejection!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value;

                    // Update Status Badge
                    if (statusCell) {
                        statusCell.className = 'badge badge-danger';
                        statusCell.textContent = 'Rejected';
                    }

                    // Replace actions with disabled label
                    if (actionsCell) {
                        actionsCell.innerHTML = `
                            <button class="btn btn-outline btn-sm" disabled style="opacity: 0.5;">
                                <span>Locked</span>
                            </button>
                        `;
                    }

                    Swal.fire({
                        title: 'Rejected!',
                        text: `Deposit receipt has been marked as invalid. Reason logged.`,
                        icon: 'success',
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        });
    });

});
