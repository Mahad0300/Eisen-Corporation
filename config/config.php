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
