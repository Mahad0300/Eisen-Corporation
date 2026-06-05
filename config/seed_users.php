<?php
// config/seed_users.php

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
    $db->exec("TRUNCATE TABLE users");
    $db->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // Prepare INSERT statement
    $stmt = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    
    // 1. Seed Admin
    $adminPassword = password_hash('admin123', PASSWORD_BCRYPT);
    $stmt->execute(['Eisen Admin', 'admin@eisen.com', $adminPassword, 'admin']);
    echo "Admin user seeded successfully (admin@eisen.com / admin123)\n";
    
    // 2. Seed Registered Buyer
    $buyerPassword = password_hash('password123', PASSWORD_BCRYPT);
    $stmt->execute(['Tariq Mahmood', 'tariq.m@example.com', $buyerPassword, 'registered_buyer']);
    echo "Buyer user seeded successfully (tariq.m@example.com / password123)\n";
    
} catch (\Exception $e) {
    echo "Error seeding users: " . $e->getMessage() . "\n";
}
