<?php 
$pageTitle = "Vehicle Reservations Follow-up | Eisen Admin";
$pageScript = "reservations.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="reservations-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">Reservations Logs</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Track 24-Hour customer holds, log caller notes, and manage local deliveries</p>
        </div>
    </div>

    <!-- Main Grid Layout: left side is lists of holds, right side is log history details -->
    <div class="dashboard-main-grid">
        
        <!-- Left Side: Active Holds list (2/3 width) -->
        <div class="grid-span-2">
            <div style="display: flex; flex-direction: column; gap: 24px;" id="reservationsListContainer">
                <?php foreach ($reservations as $res): ?>
                <div class="shipment-row-card res-card" data-res-id="<?= $res['id'] ?>" style="border: 1px solid var(--color-silver-200); border-radius: var(--radius-md); padding: 24px; background: var(--color-white); position: relative;">
                    <!-- Top Section -->
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                        <div>
                            <span class="badge badge-info" style="font-size: 10px; margin-bottom: 6px;"><?= $res['id'] ?></span>
                            <h4 style="margin: 0; font-size: 16px; font-weight: 700;"><?= htmlspecialchars($res['car_name']) ?></h4>
                            <div style="font-size: 11px; color: var(--color-text-muted);">
                                Chassis: <code><?= htmlspecialchars($res['chassis']) ?></code> · Price: <strong>$<?= number_format($res['price']) ?></strong>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <span class="timer-pill" data-countdown="<?= $res['time_remaining'] ?>">
                                --:--:--
                            </span>
                            <div style="font-size: 11px; color: var(--color-text-muted); margin-top: 6px;">Hold Timer</div>
                        </div>
                    </div>

                    <!-- Customer Detail Section -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; font-size: 12px; background: var(--color-silver-100); padding: 14px; border-radius: 8px; margin-bottom: 20px;">
                        <div>
                            <span style="color: var(--color-text-muted);">Buyer / Contact</span><br>
                            <strong style="color: var(--color-navy-950);"><?= htmlspecialchars($res['customer_name']) ?></strong><br>
                            <span style="font-size: 11px; color: var(--color-text-muted);"><?= htmlspecialchars($res['customer_phone']) ?></span>
                        </div>
                        <div>
                            <span style="color: var(--color-text-muted);">Assigned Caller Agent</span><br>
                            <strong style="color: var(--color-navy-900);"><i data-lucide="user" style="width: 12px; height: 12px; display: inline-block; vertical-align: middle; margin-right: 2px;"></i><?= htmlspecialchars($res['agent_assigned']) ?></strong>
                        </div>
                        <div>
                            <span style="color: var(--color-text-muted);">Call Status</span><br>
                            <?php 
                            $badge = 'badge-draft';
                            if ($res['status'] === 'Deposit Received - Booking Locked') $badge = 'badge-success';
                            else if ($res['status'] === 'Contacted - Awaiting Wire Deposit') $badge = 'badge-warning';
                            else if ($res['status'] === 'Pending Call') $badge = 'badge-danger';
                            ?>
                            <span class="badge <?= $badge ?>" style="margin-top: 4px;"><?= $res['status'] ?></span>
                        </div>
                    </div>

                    <!-- Caller Interaction History Log -->
                    <div style="border-top: 1px dashed var(--color-silver-300); padding-top: 14px; margin-top: 10px;">
                        <span style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 10px;">Caller Interaction History</span>
                        <div class="res-history-timeline" style="display: flex; flex-direction: column; gap: 12px;">
                            <?php foreach ($res['logs'] as $log): ?>
                            <div style="display: flex; gap: 10px; font-size: 12.5px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--color-gold-500); margin-top: 5px; flex-shrink: 0;"></div>
                                <div style="flex: 1;">
                                    <span style="font-size: 11px; color: var(--color-text-muted); font-weight: 500;"><?= $log['time'] ?> · <strong><?= htmlspecialchars($log['agent']) ?></strong></span>
                                    <p style="margin: 2px 0 0 0; color: var(--color-navy-950); line-height: 1.35;"><?= htmlspecialchars($log['note']) ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Log Call Button -->
                    <div style="display: flex; justify-content: flex-end; margin-top: 18px; border-top: 1px solid var(--color-silver-200); padding-top: 12px;">
                        <button class="btn btn-outline btn-sm log-call-btn" data-res-id="<?= $res['id'] ?>" data-name="<?= htmlspecialchars($res['customer_name']) ?>" data-car="<?= htmlspecialchars($res['car_name']) ?>" data-status="<?= htmlspecialchars($res['status']) ?>">
                            <i data-lucide="phone-call" style="width: 14px; height: 14px;"></i>
                            <span>Log Agent Call</span>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right Side: Pipeline metrics & Call Tips (1/3 width) -->
        <div>
            <!-- Performance Stats -->
            <div class="card">
                <h3 class="card-title-sm mb-20">Call Center Performance</h3>
                <div style="display: flex; flex-direction: column; gap: 16px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">Avg. First Call Delay</span>
                        <strong>14.5 minutes</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">Hold-to-Sale Conversion</span>
                        <strong style="color: var(--color-success);">64.2%</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-silver-200); padding-bottom: 8px;">
                        <span style="color: var(--color-text-muted);">Active Holds Today</span>
                        <strong>3 reserves</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--color-text-muted);">Avg. Call Time</span>
                        <strong>6.4 mins</strong>
                    </div>
                </div>
            </div>

            <!-- Agent Guidelines Info Box -->
            <div class="card" style="border-left: 4px solid var(--color-navy-700);">
                <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 12px;">
                    <i data-lucide="help-circle" style="color: var(--color-navy-700); flex-shrink: 0; width: 22px; height: 22px;"></i>
                    <h3 class="card-title-sm" style="margin: 0;">Caller Checklist</h3>
                </div>
                <ul style="display: flex; flex-direction: column; gap: 12px; font-size: 12.5px; color: var(--color-text);">
                    <li>1. Verify consignee details, destination port, and delivery deadline.</li>
                    <li>2. Discuss FOB price calculations and final C&F invoicing variables.</li>
                    <li>3. Inform client that wire receipt uploads are required within 24 hours to secure holds.</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<!-- ==========================================
     Modal Sheet: Log Call Dialog
     ========================================== -->
