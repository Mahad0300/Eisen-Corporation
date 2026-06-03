<?php 
$pageTitle = "Reports & Analytics | Eisen Admin";
$pageScript = "reports.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="reports-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">Reports & Analytics</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Inspect sales volumes, auction bidding performance, and destination statistics</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="btn btn-outline" id="exportExcelBtn">
                <i data-lucide="file-spreadsheet"></i>
                <span>Export Excel</span>
            </button>
            <button class="btn btn-primary" id="downloadPdfBtn">
                <i data-lucide="download"></i>
                <span>Download PDF</span>
            </button>
        </div>
    </div>

    <!-- KPI Grid Row -->
    <div class="dashboard-stats-grid mb-30">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-primary"><i data-lucide="dollar-sign"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Total Invoiced Volume</span>
                    <span class="stat-change text-success">+18% vs last Q</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value text-gold" style="color: var(--color-gold-500);">$<?= number_format($reports['total_sales_value']) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-info"><i data-lucide="shopping-cart"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Total Vehicles Sold</span>
                    <span class="stat-change text-success">+14 this month</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value"><?= $reports['total_cars_sold'] ?> cars</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-warning"><i data-lucide="gavel"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Auction Win Rate</span>
                    <span class="stat-change text-success">Target (45%) met</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value"><?= $reports['auction_win_rate'] ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon-box bg-soft-success"><i data-lucide="trending-up"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Avg. Commission per Car</span>
                    <span class="stat-change text-success">+2.5% vs last year</span>
                </div>
            </div>
            <div class="stat-card-body">
                <h2 class="stat-value">$<?= number_format($reports['average_profit_per_car']) ?></h2>
            </div>
        </div>
    </div>

    <!-- Charts and Table Grid -->
    <div class="dashboard-main-grid">
        
        <!-- Left Panel: Line Charts & Table -->
        <div class="grid-span-2">
            <!-- Line Chart Card -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Monthly Revenue Trend (2026)</h3>
                <div style="height: 320px; width: 100%;">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card">
                <div class="card-header-flex">
                    <h3 class="card-title-sm">International Importing Markets (YTD)</h3>
                    <span class="badge badge-info">Top destination countries</span>
                </div>
                <div class="table-responsive">
                    <table class="data-table-minimal">
                        <thead>
                            <tr>
                                <th>Export Destination</th>
                                <th>Vehicles Shipped</th>
                                <th>Total Sales Volume (USD)</th>
                                <th>Agent Commission Share (10%)</th>
                                <th style="text-align: right;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports['top_countries'] as $row): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($row['country']) ?></strong></td>
                                <td><?= $row['cars'] ?> units</td>
                                <td><strong>$<?= number_format($row['revenue']) ?></strong></td>
                                <td><span style="color: var(--color-success); font-weight: 600;">$<?= number_format($row['revenue'] * 0.1) ?></span></td>
                                <td style="text-align: right;"><span class="badge badge-success">Active Port</span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Panel: Donut Chart & Side Stats -->
        <div>
            <!-- Donut Chart Card -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Listing Type Shares</h3>
                <div style="height: 240px; display: flex; align-items: center; justify-content: center;">
                    <canvas id="categoryDistChart"></canvas>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 24px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background-color: var(--color-navy-700);"></span>
                            <span>Live Auction Sourced</span>
                        </span>
                        <strong>926 cars (72%)</strong>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background-color: var(--color-gold-500);"></span>
                            <span>In-Stock Direct Inventory</span>
                        </span>
                        <strong>354 cars (28%)</strong>
                    </div>
                </div>
            </div>

            <!-- Logistics Performance Summary -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Logistics Metrics</h3>
                <div style="display: flex; flex-direction: column; gap: 16px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">Avg. Port Customs Duration</span>
                        <strong>3.2 days</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">Vessel Transit Time (Japan ➔ PK)</span>
                        <strong>18.4 days</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">BL Release Rate</span>
                        <strong style="color: var(--color-success);">98.5%</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--color-text-muted);">Pending Customs Clearence</span>
                        <strong style="color: var(--color-danger);">1 vessel</strong>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
