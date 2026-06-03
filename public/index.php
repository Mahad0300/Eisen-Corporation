<?php
// public/index.php

// 1. PSR-4 Class Autoloader
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

// 2. Load Configuration
require_once dirname(__DIR__) . '/config/config.php';

// 3. Initialize Core Session
use App\Core\Router;
use App\Core\Session;

Session::init();

// 4. Router Initialization
$router = new Router();

// 4. Frontstore Routes
$router->get('/', 'Front\HomeController@index');
$router->get('/listing', 'Front\ListingController@index');
$router->get('/listings', 'Front\ListingController@index');
$router->get('/product', 'Front\ProductController@show');
$router->get('/product/{id}', 'Front\ProductController@show');
$router->get('/blog', 'Front\BlogController@index');
$router->get('/blog/{slug}', 'Front\BlogController@show');
$router->get('/about', 'Front\AboutController@index');
$router->get('/contact', 'Front\ContactController@index');
$router->get('/contacts', 'Front\ContactController@index');

// 5. Admin UI Routes
$router->get('/admin', 'Admin\DashboardController@index');
$router->get('/admin/login', 'Admin\AuthController@showLoginForm');
$router->post('/admin/login', 'Admin\AuthController@login');
$router->get('/admin/logout', 'Admin\AuthController@logout');
$router->get('/admin/inventory', 'Admin\InventoryController@index');
$router->get('/admin/bids', 'Admin\BidController@index');
$router->get('/admin/reservations', 'Admin\ReservationController@index');
$router->get('/admin/customers', 'Admin\CustomerController@index');
$router->get('/admin/customers/detail', 'Admin\CustomerController@detail'); // Standard detail view fallback for UI
$router->get('/admin/shipping', 'Admin\ShippingController@index');
$router->get('/admin/reports', 'Admin\ReportController@index');

// 6. Dispatch Request
// Extract 'url' parameter passed by .htaccess rewrite
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';
$router->dispatch($url);
