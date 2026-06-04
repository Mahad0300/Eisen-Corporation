(function () {
  "use strict";

  const root = document.querySelector("[data-price-calc-days]");
  const priceCells = [...document.querySelectorAll("[data-price-jpy]")];
  const priceColHeaders = [...document.querySelectorAll("[data-price-calc-col-price]")];

  function getLang() {
    return document.documentElement.lang === "ja" ? "ja" : "en";
  }

  function t(key) {
    if (window.EisenI18n && typeof window.EisenI18n.t === "function") {
      return window.EisenI18n.t(key, getLang());
    }
    return key;
  }

  function updatePriceColumnHeaders() {
    if (!priceColHeaders.length || !window.EisenCurrency) return;
    const key =
      window.EisenCurrency.getCurrency() === "jpy" ? "priceCalc.col.priceJpy" : "priceCalc.col.priceUsd";
    priceColHeaders.forEach((el) => {
      el.textContent = t(key);
      el.setAttribute("data-i18n", key);
    });
  }

  function applyDeliveryPrices() {
    if (!window.EisenCurrency || !priceCells.length) return;

    const currency = window.EisenCurrency.getCurrency();
    priceCells.forEach((cell) => {
      const jpy = Number(cell.dataset.priceJpy);
      if (!Number.isFinite(jpy)) return;
      cell.textContent = window.EisenCurrency.formatFromJpy(jpy, currency);
    });
    updatePriceColumnHeaders();
  }

  if (root) {
    const dayBtns = [...root.querySelectorAll("[data-price-calc-day]")];
    const panels = [...document.querySelectorAll("[data-price-calc-panel]")];

    function activateDay(dayId) {
      dayBtns.forEach((btn) => {
        const active = btn.dataset.priceCalcDay === dayId;
        btn.classList.toggle("is-active", active);
        btn.setAttribute("aria-selected", active ? "true" : "false");
      });

      panels.forEach((panel) => {
        const active = panel.dataset.priceCalcPanel === dayId;
        panel.classList.toggle("is-active", active);
        if (active) {
          panel.removeAttribute("hidden");
        } else {
          panel.setAttribute("hidden", "");
        }
      });
    }

    dayBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        activateDay(btn.dataset.priceCalcDay);
      });
    });
  }

  function initPrices() {
    applyDeliveryPrices();
  }

  if (window.EisenCurrency) {
    window.EisenCurrency.ready.then(initPrices);
    document.addEventListener("eisen:currency-change", applyDeliveryPrices);
  }

  document.addEventListener("eisen:language-change", () => {
    updatePriceColumnHeaders();
  });
})();
