<?php 
$pageTitle = "Customer Registry | Eisen Admin";
$pageScript = "customers.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="customers-page-content">
    <div class="page-header-container mb-25">
        <div class="header-title-group">
            <h1 class="page-title">Customer Registry</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Browse registered buyers, check account configurations, shipping destinations, and active portfolio holds</p>
        </div>
    </div>

    <!-- Search/Filters Toolbar -->
    <div class="card mb-25" style="padding: 16px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; align-items: center;">
            <div class="form-group" style="margin-bottom: 0; position: relative;">
                <input type="text" class="form-control" id="customerSearch" placeholder="Search by name, email, country, or ID...">
                <i data-lucide="search" style="position: absolute; right: 14px; top: 12px; color: var(--color-silver-400); width: 18px; height: 18px;"></i>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <select class="form-control" id="typeFilter">
                    <option value="">All Account Types</option>
                    <option value="Individual Buyer">Individual Buyer</option>
                    <option value="Corporate Buyer">Corporate Buyer</option>
                </select>
            </div>

            <button class="btn btn-outline" id="clearCustomerFiltersBtn" style="height: 100%;">
                <i data-lucide="filter-x"></i>
                <span>Reset Filters</span>
            </button>
        </div>
    </div>

    <!-- Users Table Grid -->
    <div class="card" style="padding: 0;">
        <div class="table-responsive">
            <table class="data-table-minimal" id="customersTable">
                <thead>
                    <tr>
                        <th style="padding-left: 24px;">Buyer ID</th>
                        <th>Full Name / Company</th>
                        <th>Contact Email</th>
                        <th>Account Type</th>
                        <th>Destination Country</th>
                        <th>WhatsApp</th>
                        <th style="text-align: center;">ASF Compliance</th>
                        <th>Active Holds</th>
                        <th style="text-align: right; padding-right: 24px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $cust): ?>
                    <tr data-type="<?= htmlspecialchars($cust['account_type']) ?>">
                        <td style="padding-left: 24px;"><strong>#<?= $cust['id'] ?></strong></td>
                        <td>
                            <strong><?= htmlspecialchars($cust['name']) ?></strong>
                            <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($cust['company']) ?></div>
                        </td>
                        <td>
                            <div><?= htmlspecialchars($cust['email']) ?></div>
                            <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($cust['phone']) ?></div>
                        </td>
                        <td>
                            <span class="badge badge-info" style="font-size: 11px;"><?= htmlspecialchars($cust['account_type']) ?></span>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($cust['country']) ?></strong>
                        </td>
                        <td>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $cust['whatsapp']) ?>" target="_blank" style="color: var(--color-success); display: inline-flex; align-items: center; gap: 4px; font-weight: 500;">
                                <i data-lucide="message-square" style="width: 14px; height: 14px;"></i>
                                <span><?= htmlspecialchars($cust['whatsapp']) ?></span>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($cust['asf_confirmed'] === 'Yes'): ?>
                                <span class="badge badge-success" style="font-size: 11px; padding: 4px 8px;"><i data-lucide="shield-check" style="width: 12px; height: 12px; display: inline-block; vertical-align: middle; margin-right: 2px;"></i>Confirmed</span>
                            <?php else: ?>
                                <span class="badge badge-danger" style="font-size: 11px; padding: 4px 8px;">Not Signed</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($cust['holds'] !== 'None'): ?>
                                <span style="font-size: 12.5px; font-weight: 600; color: var(--color-navy-950);"><i data-lucide="clock" style="width: 13px; height: 13px; display: inline-block; vertical-align: middle; margin-right: 4px; color: var(--color-warning);"></i><?= htmlspecialchars($cust['holds']) ?></span>
                            <?php else: ?>
                                <span style="font-size: 12px; color: var(--color-text-muted);">None</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right; padding-right: 24px;">
                            <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= BASE_URL ?>/admin/customers/detail?id=<?= $cust['id'] ?>'">
                                <i data-lucide="user" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                <span>View Profile</span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
