<?php 
$pageTitle = "Dashboard | Eisen Admin";
$pageScript = "dashboard.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="dashboard-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">Dashboard</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Eisen Corporation — System Status & Performance</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="window.location.href='<?= BASE_URL ?>/admin/reports'">
                <i data-lucide="bar-chart-2"></i>
                <span>View Analytics</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards Row -->
    <div class="dashboard-stats-grid mb-30">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-primary">
                    <i data-lucide="car"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Listings</span>
                    <span class="stat-change text-success">+15 this week</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value"><?= number_format($stats['total_listings']) ?></h2>
                <p style="margin: 6px 0 0 0; font-size: 11px; color: var(--color-text-muted);">
                    <strong><?= $stats['active_in_stock'] ?></strong> In-Stock · <strong><?= $stats['active_auction'] ?></strong> Live Auction
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-warning">
                    <i data-lucide="clock"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Today's Holds</span>
                    <span class="stat-change text-danger" style="color: var(--color-danger);">-2 expired</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value"><?= count($stats['today_reservations']) ?></h2>
                <p style="margin: 6px 0 0 0; font-size: 11px; color: var(--color-text-muted);">
                    Active 24hr customer reservations
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-info">
                    <i data-lucide="gavel"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Pending Bid Requests</span>
                    <span class="stat-change text-success">+4 new</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value"><?= $stats['pending_bids'] ?></h2>
                <p style="margin: 6px 0 0 0; font-size: 11px; color: var(--color-text-muted);">
                    Waiting agent callback approval
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-success">
                    <i data-lucide="credit-card"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Monthly Revenue</span>
                    <span class="stat-change text-success">+8.4% vs last month</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value text-gold" style="color: var(--color-gold-500);">$<?= number_format($stats['monthly_revenue']) ?></h2>
                <p style="margin: 6px 0 0 0; font-size: 11px; color: var(--color-text-muted);">
                    Year-to-date: <strong>$<?= number_format($stats['yearly_revenue']) ?></strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Main Grid Section -->
    <div class="dashboard-main-grid">
        
        <!-- Left Panel: Active Holds & Activity -->
        <div class="grid-span-2">
            <!-- Active Holds -->
            <div class="card">
                <div class="card-header-flex">
                    <h3 class="card-title-sm">Active Holds & Reservations</h3>
                    <span class="badge badge-info">24H Timer Enabled</span>
                </div>
                <div class="table-responsive">
                    <table class="data-table-minimal">
                        <thead>
                            <tr>
                                <th>Buyer Name</th>
                                <th>Vehicle Detail</th>
                                <th>Chassis Number</th>
                                <th>Remaining Time</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats['today_reservations'] as $index => $res): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($res['buyer_name']) ?></strong></td>
                                <td><?= htmlspecialchars($res['car']) ?></td>
                                <td><code><?= htmlspecialchars($res['chassis']) ?></code></td>
                                <td>
                                    <span class="timer-pill" data-countdown="<?= $res['time_remaining'] ?>">
                                        --:--:--
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= BASE_URL ?>/admin/customers'">
                                        Verify Lead
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Live Activities Timeline -->
            <div class="card">
                <div class="card-header-flex">
                    <h3 class="card-title-sm">Live System Logs</h3>
                    <span class="pulse-indicator">
                        <span class="pulse-dot"></span> Live updates
                    </span>
                </div>
                
                <div class="activity-timeline">
                    <?php foreach ($stats['recent_activities'] as $act): ?>
                    <?php
                    $icon = 'activity';
                    $colorClass = 'bg-soft-primary';
                    if ($act['type'] === 'reservation') { $icon = 'clock'; $colorClass = 'bg-soft-warning'; }
                    else if ($act['type'] === 'bid') { $icon = 'gavel'; $colorClass = 'bg-soft-info'; }
                    else if ($act['type'] === 'document') { $icon = 'file-text'; $colorClass = 'bg-soft-primary'; }
                    else if ($act['type'] === 'payment') { $icon = 'dollar-sign'; $colorClass = 'bg-soft-success'; }
                    else if ($act['type'] === 'shipping') { $icon = 'ship'; $colorClass = 'bg-soft-success'; }
                    ?>
                    <div class="activity-item">
                        <div class="activity-icon-container <?= $colorClass ?>">
                            <i data-lucide="<?= $icon ?>"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-text">
                                <strong><?= htmlspecialchars($act['title']) ?></strong>: <?= htmlspecialchars($act['detail']) ?>
                            </p>
                            <span class="activity-time"><?= $act['time'] ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Panel: Quick Actions & Alerts -->
        <div>
            <!-- Quick Actions -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Quick Operations</h3>
                <div class="quick-actions-list">
                    <a class="btn-action" href="<?= BASE_URL ?>/admin/inventory/new">
                        <i data-lucide="plus-circle" style="color: var(--color-success);"></i>
                        <span>Add In-Stock Car</span>
                    </a>
                    <button class="btn-action" id="syncAuctionsBtn">
                        <i data-lucide="refresh-cw" style="color: var(--color-info);"></i>
                        <span>Sync Auction API</span>
                    </button>
                    <a class="btn-action" href="<?= BASE_URL ?>/admin/customers">
                        <i data-lucide="user-check" style="color: var(--color-warning);"></i>
                        <span>Verify Documents</span>
                    </a>
                    <a class="btn-action" href="<?= BASE_URL ?>/admin/shipping">
                        <i data-lucide="truck" style="color: var(--color-gold-500);"></i>
                        <span>Log Shipment</span>
                    </a>
                </div>
            </div>

            <!-- Pending Verifications Alert -->
            <div class="card" style="border-left: 4px solid var(--color-warning);">
                <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 14px;">
                    <i data-lucide="alert-triangle" style="color: var(--color-warning); flex-shrink: 0; width: 22px; height: 22px;"></i>
                    <h3 class="card-title-sm" style="margin: 0;">Attention Needed</h3>
                </div>
                <ul style="display: flex; flex-direction: column; gap: 10px; font-size: 13px;">
                    <li style="display: flex; justify-content: space-between;">
                        <span>Pending documents check:</span>
                        <strong class="text-gold" style="color: var(--color-gold-600);">2 users</strong>
                    </li>
                    <li style="display: flex; justify-content: space-between;">
                        <span>Pending wire validations:</span>
                        <strong class="text-gold" style="color: var(--color-gold-600);">3 deposits</strong>
                    </li>
                    <li style="display: flex; justify-content: space-between;">
                        <span>Holds expiring soon:</span>
                        <strong class="text-gold" style="color: var(--color-gold-600);">1 hold</strong>
                    </li>
                </ul>
                <button class="btn btn-gold btn-sm mt-20" style="width: 100%;" onclick="window.location.href='<?= BASE_URL ?>/admin/customers'">
                    Resolve Actions
                </button>
            </div>
        </div>

    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
