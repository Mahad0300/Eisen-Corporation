<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class ProductController extends Controller {
    public function show($id = null) {
        $detail = require dirname(__DIR__, 2) . '/Data/product_detail.php';

        $this->view('front/product', array_merge($detail, ['id' => $id]));
    }
}
