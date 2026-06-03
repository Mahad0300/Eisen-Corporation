document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Search and Filtering for Customers Table
    // ==========================================
    const searchInput = document.getElementById('customerSearch');
    const statusSelect = document.getElementById('statusFilter');
    const clearBtn = document.getElementById('clearCustomerFiltersBtn');
    const tableRows = document.querySelectorAll('#customersTable tbody tr');

    function filterCustomers() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const selectedStatus = statusSelect ? statusSelect.value : '';

        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const textContent = row.textContent.toLowerCase();

            const matchesSearch = query === '' || textContent.includes(query);
            const matchesStatus = selectedStatus === '' || rowStatus === selectedStatus;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('keyup', filterCustomers);
    if (statusSelect) statusSelect.addEventListener('change', filterCustomers);

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            statusSelect.value = '';
            tableRows.forEach(row => row.style.display = '');
        });
    }

    // ==========================================
    // 2. Document Reader Image Zoom & Rotate
    // ==========================================
    const docWrapper = document.getElementById('documentImageWrapper');
    const zoomInBtn = document.getElementById('zoomInBtn');
    const zoomOutBtn = document.getElementById('zoomOutBtn');
    const rotateBtn = document.getElementById('rotateBtn');

    let scale = 1;
    let rotation = 0;

    function applyTransforms() {
        if (docWrapper) {
            docWrapper.style.transform = `scale(${scale}) rotate(${rotation}deg)`;
        }
    }

    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', function() {
            if (scale < 2.5) {
                scale += 0.2;
                applyTransforms();
            }
        });
    }

    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', function() {
            if (scale > 0.6) {
                scale -= 0.2;
                applyTransforms();
            }
        });
    }

    if (rotateBtn) {
        rotateBtn.addEventListener('click', function() {
            rotation = (rotation + 90) % 360;
            applyTransforms();
        });
    }

    // ==========================================
    // 3. Document Approval & Rejection Toggles
    // ==========================================
    const approveBtn = document.getElementById('approveBuyerBtn');
    const rejectBtn = document.getElementById('rejectBuyerBtn');
    const rejectionForm = document.getElementById('rejectionFormContainer');
    const cancelRejectionBtn = document.getElementById('cancelRejectionBtn');
    const sendRejectionBtn = document.getElementById('sendRejectionNoticeBtn');
    const controlBox = document.getElementById('verificationControlsCard');
    const statusBadge = document.getElementById('currentStatusBadge');

    // Approve Button Action
    if (approveBtn) {
        approveBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Verify Buyer Identity?',
                text: 'Confirm that you have inspected this document and it matches the registration information.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-success)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Yes, Approve Identity'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update Badge UI
                    if (statusBadge) {
                        statusBadge.className = 'badge badge-success';
                        statusBadge.textContent = 'Verified';
                    }
                    
                    // Replace Controls with Success Message Banner
                    if (controlBox) {
                        controlBox.innerHTML = `
                            <h3 class="card-title-sm mb-20">Verification Assessment</h3>
                            <div style="background-color: var(--color-success-soft); border-left: 4px solid var(--color-success); padding: 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                                <i data-lucide="check-check" style="color: var(--color-success); width: 24px; height: 24px; flex-shrink: 0;"></i>
                                <div>
                                    <h4 style="color: var(--color-success); font-size: 14px; margin: 0;">Identity Verified</h4>
                                    <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--color-text-muted);">Verified just now by Eisen Admin</p>
                                </div>
                            </div>
                            <button class="btn btn-outline" id="revertToReviewBtn" style="width: 100%;">
                                <i data-lucide="shield-alert"></i>
                                <span>Revoke Verification Status</span>
                            </button>
                        `;
                        lucide.createIcons();
                        bindRevertBtn(); // Bind revert handler to the newly injected button
                    }
                    
                    toastr.options = { "closeButton": true, "progressBar": true };
                    toastr.success('Buyer identity document verified successfully!', 'Verified');
                }
            });
        });
    }

    // Toggle Rejection Form Container
    if (rejectBtn) {
        rejectBtn.addEventListener('click', function() {
            if (rejectionForm) {
                rejectionForm.style.display = 'block';
                rejectionForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    }

    if (cancelRejectionBtn) {
        cancelRejectionBtn.addEventListener('click', function() {
            if (rejectionForm) {
                rejectionForm.style.display = 'none';
                document.getElementById('rejectionReason').value = '';
            }
        });
    }

    // Send Rejection Notice Form Submission
    if (sendRejectionBtn) {
        sendRejectionBtn.addEventListener('click', function() {
            const reasonInput = document.getElementById('rejectionReason');
            const reasonVal = reasonInput.value.trim();

            if (reasonVal === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Explanation Required',
                    text: 'Please write a brief reason why this document is being rejected.',
                    confirmButtonColor: 'var(--color-navy-700)'
                });
                return;
            }

            Swal.fire({
                title: 'Reject Document?',
                text: 'Send notification to the buyer to re-upload ID document.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-danger)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Yes, Reject Document'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update Badge UI
                    if (statusBadge) {
                        statusBadge.className = 'badge badge-danger';
                        statusBadge.textContent = 'Rejected';
                    }

                    // Replace Controls with Rejection banner
                    if (controlBox) {
                        controlBox.innerHTML = `
                            <h3 class="card-title-sm mb-20">Verification Assessment</h3>
                            <div style="background-color: var(--color-danger-soft); border-left: 4px solid var(--color-danger); padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                                <h4 style="color: var(--color-danger); font-size: 14px; margin-bottom: 6px;">Document Rejected</h4>
                                <p style="margin: 0; font-size: 12px; color: var(--color-text);">${reasonVal}</p>
                            </div>
                            <button class="btn btn-outline" id="revertToReviewBtn" style="width: 100%;">
                                <i data-lucide="rotate-ccw"></i>
                                <span>Revert to Pending Review</span>
                            </button>
                        `;
                        lucide.createIcons();
                        bindRevertBtn();
                    }

                    toastr.options = { "closeButton": true, "progressBar": true };
                    toastr.error('Rejection notice has been sent to the buyer.', 'Rejected');
                }
            });
        });
    }

    // Bind Revert to Pending Action
    function bindRevertBtn() {
        const revertBtn = document.getElementById('revertToReviewBtn');
        if (revertBtn) {
            revertBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Revert Verification Status?',
                    text: 'Reset this user status back to "Pending Review"?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--color-navy-700)',
                    cancelButtonColor: 'var(--color-silver-400)',
                    confirmButtonText: 'Revert Status'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            });
        }
    }

    // Call bind on page load in case page loaded in Verified/Rejected state
    bindRevertBtn();

});
