<?php
namespace App\Controllers\Admin;

class InventoryController extends AdminController {
    
    public function index() {
        // Mock inventory records containing both In-Stock and Auction items
        $cars = [
            [
                'id' => 'ST-2094',
                'type' => 'In-Stock',
                'make' => 'Honda',
                'model' => 'Vezel EX-L',
                'year' => 2023,
                'chassis' => 'RU3-1204928',
                'price' => 29800,
                'grade' => '5.0',
                'mileage' => '14,200 km',
                'transmission' => 'Auto',
                'status' => 'Reserved',
                'featured' => true,
                'arrival_date' => '2026-06-15'
            ],
            [
                'id' => 'ST-2095',
                'type' => 'In-Stock',
                'make' => 'Toyota',
                'model' => 'Aqua Hybrid',
                'year' => 2022,
                'chassis' => 'NHP10-2394851',
                'price' => 22400,
                'grade' => '4.5',
                'mileage' => '21,500 km',
                'transmission' => 'Auto',
                'status' => 'Available',
                'featured' => true,
                'arrival_date' => 'Available Now'
            ],
            [
                'id' => 'AUC-9824',
                'type' => 'Auction',
                'make' => 'BMW',
                'model' => '5 Series',
                'year' => 2021,
                'chassis' => 'WBA5A31000K29',
                'price' => 32200, // starting bid
                'grade' => '4.0',
                'mileage' => '32,800 km',
                'transmission' => 'Auto',
                'status' => 'Available',
                'featured' => false,
                'arrival_date' => 'Auction Date: Jun 08'
            ],
            [
                'id' => 'ST-2096',
                'type' => 'In-Stock',
                'make' => 'Mercedes-Benz',
                'model' => 'E-Class E200',
                'year' => 2022,
                'chassis' => 'WDD21300412A',
                'price' => 48900,
                'grade' => '4.5',
                'mileage' => '18,400 km',
                'transmission' => 'Auto',
                'status' => 'Sold',
                'featured' => false,
                'arrival_date' => 'Delivered'
            ],
            [
                'id' => 'AUC-9825',
                'type' => 'Auction',
                'make' => 'Audi',
                'model' => 'Q5 Premium',
                'year' => 2022,
                'chassis' => 'WA1BUAFY4N210',
                'price' => 34500,
                'grade' => 'R (Repaired)',
                'mileage' => '45,100 km',
                'transmission' => 'Auto',
                'status' => 'Available',
                'featured' => false,
                'arrival_date' => 'Auction Date: Jun 10'
            ]
        ];

        $this->view('admin/inventory', [
            'pageTitle' => 'Inventory Management | Eisen Admin',
            'pageScript' => 'inventory.js',
            'cars' => $cars
        ]);
    }
}
