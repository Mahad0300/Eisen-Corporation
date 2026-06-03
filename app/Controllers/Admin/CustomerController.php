<?php
namespace App\Controllers\Admin;

class CustomerController extends AdminController {
    
    // List all users and registry details
    public function index() {
        $customers = $this->getMockCustomers();
        
        $this->view('admin/customers', [
            'pageTitle' => 'Customer Registry | Eisen Admin',
            'pageScript' => 'customers.js',
            'customers' => $customers
        ]);
    }

    // Detail page to review complete customer profile, holds, bids, and deposits
    public function detail() {
        $customers = $this->getMockCustomers();
        
        $customerId = $_GET['id'] ?? '1001';
        $customer = null;
        
        foreach ($customers as $c) {
            if ($c['id'] == $customerId) {
                $customer = $c;
                break;
            }
        }
        
        if (!$customer) {
            $customer = $customers[0];
        }

        $this->view('admin/customer-detail', [
            'pageTitle' => 'Customer Profile - ' . $customer['name'] . ' | Eisen Admin',
            'pageScript' => 'customers.js',
            'customer' => $customer
        ]);
    }

    private function getMockCustomers() {
        return [
            [
                'id' => '1001',
                'name' => 'Tariq Mahmood',
                'email' => 'tariq.m@example.com',
                'phone' => '+92 300 1234567',
                'whatsapp' => '+92 300 1234567',
                'country' => 'Pakistan',
                'account_type' => 'Corporate Buyer',
                'asf_confirmed' => 'Yes',
                'newsletter' => 'Yes',
                'company' => 'TM Auto Imports Ltd.',
                'registered_at' => '2026-06-03 14:30',
                'holds' => 'Honda Vezel EX-L (2023)',
                'bids' => 'None',
                'deposits' => '$5,000 (Pending Verification)'
            ],
            [
                'id' => '1002',
                'name' => 'Sarah Jenkins',
                'email' => 'sarah.j@example.com',
                'phone' => '+254 712 345678',
                'whatsapp' => '+254 712 345678',
                'country' => 'Kenya',
                'account_type' => 'Corporate Buyer',
                'asf_confirmed' => 'Yes',
                'newsletter' => 'Yes',
                'company' => 'S.J. Auto Solutions',
                'registered_at' => '2026-06-02 09:15',
                'holds' => 'BMW 5 Series (2021)',
                'bids' => '$32,200 on BMW 5 Series (2021)',
                'deposits' => '$10,000 (Approved)'
            ],
            [
                'id' => '1003',
                'name' => 'Kenji Tanaka',
                'email' => 'kenji.t@example.co.jp',
                'phone' => '+81 90 8765 4321',
                'whatsapp' => '+81 90 8765 4321',
                'country' => 'Japan',
                'account_type' => 'Individual Buyer',
                'asf_confirmed' => 'Yes',
                'newsletter' => 'No',
                'company' => 'Individual Buyer',
                'registered_at' => '2026-06-01 11:20',
                'holds' => 'Toyota Aqua Hybrid (2022)',
                'bids' => 'None',
                'deposits' => 'None'
            ],
            [
                'id' => '1004',
                'name' => 'Mohammed Al-Mansoor',
                'email' => 'mansoor@example.com',
                'phone' => '+971 50 123 4567',
                'whatsapp' => '+971 50 999 8888',
                'country' => 'UAE',
                'account_type' => 'Corporate Buyer',
                'asf_confirmed' => 'Yes',
                'newsletter' => 'Yes',
                'company' => 'Al-Mansoor Trading LLC',
                'registered_at' => '2026-06-01 17:45',
                'holds' => 'None',
                'bids' => '$34,500 on Audi Q5 Premium (2022)',
                'deposits' => '$2,000 (Rejected)'
            ]
        ];
    }
}
