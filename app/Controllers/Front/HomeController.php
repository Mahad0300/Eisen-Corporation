<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Database;
use PDO;

class HomeController extends Controller {
    public function index() {
        try {
            $db = Database::getConnection();
            $stmt = $db->query("SELECT * FROM vehicles WHERE status = 'Available' ORDER BY featured DESC, id DESC LIMIT 4");
            $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Load main thumbnail image for each vehicle
            foreach ($cars as &$car) {
                $imgStmt = $db->prepare("SELECT image_url FROM vehicle_images WHERE vehicle_id = ? ORDER BY sort_order ASC LIMIT 1");
                $imgStmt->execute([$car['id']]);
                $car['image_url'] = $imgStmt->fetchColumn();
            }
        } catch (\Exception $e) {
            $cars = [];
        }

        $this->view('front/index', [
            'cars' => $cars
        ]);
    }
}
