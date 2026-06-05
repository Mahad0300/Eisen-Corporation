<?php
// config/alter_vehicles.php

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/app/Core/Database.php';

use App\Core\Database;

try {
    $db = Database::getConnection();
    
    echo "Altering vehicles table...\n";
    
    // 1. Alter color column default
    $db->exec("ALTER TABLE `vehicles` MODIFY COLUMN `color` VARCHAR(30) NOT NULL DEFAULT 'White'");
    echo "- Set default for color column to 'White'\n";
    
    // 2. Fetch existing columns
    $stmt = $db->query("DESCRIBE `vehicles`");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $columnExists = function($col) use ($columns) {
        return in_array($col, $columns);
    };
    
    // Add steering
    if (!$columnExists('steering')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `steering` ENUM('RHD', 'LHD') NOT NULL DEFAULT 'RHD' AFTER `transmission`");
        echo "- Added column steering\n";
    }
    
    // Add fuel
    if (!$columnExists('fuel')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `fuel` ENUM('PETROL', 'DIESEL', 'HYBRID', 'ELECTRIC') NOT NULL DEFAULT 'PETROL' AFTER `steering`");
        echo "- Added column fuel\n";
    }
    
    // Add doors
    if (!$columnExists('doors')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `doors` INT NOT NULL DEFAULT 5 AFTER `fuel`");
        echo "- Added column doors\n";
    }
    
    // Add seats
    if (!$columnExists('seats')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `seats` INT NOT NULL DEFAULT 5 AFTER `doors`");
        echo "- Added column seats\n";
    }
    
    // Add location
    if (!$columnExists('location')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `location` VARCHAR(100) NOT NULL DEFAULT 'KOBE, JAPAN' AFTER `seats`");
        echo "- Added column location\n";
    }
    
    // Add freight_price
    if (!$columnExists('freight_price')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `freight_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00 AFTER `fob_price`");
        echo "- Added column freight_price\n";
    }
    
    // Add vanning_price
    if (!$columnExists('vanning_price')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `vanning_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00 AFTER `freight_price`");
        echo "- Added column vanning_price\n";
    }
    
    // Add inspection_price
    if (!$columnExists('inspection_price')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `inspection_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00 AFTER `vanning_price`");
        echo "- Added column inspection_price\n";
    }
    
    // Add insurance_price
    if (!$columnExists('insurance_price')) {
        $db->exec("ALTER TABLE `vehicles` ADD COLUMN `insurance_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00 AFTER `inspection_price`");
        echo "- Added column insurance_price\n";
    }
    
    echo "Alteration completed successfully!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
