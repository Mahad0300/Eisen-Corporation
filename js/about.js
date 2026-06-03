(function () {
  "use strict";

  const section = document.querySelector("[data-about-stats]");
  if (!section) return;

  const counters = [...section.querySelectorAll("[data-counter]")];
  if (!counters.length) return;

  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function formatValue(value, useComma) {
    const rounded = Math.round(value);
    return useComma ? rounded.toLocaleString("en-US") : String(rounded);
  }

  function setFinalValues() {
    counters.forEach((el) => {
      const target = Number(el.dataset.counterTarget) || 0;
      const suffix = el.dataset.counterSuffix || "";
      const useComma = el.dataset.counterComma === "true";
      el.textContent = formatValue(target, useComma) + suffix;
    });
  }

  function animateCounter(el) {
    if (el.dataset.counterDone === "true") return;
    el.dataset.counterDone = "true";

    const target = Number(el.dataset.counterTarget) || 0;
    const suffix = el.dataset.counterSuffix || "";
    const useComma = el.dataset.counterComma === "true";
    const duration = 1800;
    const startTime = performance.now();

    function tick(now) {
      const progress = Math.min((now - startTime) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = target * eased;
      el.textContent = formatValue(current, useComma) + suffix;

      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        el.textContent = formatValue(target, useComma) + suffix;
      }
    }

    requestAnimationFrame(tick);
  }

  function runCounters() {
    counters.forEach(animateCounter);
  }

  if (reducedMotion) {
    setFinalValues();
    return;
  }

  if (!("IntersectionObserver" in window)) {
    runCounters();
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        runCounters();
        observer.disconnect();
      });
    },
    { threshold: 0.35 }
  );

  observer.observe(section);
})();
