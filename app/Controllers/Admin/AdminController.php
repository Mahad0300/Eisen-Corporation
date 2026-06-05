<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;

class AdminController extends Controller {
    
    public function __construct() {
        if (!Session::isAdminLoggedIn()) {
            $this->redirect('/admin/login');
        }
    }
}
