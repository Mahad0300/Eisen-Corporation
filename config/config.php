<?php
// config/config.php

// Set local timezone
date_default_timezone_set('Asia/Karachi');

// Base URLs
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
// Remove /public if we are already in the public folder to avoid duplication
$basePath = str_replace('/public', '', $scriptName);
$dynamicBaseUrl = $protocol . "://" . $host . $basePath;

// Strip trailing slash if any
$dynamicBaseUrl = rtrim($dynamicBaseUrl, '/');

define('BASE_URL', $dynamicBaseUrl);
define('ASSET_URL', BASE_URL . '/public/assets');

// Directories
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . '/app');
define('VIEW_DIR', ROOT_DIR . '/views');

// Load local configurations / secrets if they exist
if (file_exists(__DIR__ . '/config_local.php')) {
    require_once __DIR__ . '/config_local.php';
}

// Database Configuration
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'eisen_db');

// Google OAuth Configuration
if (!defined('GOOGLE_CLIENT_ID')) define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID');
if (!defined('GOOGLE_CLIENT_SECRET')) define('GOOGLE_CLIENT_SECRET', 'YOUR_GOOGLE_CLIENT_SECRET');
define('GOOGLE_REDIRECT_URI', BASE_URL . '/auth/google/callback');
