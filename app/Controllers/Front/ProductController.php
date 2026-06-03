<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class ProductController extends Controller {
    public function show($id = null) {
        $this->view('front/product', ['id' => $id]);
    }
}