<div class="modal-backdrop" id="callLogModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin: 0; font-size: 18px;">Log Call & Update Status</h3>
            <button class="modal-close-btn" id="closeCallLogModalBtn">&times;</button>
        </div>
        
        <form id="callLogForm" onsubmit="event.preventDefault();">
            <input type="hidden" id="log_res_id">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Reserved Vehicle</label>
                    <input class="form-control" type="text" id="log_car_name" readonly style="background-color: var(--color-silver-200); cursor: not-allowed;">
                </div>
                <div class="form-group">
                    <label class="form-label">Buyer Name</label>
                    <input class="form-control" type="text" id="log_customer_name" readonly style="background-color: var(--color-silver-200); cursor: not-allowed;">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="log_call_status">Update Call Pipeline Status</label>
                    <select class="form-control" id="log_call_status" required>
                        <option value="Pending Call">Pending Call</option>
                        <option value="Contacted - Awaiting Wire Deposit">Contacted - Awaiting Wire Deposit</option>
                        <option value="Deposit Received - Booking Locked">Deposit Received - Booking Locked</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="log_call_note">Caller Notes Log *</label>
                    <textarea class="form-control" id="log_call_note" rows="5" placeholder="Enter follow-up conversation notes here..." required style="resize: vertical;"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-outline" type="button" id="cancelCallLogModalBtn">Cancel</button>
                <button class="btn btn-gold" type="submit" id="saveCallLogBtn">Log Call & Save</button>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
