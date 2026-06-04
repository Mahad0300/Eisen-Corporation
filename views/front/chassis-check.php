<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="chassis-page">

    <section class="chassis-page__main section" aria-labelledby="chassis-page-title">
      <div class="container chassis-page__inner">
        <header class="chassis-page__head">
          <p class="chassis-page__eyebrow" data-i18n="chassis.eyebrow">Vehicle lookup</p>
          <h1 id="chassis-page-title" class="chassis-page__title" data-i18n="chassis.title">Chassis Check</h1>
          <div class="chassis-page__intro">
            <p data-i18n="chassis.intro1">You can search for the manufacturing year of Japanese vehicles.</p>
            <p data-i18n="chassis.intro2">Enter the VIN number (e.g. AE100-0001234) and select the maker (only Japanese makers).</p>
            <p class="chassis-page__note" data-i18n="chassis.disclaimer">* Please note that this service is for reference purposes only and does not guarantee the provided information. If you have any doubts, please contact the manufacturer directly for confirmation.</p>
          </div>
        </header>

        <div class="chassis-search-card card">
          <form class="chassis-search" data-chassis-form novalidate>
            <div class="chassis-search__fields">
              <div class="form-field">
                <label class="form-label" for="chassis-number">
                  <span data-i18n="chassis.number">Number</span>
                  <span class="chassis-required" aria-hidden="true">*</span>
                </label>
                <input
                  class="form-control form-control--text"
                  type="text"
                  id="chassis-number"
                  name="number"
                  placeholder="AE100-7895427"
                  data-i18n-placeholder="chassis.numberPlaceholder"
                  required
                  autocomplete="off"
                />
              </div>

              <div class="form-field">
                <label class="form-label" for="chassis-maker">
                  <span data-i18n="chassis.maker">Maker</span>
                  <span class="chassis-required" aria-hidden="true">*</span>
                </label>
                <select class="form-control" id="chassis-maker" name="maker" required>
                  <option value="" data-i18n="chassis.makerPlaceholder">Select maker</option>
                  <?php foreach ($makers as $maker): ?>
                  <option value="<?= htmlspecialchars($maker) ?>"><?= htmlspecialchars($maker) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-field chassis-search__action">
                <span class="form-label chassis-search__label-spacer" aria-hidden="true">&nbsp;</span>
                <button class="chassis-search__btn" type="submit">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <path d="M20 20L16.5 16.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                  </svg>
                  <span data-i18n="chassis.search">Search</span>
                </button>
              </div>
            </div>
          </form>
        </div>

        <section class="chassis-results card" data-chassis-results hidden aria-labelledby="chassis-results-title">
          <h2 id="chassis-results-title" class="chassis-results__title" data-i18n="chassis.resultsTitle">Chassis check results</h2>
          <div class="chassis-results__grid">
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.make">Make</span>
              <span class="chassis-results__value" data-chassis-field="make">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.engine">Engine</span>
              <span class="chassis-results__value" data-chassis-field="engine">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.year">Year</span>
              <span class="chassis-results__value" data-chassis-field="year">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.model">Model</span>
              <span class="chassis-results__value" data-chassis-field="model">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.grade">Grade</span>
              <span class="chassis-results__value" data-chassis-field="grade">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.transmission">Transmission</span>
              <span class="chassis-results__value" data-chassis-field="transmission">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.body">Body</span>
              <span class="chassis-results__value" data-chassis-field="body">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.drive">Drive</span>
              <span class="chassis-results__value" data-chassis-field="drive">—</span>
            </div>
            <div class="chassis-results__item">
              <span class="chassis-results__label" data-i18n="chassis.field.fuel">Fuel</span>
              <span class="chassis-results__value" data-chassis-field="fuel">—</span>
            </div>
          </div>
        </section>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/public/js/chassis.js" defer></script>
<?php include __DIR__ . '/partials/footer.php'; ?>
