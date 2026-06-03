<?php
$imgBase = 'https://images.unsplash.com/';

$processSteps = [
  ['num' => '01', 'title' => 'Shortlist & bid', 'text' => 'Review auction sheets, grades, and live photos to select the right stock.', 'key' => 'about.process.step1'],
  ['num' => '02', 'title' => 'Inspect & confirm', 'text' => 'Pre-export checks, documentation, and transparent condition reporting.', 'key' => 'about.process.step2'],
  ['num' => '03', 'title' => 'Ship worldwide', 'text' => 'RoRo or container logistics from Japan to your destination port.', 'key' => 'about.process.step3'],
  ['num' => '04', 'title' => 'Deliver & support', 'text' => 'Handover coordination and ongoing support for dealers and buyers.', 'key' => 'about.process.step4'],
];
?>
<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="about-page">

    <section class="about-hero" aria-labelledby="about-page-title">
      <div class="about-hero__media" aria-hidden="true">
        <img src="<?= htmlspecialchars($imgBase) ?>photo-1618843479313-40f8afb4b4d8?w=1600&q=80" alt="" width="1600" height="900" fetchpriority="high" />
        <div class="about-hero__overlay"></div>
      </div>
      <div class="container about-hero__inner">
        <div class="about-hero__content">
          <p class="about-hero__eyebrow" data-i18n="about.eyebrow">Who we are</p>
          <h1 id="about-page-title" class="about-hero__title" data-i18n="about.title">About Eisen Corporation</h1>
          <p class="about-hero__lead" data-i18n="about.lead">
            A trusted bridge between Japan's wholesale auction market and buyers worldwide — delivering inspection-grade vehicles, transparent export logistics, and expert guidance since day one.
          </p>
        </div>
      </div>
    </section>

    <section class="about-story section" aria-labelledby="about-story-title">
      <div class="container">
        <div class="about-story__layout">
          <div class="about-story__media">
            <div class="about-story__frame">
              <img
                src="<?= htmlspecialchars($imgBase) ?>photo-1549317661-bd32c8ce0db2?w=900&q=80"
                alt=""
                width="900"
                height="600"
                loading="lazy"
              />
            </div>
            <div class="about-story__badge card">
              <span class="about-story__badge-value">15+</span>
              <span class="about-story__badge-label" data-i18n="about.story.badge">Years connecting Japan auctions to global buyers</span>
            </div>
          </div>
          <div class="about-story__content">
            <div class="about-section-head">
              <span class="about-section-head__label" data-i18n="about.story.title">Our story</span>
              <span class="about-section-head__line" aria-hidden="true"></span>
            </div>
            <h2 id="about-story-title" class="about-section-title" data-i18n="about.story.heading">Built for serious importers</h2>
            <p class="about-story__intro" data-i18n="about.story.p1">
              Eisen Corporation was built for one purpose: make Japan auction imports straightforward for dealers and private buyers who demand quality, clarity, and reliable delivery.
            </p>
            <p data-i18n="about.story.p2">
              From shortlisting USS and TAA stock to pre-export inspection and port handover, our team handles the details so you can focus on sourcing the right vehicles for your market.
            </p>
            <p data-i18n="about.story.p3">
              Today we support clients across dozens of countries — combining auction expertise with logistics partners and a commitment to transparent communication at every step.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="about-stats" aria-label="Company highlights" data-about-stats>
      <div class="container">
        <ul class="about-stats__grid">
          <?php foreach ($stats as $stat): ?>
          <li class="about-stats__item">
            <span
              class="about-stats__value"
              data-counter
              data-counter-target="<?= (int) $stat['target'] ?>"
              data-counter-suffix="<?= htmlspecialchars($stat['suffix']) ?>"
              <?= !empty($stat['comma']) ? 'data-counter-comma="true"' : '' ?>
            >0<?= htmlspecialchars($stat['suffix']) ?></span>
            <span class="about-stats__label" data-i18n="<?= htmlspecialchars($stat['key']) ?>"><?= htmlspecialchars($stat['label']) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <section class="about-services section" aria-labelledby="about-services-title">
      <div class="container">
        <div class="about-section-head about-section-head--center">
          <span class="about-section-head__label" data-i18n="about.services.title">What we do</span>
          <span class="about-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="about-services-title" class="about-section-title about-section-title--center" data-i18n="about.services.heading">Full-spectrum export services</h2>
        <p class="about-section-lead" data-i18n="about.services.lead">From auction lane to destination port — one partner for sourcing, inspection, and logistics.</p>
        <ul class="about-services__grid">
          <?php foreach ($services as $i => $service): ?>
          <li class="about-services__item">
            <span class="about-services__index" aria-hidden="true"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3 class="about-services__title" data-i18n="<?= htmlspecialchars($service['titleKey']) ?>"><?= htmlspecialchars($service['title']) ?></h3>
            <p class="about-services__text" data-i18n="<?= htmlspecialchars($service['textKey']) ?>"><?= htmlspecialchars($service['text']) ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <section class="about-process section" aria-labelledby="about-process-title">
      <div class="container">
        <div class="about-section-head">
          <span class="about-section-head__label" data-i18n="about.process.label">How we work</span>
          <span class="about-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="about-process-title" class="about-section-title" data-i18n="about.process.title">Your import journey with Eisen</h2>
        <ol class="about-process__steps">
          <?php foreach ($processSteps as $step): ?>
          <li class="about-process__step">
            <span class="about-process__num" aria-hidden="true"><?= htmlspecialchars($step['num']) ?></span>
            <div class="about-process__body">
              <h3 class="about-process__step-title"><?= htmlspecialchars($step['title']) ?></h3>
              <p class="about-process__step-text" data-i18n="<?= htmlspecialchars($step['key']) ?>"><?= htmlspecialchars($step['text']) ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <section class="about-values section" aria-labelledby="about-values-title">
      <div class="container">
        <div class="about-values__layout">
          <div class="about-values__content">
            <div class="about-section-head">
              <span class="about-section-head__label" data-i18n="about.values.label">Why Eisen</span>
              <span class="about-section-head__line" aria-hidden="true"></span>
            </div>
            <h2 id="about-values-title" class="about-section-title" data-i18n="about.values.title">Why buyers choose Eisen</h2>
            <ul class="about-values__grid">
              <li class="about-values__item">
                <span class="about-values__icon" aria-hidden="true">✓</span>
                <span data-i18n="about.values.item1">Auction-grade stock with documented inspection and grading support</span>
              </li>
              <li class="about-values__item">
                <span class="about-values__icon" aria-hidden="true">✓</span>
                <span data-i18n="about.values.item2">Transparent pricing in USD and JPY with live conversion tools</span>
              </li>
              <li class="about-values__item">
                <span class="about-values__icon" aria-hidden="true">✓</span>
                <span data-i18n="about.values.item3">End-to-end export coordination from Japan to your destination port</span>
              </li>
              <li class="about-values__item">
                <span class="about-values__icon" aria-hidden="true">✓</span>
                <span data-i18n="about.values.item4">Dedicated support for dealers, resellers, and first-time importers</span>
              </li>
            </ul>
          </div>
          <div class="about-values__media">
            <div class="about-values__frame">
              <img
                src="<?= htmlspecialchars($imgBase) ?>photo-1553440569-bcc63803a83d?w=800&q=80"
                alt=""
                width="800"
                height="500"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="about-cta section" aria-labelledby="about-cta-title">
      <div class="container">
        <div class="about-cta__banner">
          <div class="about-cta__content">
            <p class="about-cta__eyebrow" data-i18n="about.cta.eyebrow">Start sourcing today</p>
            <h2 id="about-cta-title" class="about-cta__title" data-i18n="about.cta.title">Ready to source from Japan?</h2>
            <p class="about-cta__text" data-i18n="about.cta.text">Browse our current inventory or speak with our export team about your next auction purchase.</p>
          </div>
          <div class="about-cta__actions">
            <a class="btn btn--gold" href="<?= BASE_URL ?>/listing" data-i18n="about.cta.inventory">Browse inventory</a>
            <a class="btn btn--white" href="<?= BASE_URL ?>/contact" data-i18n="about.cta.contact">Contact us</a>
          </div>
        </div>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/public/js/about.js" defer></script>
<?php include __DIR__ . '/partials/footer.php'; ?>
