<?php 
$pageTitle = "User Verifications | Eisen Admin";
$pageScript = "customers.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="customers-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">User Verifications</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Inspect and verify buyer documentation for live auction and reservation access</p>
        </div>
    </div>

    <!-- Search/Filters Toolbar -->
    <div class="card mb-30" style="padding: 16px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; align-items: center;">
            <div class="form-group" style="margin-bottom: 0; position: relative;">
                <input type="text" class="form-control" id="customerSearch" placeholder="Search by name, email, or country...">
                <i data-lucide="search" style="position: absolute; right: 14px; top: 12px; color: var(--color-silver-400); width: 18px; height: 18px;"></i>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <select class="form-control" id="statusFilter">
                    <option value="">All Verification Statuses</option>
                    <option value="Pending Review">Pending Review</option>
                    <option value="Verified">Verified</option>
                    <option value="Rejected">Rejected</option>
                    <option value="No Uploads">No Uploads</option>
                </select>
            </div>

            <button class="btn btn-outline" id="clearCustomerFiltersBtn" style="height: 100%;">
                <i data-lucide="filter-x"></i>
                <span>Reset</span>
            </button>
        </div>
    </div>

    <!-- Users Table Grid -->
    <div class="card">
        <div class="table-responsive">
            <table class="data-table-minimal" id="customersTable">
                <thead>
                    <tr>
                        <th>Buyer ID</th>
                        <th>Full Name / Company</th>
                        <th>Contact Details</th>
                        <th>Region / Port</th>
                        <th>Verification Status</th>
                        <th>Holds / Reservations</th>
                        <th>Uploaded At</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $cust): ?>
                    <tr data-status="<?= $cust['status'] ?>">
                        <td><strong>#<?= $cust['id'] ?></strong></td>
                        <td>
                            <strong><?= htmlspecialchars($cust['name']) ?></strong>
                            <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($cust['company']) ?></div>
                        </td>
                        <td>
                            <div><?= htmlspecialchars($cust['email']) ?></div>
                            <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($cust['phone']) ?></div>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($cust['country']) ?></strong>
                            <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($cust['port']) ?></div>
                        </td>
                        <td>
                            <?php 
                            $badge = 'badge-draft';
                            if ($cust['status'] === 'Verified') $badge = 'badge-success';
                            else if ($cust['status'] === 'Pending Review') $badge = 'badge-warning';
                            else if ($cust['status'] === 'Rejected') $badge = 'badge-danger';
                            ?>
                            <span class="badge <?= $badge ?>"><?= $cust['status'] ?></span>
                        </td>
                        <td>
                            <span style="font-size: 12px; font-weight: 500;"><?= htmlspecialchars($cust['holds']) ?></span>
                        </td>
                        <td>
                            <span style="font-size: 12px; color: var(--color-text-muted);"><?= $cust['uploaded_at'] ?: 'N/A' ?></span>
                        </td>
                        <td style="text-align: right;">
                            <?php if ($cust['status'] !== 'No Uploads'): ?>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= BASE_URL ?>/admin/customers/detail?id=<?= $cust['id'] ?>'">
                                    <i data-lucide="eye" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                    <span>Review</span>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-outline btn-sm" disabled style="opacity: 0.5;">
                                    <span>No Docs</span>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
