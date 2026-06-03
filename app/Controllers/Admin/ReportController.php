<?php
namespace App\Controllers\Admin;

class ReportController extends AdminController {
    
    public function index() {
        // Mock reports summary statistics
        $reports = [
            'total_sales_value' => 298000,
            'total_cars_sold' => 128,
            'auction_win_rate' => '48%',
            'average_profit_per_car' => 1850,
            'sales_history' => [
                ['month' => 'Jan 2026', 'cars' => 15, 'revenue' => 38000],
                ['month' => 'Feb 2026', 'cars' => 18, 'revenue' => 42500],
                ['month' => 'Mar 2026', 'cars' => 22, 'revenue' => 54000],
                ['month' => 'Apr 2026', 'cars' => 20, 'revenue' => 49500],
                ['month' => 'May 2026', 'cars' => 25, 'revenue' => 61000],
                ['month' => 'Jun 2026 (YTD)', 'cars' => 28, 'revenue' => 53000]
            ],
            'top_countries' => [
                ['country' => 'Pakistan', 'cars' => 142, 'revenue' => 324000],
                ['country' => 'Kenya', 'cars' => 86, 'revenue' => 185000],
                ['country' => 'United Arab Emirates', 'cars' => 64, 'revenue' => 152000],
                ['country' => 'United Kingdom', 'cars' => 42, 'revenue' => 98000],
                ['country' => 'Russia', 'cars' => 38, 'revenue' => 85000]
            ]
        ];

        $this->view('admin/reports', [
            'pageTitle' => 'Reports & Analytics | Eisen Admin',
            'pageScript' => 'reports.js',
            'reports' => $reports
        ]);
    }
}
