<?php 
$pageTitle = "Vehicle Reservations Follow-up | Eisen Admin";
$pageScript = "reservations.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>


<div class="reservations-page-content">
    <div class="page-header-container mb-25">
        <div class="header-title-group">
            <h1 class="page-title">Reservations Logs</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Track 24-Hour customer holds, log caller notes, and manage local deliveries</p>
        </div>
    </div>

    <!-- Top Summary Metrics Grid -->
    <div class="metrics-grid mb-25">
        <div class="card" style="padding: 16px; display: flex; align-items: center; gap: 14px; margin-bottom: 0;">
            <div style="background: var(--color-info-soft); color: var(--color-info); width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i data-lucide="clock" style="width: 20px; height: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 11px; color: var(--color-text-muted); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Avg. Call Delay</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--color-navy-950); margin-top: 2px;">14.5 minutes</div>
            </div>
        </div>
        <div class="card" style="padding: 16px; display: flex; align-items: center; gap: 14px; margin-bottom: 0;">
            <div style="background: var(--color-success-soft); color: var(--color-success); width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i data-lucide="trending-up" style="width: 20px; height: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 11px; color: var(--color-text-muted); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Conversion Rate</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--color-success); margin-top: 2px;">64.2%</div>
            </div>
        </div>
        <div class="card" style="padding: 16px; display: flex; align-items: center; gap: 14px; margin-bottom: 0;">
            <div style="background: var(--color-warning-soft); color: var(--color-warning); width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i data-lucide="wallet" style="width: 20px; height: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 11px; color: var(--color-text-muted); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Active Holds Today</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--color-navy-950); margin-top: 2px;"><?= count($reservations) ?> reserves</div>
            </div>
        </div>
        <div class="card" style="padding: 16px; display: flex; align-items: center; gap: 14px; margin-bottom: 0;">
            <div style="background: rgba(30, 74, 122, 0.1); color: var(--color-navy-600); width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i data-lucide="phone-call" style="width: 20px; height: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 11px; color: var(--color-text-muted); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Avg. Call Time</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--color-navy-950); margin-top: 2px;">6.4 mins</div>
            </div>
        </div>
    </div>

    <!-- Master-Detail Panel Wrapper -->
    <div class="reservations-layout-grid">
        
        <!-- Master List (Left Panel) -->
        <div class="res-list-container">
            <div style="position: relative;">
                <input type="text" id="resSearchInput" placeholder="Search by buyer, ID, or car..." style="width: 100%; height: 38px; padding: 0 12px 0 34px; border: 1px solid var(--color-silver-300); border-radius: var(--radius-sm); font-size: 13px; outline: none; transition: border-color var(--transition-fast);">
                <i data-lucide="search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--color-text-muted);"></i>
            </div>
            
            <div class="filter-pills-row">
                <button class="filter-pill active" data-filter="all">All</button>
                <button class="filter-pill" data-filter="Pending Call">Pending</button>
                <button class="filter-pill" data-filter="Contacted - Awaiting Wire Deposit">Contacted</button>
                <button class="filter-pill" data-filter="Deposit Received - Booking Locked">Locked</button>
            </div>
            
            <div class="res-scroll-area" id="reservationsList">
                <?php foreach ($reservations as $index => $res): ?>
                <?php 
                $badgeClass = 'badge-draft';
                if ($res['status'] === 'Deposit Received - Booking Locked') $badgeClass = 'badge-success';
                else if ($res['status'] === 'Contacted - Awaiting Wire Deposit') $badgeClass = 'badge-warning';
                else if ($res['status'] === 'Pending Call') $badgeClass = 'badge-danger';
                ?>
                <div class="res-list-item <?= $index === 0 ? 'active' : '' ?>" data-id="<?= $res['id'] ?>" data-status="<?= htmlspecialchars($res['status']) ?>" data-search-str="<?= htmlspecialchars(strtolower($res['id'] . ' ' . $res['customer_name'] . ' ' . $res['car_name'])) ?>">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 6px;">
                        <span style="font-size: 11px; font-weight: 700; color: var(--color-navy-900);"><?= $res['id'] ?></span>
                        <span class="timer-pill-sm" data-countdown="<?= $res['time_remaining'] ?>">
                            --:--:--
                        </span>
                    </div>
                    <h5 style="margin: 0 0 6px 0; font-size: 13.5px; font-weight: 700; color: var(--color-navy-950); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?= htmlspecialchars($res['car_name']) ?>"><?= htmlspecialchars($res['car_name']) ?></h5>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 11.5px;">
                        <span style="color: var(--color-text-muted); font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 140px;"><?= htmlspecialchars($res['customer_name']) ?></span>
                        <span class="badge <?= $badgeClass ?>" style="font-size: 9px; padding: 2px 6px;"><?= ($res['status'] === 'Deposit Received - Booking Locked') ? 'Locked' : (($res['status'] === 'Contacted - Awaiting Wire Deposit') ? 'Contacted' : 'Pending') ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Detail View (Right Panel) -->
        <div id="reservationDetailsContainer">
            <?php foreach ($reservations as $index => $res): ?>
            <div class="res-details-pane res-card" id="res-details-<?= $res['id'] ?>" data-res-id="<?= $res['id'] ?>" style="display: <?= $index === 0 ? 'block' : 'none' ?>;">
                <div class="card" style="border: 1px solid var(--color-silver-200); border-radius: var(--radius-md); padding: 24px; background: var(--color-white); position: relative; margin-bottom: 0;">
                    <!-- Top Section -->
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 18px;">
                        <div>
                            <span class="badge badge-info" style="font-size: 10px; margin-bottom: 6px;"><?= $res['id'] ?></span>
                            <h3 style="margin: 0; font-size: 19px; font-weight: 700; color: var(--color-navy-950);"><?= htmlspecialchars($res['car_name']) ?></h3>
                            <div style="font-size: 12px; color: var(--color-text-muted); margin-top: 4px;">
                                Chassis: <code style="background: var(--color-silver-100); padding: 2px 6px; border-radius: 4px; font-weight: 600; color: var(--color-navy-900);"><?= htmlspecialchars($res['chassis']) ?></code> · Price: <strong style="color: var(--color-navy-950);">$<?= number_format($res['price']) ?></strong>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <span class="timer-pill" data-countdown="<?= $res['time_remaining'] ?>" style="font-size: 14px; font-weight: 700; padding: 6px 12px; border-radius: 6px;">
                                --:--:--
                            </span>
                            <div style="font-size: 11px; color: var(--color-text-muted); margin-top: 6px;">Hold Countdown Timer</div>
                        </div>
                    </div>

                    <!-- Customer Detail Section -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; font-size: 13px; background: var(--color-silver-100); padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                        <div>
                            <span style="color: var(--color-text-muted); font-size: 11.5px; display: block; margin-bottom: 4px;">Buyer / Contact</span>
                            <strong style="color: var(--color-navy-950); font-size: 14px;"><?= htmlspecialchars($res['customer_name']) ?></strong>
                            <div style="font-size: 11.5px; color: var(--color-text-muted); margin-top: 2px;"><?= htmlspecialchars($res['customer_phone']) ?></div>
                        </div>
                        <div>
                            <span style="color: var(--color-text-muted); font-size: 11.5px; display: block; margin-bottom: 4px;">Assigned Caller Agent</span>
                            <strong style="color: var(--color-navy-900); display: inline-flex; align-items: center; gap: 4px; font-size: 14px;">
                                <i data-lucide="user" style="width: 14px; height: 14px;"></i>
                                <?= htmlspecialchars($res['agent_assigned']) ?>
                            </strong>
                        </div>
                        <div>
                            <span style="color: var(--color-text-muted); font-size: 11.5px; display: block; margin-bottom: 4px;">Call Status</span>
                            <?php 
                            $badge = 'badge-draft';
                            if ($res['status'] === 'Deposit Received - Booking Locked') $badge = 'badge-success';
                            else if ($res['status'] === 'Contacted - Awaiting Wire Deposit') $badge = 'badge-warning';
                            else if ($res['status'] === 'Pending Call') $badge = 'badge-danger';
                            ?>
                            <span class="badge <?= $badge ?>" style="margin-top: 2px; font-size: 11px; padding: 4px 10px;"><?= $res['status'] ?></span>
                        </div>
                    </div>

                    <!-- Caller Interaction History Log -->
                    <div style="border-top: 1px dashed var(--color-silver-300); padding-top: 18px; margin-top: 10px;">
                        <span style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 14px; letter-spacing: 0.5px;">Caller Interaction History</span>
                        <div class="res-history-timeline" style="display: flex; flex-direction: column; gap: 14px; max-height: 200px; overflow-y: auto; padding-right: 6px;">
                            <?php foreach ($res['logs'] as $log): ?>
                            <div style="display: flex; gap: 12px; font-size: 13px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--color-gold-500); margin-top: 6px; flex-shrink: 0;"></div>
                                <div style="flex: 1;">
                                    <div style="font-size: 11px; color: var(--color-text-muted); font-weight: 500;">
                                        <?= $log['time'] ?> · <strong style="color: var(--color-navy-900);"><?= htmlspecialchars($log['agent']) ?></strong>
                                    </div>
                                    <p style="margin: 4px 0 0 0; color: var(--color-navy-950); line-height: 1.45;"><?= htmlspecialchars($log['note']) ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Action Checklist (integrated) -->
                    <div class="checklist-box">
                        <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px; font-weight: 700; color: var(--color-navy-950); font-size: 13px;">
                            <i data-lucide="check-square" style="color: var(--color-navy-700); width: 16px; height: 16px;"></i>
                            <span>Caller Action Checklist</span>
                        </div>
                        <ul style="display: flex; flex-direction: column; gap: 6px; font-size: 12px; color: var(--color-text-muted); margin: 0; padding-left: 20px; list-style-type: decimal;">
                            <li>Verify consignee details, destination port, and delivery deadline.</li>
                            <li>Discuss FOB price calculations and final C&F invoicing variables.</li>
                            <li>Inform client that wire receipt uploads are required within 24 hours to secure holds.</li>
                        </ul>
                    </div>

                    <!-- Log Call Button -->
                    <div style="display: flex; justify-content: flex-end; margin-top: 20px; border-top: 1px solid var(--color-silver-200); padding-top: 16px;">
                        <button class="btn btn-gold btn-md log-call-btn" data-res-id="<?= $res['id'] ?>" data-name="<?= htmlspecialchars($res['customer_name']) ?>" data-car="<?= htmlspecialchars($res['car_name']) ?>" data-status="<?= htmlspecialchars($res['status']) ?>">
                            <i data-lucide="phone-call" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                            <span>Log Agent Call</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
