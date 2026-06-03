<?php 
$pageTitle = "Auction Bids & Deposits | Eisen Admin";
$pageScript = "bids.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="bids-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">Auction Bids & Deposits</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Verify customer security deposits and monitor live auction bidding activity</p>
        </div>
    </div>

    <!-- Switcher Tabs -->
    <div class="inventory-tabs mb-25">
        <button class="tab-btn active" data-tab="deposits">
            <i data-lucide="wallet"></i>
            <span>Security Deposits</span>
            <span class="count-badge"><?= count($deposits) ?></span>
        </button>
        <button class="tab-btn" data-tab="active-bids">
            <i data-lucide="gavel"></i>
            <span>Active Auction Bids</span>
            <span class="count-badge"><?= count($activeBids) ?></span>
        </button>
    </div>

    <!-- Section 1: Security Deposits Requests -->
    <div class="tab-section" id="section-deposits">
        <div class="card" style="padding: 0;">
            <div class="table-responsive">
                <table class="data-table-minimal" id="depositsTable">
                    <thead>
                        <tr>
                            <th style="padding-left: 24px;">Deposit ID</th>
                            <th>Customer Name</th>
                            <th>Amount Deposited</th>
                            <th>Requested Bid Limit</th>
                            <th>Slip Receipt</th>
                            <th>Uploaded At</th>
                            <th>Status</th>
                            <th style="text-align: right; padding-right: 24px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deposits as $dep): ?>
                        <tr data-status="<?= $dep['status'] ?>">
                            <td style="padding-left: 24px; white-space: nowrap;"><strong>#<?= $dep['id'] ?></strong></td>
                            <td>
                                <strong><?= htmlspecialchars($dep['customer_name']) ?></strong>
                                <div style="font-size: 11px; color: var(--color-text-muted);">ID: #<?= $dep['customer_id'] ?></div>
                            </td>
                            <td><strong style="color: var(--color-navy-900);">$<?= number_format($dep['amount']) ?></strong></td>
                            <td><strong style="color: var(--color-success);">$<?= number_format($dep['requested_limit']) ?></strong></td>
                            <td>
                                <a href="#" class="view-slip-btn" data-url="<?= $dep['slip_url'] ?>" data-name="<?= $dep['slip_name'] ?>" style="color: var(--color-info); display: inline-flex; align-items: center; gap: 6px; font-weight: 500;">
                                    <i data-lucide="file-text" style="width: 14px; height: 14px;"></i>
                                    <span><?= htmlspecialchars($dep['slip_name']) ?></span>
                                </a>
                            </td>
                            <td><span style="font-size: 12px; color: var(--color-text-muted);"><?= $dep['uploaded_at'] ?></span></td>
                            <td>
                                <?php 
                                $badge = 'badge-draft';
                                if ($dep['status'] === 'Approved') $badge = 'badge-success';
                                else if ($dep['status'] === 'Pending Verification') $badge = 'badge-warning';
                                else if ($dep['status'] === 'Rejected') $badge = 'badge-danger';
                                ?>
                                <span class="badge <?= $badge ?>"><?= $dep['status'] ?></span>
                            </td>
                            <td style="text-align: right; padding-right: 24px;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <?php if ($dep['status'] === 'Pending Verification'): ?>
                                        <button class="btn btn-primary btn-sm approve-dep-btn" data-id="<?= $dep['id'] ?>" data-name="<?= htmlspecialchars($dep['customer_name']) ?>">
                                            <i data-lucide="check"></i>
                                            <span>Approve</span>
                                        </button>
                                        <button class="btn btn-danger btn-sm reject-dep-btn" data-id="<?= $dep['id'] ?>" data-name="<?= htmlspecialchars($dep['customer_name']) ?>">
                                            <i data-lucide="x"></i>
                                            <span>Reject</span>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline btn-sm" disabled style="opacity: 0.5;">
                                            <span>Locked</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section 2: Active Auction Bids -->
    <div class="tab-section" id="section-active-bids" style="display: none;">
        <div class="card" style="padding: 0;">
            <div class="table-responsive">
                <table class="data-table-minimal" id="bidsTable">
                    <thead>
                        <tr>
                            <th style="padding-left: 24px;">Bid ID</th>
                            <th>Bidder Name</th>
                            <th>Auction Lot</th>
                            <th>Starting Price</th>
                            <th>Bid Limit Locked</th>
                            <th>Placed Bid Amount</th>
                            <th>Placed At</th>
                            <th style="text-align: right; padding-right: 24px;">Bidding Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activeBids as $bid): ?>
                        <tr>
                            <td style="padding-left: 24px; white-space: nowrap;"><strong>#<?= $bid['id'] ?></strong></td>
                            <td><strong><?= htmlspecialchars($bid['customer_name']) ?></strong></td>
                            <td>
                                <strong><?= htmlspecialchars($bid['car_detail']) ?></strong>
                                <div style="font-size: 11px; color: var(--color-text-muted);"><?= $bid['lot_number'] ?></div>
                            </td>
                            <td>$<?= number_format($bid['starting_bid']) ?></td>
                            <td><strong style="color: var(--color-success);">$<?= number_format($bid['max_limit_allowed']) ?></strong></td>
                            <td><strong style="color: var(--color-navy-950); font-size: 15px;">$<?= number_format($bid['placed_bid']) ?></strong></td>
                            <td><span style="font-size: 12px; color: var(--color-text-muted);"><?= $bid['placed_at'] ?></span></td>
                            <td style="text-align: right; padding-right: 24px;">
                                <?php 
                                $badge = 'badge-active';
                                if ($bid['status'] === 'Active Winner') $badge = 'badge-success';
                                else if ($bid['status'] === 'Outbid') $badge = 'badge-danger';
                                ?>
                                <span class="badge <?= $badge ?>"><?= $bid['status'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     Modal Sheet: Slip Viewer Dialog
     ========================================== -->
<div class="modal-backdrop" id="slipModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin: 0; font-size: 18px;" id="slipModalTitle">Bank Wire Slip</h3>
            <button class="modal-close-btn" id="closeSlipModalBtn">&times;</button>
        </div>
        <div class="modal-body" style="background-color: var(--color-navy-950); display: flex; align-items: center; justify-content: center; padding: 20px; overflow: hidden; min-height: 400px;">
            <img id="slipModalImg" src="" alt="Deposit Wire Slip Scan" style="max-width: 100%; max-height: 450px; border-radius: 4px; box-shadow: 0 10px 20px rgba(0,0,0,0.5);">
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" id="closeSlipModalFooterBtn">Close Preview</button>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
