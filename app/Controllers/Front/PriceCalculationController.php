<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class PriceCalculationController extends Controller
{
    public function index()
    {
        $auctionDays = require dirname(__DIR__, 2) . '/Data/price_calculation_auctions.php';

        $this->view('front/price-calculation', [
            'auctionDays' => $auctionDays,
        ]);
    }
}
