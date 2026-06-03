<?php 
$pageTitle = "Logistics & Shipping Management | Eisen Admin";
$pageScript = "shipping.js";
include dirname(__DIR__) . '/admin/partials/header.php'; 
?>

<div class="shipping-page-content">
    <div class="page-header-container mb-30">
        <div class="header-title-group">
            <h1 class="page-title">Logistics & Shipping Management</h1>
            <p style="color: var(--color-text-muted); margin: 4px 0 0 0;">Manage Bill of Lading, vessel details, departures, and delivery milestones</p>
        </div>
    </div>

    <!-- Main Logistics Grid -->
    <div class="dashboard-main-grid">
        
        <!-- Left Side: Shipment Logs Grid -->
        <div class="grid-span-2">
            <div class="card">
                <div class="card-header-flex">
                    <h3 class="card-title-sm">Active Shipment Logs</h3>
                    <span class="badge badge-info">3 Active Shipments</span>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 24px;" id="shippingListContainer">
                    <?php foreach ($shipments as $ship): ?>
                    <div class="shipment-row-card" data-shipment-id="<?= $ship['id'] ?>" style="border: 1px solid var(--color-silver-200); border-radius: var(--radius-md); padding: 20px; background: var(--color-white); position: relative;">
                        <!-- Top Info -->
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                            <div>
                                <span class="badge badge-success" style="font-size: 10px; margin-bottom: 6px;"><?= $ship['id'] ?></span>
                                <h4 style="margin: 0; font-size: 15px; font-weight: 700;"><?= htmlspecialchars($ship['car']) ?></h4>
                                <div style="font-size: 11px; color: var(--color-text-muted);">
                                    Chassis: <code><?= htmlspecialchars($ship['chassis']) ?></code> · Buyer: <strong><?= htmlspecialchars($ship['buyer_name']) ?></strong>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-size: 11px; color: var(--color-text-muted);">Vessel Name</div>
                                <strong style="font-size: 13px; color: var(--color-navy-900);"><?= htmlspecialchars($ship['vessel_name']) ?></strong>
                            </div>
                        </div>

                        <!-- Bill of Lading and Dates Metadata -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; font-size: 12px; background: var(--color-silver-100); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                            <div>
                                <span style="color: var(--color-text-muted);">BL Number</span><br>
                                <strong style="color: var(--color-navy-950); font-family: monospace; font-size: 13px;"><?= htmlspecialchars($ship['bl_number']) ?></strong>
                            </div>
                            <div>
                                <span style="color: var(--color-text-muted);">ETD (Japan Departure)</span><br>
                                <strong><?= $ship['etd'] ?></strong>
                            </div>
                            <div>
                                <span style="color: var(--color-text-muted);">ETA (Destination Port)</span><br>
                                <strong><?= $ship['eta'] ?></strong>
                            </div>
                        </div>

                        <!-- Progress Pipeline Bar -->
                        <div style="margin-bottom: 10px;">
                            <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 8px;">Delivery Milestones</span>
                            
                            <?php
                            $status = $ship['status'];
                            $step1 = 'active'; $step2 = ''; $step3 = ''; $step4 = '';
                            $line1 = ''; $line2 = ''; $line3 = '';
                            
                            if ($status === 'Dispatched' || $status === 'At Port' || $status === 'Delivered') { $step2 = 'active'; $line1 = 'active'; }
                            if ($status === 'At Port' || $status === 'Delivered') { $step3 = 'active'; $line2 = 'active'; }
                            if ($status === 'Delivered') { $step4 = 'active'; $line3 = 'active'; }
                            ?>
                            
                            <div class="progress-pipeline">
                                <div class="pipeline-step <?= $step1 ?>">
                                    <div class="circle"><i data-lucide="package"></i></div>
                                    <span class="step-label">Preparing</span>
                                </div>
                                <div class="pipeline-line <?= $line1 ?>"></div>
                                <div class="pipeline-step <?= $step2 ?>">
                                    <div class="circle"><i data-lucide="navigation"></i></div>
                                    <span class="step-label">Dispatched</span>
                                </div>
                                <div class="pipeline-line <?= $line2 ?>"></div>
                                <div class="pipeline-step <?= $step3 ?>">
                                    <div class="circle"><i data-lucide="anchor"></i></div>
                                    <span class="step-label">At Port</span>
                                </div>
                                <div class="pipeline-line <?= $line3 ?>"></div>
                                <div class="pipeline-step <?= $step4 ?>">
                                    <div class="circle"><i data-lucide="check-check"></i></div>
                                    <span class="step-label">Delivered</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions bar -->
                        <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--color-silver-200); padding-top: 14px; margin-top: 20px;">
                            <button class="btn btn-outline btn-sm update-shipping-status-btn" data-id="<?= $ship['id'] ?>">
                                <i data-lucide="refresh-cw"></i>
                                <span>Advance Status</span>
                            </button>
                            <button class="btn btn-outline btn-sm upload-docs-btn" style="color: var(--color-info);">
                                <i data-lucide="file-up"></i>
                                <span>Upload BL Docs</span>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Side: Log / Update Form -->
        <div>
            <div class="card">
                <h3 class="card-title-sm mb-20">Log Logistics Record</h3>
                <form id="shippingLogForm" onsubmit="event.preventDefault();">
                    <div class="form-group">
                        <label class="form-label" for="ship_car">Select Vehicle *</label>
                        <select class="form-control" id="ship_car" required>
                            <option value="">Choose reserved vehicle...</option>
                            <option value="ST-2094">Honda Vezel (Tariq Mahmood)</option>
                            <option value="ST-2095">Toyota Aqua (Kenji Tanaka)</option>
                            <option value="ST-2096">Mercedes-Benz E-Class</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="bl_number">Bill of Lading Number *</label>
                        <input class="form-control" type="text" id="bl_number" placeholder="BL-JPKHI-XXXXXXXX" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="vessel">Vessel Name *</label>
                        <input class="form-control" type="text" id="vessel" placeholder="Sunrise Queen V.21" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="etd">ETD (Estimated Departure)</label>
                        <input class="form-control" type="date" id="etd" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="eta">ETA (Estimated Arrival)</label>
                        <input class="form-control" type="date" id="eta" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="shipping_status">Logistics Status</label>
                        <select class="form-control" id="shipping_status">
                            <option value="Preparing">Preparing</option>
                            <option value="Dispatched">Dispatched</option>
                            <option value="At Port">At Port</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>

                    <button class="btn btn-gold btn-block mt-20" type="submit" id="logShipmentBtn">
                        <i data-lucide="shield-check"></i>
                        <span>Register Shipment</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include dirname(__DIR__) . '/admin/partials/footer.php'; ?>
