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
  const checkboxes = [
    ...filtersPanel.querySelectorAll('.inventory-check input[type="checkbox"]:not([data-condition-input])'),
  ];
  const conditionInputs = [...filtersPanel.querySelectorAll("[data-condition-input]")];
  const priceRangeRoot = filtersPanel.querySelector("[data-price-range]");
  const priceMinInput = priceRangeRoot?.querySelector("[data-price-min-input]");
  const priceMaxInput = priceRangeRoot?.querySelector("[data-price-max-input]");
  const priceFill = priceRangeRoot?.querySelector("[data-price-fill]");
  const priceMinDisplay = priceRangeRoot?.querySelector("[data-price-min-display]");
  const priceMaxDisplay = priceRangeRoot?.querySelector("[data-price-max-display]");
  const yearMinSelect = filtersPanel.querySelector("[data-year-min-select]");
  const yearMaxSelect = filtersPanel.querySelector("[data-year-max-select]");
  const engineCcMinSelect = filtersPanel.querySelector("[data-engine-cc-min-select]");
  const engineCcMaxSelect = filtersPanel.querySelector("[data-engine-cc-max-select]");
  const mileageRangeRoot = filtersPanel.querySelector("[data-mileage-range]");
  const mileageMinInput = mileageRangeRoot?.querySelector("[data-mileage-min-input]");
  const mileageMaxInput = mileageRangeRoot?.querySelector("[data-mileage-max-input]");
  const mileageFill = mileageRangeRoot?.querySelector("[data-mileage-fill]");
  const mileageMinDisplay = mileageRangeRoot?.querySelector("[data-mileage-min-display]");
  const mileageMaxDisplay = mileageRangeRoot?.querySelector("[data-mileage-max-display]");

  if (!tagsContainer || !countEl || !clearBtn) return;

  const MOBILE_MQ = window.matchMedia("(max-width: 1023px)");
  const PRICE_ABS_MIN = priceRangeRoot ? Number(priceRangeRoot.dataset.priceMin) || 5000 : 5000;
  const PRICE_ABS_MAX = priceRangeRoot ? Number(priceRangeRoot.dataset.priceMax) || 80000 : 80000;
  const PRICE_STEP = priceRangeRoot ? Number(priceRangeRoot.dataset.priceStep) || 1000 : 1000;
  const MILEAGE_ABS_MIN = mileageRangeRoot ? Number(mileageRangeRoot.dataset.mileageMin) || 0 : 0;
  const MILEAGE_ABS_MAX = mileageRangeRoot ? Number(mileageRangeRoot.dataset.mileageMax) || 300 : 300;
  const MILEAGE_STEP = mileageRangeRoot ? Number(mileageRangeRoot.dataset.mileageStep) || 5 : 5;

  function t(key) {
    if (window.EisenI18n && typeof window.EisenI18n.t === "function") {
      const lang = document.documentElement.lang === "ja" ? "ja" : "en";
      return window.EisenI18n.t(key, lang);
    }
    return key;
  }

  function getFilterLabel(input) {
    const label = input.closest(".inventory-check");
    if (!label) return input.value;
    const textEl = label.querySelector("[data-i18n]") || label.querySelector("span");
    return textEl ? textEl.textContent.trim() : label.textContent.trim();
  }

  function getFilterId(input) {
    return `${input.name}:${input.value}`;
  }

  function getActiveFilters() {
    return checkboxes.filter((input) => input.checked);
  }

  function formatPriceAmount(amount) {
    if (window.EisenCurrency) {
      return window.EisenCurrency.formatPrice(amount, window.EisenCurrency.getCurrency());
    }
    return "$" + Number(amount).toLocaleString("en-US");
  }

  function isPriceRangeActive() {
    if (!priceMinInput || !priceMaxInput) return false;
    const min = Number(priceMinInput.value);
    const max = Number(priceMaxInput.value);
    return min > PRICE_ABS_MIN || max < PRICE_ABS_MAX;
  }

  function getPriceRangeLabel() {
    if (!priceMinInput || !priceMaxInput) return "";
    return `${formatPriceAmount(priceMinInput.value)} – ${formatPriceAmount(priceMaxInput.value)}`;
  }

  function updatePriceRangeUi() {
    if (!priceMinInput || !priceMaxInput || !priceFill) return;

    let min = Number(priceMinInput.value);
    let max = Number(priceMaxInput.value);

    if (min > max - PRICE_STEP) {
      if (document.activeElement === priceMinInput) {
        min = max - PRICE_STEP;
        priceMinInput.value = String(min);
      } else {
        max = min + PRICE_STEP;
        priceMaxInput.value = String(max);
      }
    }

    const range = PRICE_ABS_MAX - PRICE_ABS_MIN;
    const left = ((min - PRICE_ABS_MIN) / range) * 100;
    const right = ((max - PRICE_ABS_MIN) / range) * 100;

    priceFill.style.left = `${left}%`;
    priceFill.style.width = `${right - left}%`;

    if (priceMinDisplay) priceMinDisplay.textContent = formatPriceAmount(min);
    if (priceMaxDisplay) priceMaxDisplay.textContent = formatPriceAmount(max);
  }

  function resetPriceRange() {
    if (!priceMinInput || !priceMaxInput) return;
    priceMinInput.value = String(PRICE_ABS_MIN);
    priceMaxInput.value = String(PRICE_ABS_MAX);
    updatePriceRangeUi();
  }

  function getLang() {
    return document.documentElement.lang === "ja" ? "ja" : "en";
  }

  function formatMileageK(k) {
    const value = Number(k);
    if (getLang() === "ja") {
      const man = (value / 10).toFixed(1);
      return t("inventory.mileageRangeUnit").replace("{value}", man);
    }
    return t("inventory.mileageRangeUnit").replace("{value}", String(value));
  }

  function isMileageRangeActive() {
    if (!mileageMinInput || !mileageMaxInput) return false;
    const min = Number(mileageMinInput.value);
    const max = Number(mileageMaxInput.value);
    return min > MILEAGE_ABS_MIN || max < MILEAGE_ABS_MAX;
  }

  function getMileageRangeLabel() {
    if (!mileageMinInput || !mileageMaxInput) return "";
    return `${formatMileageK(mileageMinInput.value)} – ${formatMileageK(mileageMaxInput.value)}`;
  }

  function updateMileageRangeUi() {
    if (!mileageMinInput || !mileageMaxInput || !mileageFill) return;

    let min = Number(mileageMinInput.value);
    let max = Number(mileageMaxInput.value);

    if (min > max - MILEAGE_STEP) {
      if (document.activeElement === mileageMinInput) {
        min = max - MILEAGE_STEP;
        mileageMinInput.value = String(min);
      } else {
        max = min + MILEAGE_STEP;
        mileageMaxInput.value = String(max);
      }
    }

    const range = MILEAGE_ABS_MAX - MILEAGE_ABS_MIN;
    const left = ((min - MILEAGE_ABS_MIN) / range) * 100;
    const right = ((max - MILEAGE_ABS_MIN) / range) * 100;

    mileageFill.style.left = `${left}%`;
    mileageFill.style.width = `${right - left}%`;

    if (mileageMinDisplay) mileageMinDisplay.textContent = formatMileageK(min);
    if (mileageMaxDisplay) mileageMaxDisplay.textContent = formatMileageK(max);
  }

  function resetMileageRange() {
    if (!mileageMinInput || !mileageMaxInput) return;
    mileageMinInput.value = String(MILEAGE_ABS_MIN);
    mileageMaxInput.value = String(MILEAGE_ABS_MAX);
    updateMileageRangeUi();
  }

  function isYearRangeActive() {
    if (!yearMinSelect || !yearMaxSelect) return false;
    return yearMinSelect.value !== "" || yearMaxSelect.value !== "";
  }

  function syncYearRange() {
    if (!yearMinSelect || !yearMaxSelect) return;

    const min = yearMinSelect.value ? Number(yearMinSelect.value) : null;
    const max = yearMaxSelect.value ? Number(yearMaxSelect.value) : null;

    if (min !== null && max !== null && min > max) {
      if (document.activeElement === yearMinSelect) {
        yearMaxSelect.value = String(min);
      } else {
        yearMinSelect.value = String(max);
      }
    }
  }

  function getYearRangeLabel() {
    if (!yearMinSelect || !yearMaxSelect) return "";

    const min = yearMinSelect.value;
    const max = yearMaxSelect.value;

    if (min && max) return `${min} – ${max}`;
    if (min) return `${min}+`;
    if (max) return `– ${max}`;
    return "";
  }

  function resetYearRange() {
    if (!yearMinSelect || !yearMaxSelect) return;
    yearMinSelect.value = "";
    yearMaxSelect.value = "";
  }

  function formatEngineCc(cc) {
    const value = Number(cc);
    const formatted = value.toLocaleString(getLang() === "ja" ? "ja-JP" : "en-US");
    return t("inventory.engineCcUnit").replace("{value}", formatted);
  }

  function updateEngineCcSelectLabels() {
    if (!engineCcMinSelect || !engineCcMaxSelect) return;
    [engineCcMinSelect, engineCcMaxSelect].forEach((select) => {
      [...select.options].forEach((opt) => {
        if (!opt.value) return;
        opt.textContent = formatEngineCc(opt.value);
      });
    });
  }

  function isEngineCcRangeActive() {
    if (!engineCcMinSelect || !engineCcMaxSelect) return false;
    return engineCcMinSelect.value !== "" || engineCcMaxSelect.value !== "";
  }

  function syncEngineCcRange() {
    if (!engineCcMinSelect || !engineCcMaxSelect) return;

    const min = engineCcMinSelect.value ? Number(engineCcMinSelect.value) : null;
    const max = engineCcMaxSelect.value ? Number(engineCcMaxSelect.value) : null;

    if (min !== null && max !== null && min > max) {
      if (document.activeElement === engineCcMinSelect) {
        engineCcMaxSelect.value = String(min);
      } else {
        engineCcMinSelect.value = String(max);
      }
    }
  }

  function getEngineCcRangeLabel() {
    if (!engineCcMinSelect || !engineCcMaxSelect) return "";

    const min = engineCcMinSelect.value;
    const max = engineCcMaxSelect.value;

    if (min && max) return `${formatEngineCc(min)} – ${formatEngineCc(max)}`;
    if (min) return `${formatEngineCc(min)}+`;
    if (max) return `– ${formatEngineCc(max)}`;
    return "";
  }

  function resetEngineCcRange() {
    if (!engineCcMinSelect || !engineCcMaxSelect) return;
    engineCcMinSelect.value = "";
    engineCcMaxSelect.value = "";
  }

  function getConditionValue() {
    const active = conditionInputs.find((input) => input.checked && input.value !== "all");
    return active ? active.value : "";
  }

  function isConditionActive() {
    return getConditionValue() !== "";
  }

  function getConditionLabel() {
    const active = conditionInputs.find((input) => input.checked && input.value !== "all");
    if (!active) return "";
    const textEl = active.closest(".inventory-check")?.querySelector("[data-i18n]") || active.closest(".inventory-check")?.querySelector("span");
    return textEl ? textEl.textContent.trim() : active.value;
  }

  function setConditionValue(value) {
    const next = value || "all";
    conditionInputs.forEach((input) => {
      input.checked = input.value === next;
    });
  }

  function resetCondition() {
    setConditionValue("all");
  }

  function handleConditionChange(changedInput) {
    if (!conditionInputs.length) return;

    if (changedInput.value === "all" && changedInput.checked) {
      conditionInputs.forEach((input) => {
        if (input.value !== "all") input.checked = false;
      });
    } else if (changedInput.checked) {
      conditionInputs.forEach((input) => {
        if (input === changedInput) return;
        input.checked = false;
      });
      if (!conditionInputs.some((input) => input.checked)) {
        const allInput = conditionInputs.find((input) => input.value === "all");
        if (allInput) allInput.checked = true;
      }
    } else if (!conditionInputs.some((input) => input.checked)) {
      const allInput = conditionInputs.find((input) => input.value === "all");
      if (allInput) allInput.checked = true;
    }

    renderTags();
  }

  function getActiveFilterCount() {
    return (
      getActiveFilters().length +
      (isConditionActive() ? 1 : 0) +
      (isPriceRangeActive() ? 1 : 0) +
      (isMileageRangeActive() ? 1 : 0) +
      (isYearRangeActive() ? 1 : 0) +
      (isEngineCcRangeActive() ? 1 : 0)
    );
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

    if (isConditionActive()) {
      const conditionLabel = `${t("inventory.conditionTag")}: ${getConditionLabel()}`;
      const conditionTag = document.createElement("button");
      conditionTag.type = "button";
      conditionTag.className = "inventory-tag";
      conditionTag.dataset.filterId = "condition";
      conditionTag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${conditionLabel} ${t("inventory.filter.suffix")}`
      );
      conditionTag.innerHTML = `${conditionLabel} <span aria-hidden="true">×</span>`;
      conditionTag.addEventListener("click", () => {
        resetCondition();
        renderTags();
      });
      tagsContainer.appendChild(conditionTag);
    }

    if (isEngineCcRangeActive()) {
      const ccLabel = `${t("inventory.engineCcTag")}: ${getEngineCcRangeLabel()}`;
      const ccTag = document.createElement("button");
      ccTag.type = "button";
      ccTag.className = "inventory-tag";
      ccTag.dataset.filterId = "engine-cc-range";
      ccTag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${ccLabel} ${t("inventory.filter.suffix")}`
      );
      ccTag.innerHTML = `${ccLabel} <span aria-hidden="true">×</span>`;
      ccTag.addEventListener("click", () => {
        resetEngineCcRange();
        renderTags();
      });
      tagsContainer.appendChild(ccTag);
    }

    if (isYearRangeActive()) {
      const yearLabel = `${t("inventory.yearRangeTag")}: ${getYearRangeLabel()}`;
      const yearTag = document.createElement("button");
      yearTag.type = "button";
      yearTag.className = "inventory-tag";
      yearTag.dataset.filterId = "year-range";
      yearTag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${yearLabel} ${t("inventory.filter.suffix")}`
      );
      yearTag.innerHTML = `${yearLabel} <span aria-hidden="true">×</span>`;
      yearTag.addEventListener("click", () => {
        resetYearRange();
        renderTags();
      });
      tagsContainer.appendChild(yearTag);
    }

    if (isMileageRangeActive()) {
      const mileageLabel = `${t("inventory.mileageRangeTag")}: ${getMileageRangeLabel()}`;
      const mileageTag = document.createElement("button");
      mileageTag.type = "button";
      mileageTag.className = "inventory-tag";
      mileageTag.dataset.filterId = "mileage-range";
      mileageTag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${mileageLabel} ${t("inventory.filter.suffix")}`
      );
      mileageTag.innerHTML = `${mileageLabel} <span aria-hidden="true">×</span>`;
      mileageTag.addEventListener("click", () => {
        resetMileageRange();
        renderTags();
      });
      tagsContainer.appendChild(mileageTag);
    }

    if (isPriceRangeActive()) {
      const priceLabel = `${t("inventory.priceRangeTag")}: ${getPriceRangeLabel()}`;
      const priceTag = document.createElement("button");
      priceTag.type = "button";
      priceTag.className = "inventory-tag";
      priceTag.dataset.filterId = "price-range";
      priceTag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${priceLabel} ${t("inventory.filter.suffix")}`
      );
      priceTag.innerHTML = `${priceLabel} <span aria-hidden="true">×</span>`;
      priceTag.addEventListener("click", () => {
        resetPriceRange();
        renderTags();
      });
      tagsContainer.appendChild(priceTag);
    }

    active.forEach((input) => {
      const id = getFilterId(input);
      const label = getFilterLabel(input);
      const tag = document.createElement("button");
      tag.type = "button";
      tag.className = "inventory-tag";
      tag.dataset.filterId = id;
      tag.setAttribute(
        "aria-label",
        `${t("inventory.filter.remove")} ${label} ${t("inventory.filter.suffix")}`
      );
      tag.innerHTML = `${label} <span aria-hidden="true">×</span>`;

      tag.addEventListener("click", () => {
        input.checked = false;
        renderTags();
      });

      tagsContainer.appendChild(tag);
    });

    const totalActive = getActiveFilterCount();
    tagsContainer.hidden = totalActive === 0;
    updateCount(totalActive);
  }

  checkboxes.forEach((input) => {
    input.addEventListener("change", renderTags);
  });

  clearBtn.addEventListener("click", () => {
    checkboxes.forEach((input) => {
      input.checked = false;
    });
    resetPriceRange();
    resetMileageRange();
    resetYearRange();
    resetEngineCcRange();
    resetCondition();
    renderTags();
  });

  conditionInputs.forEach((input) => {
    input.addEventListener("change", () => handleConditionChange(input));
  });

  if (conditionToolbar) {
    conditionToolbar.addEventListener("change", () => {
      const value = conditionToolbar.value;
      if (value === "") {
        setConditionValue("all");
      } else {
        setConditionValue(value);
      }
      renderTags();
    });
  }

  if (yearMinSelect && yearMaxSelect) {
    yearMinSelect.addEventListener("change", () => {
      syncYearRange();
      renderTags();
    });
    yearMaxSelect.addEventListener("change", () => {
      syncYearRange();
      renderTags();
    });
  }

  if (engineCcMinSelect && engineCcMaxSelect) {
    engineCcMinSelect.addEventListener("change", () => {
      syncEngineCcRange();
      renderTags();
    });
    engineCcMaxSelect.addEventListener("change", () => {
      syncEngineCcRange();
      renderTags();
    });
  }

  if (priceMinInput && priceMaxInput) {
    priceMinInput.addEventListener("input", () => {
      updatePriceRangeUi();
      renderTags();
    });
    priceMaxInput.addEventListener("input", () => {
      updatePriceRangeUi();
      renderTags();
    });
    updatePriceRangeUi();
  }

  if (mileageMinInput && mileageMaxInput) {
    mileageMinInput.addEventListener("input", () => {
      updateMileageRangeUi();
      renderTags();
    });
    mileageMaxInput.addEventListener("input", () => {
      updateMileageRangeUi();
      renderTags();
    });
    updateMileageRangeUi();
  }

  document.addEventListener("eisen:currency-change", () => {
    updatePriceRangeUi();
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

  document.addEventListener("eisen:language-change", () => {
    updatePriceRangeUi();
    updateMileageRangeUi();
    updateEngineCcSelectLabels();
    renderTags();
  });

  updateEngineCcSelectLabels();
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

  const MAKES = [
    "Toyota", "Honda", "Nissan", "Mazda", "Subaru", "Suzuki", "Mitsubishi", "Daihatsu",
    "BMW", "Mercedes", "Audi", "Volkswagen", "Volvo", "Porsche", "Lexus",
    "Ford", "Isuzu", "Hino",
  ];
  const MODELS = ["Highlander XLE", "CR-V EX-L", "Q5 Premium", "Rogue SV", "Mustang GT", "X5 xDrive", "Wrangler", "Acadia", "QX50"];
  const CITY_KEYS = ["tokyo", "osaka", "yokohama", "nagoya", "fukuoka", "sapporo", "kobe", "kyoto", "hiroshima"];
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
    const mileageK = 18 + (index % 140);
    const cityKey = CITY_KEYS[index % CITY_KEYS.length];

    return {
      make,
      model,
      priceUsd: price,
      mileageK,
      cityKey,
      image: IMAGES[index % IMAGES.length],
      alt: `${make} ${model}`,
    };
  });

  const totalPages = Math.ceil(TOTAL_LISTINGS / PER_PAGE);
  let currentPage = 1;

  function getLang() {
    return document.documentElement.lang === "ja" ? "ja" : "en";
  }

  function t(key) {
    if (window.EisenI18n && typeof window.EisenI18n.t === "function") {
      return window.EisenI18n.t(key, getLang());
    }
    return key;
  }

  function formatMileage(k) {
    if (getLang() === "ja") {
      const man = (k / 10).toFixed(1);
      return t("inventory.mileageUnit").replace("{value}", man);
    }
    return t("inventory.mileageUnit").replace("{value}", String(k));
  }

  function formatLocation(cityKey) {
    const city = t(`inventory.city.${cityKey}`);
    return t("inventory.location").replace("{city}", city);
  }

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
    const mileage = formatMileage(item.mileageK);
    const location = formatLocation(item.cityKey);

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
              <p class="inventory-card__price-line"><strong>${escapeHtml(formatListingPrice(item.priceUsd))}</strong> · ${escapeHtml(mileage)}</p>
              <p class="inventory-card__location">${escapeHtml(location)}</p>
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

  document.addEventListener("eisen:language-change", () => {
    renderCards();
  });

  if (window.EisenCurrency) {
    window.EisenCurrency.ready.then(initListingGrid);
    document.addEventListener("eisen:currency-change", renderCards);
  } else {
    initListingGrid();
  }
})();
