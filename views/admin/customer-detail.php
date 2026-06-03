<?php 
$pageTitle = "Review Document - " . $customer['name'] . " | Eisen Admin";
$pageScript = "customers.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="customer-detail-page">
    <div class="page-header-container mb-20">
        <div class="header-title-group" style="display: flex; align-items: center; gap: 14px;">
            <a href="<?= BASE_URL ?>/admin/customers" class="btn btn-outline btn-sm">
                <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i>
                <span>Back</span>
            </a>
            <div>
                <h1 class="page-title" style="font-size: 20px; margin-bottom: 0;">Review Document: <?= htmlspecialchars($customer['name']) ?></h1>
                <p style="color: var(--color-text-muted); margin: 2px 0 0 0; font-size: 12px;">Verify identity documents and consignee ports</p>
            </div>
        </div>
    </div>

    <!-- Side-by-Side Grid Layout -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: start;">
        
        <!-- Left Column: Document File Viewer -->
        <div class="card" style="padding: 0; min-height: 500px; display: flex; flex-direction: column;">
            <div style="padding: 16px 24px; border-bottom: 1px solid var(--color-silver-200); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="font-size: 14px;"><?= htmlspecialchars($customer['doc_type']) ?> Upload</strong>
                    <div style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($customer['doc_name']) ?></div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button class="btn-icon-sm" id="zoomInBtn" title="Zoom In"><i data-lucide="zoom-in"></i></button>
                    <button class="btn-icon-sm" id="zoomOutBtn" title="Zoom Out"><i data-lucide="zoom-out"></i></button>
                    <button class="btn-icon-sm" id="rotateBtn" title="Rotate"><i data-lucide="rotate-cw"></i></button>
                </div>
            </div>
            
            <!-- PDF/Image Scan Window -->
            <div style="flex: 1; background-color: var(--color-navy-950); display: flex; align-items: center; justify-content: center; padding: 20px; overflow: hidden; min-height: 400px; position: relative;">
                <div id="documentImageWrapper" style="transition: transform 0.2s; transform: scale(1) rotate(0deg); cursor: grab;">
                    <img src="<?= $customer['doc_url'] ?>" alt="Uploaded Document Scan" style="max-width: 100%; max-height: 420px; border-radius: 4px; box-shadow: 0 10px 20px rgba(0,0,0,0.5);">
                </div>
            </div>
        </div>

        <!-- Right Column: Verification Stats & Form Control -->
        <div>
            <!-- Buyer profile specifications -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Buyer Information</h3>
                
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <tbody>
                        <tr style="border-bottom: 1px solid var(--color-silver-200);">
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Buyer ID</td>
                            <td style="padding: 12px 0; text-align: right; font-weight: 700;">#<?= $customer['id'] ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--color-silver-200);">
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Registered Name</td>
                            <td style="padding: 12px 0; text-align: right; font-weight: 700;"><?= htmlspecialchars($customer['name']) ?></td>
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
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Company Name</td>
                            <td style="padding: 12px 0; text-align: right; font-weight: 600;"><?= htmlspecialchars($customer['company']) ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--color-silver-200);">
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Country / Destination Port</td>
                            <td style="padding: 12px 0; text-align: right; font-weight: 700; color: var(--color-navy-900);">
                                <?= htmlspecialchars($customer['country']) ?> (➔ <?= htmlspecialchars($customer['port']) ?>)
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--color-silver-200);">
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Current Verification Status</td>
                            <td style="padding: 12px 0; text-align: right;">
                                <?php 
                                $badge = 'badge-draft';
                                if ($customer['status'] === 'Verified') $badge = 'badge-success';
                                else if ($customer['status'] === 'Pending Review') $badge = 'badge-warning';
                                else if ($customer['status'] === 'Rejected') $badge = 'badge-danger';
                                ?>
                                <span class="badge <?= $badge ?>" id="currentStatusBadge"><?= $customer['status'] ?></span>
                            </td>
                        </tr>
                        <?php if ($customer['holds'] !== 'None'): ?>
                        <tr>
                            <td style="padding: 12px 0; color: var(--color-text-muted);">Reserved Holdings</td>
                            <td style="padding: 12px 0; text-align: right; color: var(--color-danger); font-weight: 700;">
                                <i data-lucide="clock" style="width: 12px; height: 12px; display: inline-block; vertical-align: middle; margin-right: 2px;"></i>
                                <span style="vertical-align: middle;"><?= htmlspecialchars($customer['holds']) ?></span>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Verification Action Box -->
            <div class="card" id="verificationControlsCard">
                <h3 class="card-title-sm mb-20">Verification Assessment</h3>
                
                <?php if ($customer['status'] === 'Pending Review'): ?>
                    <p style="margin-bottom: 20px; font-size: 13px; color: var(--color-text-muted);">
                        Please review the document details on the left. Make sure the name, ID photo, and signature matches the profile data provided.
                    </p>
                    
                    <div style="display: flex; gap: 16px;">
                        <button class="btn btn-primary" id="approveBuyerBtn" style="flex: 1; background-color: var(--color-success); border-color: var(--color-success);">
                            <i data-lucide="check-circle-2"></i>
                            <span>Approve & Verify</span>
                        </button>
                        <button class="btn btn-danger" id="rejectBuyerBtn" style="flex: 1;">
                            <i data-lucide="x-circle"></i>
                            <span>Reject & Notify</span>
                        </button>
                    </div>
                    
                    <!-- Hidden Rejection Form -->
                    <div id="rejectionFormContainer" style="display: none; margin-top: 24px; border-top: 1px solid var(--color-silver-200); padding-top: 16px;">
                        <div class="form-group">
                            <label class="form-label" for="rejectionReason">Reason for Rejection *</label>
                            <textarea class="form-control" id="rejectionReason" rows="4" placeholder="Enter reason here (e.g. Blurry photo, expired ID, name mismatch)..." style="resize: vertical;"></textarea>
                        </div>
                        <div style="display: flex; gap: 12px; justify-content: flex-end;">
                            <button class="btn btn-outline btn-sm" id="cancelRejectionBtn" type="button">Cancel</button>
                            <button class="btn btn-danger btn-sm" id="sendRejectionNoticeBtn" type="button">Send Rejection Note</button>
                        </div>
                    </div>
                <?php elseif ($customer['status'] === 'Rejected'): ?>
                    <div style="background-color: var(--color-danger-soft); border-left: 4px solid var(--color-danger); padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                        <h4 style="color: var(--color-danger); font-size: 14px; margin-bottom: 6px;">Document Rejected</h4>
                        <p style="margin: 0; font-size: 12px; color: var(--color-text);"><?= htmlspecialchars($customer['rejection_reason']) ?></p>
                    </div>
                    <button class="btn btn-outline" id="revertToReviewBtn" style="width: 100%;">
                        <i data-lucide="rotate-ccw"></i>
                        <span>Revert to Pending Review</span>
                    </button>
                <?php else: ?>
                    <div style="background-color: var(--color-success-soft); border-left: 4px solid var(--color-success); padding: 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                        <i data-lucide="check-check" style="color: var(--color-success); width: 24px; height: 24px; flex-shrink: 0;"></i>
                        <div>
                            <h4 style="color: var(--color-success); font-size: 14px; margin: 0;">Identity Verified</h4>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: var(--color-text-muted);">Verified by Eisen Admin Officer</p>
                        </div>
                    </div>
                    <button class="btn btn-outline" id="revertToReviewBtn" style="width: 100%;">
                        <i data-lucide="shield-alert"></i>
                        <span>Revoke Verification Status</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
