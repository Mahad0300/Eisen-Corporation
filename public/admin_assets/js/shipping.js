document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Advance Shipping Status Simulation
    // ==========================================
    function bindRowActions(row) {
        const advanceBtn = row.querySelector('.update-shipping-status-btn');
        const uploadBtn = row.querySelector('.upload-docs-btn');
        const shipId = row.getAttribute('data-shipment-id');
        const carName = row.querySelector('h4').textContent;

        if (advanceBtn) {
            advanceBtn.addEventListener('click', function() {
                const steps = row.querySelectorAll('.pipeline-step');
                const lines = row.querySelectorAll('.pipeline-line');
                
                // Determine active index
                let activeCount = 0;
                steps.forEach(step => {
                    if (step.classList.contains('active')) activeCount++;
                });

                if (activeCount === 1) {
                    // Transition to Dispatched
                    steps[1].classList.add('active');
                    lines[0].classList.add('active');
                    toastr.success(`"${carName}" status advanced to: DISPATCHED (In-Transit)`, 'Logistics Update');
                } else if (activeCount === 2) {
                    // Transition to At Port
                    steps[2].classList.add('active');
                    lines[1].classList.add('active');
                    toastr.success(`"${carName}" status advanced to: AT PORT (Customs)`, 'Logistics Update');
                } else if (activeCount === 3) {
                    // Transition to Delivered
                    steps[3].classList.add('active');
                    lines[2].classList.add('active');
                    toastr.success(`"${carName}" status advanced to: DELIVERED (Complete)`, 'Logistics Update');
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Logistics Complete',
                        text: `"${carName}" shipment is already fully delivered and completed.`,
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        }

        if (uploadBtn) {
            uploadBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Upload Bill of Lading Documents',
                    text: `Upload PDF file/images for shipment #${shipId}`,
                    input: 'file',
                    inputAttributes: {
                        'accept': 'application/pdf,image/*',
                        'aria-label': 'Upload BL file'
                    },
                    showCancelButton: true,
                    confirmButtonColor: 'var(--color-navy-700)',
                    confirmButtonText: 'Upload File',
                    cancelButtonColor: 'var(--color-silver-400)'
                }).then((fileResult) => {
                    if (fileResult.value) {
                        Swal.fire({
                            title: 'Uploaded!',
                            text: 'Bill of Lading files have been linked to this shipment record.',
                            icon: 'success',
                            confirmButtonColor: 'var(--color-navy-700)'
                        });
                    }
                });
            });
        }
    }

    // Bind existing rows on load
    document.querySelectorAll('.shipment-row-card').forEach(row => bindRowActions(row));

    // ==========================================
    // 2. Submit New Shipment Log Form
    // ==========================================
    const logForm = document.getElementById('shippingLogForm');
    const listContainer = document.getElementById('shippingListContainer');

    if (logForm && listContainer) {
        logForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const carSelect = document.getElementById('ship_car');
            const carText = carSelect.options[carSelect.selectedIndex].text;
            const blVal = document.getElementById('bl_number').value;
            const vesselVal = document.getElementById('vessel').value;
            const etdVal = document.getElementById('etd').value;
            const etaVal = document.getElementById('eta').value;
            const statusVal = document.getElementById('shipping_status').value;
            
            const randomId = 'SH-' + Math.floor(1000 + Math.random() * 9000);
            
            // Build progress markers matching selected status
            let step1 = 'active', step2 = '', step3 = '', step4 = '';
            let line1 = '', line2 = '', line3 = '';
            
            if (statusVal === 'Dispatched' || statusVal === 'At Port' || statusVal === 'Delivered') { step2 = 'active'; line1 = 'active'; }
            if (statusVal === 'At Port' || statusVal === 'Delivered') { step3 = 'active'; line2 = 'active'; }
            if (statusVal === 'Delivered') { step4 = 'active'; line3 = 'active'; }

            // Create new element card
            const newCard = document.createElement('div');
            newCard.className = 'shipment-row-card';
            newCard.setAttribute('data-shipment-id', randomId);
            newCard.setAttribute('data-status', statusVal);
            newCard.style.cssText = 'border: 1px solid var(--color-silver-200); border-radius: var(--radius-md); padding: 20px; background: var(--color-white); position: relative;';
            
            newCard.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                    <div>
                        <span class="badge badge-success" style="font-size: 10px; margin-bottom: 6px;">${randomId}</span>
                        <h4 style="margin: 0; font-size: 15px; font-weight: 700;">${carText}</h4>
                        <div style="font-size: 11px; color: var(--color-text-muted);">
                            Chassis: <code>LOGGED-${randomId}</code> · Buyer: <strong>Assigned Buyer</strong>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 11px; color: var(--color-text-muted);">Vessel Name</div>
                        <strong style="font-size: 13px; color: var(--color-navy-900);">${vesselVal}</strong>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; font-size: 12px; background: var(--color-silver-100); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <div>
                        <span style="color: var(--color-text-muted);">BL Number</span><br>
                        <strong style="color: var(--color-navy-950); font-family: monospace; font-size: 13px;">${blVal}</strong>
                    </div>
                    <div>
                        <span style="color: var(--color-text-muted);">ETD (Japan Departure)</span><br>
                        <strong>${etdVal}</strong>
                    </div>
                    <div>
                        <span style="color: var(--color-text-muted);">ETA (Destination Port)</span><br>
                        <strong>${etaVal}</strong>
                    </div>
                </div>

                <div style="margin-bottom: 10px;">
                    <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 8px;">Delivery Milestones</span>
                    <div class="progress-pipeline">
                        <div class="pipeline-step ${step1}">
                            <div class="circle"><i data-lucide="package"></i></div>
                            <span class="step-label">Preparing</span>
                        </div>
                        <div class="pipeline-line ${line1}"></div>
                        <div class="pipeline-step ${step2}">
                            <div class="circle"><i data-lucide="navigation"></i></div>
                            <span class="step-label">Dispatched</span>
                        </div>
                        <div class="pipeline-line ${line2}"></div>
                        <div class="pipeline-step ${step3}">
                            <div class="circle"><i data-lucide="anchor"></i></div>
                            <span class="step-label">At Port</span>
                        </div>
                        <div class="pipeline-line ${line3}"></div>
                        <div class="pipeline-step ${step4}">
                            <div class="circle"><i data-lucide="check-check"></i></div>
                            <span class="step-label">Delivered</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--color-silver-200); padding-top: 14px; margin-top: 20px;">
                    <button class="btn btn-outline btn-sm update-shipping-status-btn" data-id="${randomId}">
                        <i data-lucide="refresh-cw"></i>
                        <span>Advance Status</span>
                    </button>
                    <button class="btn btn-outline btn-sm upload-docs-btn" style="color: var(--color-info);">
                        <i data-lucide="file-up"></i>
                        <span>Upload BL Docs</span>
                    </button>
                </div>
            `;

            // Insert at the top of the timeline logs list
            listContainer.insertBefore(newCard, listContainer.firstChild);
            
            // Re-bind Lucide Icons and actions
            lucide.createIcons();
            bindRowActions(newCard);
            
            // Reset form uploader
            logForm.reset();
            
            toastr.options = { "closeButton": true, "progressBar": true };
            toastr.success(`Registered new shipment route for "${carText}" with BL #${blVal}.`, 'Shipment Registered');
        });
    }

});
