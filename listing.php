<?php include 'header.php'; ?>

  <main id="main">

    <section class="inventory-page section" aria-labelledby="inventory-page-title">
      <div class="container">
        <h1 id="inventory-page-title" class="visually-hidden">Vehicle listings</h1>

        <form class="inventory-toolbar card" action="#" method="get" aria-label="Quick inventory search">
          <div class="inventory-toolbar__fields">
            <label class="inventory-toolbar__field">
              <span class="visually-hidden">Condition</span>
              <select class="inventory-toolbar__select" name="condition">
                <option>New and Used Cars</option>
                <option>New Cars</option>
                <option>Used Cars</option>
              </select>
            </label>
            <label class="inventory-toolbar__field">
              <span class="visually-hidden">Make</span>
              <select class="inventory-toolbar__select" name="make">
                <option>All Makes</option>
                <option>Toyota</option>
                <option>Honda</option>
                <option>Audi</option>
                <option>Nissan</option>
              </select>
            </label>
            <label class="inventory-toolbar__field">
              <span class="visually-hidden">Model</span>
              <select class="inventory-toolbar__select" name="model">
                <option>All Models</option>
                <option>Highlander</option>
                <option>CR-V</option>
                <option>Q5</option>
              </select>
            </label>
            <label class="inventory-toolbar__field">
              <span class="visually-hidden">Max price</span>
              <select class="inventory-toolbar__select" name="max_price">
                <option>No Max Price</option>
                <option>$20,000</option>
                <option>$30,000</option>
                <option>$50,000</option>
              </select>
            </label>
            <label class="inventory-toolbar__field">
              <span class="visually-hidden">Distance</span>
              <select class="inventory-toolbar__select" name="distance">
                <option>From 20 Miles</option>
                <option>From 50 Miles</option>
                <option>From 100 Miles</option>
              </select>
            </label>
          </div>
          <button class="inventory-toolbar__submit" type="submit" aria-label="Search inventory">
            <svg width="20" height="20" viewBox="0 0 48 48" fill="none" aria-hidden="true">
              <circle cx="20" cy="20" r="11" stroke="currentColor" stroke-width="3.5" />
              <line x1="28.5" y1="28.5" x2="40" y2="40" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" />
            </svg>
          </button>
        </form>

        <div class="inventory-layout">
          <button
            class="inventory-filters-toggle btn btn--primary"
            type="button"
            data-filter-toggle
            aria-expanded="false"
            aria-controls="inventory-filters-panel"
          >
            Filters<span class="inventory-filters-toggle__count" data-filter-toggle-count hidden></span>
          </button>

          <div class="inventory-filters-backdrop" data-filter-backdrop hidden></div>

          <aside class="inventory-filters card" id="inventory-filters-panel" aria-label="Filters" data-inventory-filters>
            <div class="inventory-filters__head">
              <h2 class="inventory-filters__title">Filters <span class="inventory-filters__count" data-filter-count hidden></span></h2>
              <div class="inventory-filters__head-actions">
                <button class="inventory-filters__clear" type="button" data-filter-clear hidden>clear filter</button>
                <button class="inventory-filters__close" type="button" data-filter-close aria-label="Close filters">×</button>
              </div>
            </div>

            <div class="inventory-filters__tags" data-filter-tags hidden></div>

            <div class="inventory-filters__groups">
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Make</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="make" value="toyota" /> Toyota</label>
                  <label class="inventory-check"><input type="checkbox" name="make" value="honda" /> Honda</label>
                  <label class="inventory-check"><input type="checkbox" name="make" value="audi" /> Audi</label>
                  <label class="inventory-check"><input type="checkbox" name="make" value="nissan" /> Nissan</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Model</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="model" value="highlander" /> Highlander</label>
                  <label class="inventory-check"><input type="checkbox" name="model" value="crv" /> CR-V</label>
                  <label class="inventory-check"><input type="checkbox" name="model" value="q5" /> Q5</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Type</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="type" value="suv" /> SUV</label>
                  <label class="inventory-check"><input type="checkbox" name="type" value="sedan" /> Sedan</label>
                  <label class="inventory-check"><input type="checkbox" name="type" value="coupe" /> Coupe</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Year</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="year" value="2024" /> 2024</label>
                  <label class="inventory-check"><input type="checkbox" name="year" value="2023" /> 2023</label>
                  <label class="inventory-check"><input type="checkbox" name="year" value="2022" /> 2022</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Price / Monthly Payment</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="price" value="under-25" /> Under $25,000</label>
                  <label class="inventory-check"><input type="checkbox" name="price" value="25-35" /> $25,000 – $35,000</label>
                  <label class="inventory-check"><input type="checkbox" name="price" value="over-35" /> Over $35,000</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Mileage</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="mileage" value="under-50" /> Under 50K mi</label>
                  <label class="inventory-check"><input type="checkbox" name="mileage" value="50-100" /> 50K – 100K mi</label>
                  <label class="inventory-check"><input type="checkbox" name="mileage" value="over-100" /> Over 100K mi</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Features</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="features" value="awd" /> AWD</label>
                  <label class="inventory-check"><input type="checkbox" name="features" value="leather" /> Leather Seats</label>
                  <label class="inventory-check"><input type="checkbox" name="features" value="sunroof" /> Sunroof</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Size</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="size" value="compact" /> Compact</label>
                  <label class="inventory-check"><input type="checkbox" name="size" value="mid" /> Mid-size</label>
                  <label class="inventory-check"><input type="checkbox" name="size" value="full" /> Full-size</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Exterior Color</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="ext_color" value="white" /> White</label>
                  <label class="inventory-check"><input type="checkbox" name="ext_color" value="black" /> Black</label>
                  <label class="inventory-check"><input type="checkbox" name="ext_color" value="silver" /> Silver</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Interior Color</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="int_color" value="black" /> Black</label>
                  <label class="inventory-check"><input type="checkbox" name="int_color" value="beige" /> Beige</label>
                  <label class="inventory-check"><input type="checkbox" name="int_color" value="gray" /> Gray</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Transmission</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="transmission" value="auto" /> Automatic</label>
                  <label class="inventory-check"><input type="checkbox" name="transmission" value="manual" /> Manual</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">Cylinders</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="cylinders" value="4" /> 4 Cylinder</label>
                  <label class="inventory-check"><input type="checkbox" name="cylinders" value="6" /> 6 Cylinder</label>
                  <label class="inventory-check"><input type="checkbox" name="cylinders" value="8" /> 8 Cylinder</label>
                </div>
              </details>
              <details class="inventory-filter-group">
                <summary class="inventory-filter-group__summary">MPG Highway</summary>
                <div class="inventory-filter-group__body">
                  <label class="inventory-check"><input type="checkbox" name="mpg" value="25" /> 25+ MPG</label>
                  <label class="inventory-check"><input type="checkbox" name="mpg" value="30" /> 30+ MPG</label>
                  <label class="inventory-check"><input type="checkbox" name="mpg" value="35" /> 35+ MPG</label>
                </div>
              </details>
            </div>
          </aside>

          <div class="inventory-results">
            <header class="inventory-results__head">
              <h2 class="inventory-results__title"><span class="inventory-results__total">926</span> Listings</h2>
              <div class="inventory-results__actions">
                <a class="inventory-results__compare" href="#">Compare</a>
                <span class="inventory-results__sort">
                  Sort By:
                  <button class="inventory-results__sort-btn" type="button" aria-haspopup="listbox">Best match</button>
                </span>
              </div>
            </header>

            <ul class="inventory-grid" data-inventory-grid></ul>

            <nav class="inventory-pagination" aria-label="Listings pagination" data-inventory-pagination hidden>
              <button class="inventory-pagination__btn inventory-pagination__btn--arrow" type="button" data-page-prev aria-label="Previous page" disabled>
                <span aria-hidden="true">‹</span>
              </button>
              <div class="inventory-pagination__pages" data-pagination-pages></div>
              <button class="inventory-pagination__btn inventory-pagination__btn--arrow" type="button" data-page-next aria-label="Next page">
                <span aria-hidden="true">›</span>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </section>

  </main>

 <?php include 'footer.php'; ?>