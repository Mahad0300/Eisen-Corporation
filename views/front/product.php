<?php
$galleryPhotos = [
  ["label" => "Front exterior", "src" => "photo-1606664515524-ed2f786a0bd6"],
  ["label" => "Side profile", "src" => "photo-1549317661-bd32c8ce0db2"],
  ["label" => "Rear view", "src" => "photo-1552519507-da3b142c6e3d"],
  ["label" => "Interior dashboard", "src" => "photo-1618843479313-40f8afb4b4d8"],
  ["label" => "Wheel detail", "src" => "photo-1503376780353-7e6692767b70"],
  ["label" => "Front angle", "src" => "photo-1519641471654-76ce0107ad1b"],
  ["label" => "Highway driving", "src" => "photo-1553440569-bcc63803a83d"],
  ["label" => "Sport trim", "src" => "photo-1553440569-bcc63803a83d"],
  ["label" => "Showroom front", "src" => "photo-1492144534655-ae79c964c9d7"],
  ["label" => "Luxury sedan", "src" => "photo-1555215695-3004980ad54e"],
  ["label" => "Performance view", "src" => "photo-1603386329225-868f9b1ee6b9"],
  ["label" => "SUV profile", "src" => "photo-1519641471654-76ce0107ad1b"],
  ["label" => "City street", "src" => "photo-1606664515524-ed2f786a0bd6"],
  ["label" => "Cabin seats", "src" => "photo-1549317661-bd32c8ce0db2"],
  ["label" => "Trunk space", "src" => "photo-1552519507-da3b142c6e3d"],
];
$galleryTotal = count($galleryPhotos);
$galleryFirst = $galleryPhotos[0];
$galleryFirstLarge = "https://images.unsplash.com/{$galleryFirst['src']}?w=1200&q=80";
$galleryFirstThumb = "https://images.unsplash.com/{$galleryFirst['src']}?w=200&q=80";
$galleryFirstAlt = "2012 Jeep Patriot Latitude — {$galleryFirst['label']}";
include __DIR__ . '/partials/header.php';
?>

  <main id="main">

    <section class="product-page section" aria-labelledby="product-title">
      <div class="container">
        <div class="product-layout">

          <div class="product-gallery-wrap" data-product-gallery>
            <figure class="product-gallery card">
              <button type="button" class="product-gallery__main" data-gallery-open aria-label="Open full-size photo">
                <img
                  class="product-gallery__img"
                  data-gallery-main
                  src="<?= htmlspecialchars($galleryFirstLarge) ?>"
                  alt="<?= htmlspecialchars($galleryFirstAlt) ?>"
                  width="1200"
                  height="675"
                  fetchpriority="high"
                />
                <span class="product-gallery__badge" data-gallery-count>1 / <?= (int) $galleryTotal ?></span>
                <span class="product-gallery__zoom" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <line x1="11" y1="8" x2="11" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <line x1="8" y1="11" x2="14" y2="11" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                  </svg>
                </span>
              </button>
            </figure>

            <div class="product-gallery__thumbs-wrap">
              <button type="button" class="product-gallery__scroll product-gallery__scroll--prev" data-thumb-prev aria-label="Scroll photos left">
                <span aria-hidden="true">‹</span>
              </button>
              <ul class="product-gallery__thumbs" data-gallery-thumbs role="tablist" aria-label="Vehicle photos">
                <?php foreach ($galleryPhotos as $index => $photo):
                  $large = "https://images.unsplash.com/{$photo['src']}?w=1200&q=80";
                  $thumb = "https://images.unsplash.com/{$photo['src']}?w=200&q=80";
                  $alt = "2012 Jeep Patriot Latitude — {$photo['label']}";
                  $isActive = $index === 0;
                ?>
                <li>
                  <button
                    type="button"
                    class="product-gallery__thumb<?= $isActive ? ' is-active' : '' ?>"
                    role="tab"
                    aria-selected="<?= $isActive ? 'true' : 'false' ?>"
                    aria-label="Photo <?= $index + 1 ?> — <?= htmlspecialchars($photo['label']) ?>"
                    data-gallery-index="<?= $index ?>"
                    data-gallery-src="<?= htmlspecialchars($large) ?>"
                    data-gallery-alt="<?= htmlspecialchars($alt) ?>"
                  >
                    <img src="<?= htmlspecialchars($thumb) ?>" alt="" width="200" height="133" loading="lazy" />
                  </button>
                </li>
                <?php endforeach; ?>
              </ul>
              <button type="button" class="product-gallery__scroll product-gallery__scroll--next" data-thumb-next aria-label="Scroll photos right">
                <span aria-hidden="true">›</span>
              </button>
            </div>
          </div>

          <aside class="product-sidebar" aria-label="Vehicle details">
            <div class="product-summary card">
              <h1 id="product-title" class="product-summary__title">2012 Patriot Latitude</h1>
              <p class="product-summary__make">jeep</p>

              <div class="product-auction-meta">
                <span class="product-auction-meta__badge">Japan Auction Stock</span>
                <span class="product-auction-meta__lot">Lot #A-2847</span>
              </div>

              <div class="product-pricing product-pricing--auction">
                <p class="product-pricing__label">Winning bid</p>
                <p class="product-pricing__price product-price" data-price-usd="9998">$9,998</p>
              </div>

              <ul class="product-auction-facts">
                <li class="product-auction-facts__item">
                  <span class="product-auction-facts__label">Auction house</span>
                  <strong class="product-auction-facts__value">USS Tokyo</strong>
                </li>
                <li class="product-auction-facts__item">
                  <span class="product-auction-facts__label">Auction date</span>
                  <strong class="product-auction-facts__value">Jun 8, 2026</strong>
                </li>
                <li class="product-auction-facts__item">
                  <span class="product-auction-facts__label">Mileage</span>
                  <strong class="product-auction-facts__value">67,400 km</strong>
                </li>
                <li class="product-auction-facts__item">
                  <span class="product-auction-facts__label">Grade</span>
                  <strong class="product-auction-facts__value">4.5 B</strong>
                </li>
              </ul>

              <a class="btn btn--primary btn--block product-summary__cta" href="<?= BASE_URL ?>/contact">
                Request export quote
                <svg class="product-summary__cta-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </a>
            </div>

            <div class="product-features card">
              <h2 class="product-panel__title">Features</h2>
              <ul class="product-features__list">
                <li>ABS Brakes</li>
                <li>AM/FM Stereo</li>
                <li>Air Conditioning</li>
                <li>Alloy Wheels</li>
                <li>Auto Dimming Mirror</li>
                <li>Automatic Headlights</li>
                <li>Backup Camera</li>
                <li>CD Audio</li>
                <li>Child Safety Door Locks</li>
                <li>Cruise Control</li>
                <li>Driver Airbag</li>
                <li>Front Side Airbag</li>
                <li>Keyless Entry</li>
                <li>Leather Steering Wheel</li>
                <li>Passenger Airbag</li>
                <li>Power Locks</li>
                <li>Power Mirrors</li>
                <li>Power Steering</li>
                <li>Power Windows</li>
                <li>Rear Window Defroster</li>
                <li>Security System</li>
                <li>Steering Wheel Controls</li>
                <li>Tilt Steering Wheel</li>
                <li>Traction Control</li>
              </ul>
            </div>

            <div class="product-specs card">
              <h2 class="product-panel__title">Specs</h2>
              <dl class="product-specs__list">
                <div class="product-specs__row">
                  <dt>Transmission</dt>
                  <dd>Automatic</dd>
                </div>
                <div class="product-specs__row">
                  <dt>Drive</dt>
                  <dd>2WD</dd>
                </div>
                <div class="product-specs__row">
                  <dt>Engine</dt>
                  <dd>2.4L</dd>
                </div>
                <div class="product-specs__row">
                  <dt>MPG</dt>
                  <dd>21/27</dd>
                </div>
              </dl>
              <details class="product-specs__more">
                <div class="product-specs__more-body">
                  <dl class="product-specs__list">
                    <div class="product-specs__row">
                      <dt>Exterior Color</dt>
                      <dd>Silver</dd>
                    </div>
                    <div class="product-specs__row">
                      <dt>Interior Color</dt>
                      <dd>Black</dd>
                    </div>
                    <div class="product-specs__row">
                      <dt>Doors</dt>
                      <dd>4</dd>
                    </div>
                    <div class="product-specs__row">
                      <dt>Seating</dt>
                      <dd>5 Passengers</dd>
                    </div>
                    <div class="product-specs__row">
                      <dt>Fuel Type</dt>
                      <dd>Gasoline</dd>
                    </div>
                    <div class="product-specs__row">
                      <dt>VIN</dt>
                      <dd>1C4NJRFB0CD123456</dd>
                    </div>
                  </dl>
                </div>
                <summary class="product-specs__toggle">Show All Specs</summary>
              </details>
            </div>
          </aside>

          <div class="product-recs-wrap">
            <section class="product-recs" aria-labelledby="recs-this-title">
              <header class="product-recs__head">
                <h2 id="recs-this-title" class="product-recs__title">Recommended for you</h2>
                <p class="product-recs__subtitle">Based on this vehicle</p>
              </header>
              <ul class="product-recs-grid">
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=600&q=80" alt="Toyota Highlander XLE" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">Toyota Highlander XLE</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="26998">$26,998</span> · 67K mi · Grade 4.0</p>
                      <p class="product-rec-card__location">USS Tokyo, Japan</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80" alt="Honda CR-V EX-L" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">Honda CR-V EX-L</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="24998">$24,998</span> · 54K mi · Grade 4.5</p>
                      <p class="product-rec-card__location">USS Osaka, Japan</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&q=80" alt="Audi Q5 Premium" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">Audi Q5 Premium</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="31998">$31,998</span> · 41K mi · Grade 4.0</p>
                      <p class="product-rec-card__location">TAA Yokohama, Japan</p>
                    </div>
                  </a>
                </li>
              </ul>
            </section>

            <section class="product-recs" aria-labelledby="recs-search-title">
              <header class="product-recs__head">
                <h2 id="recs-search-title" class="product-recs__title">Based on your recent search</h2>
              </header>
              <ul class="product-recs-grid">
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&q=80" alt="Ford Mustang GT" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">Ford Mustang GT</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="38998">$38,998</span> · 29K mi · Grade 4.5</p>
                      <p class="product-rec-card__location">USS Nagoya, Japan</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80" alt="BMW X5 xDrive" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">BMW X5 xDrive</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="44998">$44,998</span> · 36K mi · Grade 4.0</p>
                      <p class="product-rec-card__location">JAA Fukuoka, Japan</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="<?= BASE_URL ?>/product" class="product-rec-card">
                    <div class="product-rec-card__media">
                      <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80" alt="Nissan Rogue SV" width="600" height="400" loading="lazy" />
                    </div>
                    <div class="product-rec-card__body">
                      <h3 class="product-rec-card__name">Nissan Rogue SV</h3>
                      <p class="product-rec-card__meta"><span class="product-price" data-price-usd="21998">$21,998</span> · 58K mi · Grade 3.5</p>
                      <p class="product-rec-card__location">USS Sapporo, Japan</p>
                    </div>
                  </a>
                </li>
              </ul>
            </section>
          </div>

        </div>
      </div>
    </section>

  </main>

  <div class="product-lightbox" data-gallery-lightbox hidden>
    <div class="product-lightbox__backdrop" data-gallery-close></div>
    <div
      class="product-lightbox__dialog"
      role="dialog"
      aria-modal="true"
      aria-label="Vehicle photo gallery"
    >
      <button class="product-lightbox__close" type="button" data-gallery-close aria-label="Close gallery">×</button>
      <button class="product-lightbox__nav product-lightbox__nav--prev" type="button" data-gallery-prev aria-label="Previous photo">‹</button>
      <img class="product-lightbox__img" data-gallery-lightbox-img src="" alt="" />
      <button class="product-lightbox__nav product-lightbox__nav--next" type="button" data-gallery-next aria-label="Next photo">›</button>
      <p class="product-lightbox__counter" data-gallery-counter aria-live="polite"></p>
    </div>
  </div>

  <script src="<?= BASE_URL ?>/public/js/product.js" defer></script>
<?php include __DIR__ . '/partials/footer.php'; ?>
