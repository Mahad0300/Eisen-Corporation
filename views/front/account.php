<?php
$p = $profile;
$tabQuery = static function (string $tab): string {
    return BASE_URL . '/account?' . http_build_query(['tab' => $tab]);
};
?>
<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="account-page" data-page-title="account.pageTitle">

    <section class="account-page__main section">
      <div class="container account-page__inner">

        <!-- Flash Alert Message Display -->
        <?php if (isset($flash) && $flash): ?>
          <div class="login-flash<?= $flash['type'] === 'success' ? ' login-flash--success' : '' ?>" role="alert" style="margin-bottom: 24px;">
            <?= htmlspecialchars($flash['message']) ?>
          </div>
        <?php endif; ?>

        <div class="account-layout">
          <aside class="account-sidebar" aria-label="Account navigation">
            <ul class="account-sidebar__list">
              <?php foreach ($tabs as $tab): ?>
              <li>
                <a
                  class="account-sidebar__link<?= $activeTab === $tab['key'] ? ' is-active' : '' ?>"
                  href="<?= htmlspecialchars($tabQuery($tab['key'])) ?>"
                  <?php if (!empty($tab['i18n'])): ?>data-i18n="<?= htmlspecialchars($tab['i18n']) ?>"<?php endif; ?>
                ><?= htmlspecialchars($tab['label']) ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
          </aside>

          <div class="account-panel<?= in_array($activeTab, ['favorites', 'inquiries', 'reserved', 'purchased'], true) ? ' account-panel--open' : ' card' ?><?= $activeTab === 'account-info' ? ' account-panel--flat' : '' ?>">
            
            <!-- Tab: My Account Info -->
            <?php if ($activeTab === 'account-info'): ?>
            <?php $info = $accountInfo; ?>
            <div class="account-info-page">

              <section class="account-info-section" aria-labelledby="account-info-title">
                <h2 id="account-info-title" class="account-info-section__heading" data-i18n="account.tab.accountInfo">My Account Info</h2>
                <div class="account-info-table-wrap">
                  <div class="account-info-table">
                    <?php
                    $leftRows = $info['left'];
                    $leftRows[] = [
                        'label' => $info['bankAddress']['label'],
                        'value' => $info['bankAddress']['value'],
                        'i18n' => $info['bankAddress']['i18n'],
                    ];
                    $rightRows = $info['right'];
                    $rowCount = max(count($leftRows), count($rightRows));
                    for ($i = 0; $i < $rowCount; $i++):
                      $left = $leftRows[$i] ?? null;
                      $right = $rightRows[$i] ?? null;
                    ?>
                    <div class="account-info-table__pair">
                      <?php if ($left): ?>
                      <div class="account-info-table__cell">
                        <span class="account-info-table__label" data-i18n="<?= htmlspecialchars($left['i18n']) ?>"><?= htmlspecialchars($left['label']) ?></span>
                        <span class="account-info-table__value"><?= htmlspecialchars($left['value']) ?></span>
                      </div>
                      <?php else: ?>
                      <div class="account-info-table__cell account-info-table__cell--empty" aria-hidden="true">
                        <span class="account-info-table__label">&nbsp;</span>
                        <span class="account-info-table__value">&nbsp;</span>
                      </div>
                      <?php endif; ?>
                      <?php if ($right): ?>
                      <div class="account-info-table__cell">
                        <span class="account-info-table__label" data-i18n="<?= htmlspecialchars($right['i18n']) ?>"><?= htmlspecialchars($right['label']) ?></span>
                        <span class="account-info-table__value"><?= htmlspecialchars($right['value']) ?></span>
                      </div>
                      <?php else: ?>
                      <div class="account-info-table__cell account-info-table__cell--empty" aria-hidden="true">
                        <span class="account-info-table__label">&nbsp;</span>
                        <span class="account-info-table__value">&nbsp;</span>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
              </section>

              <section class="account-info-section" aria-labelledby="account-payment-title">
                <header class="account-info-section__head">
                  <p class="account-info-section__eyebrow" data-i18n="account.payment.eyebrow">Finance</p>
                  <h2 id="account-payment-title" class="account-info-section__title" data-i18n="account.payment.title">My Payment</h2>
                </header>
                <p class="account-info-section__label" data-i18n="account.payment.summary">Payment Summary</p>
                <?php if (empty($paymentSummary)): ?>
                <p class="account-empty-note" data-i18n="account.payment.empty">No payment summary available yet.</p>
                <?php else: ?>
                <div class="account-summary-wrap">
                  <table class="account-summary-table">
                    <thead>
                      <tr>
                        <th scope="col" data-i18n="account.payment.col.currency">Currency</th>
                        <th scope="col" data-i18n="account.payment.col.paymentTotal">Payment Total</th>
                        <th scope="col" data-i18n="account.payment.col.allocatedTotal">Allocated Total</th>
                        <th scope="col" data-i18n="account.payment.col.depositTotal">Deposit Total</th>
                        <th scope="col" data-i18n="account.payment.col.securityDeposit">Security Deposit Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($paymentSummary as $row): ?>
                      <tr>
                        <td><span class="account-summary-table__currency"><?= htmlspecialchars($row['currency']) ?></span></td>
                        <td class="account-summary-table__amount"><?= htmlspecialchars($row['paymentTotal']) ?></td>
                        <td class="account-summary-table__amount"><?= htmlspecialchars($row['allocatedTotal']) ?></td>
                        <td class="account-summary-table__amount"><?= htmlspecialchars($row['depositTotal']) ?></td>
                        <td class="account-summary-table__amount"><?= htmlspecialchars($row['securityDeposit']) ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <?php endif; ?>
              </section>

              <section class="account-info-section" aria-labelledby="account-payment-history-title">
                <header class="account-info-section__head">
                  <p class="account-info-section__eyebrow" data-i18n="account.paymentHistory.eyebrow">Transactions</p>
                  <h2 id="account-payment-history-title" class="account-info-section__title" data-i18n="account.paymentHistory.title">Payment History</h2>
                </header>
                <div class="account-filter-panel">
                  <form class="account-payment-search" action="<?= BASE_URL ?>/account" method="get" role="search" data-payment-search>
                    <input type="hidden" name="tab" value="account-info" />
                    <input
                      type="text"
                      id="payment-date-range"
                      class="form-control account-payment-search__field account-payment-search__date"
                      value="<?= htmlspecialchars($paymentDateRangeDisplay ?? '') ?>"
                      placeholder="Date range"
                      data-i18n-placeholder="account.paymentHistory.dateRange"
                      readonly
                      autocomplete="off"
                      aria-label="Date range"
                    />
                    <input type="hidden" name="date_from" id="payment-date-from" value="<?= htmlspecialchars($paymentDateFrom ?? '') ?>" />
                    <input type="hidden" name="date_to" id="payment-date-to" value="<?= htmlspecialchars($paymentDateTo ?? '') ?>" />
                    <input class="form-control form-control--text account-payment-search__field" type="text" name="stock_id" value="<?= htmlspecialchars($paymentStockId ?? '') ?>" placeholder="Stock Id" data-i18n-placeholder="account.paymentHistory.stockId" />
                    <input class="form-control form-control--text account-payment-search__field" type="text" name="chassis" value="<?= htmlspecialchars($paymentChassis ?? '') ?>" placeholder="Chassis Number" data-i18n-placeholder="account.paymentHistory.chassis" />
                    <button type="submit" class="btn btn--primary account-payment-search__btn" data-i18n="account.paymentHistory.search">Search</button>
                  </form>
                </div>
                <p class="account-result-count"><strong><?= count($paymentHistory) ?></strong> <span data-i18n="account.table.itemsFound">Items found</span></p>
                <div class="account-ledger-wrap">
                  <table class="account-ledger">
                    <thead>
                      <tr>
                        <th scope="col" data-i18n="account.paymentHistory.col.id">Payment Id</th>
                        <th scope="col" data-i18n="account.paymentHistory.col.received">Received Date</th>
                        <th scope="col" data-i18n="account.payment.col.currency">Currency</th>
                        <th scope="col" data-i18n="account.paymentHistory.col.amount">Amount</th>
                        <th scope="col" data-i18n="account.paymentHistory.col.allocated">Allocated</th>
                        <th scope="col" data-i18n="account.paymentHistory.col.deposit">Deposit</th>
                        <th scope="col" data-i18n="account.paymentHistory.col.security">Security Deposit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (empty($paymentHistory)): ?>
                      <tr>
                        <td colspan="7" class="account-ledger__empty" data-i18n="account.paymentHistory.empty">No payments match your filters.</td>
                      </tr>
                      <?php else: ?>
                      <?php foreach ($paymentHistory as $row): ?>
                      <tr>
                        <td class="account-ledger__id"><?= htmlspecialchars($row['paymentId']) ?></td>
                        <td><?= htmlspecialchars($row['receivedDate']) ?></td>
                        <td><span class="account-ledger__badge"><?= htmlspecialchars($row['currency']) ?></span></td>
                        <td><?= htmlspecialchars($row['amount']) ?></td>
                        <td><?= htmlspecialchars($row['allocated']) ?></td>
                        <td><?= htmlspecialchars($row['deposit']) ?></td>
                        <td><?= htmlspecialchars($row['securityDeposit']) ?></td>
                      </tr>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </section>

            </div>

            <!-- Tab: Profile Details -->
            <?php elseif ($activeTab === 'profile'): ?>
            <form class="account-form" action="<?= BASE_URL ?>/account/profile" method="post">
              <?= $this->csrf_field() ?>

              <div class="account-form__grid account-form__grid--2">
                <div class="form-field">
                  <label class="form-label" for="account-first-name" data-i18n="account.field.firstName">First Name</label>
                  <input class="form-control form-control--text" type="text" id="account-first-name" name="first_name" value="<?= htmlspecialchars($p['firstName']) ?>" required />
                </div>
                <div class="form-field">
                  <label class="form-label" for="account-last-name" data-i18n="account.field.lastName">Last Name</label>
                  <input class="form-control form-control--text" type="text" id="account-last-name" name="last_name" value="<?= htmlspecialchars($p['lastName']) ?>" />
                </div>
              </div>

              <div class="form-field">
                <span class="form-label" data-i18n="account.field.accountType">Account Type</span>
                <p class="account-form__static"><?= htmlspecialchars($p['accountType']) ?></p>
              </div>

              <div class="form-field">
                <label class="form-label" for="account-address" data-i18n="account.field.address">Address</label>
                <input class="form-control form-control--text" type="text" id="account-address" name="address" value="<?= htmlspecialchars($p['address']) ?>" />
              </div>

              <div class="form-field">
                <label class="form-label" for="account-address2" data-i18n="account.field.address2">Address (contd)</label>
                <input class="form-control form-control--text" type="text" id="account-address2" name="address2" value="<?= htmlspecialchars($p['address2']) ?>" />
              </div>

              <div class="account-form__grid account-form__grid--3">
                <div class="form-field">
                  <label class="form-label" for="account-city" data-i18n="account.field.city">City</label>
                  <input class="form-control form-control--text" type="text" id="account-city" name="city" value="<?= htmlspecialchars($p['city']) ?>" />
                </div>
                <div class="form-field">
                  <label class="form-label" for="account-state" data-i18n="account.field.state">State</label>
                  <input class="form-control form-control--text" type="text" id="account-state" name="state" value="<?= htmlspecialchars($p['state']) ?>" />
                </div>
                <div class="form-field">
                  <label class="form-label" for="account-zip" data-i18n="account.field.zip">Zip Code</label>
                  <input class="form-control form-control--text" type="text" id="account-zip" name="zip" value="<?= htmlspecialchars($p['zip']) ?>" />
                </div>
              </div>

              <div class="account-form__grid account-form__grid--2">
                <div class="form-field">
                  <label class="form-label" for="account-country" data-i18n="account.field.importCountry">Import Country</label>
                  <select class="form-control" id="account-country" name="import_country">
                    <?php foreach ($countries as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>"<?= $country === $p['importCountry'] ? ' selected' : '' ?>><?= htmlspecialchars($country) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-field">
                  <label class="form-label" for="account-port" data-i18n="account.field.port">Port</label>
                  <select class="form-control" id="account-port" name="port">
                    <?php foreach ($ports as $port): ?>
                    <option value="<?= htmlspecialchars($port) ?>"<?= $port === $p['port'] ? ' selected' : '' ?>><?= htmlspecialchars($port) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="account-form__actions">
                <button type="submit" class="btn btn--primary" data-i18n="account.update">Update</button>
              </div>
            </form>

            <!-- Tab: Consignee Details -->
            <?php elseif ($activeTab === 'consignee'): ?>
            <div class="account-consignee">
              <h2 class="account-consignee__title" data-i18n="account.consignee.addTitle">Add New Consignee Details</h2>
              <p class="account-consignee__intro" data-i18n="account.consignee.intro">Input Consignee &amp; Notify details below:</p>
              <form class="account-consignee-form" action="<?= BASE_URL ?>/account/consignee" method="post" data-consignee-form>
                <?= $this->csrf_field() ?>
                
                <div class="account-consignee-form__grid">
                  <div class="account-consignee-form__col">
                    <h3 class="account-consignee-form__col-title" data-i18n="account.consignee.consigneeHeading">Consignee</h3>
                    <div class="form-field">
                      <label class="form-label" for="consignee-name"><span data-i18n="account.consignee.name">Consignee Name</span><span class="form-required" aria-hidden="true">*</span></label>
                      <input class="form-control form-control--text" type="text" id="consignee-name" name="consignee_name" data-consignee-field="name" value="<?= htmlspecialchars($consignee['consignee_name'] ?? '') ?>" placeholder="Enter full name" data-i18n-placeholder="account.consignee.phName" required />
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="consignee-country"><span data-i18n="account.consignee.country">Consignee Country</span><span class="form-required" aria-hidden="true">*</span></label>
                      <select class="form-control" id="consignee-country" name="consignee_country" data-consignee-field="country" required>
                        <option value="" disabled <?= empty($consignee['consignee_country']) ? 'selected' : '' ?> data-i18n="account.consignee.selectCountry">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?= htmlspecialchars($country) ?>"<?= ($consignee['consignee_country'] ?? '') === $country ? ' selected' : '' ?>><?= htmlspecialchars($country) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="consignee-state"><span data-i18n="account.consignee.state">Consignee State</span><span class="form-required" aria-hidden="true">*</span></label>
                      <select class="form-control" id="consignee-state" name="consignee_state" data-consignee-field="state" required>
                        <option value="" disabled <?= empty($consignee['consignee_state']) ? 'selected' : '' ?> data-i18n="account.consignee.selectState">Select State</option>
                        <?php foreach ($consigneeStates as $state): ?>
                        <option value="<?= htmlspecialchars($state) ?>"<?= ($consignee['consignee_state'] ?? '') === $state ? ' selected' : '' ?>><?= htmlspecialchars($state) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="consignee-city"><span data-i18n="account.consignee.city">Consignee City</span><span class="form-required" aria-hidden="true">*</span></label>
                      <input class="form-control form-control--text" type="text" id="consignee-city" name="consignee_city" data-consignee-field="city" value="<?= htmlspecialchars($consignee['consignee_city'] ?? '') ?>" placeholder="Enter city" data-i18n-placeholder="account.consignee.phCity" required />
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="consignee-address"><span data-i18n="account.consignee.address">Consignee Address</span><span class="form-required" aria-hidden="true">*</span></label>
                      <textarea class="form-control form-control--textarea account-consignee-form__textarea" id="consignee-address" name="consignee_address" rows="3" data-consignee-field="address" placeholder="Enter full address" data-i18n-placeholder="account.consignee.phAddress" required><?= htmlspecialchars($consignee['consignee_address'] ?? '') ?></textarea>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="consignee-ref-address" data-i18n="account.consignee.refAddress">Consignee Reference Address</label>
                      <textarea class="form-control form-control--textarea account-consignee-form__textarea" id="consignee-ref-address" name="consignee_ref_address" rows="3" data-consignee-field="ref_address" placeholder="Reference address (optional)" data-i18n-placeholder="account.consignee.phRefAddress"><?= htmlspecialchars($consignee['consignee_ref_address'] ?? '') ?></textarea>
                    </div>
                    <div class="form-field">
                      <span class="form-label"><span data-i18n="account.consignee.phone">Consignee Phone</span><span class="form-required" aria-hidden="true">*</span></span>
                      <div class="account-consignee-form__triple">
                        <input class="form-control form-control--text" type="text" name="consignee_phone_1" data-consignee-field="phone_1" value="<?= htmlspecialchars($consignee['consignee_phone_1'] ?? '') ?>" inputmode="tel" placeholder="Phone 1" data-i18n-placeholder="account.consignee.phPhone1" aria-label="Consignee phone part 1" required />
                        <input class="form-control form-control--text" type="text" name="consignee_phone_2" data-consignee-field="phone_2" value="<?= htmlspecialchars($consignee['consignee_phone_2'] ?? '') ?>" inputmode="tel" placeholder="Phone 2" data-i18n-placeholder="account.consignee.phPhone2" aria-label="Consignee phone part 2" required />
                        <input class="form-control form-control--text" type="text" name="consignee_phone_3" data-consignee-field="phone_3" value="<?= htmlspecialchars($consignee['consignee_phone_3'] ?? '') ?>" inputmode="tel" placeholder="Phone 3" data-i18n-placeholder="account.consignee.phPhone3" aria-label="Consignee phone part 3" required />
                      </div>
                    </div>
                    <div class="form-field">
                      <span class="form-label" data-i18n="account.consignee.email">Consignee Email</span>
                      <div class="account-consignee-form__triple">
                        <input class="form-control form-control--text" type="text" name="consignee_email_1" data-consignee-field="email_1" value="<?= htmlspecialchars($consignee['consignee_email_1'] ?? '') ?>" placeholder="Email address 1" data-i18n-placeholder="account.consignee.phEmail1" aria-label="Consignee email part 1" />
                        <input class="form-control form-control--text" type="text" name="consignee_email_2" data-consignee-field="email_2" value="<?= htmlspecialchars($consignee['consignee_email_2'] ?? '') ?>" placeholder="Email address 2" data-i18n-placeholder="account.consignee.phEmail2" aria-label="Consignee email part 2" />
                        <input class="form-control form-control--text" type="text" name="consignee_email_3" data-consignee-field="email_3" value="<?= htmlspecialchars($consignee['consignee_email_3'] ?? '') ?>" placeholder="Email address 3" data-i18n-placeholder="account.consignee.phEmail3" aria-label="Consignee email part 3" />
                      </div>
                    </div>
                  </div>
                  <div class="account-consignee-form__col account-consignee-form__col--notify">
                    <h3 class="account-consignee-form__col-title" data-i18n="account.consignee.notifyHeading">Notify</h3>
                    <div class="form-field">
                      <label class="form-label" for="notify-name"><span data-i18n="account.consignee.notifyName">Notify Name</span><span class="form-required" aria-hidden="true">*</span></label>
                      <input class="form-control form-control--text" type="text" id="notify-name" name="notify_name" data-notify-field="name" value="<?= htmlspecialchars($consignee['notify_name'] ?? '') ?>" placeholder="Enter full name" data-i18n-placeholder="account.consignee.phName" />
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="notify-country"><span data-i18n="account.consignee.notifyCountry">Notify Country</span><span class="form-required" aria-hidden="true">*</span></label>
                      <select class="form-control" id="notify-country" name="notify_country" data-notify-field="country">
                        <option value="" disabled <?= empty($consignee['notify_country']) ? 'selected' : '' ?> data-i18n="account.consignee.selectCountry">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?= htmlspecialchars($country) ?>"<?= ($consignee['notify_country'] ?? '') === $country ? ' selected' : '' ?>><?= htmlspecialchars($country) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="notify-state"><span data-i18n="account.consignee.notifyState">Notify State</span><span class="form-required" aria-hidden="true">*</span></label>
                      <select class="form-control" id="notify-state" name="notify_state" data-notify-field="state">
                        <option value="" disabled <?= empty($consignee['notify_state']) ? 'selected' : '' ?> data-i18n="account.consignee.selectState">Select State</option>
                        <?php foreach ($consigneeStates as $state): ?>
                        <option value="<?= htmlspecialchars($state) ?>"<?= ($consignee['notify_state'] ?? '') === $state ? ' selected' : '' ?>><?= htmlspecialchars($state) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="notify-city"><span data-i18n="account.consignee.notifyCity">Notify City</span><span class="form-required" aria-hidden="true">*</span></label>
                      <input class="form-control form-control--text" type="text" id="notify-city" name="notify_city" data-notify-field="city" value="<?= htmlspecialchars($consignee['notify_city'] ?? '') ?>" placeholder="Enter city" data-i18n-placeholder="account.consignee.phCity" />
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="notify-address"><span data-i18n="account.consignee.notifyAddress">Notify Address</span><span class="form-required" aria-hidden="true">*</span></label>
                      <textarea class="form-control form-control--textarea account-consignee-form__textarea" id="notify-address" name="notify_address" rows="3" data-notify-field="address" placeholder="Enter full address" data-i18n-placeholder="account.consignee.phAddress"><?= htmlspecialchars($consignee['notify_address'] ?? '') ?></textarea>
                    </div>
                    <div class="form-field">
                      <label class="form-label" for="notify-ref-address" data-i18n="account.consignee.notifyRefAddress">Notify Reference Address</label>
                      <textarea class="form-control form-control--textarea account-consignee-form__textarea" id="notify-ref-address" name="notify_ref_address" rows="3" data-notify-field="ref_address" placeholder="Reference address (optional)" data-i18n-placeholder="account.consignee.phRefAddress"><?= htmlspecialchars($consignee['notify_ref_address'] ?? '') ?></textarea>
                    </div>
                    <div class="form-field">
                      <span class="form-label"><span data-i18n="account.consignee.notifyPhone">Notify Phone</span><span class="form-required" aria-hidden="true">*</span></span>
                      <div class="account-consignee-form__triple">
                        <input class="form-control form-control--text" type="text" name="notify_phone_1" data-notify-field="phone_1" value="<?= htmlspecialchars($consignee['notify_phone_1'] ?? '') ?>" inputmode="tel" placeholder="Phone 1" data-i18n-placeholder="account.consignee.phPhone1" aria-label="Notify phone part 1" />
                        <input class="form-control form-control--text" type="text" name="notify_phone_2" data-notify-field="phone_2" value="<?= htmlspecialchars($consignee['notify_phone_2'] ?? '') ?>" inputmode="tel" placeholder="Phone 2" data-i18n-placeholder="account.consignee.phPhone2" aria-label="Notify phone part 2" />
                        <input class="form-control form-control--text" type="text" name="notify_phone_3" data-notify-field="phone_3" value="<?= htmlspecialchars($consignee['notify_phone_3'] ?? '') ?>" inputmode="tel" placeholder="Phone 3" data-i18n-placeholder="account.consignee.phPhone3" aria-label="Notify phone part 3" />
                      </div>
                    </div>
                    <div class="form-field">
                      <span class="form-label" data-i18n="account.consignee.notifyEmail">Notify Email</span>
                      <div class="account-consignee-form__triple">
                        <input class="form-control form-control--text" type="text" name="notify_email_1" data-notify-field="email_1" value="<?= htmlspecialchars($consignee['notify_email_1'] ?? '') ?>" placeholder="Email address 1" data-i18n-placeholder="account.consignee.phEmail1" aria-label="Notify email part 1" />
                        <input class="form-control form-control--text" type="text" name="notify_email_2" data-notify-field="email_2" value="<?= htmlspecialchars($consignee['notify_email_2'] ?? '') ?>" placeholder="Email address 2" data-i18n-placeholder="account.consignee.phEmail2" aria-label="Notify email part 2" />
                        <input class="form-control form-control--text" type="text" name="notify_email_3" data-notify-field="email_3" value="<?= htmlspecialchars($consignee['notify_email_3'] ?? '') ?>" placeholder="Email address 3" data-i18n-placeholder="account.consignee.phEmail3" aria-label="Notify email part 3" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="account-consignee-form__options">
                  <label class="account-consignee-form__check">
                    <input type="checkbox" name="notify_same" value="1" data-notify-same <?= ($consignee['notify_same'] ?? 0) ? ' checked' : '' ?> />
                    <span data-i18n="account.consignee.notifySame">Notify Same as Consignee</span>
                  </label>
                  <label class="account-consignee-form__check">
                    <input type="checkbox" name="permanent" value="1" <?= ($consignee['permanent'] ?? 0) ? ' checked' : '' ?> />
                    <span data-i18n="account.consignee.permanent">Permanent</span>
                  </label>
                </div>
                <div class="account-consignee-form__actions">
                  <button type="submit" class="btn btn--primary" data-i18n="account.consignee.save">Save</button>
                </div>
              </form>
            </div>

            <!-- Tab: Favorites -->
            <?php elseif ($activeTab === 'favorites'): ?>
            <div style="display:none;"><?= $this->csrf_field() ?></div>
            <?php $favorites = $favorites ?? []; ?>
            <?php if (empty($favorites)): ?>
            <div class="account-empty-state account-empty-state--favorites">
              <div class="account-empty-state__icon" aria-hidden="true">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" stroke="currentColor" stroke-width="1.5" fill="none" />
                </svg>
              </div>
              <h2 class="account-empty-state__title" data-i18n="account.favorites.empty">No Favorites Found</h2>
            </div>
            <?php else: ?>
            <div class="account-favorites" data-account-favorites>
              <header class="account-favorites__head" data-favorites-head>
                <h2 class="account-favorites__title" data-i18n="account.tab.favorites">My Favorites</h2>
                <p class="account-favorites__count" data-favorites-count><?= count($favorites) ?> <?= count($favorites) === 1 ? 'vehicle' : 'vehicles' ?></p>
              </header>
              <ul class="account-favorites__list" data-favorites-list>
                <?php foreach ($favorites as $item): ?>
                <li data-favorite-item data-stock-id="<?= htmlspecialchars($item['stockId']) ?>">
                  <article class="account-favorites-item">
                    <button
                      type="button"
                      class="account-favorites-item__remove"
                      data-favorite-remove
                      aria-label="Remove from favorites"
                      data-i18n-aria="account.favorites.remove"
                    >
                      <svg class="account-favorites-item__heart" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="currentColor" />
                      </svg>
                    </button>
                    <a href="<?= BASE_URL ?>/product/<?= htmlspecialchars($item['stockId']) ?>" class="account-favorites-item__link">
                      <div class="account-favorites-item__media">
                        <img
                          src="<?= htmlspecialchars($item['image']) ?>"
                          alt="<?= htmlspecialchars($item['alt'] ?? ($item['make'] . ' ' . $item['model'])) ?>"
                          width="600"
                          height="400"
                          loading="lazy"
                        />
                      </div>
                      <div class="account-favorites-item__body">
                        <span class="account-favorites-item__make"><?= htmlspecialchars($item['make']) ?></span>
                        <h3 class="account-favorites-item__model"><?= htmlspecialchars($item['model']) ?></h3>
                        <p class="account-favorites-item__price">
                          <strong class="product-price" data-price-usd="<?= (int) $item['priceUsd'] ?>">$<?= number_format((int) $item['priceUsd']) ?></strong>
                          · <?= htmlspecialchars($item['mileage']) ?>
                        </p>
                        <p class="account-favorites-item__meta">
                          <span data-i18n="product.stockId">Stock Id</span>: <?= htmlspecialchars($item['stockId']) ?>
                          · <?= htmlspecialchars($item['year']) ?>
                        </p>
                      </div>
                    </a>
                  </article>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <!-- Tab: Inquiry & Bid List -->
            <?php elseif ($activeTab === 'inquiries'): ?>
            <?php $bids = $bids ?? []; ?>
            <?php if (empty($bids)): ?>
            <div class="account-empty-state account-empty-state--inquiries">
              <div class="account-empty-state__icon" aria-hidden="true">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                  <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <rect x="9" y="3" width="6" height="4" rx="1" stroke="currentColor" stroke-width="1.5" />
                  <line x1="9" y1="12" x2="15" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <line x1="9" y1="16" x2="13" y2="16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </div>
              <h2 class="account-empty-state__title" data-i18n="account.inquiries.empty">No Inquiry &amp; Bid List Found</h2>
            </div>
            <?php else: ?>
            <div class="account-favorites">
              <header class="account-favorites__head">
                <h2 class="account-favorites__title" data-i18n="account.tab.inquiries">Inquiry &amp; Bid List</h2>
                <p class="account-favorites__count"><?= count($bids) ?> <?= count($bids) === 1 ? 'bid' : 'bids' ?></p>
              </header>
              <ul class="account-favorites__list">
                <?php foreach ($bids as $bid): ?>
                <li>
                  <article class="account-favorites-item">
                    <a href="<?= BASE_URL ?>/product/<?= htmlspecialchars($bid['stockId']) ?>" class="account-favorites-item__link">
                      <div class="account-favorites-item__media">
                        <img src="<?= htmlspecialchars($bid['image']) ?>" alt="<?= htmlspecialchars($bid['make'] . ' ' . $bid['model']) ?>" width="600" height="400" loading="lazy" />
                      </div>
                      <div class="account-favorites-item__body">
                        <span class="account-favorites-item__make"><?= htmlspecialchars($bid['make']) ?></span>
                        <h3 class="account-favorites-item__model"><?= htmlspecialchars($bid['model']) ?> (<?= htmlspecialchars($bid['year']) ?>)</h3>
                        <p class="account-favorites-item__price">
                          <strong>Max Bid: $<?= number_format($bid['bidAmount']) ?></strong>
                          · FOB Price: $<?= number_format($bid['priceUsd']) ?>
                        </p>
                        <p class="account-favorites-item__meta">
                          Stock Id: <?= htmlspecialchars($bid['stockId']) ?> · Placed: <?= htmlspecialchars($bid['placedAt']) ?>
                        </p>
                        <div style="margin-top: 10px;">
                          <span class="account-ledger__badge" style="background-color: <?= $bid['status'] === 'Won' ? '#10b981' : ($bid['status'] === 'Lost' ? '#ef4444' : '#eab308') ?>; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">
                            <?= htmlspecialchars($bid['status']) ?>
                          </span>
                        </div>
                      </div>
                    </a>
                  </article>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <!-- Tab: Reserved Vehicles -->
            <?php elseif ($activeTab === 'reserved'): ?>
            <?php $reservations = $reservations ?? []; ?>
            <?php if (empty($reservations)): ?>
            <div class="account-empty-state account-empty-state--reserved">
              <div class="account-empty-state__icon" aria-hidden="true">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                  <path d="M5 17h14l-1-5H6l-1 5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                  <path d="M3 17v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M7 12l1.5-4h7L17 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <circle cx="7.5" cy="17" r="1" fill="currentColor" />
                  <circle cx="16.5" cy="17" r="1" fill="currentColor" />
                </svg>
              </div>
              <h2 class="account-empty-state__title" data-i18n="account.reserved.empty">No Reserved Vehicles Found</h2>
            </div>
            <?php else: ?>
            <div class="account-favorites">
              <header class="account-favorites__head">
                <h2 class="account-favorites__title" data-i18n="account.tab.reserved">Reserved Vehicles</h2>
                <p class="account-favorites__count"><?= count($reservations) ?> <?= count($reservations) === 1 ? 'vehicle' : 'vehicles' ?></p>
              </header>
              <ul class="account-favorites__list">
                <?php foreach ($reservations as $res): ?>
                <li>
                  <article class="account-favorites-item">
                    <a href="<?= BASE_URL ?>/product/<?= htmlspecialchars($res['stockId']) ?>" class="account-favorites-item__link">
                      <div class="account-favorites-item__media">
                        <img src="<?= htmlspecialchars($res['image']) ?>" alt="<?= htmlspecialchars($res['make'] . ' ' . $res['model']) ?>" width="600" height="400" loading="lazy" />
                      </div>
                      <div class="account-favorites-item__body">
                        <span class="account-favorites-item__make"><?= htmlspecialchars($res['make']) ?></span>
                        <h3 class="account-favorites-item__model"><?= htmlspecialchars($res['model']) ?> (<?= htmlspecialchars($res['year']) ?>)</h3>
                        <p class="account-favorites-item__price">
                          <strong>Price: $<?= number_format($res['priceUsd']) ?></strong>
                        </p>
                        <p class="account-favorites-item__meta">
                          Stock Id: <?= htmlspecialchars($res['stockId']) ?> · Expires: <?= htmlspecialchars($res['expiresAt']) ?>
                        </p>
                        <div style="margin-top: 10px;">
                          <span class="account-ledger__badge" style="background-color: #3b82f6; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">
                            <?= htmlspecialchars($res['status']) ?>
                          </span>
                        </div>
                      </div>
                    </a>
                  </article>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <!-- Tab: Purchased Vehicles -->
            <?php elseif ($activeTab === 'purchased'): ?>
            <?php $purchasedVehicles = $purchasedVehicles ?? []; ?>
            <?php if (empty($purchasedVehicles)): ?>
            <div class="account-empty-state account-empty-state--purchased">
              <div class="account-empty-state__icon" aria-hidden="true">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" />
                  <path d="M8 12.5l2.5 2.5L16 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <h2 class="account-empty-state__title" data-i18n="account.purchased.empty">No Purchased Vehicles Found</h2>
            </div>
            <?php else: ?>
            <div class="account-favorites">
              <header class="account-favorites__head">
                <h2 class="account-favorites__title" data-i18n="account.tab.purchased">Purchased Vehicles</h2>
                <p class="account-favorites__count"><?= count($purchasedVehicles) ?> <?= count($purchasedVehicles) === 1 ? 'vehicle' : 'vehicles' ?></p>
              </header>
              <ul class="account-favorites__list">
                <?php foreach ($purchasedVehicles as $purchased): ?>
                <li>
                  <div class="account-favorites-item" style="flex-direction: column; gap: 15px; align-items: stretch; padding: 20px;">
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                      <div class="account-favorites-item__media" style="width: 150px; height: 100px; flex-shrink: 0; border-radius: 8px; overflow: hidden;">
                        <img src="<?= htmlspecialchars($purchased['image']) ?>" alt="<?= htmlspecialchars($purchased['make'] . ' ' . $purchased['model']) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                      </div>
                      <div class="account-favorites-item__body" style="flex-grow: 1;">
                        <span class="account-favorites-item__make"><?= htmlspecialchars($purchased['make']) ?></span>
                        <h3 class="account-favorites-item__model" style="margin: 0; font-size: 18px;"><?= htmlspecialchars($purchased['model']) ?> (<?= htmlspecialchars($purchased['year']) ?>)</h3>
                        <p class="account-favorites-item__price" style="margin: 5px 0;">
                          <strong>FOB Price: $<?= number_format($purchased['priceUsd']) ?></strong> · Stock Id: <?= htmlspecialchars($purchased['stockId']) ?>
                        </p>
                      </div>
                    </div>
                    
                    <!-- Shipment Details Table -->
                    <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 8px; padding: 15px; margin-top: 10px;">
                      <h4 style="margin: 0 0 10px; font-size: 14px; font-family: 'Montserrat', sans-serif; color: var(--color-navy-800);">Shipment Tracking</h4>
                      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px; font-size: 13px;">
                        <div>
                          <span style="color: #718096; display: block; font-size: 11px; text-transform: uppercase;">Status</span>
                          <span class="account-ledger__badge" style="background-color: <?= $purchased['shipmentStatus'] === 'Delivered' ? '#10b981' : '#3b82f6' ?>; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: 600; display: inline-block; margin-top: 4px;">
                            <?= htmlspecialchars($purchased['shipmentStatus']) ?>
                          </span>
                        </div>
                        <div>
                          <span style="color: #718096; display: block; font-size: 11px; text-transform: uppercase;">B/L Number</span>
                          <strong style="color: #2d3748; display: block; margin-top: 4px;"><?= htmlspecialchars($purchased['blNumber']) ?></strong>
                        </div>
                        <div>
                          <span style="color: #718096; display: block; font-size: 11px; text-transform: uppercase;">Vessel</span>
                          <span style="color: #2d3748; display: block; margin-top: 4px;"><?= htmlspecialchars($purchased['vessel']) ?></span>
                        </div>
                        <div>
                          <span style="color: #718096; display: block; font-size: 11px; text-transform: uppercase;">ETD (Departure)</span>
                          <span style="color: #2d3748; display: block; margin-top: 4px;"><?= htmlspecialchars($purchased['etd']) ?></span>
                        </div>
                        <div>
                          <span style="color: #718096; display: block; font-size: 11px; text-transform: uppercase;">ETA (Arrival)</span>
                          <span style="color: #2d3748; display: block; margin-top: 4px;"><?= htmlspecialchars($purchased['eta']) ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </section>

  </main>

<?php $loadAccountPaymentPicker = ($activeTab === 'account-info'); ?>
<?php $loadAccountScripts = ($activeTab === 'account-info' || $activeTab === 'consignee' || $activeTab === 'favorites'); ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
