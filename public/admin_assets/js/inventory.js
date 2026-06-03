document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Modal Overlay Management
    // ==========================================
    const modal = document.getElementById('addCarModal');
    const openModalBtn = document.getElementById('openAddCarModalBtn');
    const closeModalBtn = document.getElementById('closeAddCarModalBtn');
    const cancelModalBtn = document.getElementById('cancelAddCarModalBtn');
    const form = document.getElementById('addCarForm');

    function openModal() {
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // prevent scrolling behind modal
        }
    }

    function closeModal() {
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
            form.reset();
            // Reset to first tab
            switchTab('specs');
        }
    }

    if (openModalBtn) openModalBtn.addEventListener('click', openModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

    // Close when clicking backdrop
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }

    // ==========================================
    // 2. Modal Tab Panel Switching
    // ==========================================
    const tabBtns = document.querySelectorAll('.modal-tab-btn');
    const panels = document.querySelectorAll('.tab-panel');

    function switchTab(tabId) {
        tabBtns.forEach(btn => {
            const active = btn.getAttribute('data-tab') === tabId;
            btn.classList.toggle('active', active);
        });

        panels.forEach(panel => {
            const active = panel.id === `panel-${tabId}`;
            panel.style.display = active ? 'block' : 'none';
        });
    }

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Form submit validation simulation
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulation check
            const makeVal = document.getElementById('make').value;
            const modelVal = document.getElementById('model').value;
            
            closeModal();
            
            toastr.options = { "closeButton": true, "progressBar": true };
            toastr.success(`Added vehicle "${makeVal} ${modelVal}" to inventory database!`, 'Listing Saved');
        });
    }

    // ==========================================
    // 3. Search and Filtering Logic
    // ==========================================
    const searchInput = document.getElementById('searchFilter');
    const statusSelect = document.getElementById('statusFilter');
    const clearBtn = document.getElementById('clearFiltersBtn');
    const tableRows = document.querySelectorAll('#inventoryTable tbody tr');
    const tabBtnsInventory = document.querySelectorAll('.inventory-tabs .tab-btn');

    function filterTable() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusSelect.value;
        
        let activeTabType = 'all';
        const activeTab = document.querySelector('.inventory-tabs .tab-btn.active');
        if (activeTab) {
            activeTabType = activeTab.getAttribute('data-filter-type');
        }

        tableRows.forEach(row => {
            const rowType = row.getAttribute('data-type');
            const rowStatus = row.getAttribute('data-status');
            const textContent = row.textContent.toLowerCase();

            const matchesSearch = query === '' || textContent.includes(query);
            const matchesType = activeTabType === 'all' || rowType === activeTabType;
            const matchesStatus = selectedStatus === '' || rowStatus === selectedStatus;

            if (matchesSearch && matchesType && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Add Tab event listeners
    tabBtnsInventory.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtnsInventory.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            filterTable();
        });
    });

    if (searchInput) searchInput.addEventListener('keyup', filterTable);
    if (statusSelect) statusSelect.addEventListener('change', filterTable);

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            statusSelect.value = '';
            
            // Reset active tab to 'all'
            tabBtnsInventory.forEach(b => b.classList.remove('active'));
            if (tabBtnsInventory[0]) tabBtnsInventory[0].classList.add('active');
            
            filterTable();
        });
    }

    // ==========================================
    // 4. Action Button Event Simulations
    // ==========================================
    
    // Featured Switch Handler
    const featuredToggles = document.querySelectorAll('.featured-toggle-btn');
    featuredToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const row = this.closest('tr');
            const carName = row.querySelector('td:nth-child(2) strong').textContent;
            const isFeatured = this.checked;
            
            toastr.options = { "closeButton": true, "timeOut": "2000" };
            if (isFeatured) {
                toastr.success(`"${carName}" is now featured on the front homepage.`, 'Featured Status');
            } else {
                toastr.info(`"${carName}" removed from homepage featured list.`, 'Featured Status');
            }
        });
    });

    // Row Actions: Edit, Duplicate, Archive, Delete
    document.querySelectorAll('.edit-car-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const carName = row.querySelector('td:nth-child(2) strong').textContent;
            
            toastr.info(`Edit Form populated for "${carName}" inside modal layout.`, 'Edit Action');
            openModal();
        });
    });

    document.querySelectorAll('.duplicate-car-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const carName = row.querySelector('td:nth-child(2) strong').textContent;
            
            Swal.fire({
                title: 'Duplicate Listing?',
                text: `Create a copy of "${carName}"? Specs will be prefilled.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-navy-700)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Yes, duplicate'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Duplicated!',
                        text: `Successfully created duplicate copy of "${carName}".`,
                        icon: 'success',
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        });
    });

    document.querySelectorAll('.archive-car-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const carName = row.querySelector('td:nth-child(2) strong').textContent;
            
            Swal.fire({
                title: 'Archive Vehicle?',
                text: `This will hide "${carName}" from the frontend store but preserve transaction histories.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-navy-700)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Archive Listing'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Archived!',
                        text: `"${carName}" has been successfully archived.`,
                        icon: 'success',
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        });
    });

    document.querySelectorAll('.delete-car-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const carName = row.querySelector('td:nth-child(2) strong').textContent;
            
            Swal.fire({
                title: 'Delete Vehicle?',
                text: `Warning: This action is permanent! Are you sure you want to delete "${carName}"?`,
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: 'var(--color-danger)',
                cancelButtonColor: 'var(--color-silver-400)',
                confirmButtonText: 'Yes, delete permanently'
            }).then((result) => {
                if (result.isConfirmed) {
                    row.remove();
                    Swal.fire({
                        title: 'Deleted!',
                        text: `"${carName}" has been removed from catalog listings.`,
                        icon: 'success',
                        confirmButtonColor: 'var(--color-navy-700)'
                    });
                }
            });
        });
    });

    // ==========================================
    // 5. Sync Auction API Simulation
    // ==========================================
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
