<?php
namespace App\Controllers\Admin;

class DashboardController extends AdminController {
    
    public function index() {
        // Prepare mock statistics to populate the UI widgets
        $stats = [
            'total_listings' => 1280,
            'active_in_stock' => 354,
            'active_auction' => 926,
            'pending_bids' => 14,
            'pending_payments' => 5,
            'active_shipments' => 8,
            'new_users' => 48,
            'monthly_revenue' => 24500,
            'yearly_revenue' => 298000,
            'today_reservations' => [
                [
                    'buyer_name' => 'Tariq Mahmood',
                    'car' => 'Honda Vezel EX-L (2023)',
                    'chassis' => 'RU3-1204928',
                    'time_remaining' => 18 * 3600 + 45 * 60, // 18 hrs 45 mins remaining in seconds
                ],
                [
                    'buyer_name' => 'Kenji Tanaka',
                    'car' => 'Toyota Aqua Hybrid (2022)',
                    'chassis' => 'NHP10-2394851',
                    'time_remaining' => 2 * 3600 + 12 * 60, // 2 hrs 12 mins remaining
                ],
                [
                    'buyer_name' => 'Sarah Jenkins',
                    'car' => 'BMW 5 Series (2021)',
                    'chassis' => 'WBA5A31000K29',
                    'time_remaining' => 23 * 3600 + 59 * 60, // 23 hrs 59 mins remaining
                ]
            ],
            'recent_activities' => [
                ['title' => 'Car Reserved', 'detail' => 'Tariq Mahmood reserved Honda Vezel #RU3-1204928', 'time' => '10 mins ago', 'type' => 'reservation'],
                ['title' => 'Bid Request Placed', 'detail' => 'Ahsan Khan requested bid of $12,500 on Lot #84920', 'time' => '25 mins ago', 'type' => 'bid'],
                ['title' => 'Document Uploaded', 'detail' => 'Sarah Jenkins uploaded Passport ID scan for verification', 'time' => '1 hour ago', 'type' => 'document'],
                ['title' => 'Payment Confirmed', 'detail' => 'Finance confirmed $24,500 bank wire from Kenji Tanaka', 'time' => '3 hours ago', 'type' => 'payment'],
                ['title' => 'Shipment Dispatched', 'detail' => 'Toyota Prius #ZVW50-483920 dispatched on vessel "Sunrise Queen"', 'time' => '5 hours ago', 'type' => 'shipping'],
            ]
        ];

        $this->view('admin/index', [
            'pageTitle' => 'Dashboard | Eisen Admin',
            'pageScript' => 'dashboard.js',
            'stats' => $stats
        ]);
    }
}
