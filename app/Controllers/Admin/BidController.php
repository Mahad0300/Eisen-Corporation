<?php
namespace App\Controllers\Admin;

class BidController extends AdminController {
    
    public function index() {
        // Mock security deposit verification requests to unlock bidding limits
        $deposits = [
            [
                'id' => 'DEP-8021',
                'customer_id' => '1001',
                'customer_name' => 'Tariq Mahmood',
                'amount' => 5000,
                'requested_limit' => 25000,
                'slip_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80', // mockup wire slip image
                'slip_name' => 'wire_receipt_5k.jpg',
                'uploaded_at' => '2026-06-03 11:45 AM',
                'status' => 'Pending Verification'
            ],
            [
                'id' => 'DEP-8022',
                'customer_id' => '1002',
                'customer_name' => 'Sarah Jenkins',
                'amount' => 10000,
                'requested_limit' => 50000,
                'slip_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80',
                'slip_name' => 'wire_receipt_10k.jpg',
                'uploaded_at' => '2026-06-02 03:20 PM',
                'status' => 'Approved'
            ],
            [
                'id' => 'DEP-8023',
                'customer_id' => '1004',
                'customer_name' => 'Mohammed Al-Mansoor',
                'amount' => 2000,
                'requested_limit' => 10000,
                'slip_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80',
                'slip_name' => 'receipt_blurry.jpg',
                'uploaded_at' => '2026-06-01 05:10 PM',
                'status' => 'Rejected',
                'rejection_reason' => 'Invalid bank reference code. The wire transaction could not be verified by our finance department.'
            ]
        ];

        // Mock active customer bids on live auction lots
        $activeBids = [
            [
                'id' => 'BID-5501',
                'customer_name' => 'Sarah Jenkins',
                'car_detail' => 'BMW 5 Series (2021)',
                'lot_number' => 'Lot #AUC-9824',
                'starting_bid' => 32000,
                'max_limit_allowed' => 50000,
                'placed_bid' => 32200,
                'placed_at' => '2026-06-03 10:15 AM',
                'status' => 'Active Winner'
            ],
            [
                'id' => 'BID-5502',
                'customer_name' => 'Mohammed Al-Mansoor',
                'car_detail' => 'Audi Q5 Premium (2022)',
                'lot_number' => 'Lot #AUC-9825',
                'starting_bid' => 34000,
                'max_limit_allowed' => 10000,
                'placed_bid' => 34500,
                'placed_at' => '2026-06-02 04:30 PM',
                'status' => 'Outbid'
            ]
        ];

        $this->view('admin/bids', [
            'pageTitle' => 'Auction Bids & Security Deposits | Eisen Admin',
            'pageScript' => 'bids.js',
            'deposits' => $deposits,
            'activeBids' => $activeBids
        ]);
    }
}
