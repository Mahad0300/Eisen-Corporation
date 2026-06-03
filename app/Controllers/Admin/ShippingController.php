<?php
namespace App\Controllers\Admin;

class ShippingController extends AdminController {
    
    public function index() {
        // Mock shipments data representing active logistics records
        $shipments = [
            [
                'id' => 'SH-5091',
                'buyer_name' => 'Tariq Mahmood',
                'car' => 'Honda Vezel EX-L (2023)',
                'chassis' => 'RU3-1204928',
                'bl_number' => 'BL-JPKHI-9402941',
                'vessel_name' => 'Sunrise Queen',
                'etd' => '2026-06-12',
                'eta' => '2026-06-25',
                'status' => 'Preparing'
            ],
            [
                'id' => 'SH-5092',
                'buyer_name' => 'Sarah Jenkins',
                'car' => 'BMW 5 Series (2021)',
                'chassis' => 'WBA5A31000K29',
                'bl_number' => 'BL-JPMBA-8592039',
                'vessel_name' => 'Ocean Pacific V.42',
                'etd' => '2026-06-01',
                'eta' => '2026-06-18',
                'status' => 'Dispatched'
            ],
            [
                'id' => 'SH-5093',
                'buyer_name' => 'Kenji Tanaka',
                'car' => 'Toyota Aqua Hybrid (2022)',
                'chassis' => 'NHP10-2394851',
                'bl_number' => 'BL-JPYOK-7492049',
                'vessel_name' => 'Asia Leader V.108',
                'etd' => '2026-05-15',
                'eta' => '2026-05-30',
                'status' => 'Delivered'
            ]
        ];

        $this->view('admin/shipping', [
            'pageTitle' => 'Logistics & Shipping Management | Eisen Admin',
            'pageScript' => 'shipping.js',
            'shipments' => $shipments
        ]);
    }
}
