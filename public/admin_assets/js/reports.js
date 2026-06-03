document.addEventListener('DOMContentLoaded', function() {
    "use strict";

    // ==========================================
    // 1. Line Chart: Monthly Revenue Trend
    // ==========================================
    const revenueCtx = document.getElementById('revenueTrendChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan 2026', 'Feb 2026', 'Mar 2026', 'Apr 2026', 'May 2026', 'Jun 2026'],
                datasets: [{
                    label: 'Revenue (USD)',
                    data: [38000, 42500, 54000, 49500, 61000, 53000],
                    borderColor: '#16325c', // navy-700
                    backgroundColor: 'rgba(22, 50, 92, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#c9a227', // gold-500
                    pointBorderColor: '#fff',
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + Number(value).toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // ==========================================
    // 2. Donut Chart: Inventory Type Dist
    // ==========================================
    const categoryCtx = document.getElementById('categoryDistChart');
    if (categoryCtx) {
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Live Auction Sourced', 'In-Stock Direct'],
                datasets: [{
                    data: [72, 28],
                    backgroundColor: [
                        '#003664', // navy-900
                        '#c9a227'  // gold-500
                    ],
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '65%'
            }
        });
    }

    // ==========================================
    // 3. Export Actions Simulation
    // ==========================================
    const pdfBtn = document.getElementById('downloadPdfBtn');
    const excelBtn = document.getElementById('exportExcelBtn');

    if (pdfBtn) {
        pdfBtn.addEventListener('click', function() {
            toastr.options = { "closeButton": true, "progressBar": true };
            toastr.info('Generating PDF Report package...', 'Please wait');
            setTimeout(() => {
                toastr.success('Monthly analytics PDF downloaded successfully!', 'PDF Exported');
            }, 1200);
        });
    }

    if (excelBtn) {
        excelBtn.addEventListener('click', function() {
            toastr.options = { "closeButton": true, "progressBar": true };
            toastr.info('Compiling Excel spreadsheets...', 'Processing');
            setTimeout(() => {
                toastr.success('Sales ledger spreadsheets exported successfully!', 'Excel Exported');
            }, 1200);
        });
    }

});
