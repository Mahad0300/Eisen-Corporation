(function () {
  "use strict";

  const page = document.querySelector(".blog-page");
  if (!page) return;

  const cards = [...page.querySelectorAll("[data-blog-card]")];
  const grid = page.querySelector("[data-blog-grid]");
  const emptyMsg = page.querySelector("[data-blog-empty]");
  const countNum = page.querySelector("[data-blog-count-num]");
  const searchInput = page.querySelector("[data-blog-search]");
  const searchForm = page.querySelector("[data-blog-search-form]");
  const filterBtns = [...page.querySelectorAll("[data-category-filter]")];

  let activeCategory = "all";
  let searchQuery = "";

  function normalize(text) {
    return (text || "").toLowerCase().trim();
  }

  function cardMatches(card) {
    const category = card.dataset.category || "";
    const text = normalize(card.textContent);
    const categoryOk = activeCategory === "all" || category === activeCategory;
    const searchOk = !searchQuery || text.includes(searchQuery);
    return categoryOk && searchOk;
  }

  function setActiveButtons(key) {
    filterBtns.forEach((btn) => {
      const match = btn.dataset.categoryFilter === key;
      btn.classList.toggle("is-active", match);
    });
  }

  function applyFilters() {
    let visible = 0;

    cards.forEach((card) => {
      const show = cardMatches(card);
      card.classList.toggle("is-hidden", !show);
      if (show) visible += 1;
    });

    if (countNum) countNum.textContent = String(visible);
    if (emptyMsg) emptyMsg.hidden = visible > 0;
    if (grid) grid.hidden = visible === 0 && cards.length > 0;
  }

  function setCategory(key) {
    activeCategory = key || "all";
    setActiveButtons(activeCategory);
    applyFilters();
  }

  filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      setCategory(btn.dataset.categoryFilter);
    });
  });

  if (searchInput) {
    searchInput.addEventListener("input", () => {
      searchQuery = normalize(searchInput.value);
      applyFilters();
    });
  }

  if (searchForm) {
    searchForm.addEventListener("submit", (event) => {
      event.preventDefault();
      searchQuery = normalize(searchInput?.value);
      applyFilters();
    });
  }

  applyFilters();
})();
