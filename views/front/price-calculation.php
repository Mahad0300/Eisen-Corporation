<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="price-calc-page">

    <section class="price-calc-hero" aria-labelledby="price-calc-title">
      <div class="container price-calc-hero__inner">
        <p class="price-calc-hero__eyebrow" data-i18n="priceCalc.eyebrow">Eisen Corporation</p>
        <h1 id="price-calc-title" class="price-calc-hero__title" data-i18n="priceCalc.title" data-page-title="priceCalc.pageTitle">Price Calculation</h1>
        <p class="price-calc-hero__lead" data-i18n="priceCalc.lead">Transparent C&amp;F pricing for Japan auction vehicles — inland delivery estimates and export cost breakdown.</p>
      </div>
    </section>

    <section class="price-calc-page__main section">
      <div class="container price-calc-page__inner">

        <article class="price-calc-formula card">
          <h2 class="price-calc-formula__title" data-i18n="priceCalc.formulaTitle">C&amp;F price calculation</h2>
          <p class="price-calc-formula__text" data-i18n="priceCalc.formulaText">The C&amp;F price calculation is done as follows: Auction fee + Inland Delivery + 10% (tax) + Handling expenses + Agent Commission + Freight &amp; shipping charges (if the customer requires insurance, the insurance cost will be added to the price).</p>
          <ul class="price-calc-formula__list" aria-label="Cost components">
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">1</span>
              <span data-i18n="priceCalc.step.auction">Auction fee</span>
            </li>
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.inland">Inland delivery</span>
            </li>
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.tax">10% tax</span>
            </li>
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.handling">Handling expenses</span>
            </li>
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.agent">Agent commission</span>
            </li>
            <li class="price-calc-formula__item">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.freight">Freight &amp; shipping charges</span>
            </li>
            <li class="price-calc-formula__item price-calc-formula__item--optional">
              <span class="price-calc-formula__step" aria-hidden="true">+</span>
              <span data-i18n="priceCalc.step.insurance">Insurance (optional)</span>
            </li>
          </ul>
        </article>

        <section class="price-calc-delivery" aria-labelledby="price-calc-delivery-title">
          <header class="price-calc-delivery__head">
            <h2 id="price-calc-delivery-title" class="price-calc-delivery__title" data-i18n="priceCalc.deliveryTitle">Delivery charges</h2>
            <p class="price-calc-delivery__subtitle" data-i18n="priceCalc.deliverySubtitle">Estimated in-land delivery prices organized by auction day.</p>
          </header>

          <div class="price-calc-days" data-price-calc-days role="tablist" aria-label="Auction days">
            <?php foreach ($auctionDays as $index => $day): ?>
            <button
              type="button"
              class="price-calc-days__btn<?= $index === 0 ? ' is-active' : '' ?>"
              role="tab"
              id="price-calc-tab-<?= htmlspecialchars($day['id']) ?>"
              aria-selected="<?= $index === 0 ? 'true' : 'false' ?>"
              aria-controls="price-calc-panel-<?= htmlspecialchars($day['id']) ?>"
              data-price-calc-day="<?= htmlspecialchars($day['id']) ?>"
              <?php if (!empty($day['i18n'])): ?>data-i18n="<?= htmlspecialchars($day['i18n']) ?>"<?php endif; ?>
            ><?= htmlspecialchars($day['label']) ?></button>
            <?php endforeach; ?>
          </div>

          <?php foreach ($auctionDays as $index => $day): ?>
          <div
            class="price-calc-panel card<?= $index === 0 ? ' is-active' : '' ?>"
            id="price-calc-panel-<?= htmlspecialchars($day['id']) ?>"
            role="tabpanel"
            aria-labelledby="price-calc-tab-<?= htmlspecialchars($day['id']) ?>"
            data-price-calc-panel="<?= htmlspecialchars($day['id']) ?>"
            <?= $index !== 0 ? 'hidden' : '' ?>
          >
            <h3 class="price-calc-panel__title" <?php if (!empty($day['i18n'])): ?>data-i18n="<?= htmlspecialchars($day['i18n']) ?>"<?php endif; ?>><?= htmlspecialchars($day['label']) ?></h3>
            <div class="price-calc-table-wrap">
              <table class="price-calc-table">
                <thead>
                  <tr>
                    <th scope="col" data-i18n="priceCalc.col.auction">Auction name</th>
                    <th scope="col" class="price-calc-table__col-price" data-price-calc-col-price data-i18n="priceCalc.col.priceJpy">Estimated price (JPY)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($day['auctions'] as $auction): ?>
                  <tr>
                    <td><?= htmlspecialchars($auction['name']) ?></td>
                    <td class="price-calc-table__price" data-price-jpy="<?= (int) $auction['price'] ?>">￥<?= number_format((int) $auction['price']) ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php endforeach; ?>
        </section>

        <aside class="price-calc-notes card">
          <h2 class="price-calc-notes__title" data-i18n="priceCalc.notesTitle">Important notes</h2>
          <ol class="price-calc-notes__list">
            <li data-i18n="priceCalc.note1">All charges are per vehicle and exclude local taxes and handling fees.</li>
            <li data-i18n="priceCalc.note2">Final charges may vary based on vehicle size, weight, and delivery method.</li>
            <li data-i18n="priceCalc.note3">Additional fees may apply for remote areas or special delivery requirements.</li>
            <li data-i18n="priceCalc.note4">Contact us for exact quotes and current rates.</li>
            <li data-i18n="priceCalc.note5">Delivery times typically range from 3–7 business days depending on prefecture.</li>
          </ol>
          <p class="price-calc-notes__cta">
            <a class="btn btn--primary" href="<?= BASE_URL ?>/contact" data-i18n="priceCalc.contactCta">Request a quote</a>
          </p>
        </aside>

      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/public/js/price-calculation.js" defer></script>
<?php include __DIR__ . '/partials/footer.php'; ?>
