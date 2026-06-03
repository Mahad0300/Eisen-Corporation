(function () {
  "use strict";

  const yearEl = document.querySelector("[data-year]");
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());

  /* Mobile navigation */
  const navToggle = document.querySelector(".nav-toggle");
  const siteNav = document.querySelector(".site-nav");

  if (navToggle && siteNav) {
    navToggle.addEventListener("click", () => {
      const open = navToggle.getAttribute("aria-expanded") === "true";
      navToggle.setAttribute("aria-expanded", String(!open));
      siteNav.classList.toggle("is-open", !open);
    });

    siteNav.querySelectorAll(".site-nav__link").forEach((link) => {
      link.addEventListener("click", () => {
        navToggle.setAttribute("aria-expanded", "false");
        siteNav.classList.remove("is-open");
      });
    });
  }

  /* Directory tabs */
  const directoryTabs = document.querySelector("[data-directory-tabs]");
  if (directoryTabs) {
    const tabButtons = [...directoryTabs.querySelectorAll(".directory-tabs__btn")];
    const panels = [...directoryTabs.querySelectorAll(".directory-panel")];

    tabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-tab");
        if (!id) return;

        tabButtons.forEach((b) => {
          const active = b === btn;
          b.classList.toggle("is-active", active);
          b.setAttribute("aria-selected", String(active));
        });

        panels.forEach((panel) => {
          const active = panel.getAttribute("data-panel") === id;
          panel.classList.toggle("is-active", active);
          panel.hidden = !active;
        });
      });
    });
  }

  /* Hero slider */
  const slider = document.querySelector("[data-slider]");
  if (!slider) return;

  const slides = [...slider.querySelectorAll(".hero-slide")];
  const dots = [...slider.querySelectorAll(".hero-slider__dot")];
  const prevBtn = slider.querySelector("[data-prev]");
  const nextBtn = slider.querySelector("[data-next]");
  let index = 0;
  let timer = null;
  const INTERVAL = 6000;

  function goTo(i) {
    index = (i + slides.length) % slides.length;

    slides.forEach((slide, n) => {
      const active = n === index;
      slide.classList.toggle("is-active", active);
      slide.hidden = !active;
    });

    dots.forEach((dot, n) => {
      const active = n === index;
      dot.classList.toggle("is-active", active);
      dot.setAttribute("aria-selected", String(active));
    });
  }

  function next() {
    goTo(index + 1);
  }

  function prev() {
    goTo(index - 1);
  }

  function startAutoplay() {
    stopAutoplay();
    timer = window.setInterval(next, INTERVAL);
  }

  function stopAutoplay() {
    if (timer) {
      window.clearInterval(timer);
      timer = null;
    }
  }

  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      const i = Number(dot.getAttribute("data-goto"));
      if (!Number.isNaN(i)) {
        goTo(i);
        startAutoplay();
      }
    });
  });

  prevBtn?.addEventListener("click", () => {
    prev();
    startAutoplay();
  });

  nextBtn?.addEventListener("click", () => {
    next();
    startAutoplay();
  });

  slider.addEventListener("mouseenter", stopAutoplay);
  slider.addEventListener("mouseleave", startAutoplay);
  slider.addEventListener("focusin", stopAutoplay);
  slider.addEventListener("focusout", startAutoplay);

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) stopAutoplay();
    else startAutoplay();
  });

  goTo(0);
  startAutoplay();
})();
