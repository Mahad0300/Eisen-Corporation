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
