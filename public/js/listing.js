/* Listing page — filters UI */
(function () {
  "use strict";

  const filtersPanel = document.querySelector("[data-inventory-filters]");
  if (!filtersPanel) return;

  const tagsContainer = filtersPanel.querySelector("[data-filter-tags]");
  const countEl = filtersPanel.querySelector("[data-filter-count]");
  const clearBtn = filtersPanel.querySelector("[data-filter-clear]");
  const toggleBtn = document.querySelector("[data-filter-toggle]");
  const toggleCountEl = document.querySelector("[data-filter-toggle-count]");
  const backdrop = document.querySelector("[data-filter-backdrop]");
  const closeBtn = filtersPanel.querySelector("[data-filter-close]");
  const checkboxes = [...filtersPanel.querySelectorAll('.inventory-check input[type="checkbox"]')];

  if (!tagsContainer || !countEl || !clearBtn || !checkboxes.length) return;

  const MOBILE_MQ = window.matchMedia("(max-width: 1023px)");

  function getFilterLabel(input) {
    const label = input.closest(".inventory-check");
    return label ? label.textContent.trim() : input.value;
  }

  function getFilterId(input) {
    return `${input.name}:${input.value}`;
  }

  function getActiveFilters() {
    return checkboxes.filter((input) => input.checked);
  }

  function updateCount(count) {
    const countText = count > 0 ? `(${count})` : "";

    if (count > 0) {
      countEl.hidden = false;
      countEl.textContent = countText;
    } else {
      countEl.hidden = true;
      countEl.textContent = "";
    }

    if (toggleCountEl) {
      toggleCountEl.hidden = count === 0;
      toggleCountEl.textContent = countText;
    }

    clearBtn.hidden = count === 0;
  }

  function openFilters() {
    filtersPanel.classList.add("is-open");
    toggleBtn?.setAttribute("aria-expanded", "true");
    backdrop?.removeAttribute("hidden");
    document.body.style.overflow = "hidden";
  }

  function closeFilters() {
    filtersPanel.classList.remove("is-open");
    toggleBtn?.setAttribute("aria-expanded", "false");
    backdrop?.setAttribute("hidden", "");
    document.body.style.overflow = "";
  }

  function renderTags() {
    const active = getActiveFilters();
    tagsContainer.innerHTML = "";

    active.forEach((input) => {
      const id = getFilterId(input);
      const label = getFilterLabel(input);
      const tag = document.createElement("button");
      tag.type = "button";
      tag.className = "inventory-tag";
      tag.dataset.filterId = id;
      tag.setAttribute("aria-label", `Remove ${label} filter`);
      tag.innerHTML = `${label} <span aria-hidden="true">×</span>`;

      tag.addEventListener("click", () => {
        input.checked = false;
        renderTags();
      });

      tagsContainer.appendChild(tag);
    });

    tagsContainer.hidden = active.length === 0;
    updateCount(active.length);
  }

  checkboxes.forEach((input) => {
    input.addEventListener("change", renderTags);
  });

  clearBtn.addEventListener("click", () => {
    checkboxes.forEach((input) => {
      input.checked = false;
    });
    renderTags();
  });

  toggleBtn?.addEventListener("click", () => {
    if (filtersPanel.classList.contains("is-open")) {
      closeFilters();
    } else {
      openFilters();
    }
  });

  closeBtn?.addEventListener("click", closeFilters);
  backdrop?.addEventListener("click", closeFilters);

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && filtersPanel.classList.contains("is-open")) {
      closeFilters();
    }
  });

  MOBILE_MQ.addEventListener("change", () => {
    if (!MOBILE_MQ.matches) {
      closeFilters();
    }
  });

  renderTags();
})();

