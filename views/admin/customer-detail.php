<?php 
$pageTitle = "Customer Profile - " . $customer['name'] . " | Eisen Admin";
$pageScript = "customers.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="customer-detail-page">
    <div class="page-header-container mb-25">
        <div class="header-title-group" style="display: flex; align-items: center; gap: 14px;">
            <a href="<?= BASE_URL ?>/admin/customers" class="btn btn-outline btn-sm">
                <i data-lucide="arrow-left" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                <span>Back</span>
            </a>
            <div>
                <h1 class="page-title" style="font-size: 20px; margin-bottom: 0;">Customer Profile: <?= htmlspecialchars($customer['name']) ?></h1>
                <p style="color: var(--color-text-muted); margin: 2px 0 0 0; font-size: 12px;">View registered profile configurations, active bidding actions, and security deposits</p>
            </div>
        </div>
    </div>

    <!-- Side-by-Side Grid Layout -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Left Column: Profile Card -->
        <div class="card" style="padding: 24px;">
            <h3 class="card-title-sm mb-20" style="display: flex; align-items: center; gap: 8px;">
                <i data-lucide="user" style="color: var(--color-navy-900); width: 18px; height: 18px;"></i>
                <span>Account Profile Details</span>
            </h3>
            
            <table style="width: 100%; border-collapse: collapse; font-size: 13.5px;">
                <tbody>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Buyer ID</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 700; color: var(--color-navy-950);">#<?= $customer['id'] ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Full Name</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 700; color: var(--color-navy-950);"><?= htmlspecialchars($customer['name']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Email Address</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600;"><?= htmlspecialchars($customer['email']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Contact Phone</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600;"><?= htmlspecialchars($customer['phone']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">WhatsApp Number</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600; color: var(--color-success);">
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $customer['whatsapp']) ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 4px; color: var(--color-success); font-weight: 500;">
                                <i data-lucide="message-square" style="width: 14px; height: 14px;"></i>
                                <span><?= htmlspecialchars($customer['whatsapp']) ?></span>
                            </a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Account Type</td>
                        <td style="padding: 12px 0; text-align: right;"><span class="badge badge-info" style="font-size: 11px;"><?= htmlspecialchars($customer['account_type']) ?></span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Company / Trade Name</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600;"><?= htmlspecialchars($customer['company']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Destination Country</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 700; color: var(--color-navy-900);"><?= htmlspecialchars($customer['country']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Registered Date</td>
                        <td style="padding: 12px 0; text-align: right; color: var(--color-text-muted);"><?= htmlspecialchars($customer['registered_at']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-silver-200);">
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Anti-Social Forces Consent</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600; color: var(--color-success);">
                            <span style="display: inline-flex; align-items: center; gap: 4px; justify-content: flex-end;">
                                <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                                <span>Policy Confirmed</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 0; color: var(--color-text-muted);">Newsletter Consent</td>
                        <td style="padding: 12px 0; text-align: right; font-weight: 600; color: <?= $customer['newsletter'] === 'Yes' ? 'var(--color-success)' : 'var(--color-text-muted)' ?>;">
                            <span style="display: inline-flex; align-items: center; gap: 4px; justify-content: flex-end;">
                                <i data-lucide="<?= $customer['newsletter'] === 'Yes' ? 'check' : 'minus-circle' ?>" style="width: 16px; height: 16px;"></i>
                                <span><?= $customer['newsletter'] === 'Yes' ? 'Subscribed' : 'Opted Out' ?></span>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Right Column: Portfolios & Activities -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Holds Card -->
            <div class="card" style="padding: 20px;">
                <h3 class="card-title-sm mb-15" style="display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="clock" style="color: var(--color-warning); width: 18px; height: 18px;"></i>
                    <span>Active Reservations (Holds)</span>
                </h3>
                <?php if ($customer['holds'] !== 'None'): ?>
                    <div style="background: var(--color-silver-100); padding: 14px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="color: var(--color-navy-950); display: block; font-size: 14px;"><?= htmlspecialchars($customer['holds']) ?></strong>
                            <span style="font-size: 11.5px; color: var(--color-text-muted);">24-Hour booking lock holds are active</span>
                        </div>
                        <span class="badge badge-warning">Active Hold</span>
                    </div>
                <?php else: ?>
                    <p style="margin: 0; color: var(--color-text-muted); font-style: italic; font-size: 13px;">No active vehicles reserved by this customer.</p>
                <?php endif; ?>
            </div>

            <!-- Bids Card -->
            <div class="card" style="padding: 20px;">
                <h3 class="card-title-sm mb-15" style="display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="gavel" style="color: var(--color-navy-900); width: 18px; height: 18px;"></i>
                    <span>Live Auction Bidding Activity</span>
                </h3>
                <?php if ($customer['bids'] !== 'None'): ?>
                    <div style="background: var(--color-silver-100); padding: 14px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="color: var(--color-navy-950); display: block; font-size: 14px;"><?= htmlspecialchars($customer['bids']) ?></strong>
                            <span style="font-size: 11.5px; color: var(--color-text-muted);">Currently tracking live bidding results</span>
                        </div>
                        <span class="badge badge-success">Active Bid</span>
                    </div>
                <?php else: ?>
                    <p style="margin: 0; color: var(--color-text-muted); font-style: italic; font-size: 13px;">No live auction lots bid by this customer.</p>
                <?php endif; ?>
            </div>

            <!-- Deposits Card -->
            <div class="card" style="padding: 20px;">
                <h3 class="card-title-sm mb-15" style="display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="wallet" style="color: var(--color-info); width: 18px; height: 18px;"></i>
                    <span>Security Deposits Ledger</span>
                </h3>
                <?php if ($customer['deposits'] !== 'None'): ?>
                    <div style="background: var(--color-silver-100); padding: 14px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="color: var(--color-navy-950); display: block; font-size: 14px;"><?= htmlspecialchars($customer['deposits']) ?></strong>
                            <span style="font-size: 11.5px; color: var(--color-text-muted);">Financial security limit verification ledger</span>
                        </div>
                        <?php 
                        $statusClass = 'badge-draft';
                        if (strpos($customer['deposits'], 'Approved') !== false) $statusClass = 'badge-success';
                        else if (strpos($customer['deposits'], 'Pending') !== false) $statusClass = 'badge-warning';
                        else if (strpos($customer['deposits'], 'Rejected') !== false) $statusClass = 'badge-danger';
                        ?>
                        <span class="badge <?= $statusClass ?>">Logged</span>
                    </div>
                <?php else: ?>
                    <p style="margin: 0; color: var(--color-text-muted); font-style: italic; font-size: 13px;">No wire slip deposits registered for this account.</p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
