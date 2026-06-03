(function () {
  "use strict";

  const STORAGE_CURRENCY = "eisen-locale-currency";
  const STORAGE_RATE = "eisen-usd-jpy-rate";
  const STORAGE_RATE_TIME = "eisen-usd-jpy-rate-time";
  const CACHE_TTL_MS = 60 * 60 * 1000;
  const FALLBACK_RATE = 150;
  const API_URL = "https://api.frankfurter.app/latest?from=USD&to=JPY";

  let usdToJpy = FALLBACK_RATE;
  let currentCurrency = localStorage.getItem(STORAGE_CURRENCY) === "jpy" ? "jpy" : "usd";
  const priceNodes = [];

  let readyResolve;
  const ready = new Promise((resolve) => {
    readyResolve = resolve;
  });

  function getCachedRate() {
    const rate = Number(localStorage.getItem(STORAGE_RATE));
    const time = Number(localStorage.getItem(STORAGE_RATE_TIME));
    if (rate > 0 && time > 0 && Date.now() - time < CACHE_TTL_MS) {
      return rate;
    }
    return null;
  }

  function saveRate(rate) {
    localStorage.setItem(STORAGE_RATE, String(rate));
    localStorage.setItem(STORAGE_RATE_TIME, String(Date.now()));
  }

  async function fetchRate() {
    const cached = getCachedRate();
    if (cached) {
      usdToJpy = cached;
      return usdToJpy;
    }

    try {
      const response = await fetch(API_URL);
      if (!response.ok) throw new Error("Rate fetch failed");

      const data = await response.json();
      const rate = data.rates?.JPY;
      if (!rate) throw new Error("Missing JPY rate");

      usdToJpy = rate;
      saveRate(rate);
    } catch {
      const stale = Number(localStorage.getItem(STORAGE_RATE));
      usdToJpy = stale > 0 ? stale : FALLBACK_RATE;
    }

    return usdToJpy;
  }

  function formatUsd(amount) {
    return "$" + Number(amount).toLocaleString("en-US");
  }

  function formatJpy(amount) {
    return "¥" + Math.round(Number(amount) * usdToJpy).toLocaleString("en-US");
  }

  function formatPrice(usdAmount, currency) {
    const code = currency || currentCurrency;
    return code === "jpy" ? formatJpy(usdAmount) : formatUsd(usdAmount);
  }

  function registerNode(node, usdAmount) {
    if (!node || node.dataset.priceRegistered) return;

    node.dataset.priceRegistered = "1";
    node.dataset.priceUsd = String(usdAmount);
    priceNodes.push({ node, usdAmount: Number(usdAmount) });
    node.textContent = formatPrice(usdAmount);
  }

  function scanPrices(selector) {
    document.querySelectorAll(selector).forEach((node) => {
      if (node.dataset.priceUsd) {
        registerNode(node, node.dataset.priceUsd);
        return;
      }

      const match = node.textContent.match(/\$([\d,]+)/);
      if (match) registerNode(node, match[1].replace(/,/g, ""));
    });
  }

  function applyCurrency(currency) {
    currentCurrency = currency === "jpy" ? "jpy" : "usd";
    localStorage.setItem(STORAGE_CURRENCY, currentCurrency);
    document.documentElement.dataset.currency = currentCurrency;

    priceNodes.forEach(({ node, usdAmount }) => {
      node.textContent = formatPrice(usdAmount, currentCurrency);
    });

    document.dispatchEvent(
      new CustomEvent("eisen:currency-change", { detail: { currency: currentCurrency, rate: usdToJpy } })
    );
  }

  function getCurrency() {
    return currentCurrency;
  }

  function getRate() {
    return usdToJpy;
  }

  fetchRate().then(() => {
    readyResolve();
  });

  window.EisenCurrency = {
    ready,
    formatPrice,
    applyCurrency,
    getCurrency,
    getRate,
    registerNode,
    scanPrices,
  };
})();
