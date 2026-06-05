<?php
// config/alter_vehicles_production.php
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/app/Core/Database.php';

use App\Core\Database;

try {
    $db = Database::getConnection();
    
    // 1. Add spec and stats columns to vehicles table
    $db->exec("
        ALTER TABLE vehicles 
        ADD COLUMN IF NOT EXISTS dimension VARCHAR(50) NOT NULL DEFAULT '0.00m × 0.00m × 0.00m',
        ADD COLUMN IF NOT EXISTS m3 VARCHAR(20) NOT NULL DEFAULT '10.167',
        ADD COLUMN IF NOT EXISTS description TEXT NULL,
        ADD COLUMN IF NOT EXISTS views INT NOT NULL DEFAULT 0;
    ");
    echo "1. Added spec and stats columns to vehicles table.\n";
    
    // 2. Create vehicle_reviews table
    $db->exec("
        CREATE TABLE IF NOT EXISTS `vehicle_reviews` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `vehicle_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `rating` TINYINT NOT NULL,
            `comment` TEXT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT `fk_reviews_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "2. Created vehicle_reviews table.\n";

    // 3. Create vehicle_favorites table
    $db->exec("
        CREATE TABLE IF NOT EXISTS `vehicle_favorites` (
            `user_id` INT NOT NULL,
            `vehicle_id` INT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`user_id`, `vehicle_id`),
            CONSTRAINT `fk_favorites_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_favorites_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "3. Created vehicle_favorites table.\n";

    // 4. Seed some mock reviews & favorites for testing
    // Fetch all vehicles
    $vehicles = $db->query("SELECT id FROM vehicles")->fetchAll(PDO::FETCH_COLUMN);
    // Fetch Tariq buyer user (id 2)
    $userCheck = $db->query("SELECT id FROM users WHERE email = 'tariq.m@example.com'")->fetch(PDO::FETCH_ASSOC);
    $buyerId = $userCheck ? $userCheck['id'] : 2;

    if (!empty($vehicles)) {
        // Clear old reviews and favorites to prevent key duplicates on re-run
        $db->exec("SET FOREIGN_KEY_CHECKS = 0; TRUNCATE TABLE vehicle_reviews; TRUNCATE TABLE vehicle_favorites; SET FOREIGN_KEY_CHECKS = 1;");
        
        $insertReview = $db->prepare("INSERT INTO vehicle_reviews (vehicle_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
        $insertFavorite = $db->prepare("INSERT INTO vehicle_favorites (user_id, vehicle_id) VALUES (?, ?)");
        
        foreach ($vehicles as $vId) {
            // Seed a review from Tariq
            $insertReview->execute([$vId, $buyerId, rand(4, 5), "Excellent condition and smooth handling, very happy with this model!"]);
            
            // If it's a seed car, seed an additional review from Admin (id 1)
            $insertReview->execute([$vId, 1, 5, "Highly recommended vehicle. Verified auction-grade inspection certificate."]);

            // Add to favorites
            $insertFavorite->execute([$buyerId, $vId]);
            if (rand(0, 1)) {
                $insertFavorite->execute([1, $vId]);
            }
        }
        echo "4. Seeded reviews and favorites successfully for " . count($vehicles) . " vehicles.\n";
    }

    echo "Migration completed successfully!\n";
} catch (\Exception $e) {
    echo "Migration Error: " . $e->getMessage() . "\n";
}