/* Listing page — grid + pagination */
(function () {
  "use strict";

  const PER_PAGE = 9;
  const TOTAL_LISTINGS = 926;

  const grid = document.querySelector("[data-inventory-grid]");
  const pagination = document.querySelector("[data-inventory-pagination]");
  const pagesContainer = document.querySelector("[data-pagination-pages]");
  const prevBtn = document.querySelector("[data-page-prev]");
  const nextBtn = document.querySelector("[data-page-next]");

  if (!grid || !pagination || !pagesContainer || !prevBtn || !nextBtn) return;

  const MAKES = ["Toyota", "Honda", "Audi", "Nissan", "Ford", "BMW", "Jeep", "GMC", "Infiniti"];
  const MODELS = ["Highlander XLE", "CR-V EX-L", "Q5 Premium", "Rogue SV", "Mustang GT", "X5 xDrive", "Wrangler", "Acadia", "QX50"];
  const CITIES = ["Tokyo", "Osaka", "Yokohama", "Nagoya", "Fukuoka", "Sapporo", "Kobe", "Kyoto", "Hiroshima"];
  const IMAGES = [
    "https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=600&q=80",
    "https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&q=80",
    "https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80",
    "https://images.unsplash.com/photo-1533473357862-305d7748521b?w=600&q=80",
    "https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80",
    "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&q=80",
    "https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80",
    "https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=600&q=80",
    "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=600&q=80",
  ];

  const listings = Array.from({ length: TOTAL_LISTINGS }, (_, index) => {
    const make = MAKES[index % MAKES.length];
    const model = MODELS[index % MODELS.length];
    const price = 19998 + (index % 120) * 250;
    const mileage = 18 + (index % 140);
    const city = CITIES[index % CITIES.length];

    return {
      make,
      model,
      priceUsd: price,
      mileage: `${mileage}K mi`,
      location: `Available at Eisen ${city}, Japan`,
      image: IMAGES[index % IMAGES.length],
      alt: `${make} ${model}`,
    };
  });

  const totalPages = Math.ceil(TOTAL_LISTINGS / PER_PAGE);
  let currentPage = 1;

  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");
  }

  function formatListingPrice(usdAmount) {
    if (window.EisenCurrency) {
      return window.EisenCurrency.formatPrice(usdAmount, window.EisenCurrency.getCurrency());
    }
    return "$" + Number(usdAmount).toLocaleString("en-US");
  }

  function renderCard(item) {
    return `
      <li>
        <article class="inventory-card">
          <a href="${(window.BASE_URL || "") + "/product"}" class="inventory-card__link">
            <div class="inventory-card__media">
              <img src="${item.image}" alt="${escapeHtml(item.alt)}" width="600" height="400" loading="lazy" />
            </div>
            <div class="inventory-card__body">
              <span class="inventory-card__make">${escapeHtml(item.make)}</span>
              <h3 class="inventory-card__model">${escapeHtml(item.model)}</h3>
              <p class="inventory-card__price-line"><strong>${escapeHtml(formatListingPrice(item.priceUsd))}</strong> · ${escapeHtml(item.mileage)}</p>
              <p class="inventory-card__location">${escapeHtml(item.location)}</p>
            </div>
          </a>
        </article>
      </li>
    `;
  }

  function getPageItems(page, total) {
    if (total <= 7) {
      return Array.from({ length: total }, (_, i) => i + 1);
    }

    const items = new Set([1, total, page, page - 1, page + 1]);
    const sorted = [...items].filter((n) => n >= 1 && n <= total).sort((a, b) => a - b);
    const result = [];

    sorted.forEach((num, index) => {
      if (index > 0 && num - sorted[index - 1] > 1) {
        result.push("…");
      }
      result.push(num);
    });

    return result;
  }

  function renderCards() {
    const start = (currentPage - 1) * PER_PAGE;
    const slice = listings.slice(start, start + PER_PAGE);
    grid.innerHTML = slice.map(renderCard).join("");
  }

  function renderPagination() {
    const items = getPageItems(currentPage, totalPages);

    pagesContainer.innerHTML = items
      .map((item) => {
        if (item === "…") {
          return `<span class="inventory-pagination__ellipsis" aria-hidden="true">…</span>`;
        }

        const isActive = item === currentPage;
        return `
          <button
            class="inventory-pagination__btn inventory-pagination__btn--page${isActive ? " is-active" : ""}"
            type="button"
            data-page="${item}"
            ${isActive ? 'aria-current="page"' : ""}
          >${item}</button>
        `;
      })
      .join("");

    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
  }

  function goToPage(page) {
    const nextPage = Math.min(Math.max(1, page), totalPages);
    if (nextPage === currentPage) return;

    currentPage = nextPage;
    renderCards();
    renderPagination();

    const resultsHead = document.querySelector(".inventory-results__head");
    if (resultsHead) {
      resultsHead.scrollIntoView({ behavior: "smooth", block: "nearest" });
    }
  }

  pagesContainer.addEventListener("click", (event) => {
    const btn = event.target.closest("[data-page]");
    if (!btn) return;
    goToPage(Number(btn.getAttribute("data-page")));
  });

  prevBtn.addEventListener("click", () => goToPage(currentPage - 1));
  nextBtn.addEventListener("click", () => goToPage(currentPage + 1));

  function initListingGrid() {
    renderCards();
    renderPagination();
    pagination.hidden = false;
  }

  if (window.EisenCurrency) {
    window.EisenCurrency.ready.then(initListingGrid);
    document.addEventListener("eisen:currency-change", renderCards);
  } else {
    initListingGrid();
  }
})();
