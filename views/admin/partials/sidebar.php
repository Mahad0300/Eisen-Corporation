<?php
$currentUri = $_SERVER['REQUEST_URI'] ?? '';
function isPageActive($path) {
    global $currentUri;
    return (strpos($currentUri, $path) !== false) ? 'active' : '';
}
?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="<?= BASE_URL ?>/admin" class="sidebar-logo">
            <img src="<?= BASE_URL ?>/public/image/eisen-logo.png" alt="Eisen Logo">
            <span class="logo-text">EISEN <span class="text-gold">ADMIN</span></span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/admin" class="nav-link <?= (preg_match('#/admin$#', rtrim($currentUri, '/')) || isPageActive('/admin/dashboard')) ? 'active' : '' ?>">
                    <i data-lucide="layout-dashboard"></i>
                    <span class="link-label">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/admin/inventory" class="nav-link <?= isPageActive('/admin/inventory') ?>">
                    <i data-lucide="car"></i>
                    <span class="link-label">Inventory</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/admin/customers" class="nav-link <?= isPageActive('/admin/customers') ?>">
                    <i data-lucide="shield-check"></i>
                    <span class="link-label">User Verifications</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/admin/shipping" class="nav-link <?= isPageActive('/admin/shipping') ?>">
                    <i data-lucide="ship"></i>
                    <span class="link-label">Shipping Logs</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/admin/reports" class="nav-link <?= isPageActive('/admin/reports') ?>">
                    <i data-lucide="bar-chart-3"></i>
                    <span class="link-label">Reports & Analytics</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="<?= BASE_URL ?>/" class="nav-link">
            <i data-lucide="arrow-left-right"></i>
            <span class="link-label">Go to Frontstore</span>
        </a>
    </div>
</aside>
