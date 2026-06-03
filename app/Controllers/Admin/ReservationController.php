<?php
namespace App\Controllers\Admin;

class ReservationController extends AdminController {
    
    public function index() {
        // Mock active reservations with countdowns and logs
        $reservations = [
            [
                'id' => 'RES-2094',
                'customer_id' => '1001',
                'customer_name' => 'Tariq Mahmood',
                'customer_phone' => '+92 300 1234567',
                'car_id' => 'ST-2094',
                'car_name' => 'Honda Vezel EX-L (2023)',
                'chassis' => 'RU3-1204928',
                'price' => 29800,
                'time_remaining' => 67497, // ~18 hours
                'agent_assigned' => 'Agent Bilal',
                'status' => 'Contacted - Awaiting Wire Deposit',
                'logs' => [
                    ['time' => '2026-06-03 03:10 PM', 'agent' => 'Agent Bilal', 'note' => 'Called Tariq. He confirmed bank wire transfer will be initiated tomorrow morning. He requested verification of Karachi Port handling fees.'],
                    ['time' => '2026-06-03 02:35 PM', 'agent' => 'System', 'note' => 'Reservation created. 24-Hour countdown timer started. Alerts sent to sales caller.']
                ]
            ],
            [
                'id' => 'RES-2095',
                'customer_id' => '1003',
                'customer_name' => 'Kenji Tanaka',
                'customer_phone' => '+81 90 8765 4321',
                'car_id' => 'ST-2095',
                'car_name' => 'Toyota Aqua Hybrid (2022)',
                'chassis' => 'NHP10-2394851',
                'price' => 22400,
                'time_remaining' => 7917, // ~2 hours
                'agent_assigned' => 'Agent Sana',
                'status' => 'Pending Call',
                'logs' => [
                    ['time' => '2026-06-03 08:15 PM', 'agent' => 'System', 'note' => 'Reservation created. Booking notification generated for caller.']
                ]
            ],
            [
                'id' => 'RES-2096',
                'customer_id' => '1002',
                'customer_name' => 'Sarah Jenkins',
                'customer_phone' => '+254 712 345678',
                'car_id' => 'ST-2096',
                'car_name' => 'BMW 5 Series (2021)',
                'chassis' => 'WBA5A31000K29',
                'price' => 32200,
                'time_remaining' => 86337, // ~24 hours
                'agent_assigned' => 'Agent Bilal',
                'status' => 'Deposit Received - Booking Locked',
                'logs' => [
                    ['time' => '2026-06-03 11:20 AM', 'agent' => 'Agent Bilal', 'note' => 'Deposit receipt slip verified and locked. Booking confirmed. Preparing transit files for Mombasa Port.'],
                    ['time' => '2026-06-02 06:30 PM', 'agent' => 'Agent Bilal', 'note' => 'Called Sarah. She uploaded deposit receipt slip. Forwarded to finance for validation.']
                ]
            ]
        ];

        $this->view('admin/reservations', [
            'pageTitle' => 'Vehicle Reservations Follow-up | Eisen Admin',
            'pageScript' => 'reservations.js',
            'reservations' => $reservations
        ]);
    }
}
