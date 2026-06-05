<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main">

    <section class="hero" data-i18n-aria-label="hero.aria" aria-label="Featured vehicles and search">
      <div class="container hero__grid">
        <div class="hero-slider card" data-slider>
          <div class="hero-slider__track">
            <article class="hero-slide is-active" data-slide="0">
              <img
                class="hero-slide__img"
                src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=1200&q=80"
                alt="Eisen Corporation promotional banner 1"
                width="1200"
                height="675"
                fetchpriority="high"
              />
            </article>

            <article class="hero-slide" data-slide="1" hidden>
              <img
                class="hero-slide__img"
                src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=1200&q=80"
                alt="Eisen Corporation promotional banner 2"
                width="1200"
                height="675"
                loading="lazy"
              />
            </article>

            <article class="hero-slide" data-slide="2" hidden>
              <img
                class="hero-slide__img"
                src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=1200&q=80"
                alt="Eisen Corporation promotional banner 3"
                width="1200"
                height="675"
                loading="lazy"
              />
            </article>

            <article class="hero-slide" data-slide="3" hidden>
              <img
                class="hero-slide__img"
                src="https://images.unsplash.com/photo-1603386329225-868f9b1ee6b9?w=1200&q=80"
                alt="Eisen Corporation promotional banner 4"
                width="1200"
                height="675"
                loading="lazy"
              />
            </article>

            <article class="hero-slide" data-slide="4" hidden>
              <img
                class="hero-slide__img"
                src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=1200&q=80"
                alt="Eisen Corporation promotional banner 5"
                width="1200"
                height="675"
                loading="lazy"
              />
            </article>
          </div>

          <div class="hero-slider__aside-ui">
            <div class="hero-slider__dots" role="tablist" data-i18n-aria-label="slider.slides" aria-label="Featured slides">
              <button class="hero-slider__dot is-active" type="button" role="tab" aria-selected="true" aria-label="Slide 1" data-goto="0"></button>
              <button class="hero-slider__dot" type="button" role="tab" aria-selected="false" aria-label="Slide 2" data-goto="1"></button>
              <button class="hero-slider__dot" type="button" role="tab" aria-selected="false" aria-label="Slide 3" data-goto="2"></button>
              <button class="hero-slider__dot" type="button" role="tab" aria-selected="false" aria-label="Slide 4" data-goto="3"></button>
              <button class="hero-slider__dot" type="button" role="tab" aria-selected="false" aria-label="Slide 5" data-goto="4"></button>
            </div>
          </div>

          <button class="hero-slider__arrow hero-slider__arrow--prev" type="button" data-i18n-aria-label="slider.prev" aria-label="Previous slide" data-prev></button>
          <button class="hero-slider__arrow hero-slider__arrow--next" type="button" data-i18n-aria-label="slider.next" aria-label="Next slide" data-next></button>
        </div>

        <aside class="search-filter card" aria-labelledby="search-filter-title">
          <h2 id="search-filter-title" class="search-filter__title" data-i18n="filter.title">Search Auto</h2>
          <form class="search-filter__form">
            <div class="form-field">
              <label class="form-label" for="manufacturer" data-i18n="filter.manufacturer">Manufacturer</label>
              <select class="form-control" id="manufacturer" name="manufacturer">
                <option value="" data-i18n="filter.allManufacturers">All manufacturers</option>
                <option>Toyota</option>
                <option>Honda</option>
                <option>Nissan</option>
                <option>BMW</option>
                <option>Mercedes-Benz</option>
                <option>Audi</option>
                <option>Lexus</option>
              </select>
            </div>

            <div class="form-field">
              <label class="form-label" for="model" data-i18n="filter.model">Model</label>
              <select class="form-control" id="model" name="model">
                <option value="" data-i18n="filter.allModels">All models</option>
                <option data-i18n="filter.sedan">Sedan</option>
                <option data-i18n="filter.suv">SUV</option>
                <option data-i18n="filter.hatchback">Hatchback</option>
                <option data-i18n="filter.hybrid">Hybrid</option>
              </select>
            </div>

            <div class="form-row">
              <div class="form-field">
                <label class="form-label" for="year-from" data-i18n="filter.yearFrom">Year from</label>
                <select class="form-control" id="year-from" name="year_from">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>2024</option>
                  <option>2023</option>
                  <option>2022</option>
                  <option>2021</option>
                  <option>2020</option>
                </select>
              </div>
              <div class="form-field">
                <label class="form-label" for="year-to" data-i18n="filter.yearTo">Year to</label>
                <select class="form-control" id="year-to" name="year_to">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>2024</option>
                  <option>2023</option>
                  <option>2022</option>
                  <option>2021</option>
                  <option>2020</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-field">
                <label class="form-label" for="price-from" data-i18n="filter.priceFrom">Price from</label>
                <select class="form-control" id="price-from" name="price_from">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>$10,000</option>
                  <option>$20,000</option>
                  <option>$30,000</option>
                  <option>$50,000</option>
                </select>
              </div>
              <div class="form-field">
                <label class="form-label" for="price-to" data-i18n="filter.priceTo">Price to</label>
                <select class="form-control" id="price-to" name="price_to">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>$30,000</option>
                  <option>$50,000</option>
                  <option>$75,000</option>
                  <option>$100,000+</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-field">
                <label class="form-label" for="mileage-from" data-i18n="filter.mileageFrom">Mileage from</label>
                <select class="form-control" id="mileage-from" name="mileage_from">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>0 km</option>
                  <option>10,000 km</option>
                  <option>50,000 km</option>
                </select>
              </div>
              <div class="form-field">
                <label class="form-label" for="mileage-to" data-i18n="filter.mileageTo">Mileage to</label>
                <select class="form-control" id="mileage-to" name="mileage_to">
                  <option value="" data-i18n="filter.any">Any</option>
                  <option>30,000 km</option>
                  <option>80,000 km</option>
                  <option>150,000 km</option>
                </select>
              </div>
            </div>

            <label class="form-checkbox">
              <input type="checkbox" name="new_only" />
              <span data-i18n="filter.newOnly">Only new cars</span>
            </label>

            <button class="btn btn--primary btn--block search-filter__submit" type="submit" data-i18n="filter.submit">Search</button>
          </form>
        </aside>
      </div>
    </section>

    <section id="listings" class="listings section" aria-labelledby="listings-title">
      <div class="container">
        <header class="section-header">
          <h2 id="listings-title" class="section-title" data-i18n="listings.title">Recent Listings</h2>
          <a class="section-link" href="#" data-i18n="listings.viewAll">View all inventory</a>
        </header>

        <ul class="listing-grid">
          <?php if (!empty($cars)): ?>
            <?php foreach ($cars as $car): 
              $carImg = $car['image_url'];
              if (empty($carImg)) {
                  $carImg = 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80'; // fallback mock image
              } else {
                  $carImg = BASE_URL . $carImg;
              }
            ?>
            <li>
              <a href="<?= BASE_URL ?>/product/<?= htmlspecialchars($car['stock_id']) ?>" class="listing-card">
                <div class="listing-card__media">
                  <img src="<?= htmlspecialchars($carImg) ?>" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" width="600" height="400" loading="lazy" />
                </div>
                <div class="listing-card__footer">
                  <span class="listing-card__name"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></span>
                  <span class="listing-card__price">$<?= number_format((float)$car['fob_price']) ?></span>
                </div>
              </a>
            </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>
              <a href="#" class="listing-card">
                <div class="listing-card__media">
                  <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80" alt="White compact SUV" width="600" height="400" loading="lazy" />
                </div>
                <div class="listing-card__footer">
                  <span class="listing-card__name">Honda Vezel</span>
                  <span class="listing-card__price">$24,500</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="listing-card">
                <div class="listing-card__media">
                  <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&q=80" alt="Blue Ford Mustang coupe" width="600" height="400" loading="lazy" />
                </div>
                <div class="listing-card__footer">
                  <span class="listing-card__name">Ford Mustang</span>
                  <span class="listing-card__price">$38,900</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="listing-card">
                <div class="listing-card__media">
                  <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80" alt="Black Porsche coupe" width="600" height="400" loading="lazy" />
                </div>
                <div class="listing-card__footer">
                  <span class="listing-card__name">Porsche 911</span>
                  <span class="listing-card__price">$89,200</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="listing-card">
                <div class="listing-card__media">
                  <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=600&q=80" alt="Red Ferrari sports car" width="600" height="400" loading="lazy" />
                </div>
                <div class="listing-card__footer">
                  <span class="listing-card__name">Ferrari 488</span>
                  <span class="listing-card__price">$215,000</span>
                </div>
              </a>
            </li>
          <?php endif; ?>
        </ul>

        <div class="cta-banners__grid" aria-label="Quick actions">
          <article class="cta-banner cta-banner--buy">
            <div class="cta-banner__icon cta-banner__icon--search" aria-hidden="true">
              <svg class="cta-banner__svg" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="11" stroke="currentColor" stroke-width="3.5" />
                <line x1="28.5" y1="28.5" x2="40" y2="40" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" />
              </svg>
            </div>
            <div class="cta-banner__content">
              <h3 class="cta-banner__title" data-i18n="cta.buy.title">Looking for a car?</h3>
              <p class="cta-banner__text" data-i18n="cta.buy.text">1000 new offers everyday 35,000 car offers on site</p>
            </div>
            <a class="btn btn--white" href="#" data-i18n="cta.buy.btn">Search</a>
          </article>

          <article class="cta-banner cta-banner--sell">
            <div class="cta-banner__icon cta-banner__icon--dollar" aria-hidden="true">
              <span class="cta-banner__dollar">$</span>
            </div>
            <div class="cta-banner__content">
              <h3 class="cta-banner__title" data-i18n="cta.sell.title">Want to sell a car?</h3>
              <p class="cta-banner__text" data-i18n="cta.sell.text">200000 visitors everyday. Add your offer now</p>
            </div>
            <a class="btn btn--white" href="#sellers" data-i18n="cta.sell.btn">Sell</a>
          </article>
        </div>
      </div>
    </section>

    <section id="blog" class="blog-hub section" aria-labelledby="blog-hub-title">
      <div class="container">
        <header class="section-header">
          <h2 id="blog-hub-title" class="section-title" data-i18n="blog.title">Recent from the blog</h2>
          <a class="section-link" href="<?= BASE_URL ?>/blog" data-i18n="blog.viewAll">View all blog</a>
        </header>

        <div class="blog-hub__layout">
          <div class="blog-hub__main">
            <div class="blog-cards">
              <article class="blog-card">
                <a href="#blog" class="blog-card__link">
                  <div class="blog-card__media">
                    <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80" alt="Luxury SUV on road" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="blog-card__body">
                    <h3 class="blog-card__title" data-i18n="blog.card.title">The importance of luxury SUV sales expand</h3>
                    <time class="blog-card__date" datetime="2020-09-16" data-i18n="blog.card.date">September, 16, 2020</time>
                    <p class="blog-card__excerpt" data-i18n="blog.excerpt1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  </div>
                </a>
              </article>

              <article class="blog-card">
                <a href="#blog" class="blog-card__link">
                  <div class="blog-card__media">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80" alt="Sports car front view" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="blog-card__body">
                    <h3 class="blog-card__title" data-i18n="blog.card.title">The importance of luxury SUV sales expand</h3>
                    <time class="blog-card__date" datetime="2020-09-16" data-i18n="blog.card.date">September, 16, 2020</time>
                    <p class="blog-card__excerpt" data-i18n="blog.excerpt2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                  </div>
                </a>
              </article>

              <article class="blog-card">
                <a href="#blog" class="blog-card__link">
                  <div class="blog-card__media">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&q=80" alt="Blue performance car" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="blog-card__body">
                    <h3 class="blog-card__title" data-i18n="blog.card.title">The importance of luxury SUV sales expand</h3>
                    <time class="blog-card__date" datetime="2020-09-16" data-i18n="blog.card.date">September, 16, 2020</time>
                    <p class="blog-card__excerpt" data-i18n="blog.excerpt3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                  </div>
                </a>
              </article>
            </div>

            <div id="directory" class="directory-tabs" data-directory-tabs>
              <div class="directory-tabs__nav" role="tablist" data-i18n-aria-label="directory.aria" aria-label="Directory">
                <button class="directory-tabs__btn is-active" type="button" role="tab" id="tab-dealers" aria-selected="true" aria-controls="panel-dealers" data-tab="dealers" data-i18n="directory.dealers">Dealers</button>
                <button class="directory-tabs__btn" type="button" role="tab" id="tab-service" aria-selected="false" aria-controls="panel-service" data-tab="service" data-i18n="directory.service">Service Stations</button>
                <button class="directory-tabs__btn" type="button" role="tab" id="tab-insurance" aria-selected="false" aria-controls="panel-insurance" data-tab="insurance" data-i18n="directory.insurance">Insurance</button>
              </div>

              <div class="directory-tabs__panels">
                <div class="directory-panel is-active" id="panel-dealers" role="tabpanel" aria-labelledby="tab-dealers" data-panel="dealers">
                  <p class="directory-panel__count" data-i18n="directory.countDealers">Found 454 dealers</p>
                  <div class="dealer-logos-marquee">
                    <ul class="dealer-logos dealer-logos--slide">
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="Mira Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="Toyota" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="Nissan" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="directory-panel" id="panel-service" role="tabpanel" aria-labelledby="tab-service" data-panel="service" hidden>
                  <p class="directory-panel__count" data-i18n="directory.countService">Found 128 service stations</p>
                  <div class="dealer-logos-marquee">
                    <ul class="dealer-logos dealer-logos--slide">
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="Mira Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="Toyota" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="Nissan" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="directory-panel" id="panel-insurance" role="tabpanel" aria-labelledby="tab-insurance" data-panel="insurance" hidden>
                  <p class="directory-panel__count" data-i18n="directory.countInsurance">Found 86 insurance partners</p>
                  <div class="dealer-logos-marquee">
                    <ul class="dealer-logos dealer-logos--slide">
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="Mira Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="Toyota" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="Nissan" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="Daihatsu" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/mira-daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/toyota.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/nissan.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                      <li class="dealer-logos__item dealer-logos__item--clone" aria-hidden="true">
                        <img class="dealer-logos__img" src="<?= BASE_URL ?>/public/image/daihatsu.png" alt="" width="160" height="64" loading="lazy" decoding="async">
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <aside class="blog-sidebar" aria-labelledby="blog-sidebar-title">
            <div class="blog-sidebar__head">
              <h2 id="blog-sidebar-title" class="blog-sidebar__title" data-i18n="sidebar.title">Auto news</h2>
            </div>

            <div class="blog-sidebar__posts">
            <article class="news-item">
              <a href="#news" class="news-item__link">
                <div class="news-item__media">
                  <img src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=400&q=80" alt="Porsche sports car" width="400" height="240" loading="lazy" />
                </div>
                <h3 class="news-item__title" data-i18n="news.title">Unofficial Porsche 918 Spyder pricing pops up</h3>
                <time class="news-item__date" datetime="2020-09-16" data-i18n="news.date">September, 16, 2020</time>
                <p class="news-item__excerpt" data-i18n="news.excerpt1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error.</p>
              </a>
            </article>

            <article class="news-item">
              <a href="#news" class="news-item__link">
                <div class="news-item__media">
                  <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&q=80" alt="White sedan" width="400" height="240" loading="lazy" />
                </div>
                <h3 class="news-item__title" data-i18n="news.title">Unofficial Porsche 918 Spyder pricing pops up</h3>
                <time class="news-item__date" datetime="2020-09-16" data-i18n="news.date">September, 16, 2020</time>
                <p class="news-item__excerpt" data-i18n="news.excerpt2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nemo enim ipsam voluptatem quia voluptas sit.</p>
              </a>
            </article>
            </div>

            <a class="btn btn--primary btn--block blog-sidebar__btn" href="#news" data-i18n="sidebar.allNews">All news</a>
          </aside>
        </div>
      </div>
    </section>

    <section id="videos" class="video-review section" aria-labelledby="video-review-title">
      <div class="container">
        <header class="section-header">
          <h2 id="video-review-title" class="section-title" data-i18n="video.title">Review</h2>
          <a class="section-link" href="#videos" data-i18n="video.viewAll">View all reviews</a>
        </header>

        <div class="video-review__layout">
          <div class="video-review__main">
            <div class="video-cards">
              <article class="video-card">
                <a href="#videos" class="video-card__link">
                  <div class="video-card__media">
                    <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80" alt="Black Mercedes G-Class SUV" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="video-card__body">
                    <h3 class="video-card__title" data-i18n="video.card.title">The importance of luxury SUV sales explained</h3>
                    <time class="video-card__meta" datetime="2020-09-16" data-i18n="video.date1">September 16, 2020</time>
                  </div>
                </a>
              </article>

              <article class="video-card">
                <a href="#videos" class="video-card__link">
                  <div class="video-card__media">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&q=80" alt="Ford Mustang on road" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="video-card__body">
                    <h3 class="video-card__title" data-i18n="video.card.title">The importance of luxury SUV sales explained</h3>
                    <time class="video-card__meta" datetime="2020-08-28" data-i18n="video.date2">August 28, 2020</time>
                  </div>
                </a>
              </article>

              <article class="video-card">
                <a href="#videos" class="video-card__link">
                  <div class="video-card__media">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80" alt="Luxury SUV front view" width="600" height="360" loading="lazy" />
                  </div>
                  <div class="video-card__body">
                    <h3 class="video-card__title" data-i18n="video.card.title">The importance of luxury SUV sales explained</h3>
                    <time class="video-card__meta" datetime="2020-07-12" data-i18n="video.date3">July 12, 2020</time>
                  </div>
                </a>
              </article>
            </div>
          </div>

          <aside class="video-review__aside" aria-label="Promotions">
            <form class="newsletter-box" action="#" method="post">
              <h3 class="newsletter-box__title" data-i18n="newsletter.title">Get Daily News</h3>
              <div class="newsletter-box__fields">
                <label class="visually-hidden" for="newsletter-email" data-i18n="newsletter.email">Email address</label>
                <input
                  id="newsletter-email"
                  class="newsletter-box__input"
                  type="email"
                  name="email"
                  placeholder="Enter Your Email"
                  data-i18n-placeholder="newsletter.placeholder"
                  autocomplete="email"
                  required
                />
                <button class="newsletter-box__btn" type="submit" data-i18n="newsletter.subscribe">Subscribe</button>
              </div>
            </form>

            <a href="#contacts" class="urgent-cta">
              <img
                class="urgent-cta__img"
                src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&q=80"
                alt=""
                width="600"
                height="400"
                loading="lazy"
              />
              <span class="urgent-cta__label" data-i18n="urgent.label">Urgent car purchase</span>
            </a>
          </aside>
        </div>
      </div>
    </section>

  </main>
<?php include __DIR__ . '/partials/footer.php'; ?>