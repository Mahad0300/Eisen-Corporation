<?php
namespace App\Controllers\Admin;

class CustomerController extends AdminController {
    
    // List all users and verification status
    public function index() {
        $customers = $this->getMockCustomers();
        
        $this->view('admin/customers', [
            'pageTitle' => 'User Verifications | Eisen Admin',
            'pageScript' => 'customers.js',
            'customers' => $customers
        ]);
    }

    // Detail page to review uploaded documents side-by-side
    public function detail() {
        $customers = $this->getMockCustomers();
        
        // Use first customer (Tariq Mahmood) as default mock selection for UI detailing
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
            'pageTitle' => 'Review Documents - ' . $customer['name'] . ' | Eisen Admin',
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
                'country' => 'Pakistan',
                'port' => 'Karachi Port',
                'status' => 'Pending Review',
                'doc_name' => 'Passport_Scan_Tariq_Mahmood.pdf',
                'doc_type' => 'Passport',
                'doc_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80', // placeholder for visual doc preview
                'uploaded_at' => '2026-06-03 14:30',
                'company' => 'TM Auto Imports Ltd.',
                'holds' => 'Honda Vezel (RU3-1204928)'
            ],
            [
                'id' => '1002',
                'name' => 'Sarah Jenkins',
                'email' => 'sarah.j@example.com',
                'phone' => '+254 712 345678',
                'country' => 'Kenya',
                'port' => 'Mombasa Port',
                'status' => 'Verified',
                'doc_name' => 'NationalID_Sarah_J.jpg',
                'doc_type' => 'National ID',
                'doc_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80',
                'uploaded_at' => '2026-06-02 09:15',
                'company' => 'S.J. Auto Solutions',
                'holds' => 'BMW 5 Series (WBA5A31000K29)'
            ],
            [
                'id' => '1003',
                'name' => 'Kenji Tanaka',
                'email' => 'kenji.t@example.co.jp',
                'phone' => '+81 90 8765 4321',
                'country' => 'Japan',
                'port' => 'Yokohama',
                'status' => 'No Uploads',
                'doc_name' => '',
                'doc_type' => '',
                'doc_url' => '',
                'uploaded_at' => '',
                'company' => 'Individual Buyer',
                'holds' => 'Toyota Aqua (NHP10-2394851)'
            ],
            [
                'id' => '1004',
                'name' => 'Mohammed Al-Mansoor',
                'email' => 'mansoor@example.com',
                'phone' => '+971 50 123 4567',
                'country' => 'UAE',
                'port' => 'Jebel Ali Port',
                'status' => 'Rejected',
                'doc_name' => 'Document_ID_Scan_Blurry.jpg',
                'doc_type' => 'Passport',
                'doc_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=800&q=80',
                'uploaded_at' => '2026-06-01 17:45',
                'company' => 'Al-Mansoor Trading LLC',
                'holds' => 'None',
                'rejection_reason' => 'The uploaded passport image is extremely blurry and the date of birth cannot be read. Please upload a clear photo scan.'
            ]
        ];
    }
}
