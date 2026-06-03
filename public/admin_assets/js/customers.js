document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Search and Filtering for Customer Registry Table
    // ==========================================
    const searchInput = document.getElementById('customerSearch');
    const typeSelect = document.getElementById('typeFilter');
    const clearBtn = document.getElementById('clearCustomerFiltersBtn');
    const tableRows = document.querySelectorAll('#customersTable tbody tr');

    function filterCustomers() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const selectedType = typeSelect ? typeSelect.value : '';

        tableRows.forEach(row => {
            const rowType = row.getAttribute('data-type') || '';
            const textContent = row.textContent.toLowerCase();

            const matchesSearch = query === '' || textContent.includes(query);
            const matchesType = selectedType === '' || rowType === selectedType;

            if (matchesSearch && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('keyup', filterCustomers);
    if (typeSelect) typeSelect.addEventListener('change', filterCustomers);

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (typeSelect) typeSelect.value = '';
            tableRows.forEach(row => row.style.display = '');
        });
    }

});
