<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class ListingController extends Controller {
    public function index() {
        $this->view('front/listing');
    }
}
