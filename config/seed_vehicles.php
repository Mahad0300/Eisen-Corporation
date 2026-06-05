<?php
// config/seed_vehicles.php

// Register PSR-4 Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = dirname(__DIR__) . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; 
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Load Configuration
require_once dirname(__DIR__) . '/config/config.php';

use App\Core\Database;

try {
    $db = Database::getConnection();
    
    // Temporarily disable foreign keys to safely truncate
    $db->exec("SET FOREIGN_KEY_CHECKS = 0");
    $db->exec("TRUNCATE TABLE vehicle_options");
    $db->exec("TRUNCATE TABLE vehicle_images");
    $db->exec("TRUNCATE TABLE vehicles");
    $db->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // Default vehicles array
    $cars = [
        [
            'stock_id' => 'ST-2094',
            'type' => 'In-Stock',
            'make' => 'Honda',
            'model' => 'Vezel EX-L',
            'year' => 2023,
            'chassis_number' => 'RU3-1204928',
            'grade' => '5.0',
            'mileage_km' => 14200,
            'engine_cc' => 1500,
            'transmission' => 'AT',
            'steering' => 'RHD',
            'fuel' => 'HYBRID',
            'doors' => 5,
            'seats' => 5,
            'location' => 'KOBE, JAPAN',
            'color' => 'Pearl White',
            'body_type' => 'SUV',
            'drive_type' => '2WD',
            'fob_price' => 29800.00,
            'freight_price' => 1200.00,
            'vanning_price' => 200.00,
            'inspection_price' => 450.00,
            'insurance_price' => 50.00,
            'cf_price' => 31700.00,
            'status' => 'Reserved',
            'featured' => 1,
            'arrival_date' => '2026-06-15',
            'images' => [
                'photo-1606664515524-ed2f786a0bd6',
                'photo-1549317661-bd32c8ce0db2',
                'photo-1552519507-da3b142c6e3d'
            ],
            'options' => ['Air Conditioner', 'Alloy Wheels', 'LED Light', 'Back Camera', 'Push Start']
        ],
        [
            'stock_id' => 'ST-2095',
            'type' => 'In-Stock',
            'make' => 'Toyota',
            'model' => 'Aqua Hybrid',
            'year' => 2022,
            'chassis_number' => 'NHP10-2394851',
            'grade' => '4.5',
            'mileage_km' => 21500,
            'engine_cc' => 1500,
            'transmission' => 'AT',
            'steering' => 'RHD',
            'fuel' => 'HYBRID',
            'doors' => 5,
            'seats' => 5,
            'location' => 'YOKOHAMA, JAPAN',
            'color' => 'Blue Metallic',
            'body_type' => 'Hatchback',
            'drive_type' => '2WD',
            'fob_price' => 22400.00,
            'freight_price' => 1100.00,
            'vanning_price' => 200.00,
            'inspection_price' => 450.00,
            'insurance_price' => 50.00,
            'cf_price' => 24200.00,
            'status' => 'Available',
            'featured' => 1,
            'arrival_date' => null,
            'images' => [
                'photo-1549317661-bd32c8ce0db2',
                'photo-1618843479313-40f8afb4b4d8'
            ],
            'options' => ['Air Conditioner', 'Navigation System', 'Power Steering', 'Air Bag', 'ABS']
        ],
        [
            'stock_id' => 'AUC-9824',
            'type' => 'Auction',
            'make' => 'BMW',
            'model' => '5 Series',
            'year' => 2021,
            'chassis_number' => 'WBA5A31000K29',
            'grade' => '4.0',
            'mileage_km' => 32800,
            'engine_cc' => 2000,
            'transmission' => 'AT',
            'steering' => 'RHD',
            'fuel' => 'PETROL',
            'doors' => 4,
            'seats' => 5,
            'location' => 'USS Tokyo, Japan',
            'color' => 'Black',
            'body_type' => 'Sedan',
            'drive_type' => '2WD',
            'fob_price' => 32200.00,
            'freight_price' => 1500.00,
            'vanning_price' => 0.00,
            'inspection_price' => 500.00,
            'insurance_price' => 100.00,
            'cf_price' => 34300.00,
            'status' => 'Available',
            'featured' => 0,
            'arrival_date' => '2026-06-08',
            'images' => [
                'photo-1503376780353-7e6692767b70',
                'photo-1553440569-bcc63803a83d'
            ],
            'options' => ['Leather Seat', 'Air Conditioner', 'Navigation System', 'Alloy Wheels', 'Push Start', 'ACC']
        ],
        [
            'stock_id' => 'ST-2096',
            'type' => 'In-Stock',
            'make' => 'Mercedes-Benz',
            'model' => 'E-Class E200',
            'year' => 2022,
            'chassis_number' => 'WDD21300412A',
            'grade' => '4.5',
            'mileage_km' => 18400,
            'engine_cc' => 2000,
            'transmission' => 'AT',
            'steering' => 'RHD',
            'fuel' => 'PETROL',
            'doors' => 4,
            'seats' => 5,
            'location' => 'KOBE, JAPAN',
            'color' => 'Silver',
            'body_type' => 'Sedan',
            'drive_type' => '2WD',
            'fob_price' => 48900.00,
            'freight_price' => 1400.00,
            'vanning_price' => 200.00,
            'inspection_price' => 450.00,
            'insurance_price' => 80.00,
            'cf_price' => 51030.00,
            'status' => 'Sold',
            'featured' => 0,
            'arrival_date' => null,
            'images' => [
                'photo-1618843479313-40f8afb4b4d8',
                'photo-1492144534655-ae79c964c9d7'
            ],
            'options' => ['Leather Seat', 'Air Conditioner', 'Navigation System', 'Alloy Wheels', 'LED Light', 'Back Camera', 'Push Start', 'Corner Sensor']
        ],
        [
            'stock_id' => 'AUC-9825',
            'type' => 'Auction',
            'make' => 'Audi',
            'model' => 'Q5 Premium',
            'year' => 2022,
            'chassis_number' => 'WA1BUAFY4N210',
            'grade' => 'R (Repaired)',
            'mileage_km' => 45100,
            'engine_cc' => 2000,
            'transmission' => 'AT',
            'steering' => 'RHD',
            'fuel' => 'PETROL',
            'doors' => 5,
            'seats' => 5,
            'location' => 'USS Osaka, Japan',
            'color' => 'Grey Metallic',
            'body_type' => 'SUV',
            'drive_type' => '4WD',
            'fob_price' => 34500.00,
            'freight_price' => 1400.00,
            'vanning_price' => 0.00,
            'inspection_price' => 450.00,
            'insurance_price' => 60.00,
            'cf_price' => 36410.00,
            'status' => 'Available',
            'featured' => 0,
            'arrival_date' => '2026-06-10',
            'images' => [
                'photo-1606664515524-ed2f786a0bd6',
                'photo-1552519507-da3b142c6e3d'
            ],
            'options' => ['Air Conditioner', 'Alloy Wheels', 'LED Light', 'Back Camera', 'Air Bag', 'ESC']
        ]
    ];
    
    // Prepare inserts
    $vehicleStmt = $db->prepare("
        INSERT INTO vehicles (
            stock_id, type, make, model, year, chassis_number, grade, mileage_km, engine_cc, transmission, 
            steering, fuel, doors, seats, location, color, body_type, drive_type, 
            fob_price, freight_price, vanning_price, inspection_price, insurance_price, cf_price, 
            status, featured, arrival_date
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, 
            ?, ?, ?
        )
    ");
    
    $imageStmt = $db->prepare("INSERT INTO vehicle_images (vehicle_id, image_url, sort_order) VALUES (?, ?, ?)");
    $optionMapStmt = $db->prepare("INSERT INTO vehicle_options (vehicle_id, option_id) VALUES (?, ?)");
    
    // Get all options with their IDs for mapping
    $optStmt = $db->query("SELECT id, label FROM options");
    $optionsDb = [];
    while ($row = $optStmt->fetch(PDO::FETCH_ASSOC)) {
        $optionsDb[$row['label']] = $row['id'];
    }
    
    foreach ($cars as $car) {
        // Insert vehicle
        $vehicleStmt->execute([
            $car['stock_id'],
            $car['type'],
            $car['make'],
            $car['model'],
            $car['year'],
            $car['chassis_number'],
            $car['grade'],
            $car['mileage_km'],
            $car['engine_cc'],
            $car['transmission'],
            $car['steering'],
            $car['fuel'],
            $car['doors'],
            $car['seats'],
            $car['location'],
            $car['color'],
            $car['body_type'],
            $car['drive_type'],
            $car['fob_price'],
            $car['freight_price'],
            $car['vanning_price'],
            $car['inspection_price'],
            $car['insurance_price'],
            $car['cf_price'],
            $car['status'],
            $car['featured'],
            $car['arrival_date']
        ]);
        
        $vehicleId = $db->lastInsertId();
        echo "Inserted vehicle {$car['make']} {$car['model']} (ID: $vehicleId)\n";
        
        // Insert images
        foreach ($car['images'] as $order => $src) {
            $imageStmt->execute([$vehicleId, $src, $order]);
        }
        echo "  - Added " . count($car['images']) . " images\n";
        
        // Insert options mapping
        $optCount = 0;
        foreach ($car['options'] as $label) {
            if (isset($optionsDb[$label])) {
                $optionMapStmt->execute([$vehicleId, $optionsDb[$label]]);
                $optCount++;
            }
        }
        echo "  - Mapped $optCount options\n";
    }
    
    echo "\nAll vehicles seeded successfully!\n";
    
} catch (\Exception $e) {
    echo "Error seeding vehicles: " . $e->getMessage() . "\n";
}
