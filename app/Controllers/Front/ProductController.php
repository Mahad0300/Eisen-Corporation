<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Database;
use PDO;

class ProductController extends Controller {
    public function show($id = null) {
        // Fallback file path
        $fallbackPath = dirname(__DIR__, 2) . '/Data/product_detail.php';

        // Helper to fetch recommendations safely
        $getRecommendations = function($excludeId = null) {
            try {
                $db = Database::getConnection();
                if ($excludeId !== null) {
                    $recStmt = $db->prepare("SELECT v.*, (SELECT image_url FROM vehicle_images WHERE vehicle_id = v.id ORDER BY sort_order ASC LIMIT 1) as main_image FROM vehicles v WHERE v.status = 'available' AND v.id != ? LIMIT 3");
                    $recStmt->execute([$excludeId]);
                } else {
                    $recStmt = $db->query("SELECT v.*, (SELECT image_url FROM vehicle_images WHERE vehicle_id = v.id ORDER BY sort_order ASC LIMIT 1) as main_image FROM vehicles v WHERE v.status = 'available' LIMIT 3");
                }
                $recs = $recStmt->fetchAll(PDO::FETCH_ASSOC);
                $recommendations = [];
                foreach ($recs as $rec) {
                    $recommendations[] = [
                        'id' => $rec['id'],
                        'stockId' => $rec['stock_id'],
                        'title' => $rec['year'] . ' ' . strtoupper($rec['make']) . ' ' . $rec['model'],
                        'priceJpy' => (int)($rec['price_jpy'] ?? ($rec['fob_price'] * 150)),
                        'mileageKm' => $rec['mileage_km'],
                        'location' => $rec['location'],
                        'image' => $rec['main_image'] ?: 'photo-1606664515524-ed2f786a0bd6',
                    ];
                }
                return $recommendations;
            } catch (\Exception $e) {
                return [];
            }
        };

        if ($id === null) {
            $detail = require $fallbackPath;
            $this->view('front/product', array_merge($detail, [
                'id' => $id,
                'recommendations' => $getRecommendations()
            ]));
            return;
        }

        try {
            $db = Database::getConnection();
            
            // Try fetching by stock_id or auto-increment id
            $stmt = $db->prepare("SELECT * FROM vehicles WHERE stock_id = ? OR id = ? LIMIT 1");
            $stmt->execute([$id, (int)$id]);
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$car) {
                // If not found, fall back to mock data
                $detail = require $fallbackPath;
                $this->view('front/product', array_merge($detail, [
                    'id' => $id,
                    'recommendations' => $getRecommendations()
                ]));
                return;
            }

            // Calculate reviews count and average rating
            $reviewsStmt = $db->prepare("SELECT COUNT(*) FROM vehicle_reviews WHERE vehicle_id = ?");
            $reviewsStmt->execute([$car['id']]);
            $reviewsCount = (int)$reviewsStmt->fetchColumn();

            $ratingStmt = $db->prepare("SELECT AVG(rating) FROM vehicle_reviews WHERE vehicle_id = ?");
            $ratingStmt->execute([$car['id']]);
            $avgRating = $ratingStmt->fetchColumn();
            $avgRating = $avgRating ? round((float)$avgRating, 1) : 5.0; // default to 5.0 if no reviews

            $stars = str_repeat('★', (int)round($avgRating)) . str_repeat('☆', 5 - (int)round($avgRating));

            // Calculate favorites count
            $favStmt = $db->prepare("SELECT COUNT(*) FROM vehicle_favorites WHERE vehicle_id = ?");
            $favStmt->execute([$car['id']]);
            $favoritesCount = (int)$favStmt->fetchColumn();

            // Increment views in DB
            $db->prepare("UPDATE vehicles SET views = views + 1 WHERE id = ?")->execute([$car['id']]);
            $viewsCount = (int)$car['views'] + 1;

            // Map database columns to the frontend keys
            $vehicle = [
                'stockId' => $car['stock_id'],
                'location' => $car['location'],
                'title' => $car['year'] . ' ' . strtoupper($car['make']) . ' ' . $car['model'],
                'modelCode' => $car['chassis_number'],
                'year' => $car['year'],
                'manufactureYear' => $car['year'],
                'bodyType' => $car['body_type'],
                'priceJpy' => (int)($car['price_jpy'] ?? ($car['fob_price'] * 150)), // convert to JPY using a standard export rate of 150 or use manual JPY price if set
                'priceMode' => 'fob',
                'reviews' => $reviewsCount,
                'views' => $viewsCount,
                'favorites' => $favoritesCount,
                'rating' => $avgRating,
                'stars' => $stars,
                'description' => $car['description'],
                'mileageKm' => $car['mileage_km'],
                'engineCc' => $car['engine_cc'],
                'transmission' => $car['transmission'],
                'drive' => $car['drive_type'],
                'steering' => $car['steering'],
                'fuel' => $car['fuel'],
                'doors' => $car['doors'],
                'seats' => $car['seats'],
            ];

            // Fetch images
            $imgStmt = $db->prepare("SELECT image_url FROM vehicle_images WHERE vehicle_id = ? ORDER BY sort_order ASC");
            $imgStmt->execute([$car['id']]);
            $dbImages = $imgStmt->fetchAll(PDO::FETCH_COLUMN);

            $gallery = [];
            if (!empty($dbImages)) {
                foreach ($dbImages as $index => $imgUrl) {
                    $gallery[] = [
                        'label' => $index === 0 ? 'Front exterior' : 'Vehicle view ' . ($index + 1),
                        'src' => $imgUrl
                    ];
                }
            } else {
                // Fallback to unsplash mock photos if no images uploaded
                $gallery = [
                    ['label' => 'Front exterior', 'src' => 'photo-1606664515524-ed2f786a0bd6'],
                    ['label' => 'Side profile', 'src' => 'photo-1549317661-bd32c8ce0db2'],
                ];
            }

            // Create vehicle details list
            $vehicleDetails = [
                ['label' => 'Make', 'value' => strtoupper($car['make'])],
                ['label' => 'Model', 'value' => $car['chassis_number']],
                ['label' => 'Body color', 'value' => strtoupper($car['color'])],
                ['label' => 'Body type', 'value' => $car['body_type']],
                ['label' => 'Doors', 'value' => (string)$car['doors']],
                ['label' => 'Seats', 'value' => (string)$car['seats']],
            ];

            // Specifications
            $specifications = [
                ['label' => 'Dimension', 'value' => $car['dimension']],
                ['label' => 'M3', 'value' => $car['m3']],
                ['label' => 'Transmission', 'value' => $car['transmission'] === 'AT' ? 'Automatic (AT)' : 'Manual (MT)'],
                ['label' => 'Drive Type', 'value' => $car['drive_type']],
                ['label' => 'Steering', 'value' => $car['steering'] === 'RHD' ? 'Right Hand Drive' : 'Left Hand Drive'],
                ['label' => 'Fuel', 'value' => $car['fuel']],
            ];

            // Fetch checked options IDs
            $optMapStmt = $db->prepare("SELECT option_id FROM vehicle_options WHERE vehicle_id = ?");
            $optMapStmt->execute([$car['id']]);
            $checkedOptionIds = $optMapStmt->fetchAll(PDO::FETCH_COLUMN);

            // Fetch all options
            $optStmt = $db->query("SELECT * FROM options ORDER BY category, label");
            $allOptions = $optStmt->fetchAll(PDO::FETCH_ASSOC);

            $optionGroups = [];
            foreach ($allOptions as $opt) {
                $category = $opt['category'];
                if (!isset($optionGroups[$category])) {
                    $optionGroups[$category] = [
                        'title' => $category,
                        'i18n' => 'product.options.' . match($category) {
                            'Comfort & Convenience' => 'comfort',
                            'Dress Up' => 'dressUp',
                            'Exterior' => 'exterior',
                            'Safety' => 'safety',
                            default => 'other'
                        },
                        'items' => []
                    ];
                }
                $optionGroups[$category]['items'][] = [
                    'label' => $opt['label'],
                    'active' => in_array($opt['id'], $checkedOptionIds)
                ];
            }

            // Sort option groups
            $order = [
                'Comfort & Convenience' => 1,
                'Dress Up' => 2,
                'Exterior' => 3,
                'Safety' => 4,
                'Other' => 5
            ];
            uksort($optionGroups, function($a, $b) use ($order) {
                return ($order[$a] ?? 99) <=> ($order[$b] ?? 99);
            });

            // Estimate details
            $estimate = [
                'countries' => ['PAKISTAN', 'KENYA', 'TANZANIA', 'BANGLADESH', 'SRI LANKA'],
                'ports' => ['ISLAMABAD', 'KARACHI', 'MOMBASA', 'DAR ES SALAAM'],
                'shipments' => ['roro', 'container'],
            ];

            // Pricing Breakdown in JPY
            $pricingBreakdown = [
                ['label' => 'Vehicle Price', 'i18n' => 'product.pricing.vehicle', 'jpy' => (int)($car['price_jpy'] ?? ($car['fob_price'] * 150))],
                ['label' => 'Freight Amount', 'i18n' => 'product.pricing.freight', 'jpy' => (int)($car['freight_price'] * 150)],
                ['label' => 'Vanning Amount', 'i18n' => 'product.pricing.vanning', 'jpy' => (int)($car['vanning_price'] * 150)],
                ['label' => 'Inspection Amount', 'i18n' => 'product.pricing.inspection', 'jpy' => (int)($car['inspection_price'] * 150)],
                ['label' => 'Insurance Amount', 'i18n' => 'product.pricing.insurance', 'jpy' => (int)($car['insurance_price'] * 150)],
                ['label' => 'Coupon', 'i18n' => 'product.pricing.coupon', 'jpy' => 0],
            ];

            $this->view('front/product', [
                'id' => $id,
                'vehicle' => $vehicle,
                'gallery' => $gallery,
                'vehicleDetails' => $vehicleDetails,
                'specifications' => $specifications,
                'optionGroups' => $optionGroups,
                'estimate' => $estimate,
                'pricingBreakdown' => $pricingBreakdown,
                'recommendations' => $getRecommendations($car['id'])
            ]);

        } catch (\Exception $e) {
            // Log error and fallback
            $detail = require $fallbackPath;
            $this->view('front/product', array_merge($detail, [
                'id' => $id,
                'recommendations' => $getRecommendations()
            ]));
        }
    }
}
