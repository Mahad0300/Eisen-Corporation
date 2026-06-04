(function () {
  "use strict";

  const page = document.querySelector("[data-faq-page]");
  if (!page || !window.EISEN_FAQ) return;

  const data = window.EISEN_FAQ;
  const topicsEl = page.querySelector("[data-faq-topics]");
  const listEl = page.querySelector("[data-faq-list]");
  const emptyEl = page.querySelector("[data-faq-empty]");
  const titleEl = page.querySelector("[data-faq-topic-title]");
  const breadcrumbEl = page.querySelector("[data-faq-breadcrumb-current]");
  const searchForm = page.querySelector("[data-faq-search-form]");
  const searchInput = page.querySelector("#faq-search-input");

  let activeSlug = page.getAttribute("data-initial-topic") || data.defaultSlug;
  let searchQuery = "";

  function getLang() {
    const lang = document.documentElement.lang || "en";
    return lang === "ja" ? "ja" : "en";
  }

  function t(key) {
    if (window.EisenI18n && typeof window.EisenI18n.t === "function") {
      return window.EisenI18n.t(key, getLang());
    }
    return key;
  }

  function labelFor(topic) {
    return topic.label[getLang()] || topic.label.en;
  }

  function findTopic(slug) {
    return data.topics.find((topic) => topic.slug === slug) || data.topics[0];
  }

  function topicUrl(slug) {
    const base = (window.BASE_URL || "").replace(/\/$/, "");
    return `${base}/faq/${slug}`;
  }

  function setActiveSlug(slug, pushState) {
    const topic = findTopic(slug);
    if (!topic) return;

    activeSlug = topic.slug;
    searchQuery = "";

    if (searchInput) {
      searchInput.value = "";
    }

    if (pushState) {
      window.history.pushState({ faqSlug: topic.slug }, "", topicUrl(topic.slug));
    }

    renderSidebar();
    renderTopic(topic);
  }

  function renderSidebar() {
    if (!topicsEl) return;

    topicsEl.innerHTML = data.topics
      .map((topic) => {
        const isActive = topic.slug === activeSlug;
        return `<li>
          <a class="faq-sidebar__link${isActive ? " is-active" : ""}" href="${topicUrl(topic.slug)}" data-faq-topic-link="${topic.slug}">
            ${escapeHtml(labelFor(topic))}
          </a>
        </li>`;
      })
      .join("");
  }

  function renderTopic(topic) {
    const label = labelFor(topic);

    if (titleEl) titleEl.textContent = label;
    if (breadcrumbEl) breadcrumbEl.textContent = label;
    document.title = `${label} | Eisen Corporation`;

    renderQuestions(topic);
  }

  function renderQuestions(topic) {
    if (!listEl) return;

    const lang = getLang();
    const query = searchQuery.trim().toLowerCase();

    const items = topic.questions.filter((item) => {
      if (!query) return true;
      const q = (item.q[lang] || item.q.en || "").toLowerCase();
      const a = (item.a[lang] || item.a.en || "").toLowerCase();
      return q.includes(query) || a.includes(query);
    });

    if (items.length === 0) {
      listEl.innerHTML = "";
      if (emptyEl) emptyEl.hidden = false;
      return;
    }

    if (emptyEl) emptyEl.hidden = true;

    listEl.innerHTML = items
      .map(
        (item) => `<details class="faq-item">
          <summary class="faq-item__question">${escapeHtml(item.q[lang] || item.q.en)}</summary>
          <div class="faq-item__answer">
            <p>${escapeHtml(item.a[lang] || item.a.en)}</p>
          </div>
        </details>`
      )
      .join("");
  }

  function escapeHtml(text) {
    return String(text)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");
  }

  topicsEl?.addEventListener("click", (event) => {
    const link = event.target.closest("[data-faq-topic-link]");
    if (!link) return;
    event.preventDefault();
    setActiveSlug(link.getAttribute("data-faq-topic-link"), true);
  });

  searchForm?.addEventListener("submit", (event) => {
    event.preventDefault();
    searchQuery = searchInput?.value || "";
    renderQuestions(findTopic(activeSlug));
  });

  searchInput?.addEventListener("input", () => {
    searchQuery = searchInput.value || "";
    renderQuestions(findTopic(activeSlug));
  });

  window.addEventListener("popstate", (event) => {
    const slug = event.state?.faqSlug || parseSlugFromPath();
    setActiveSlug(slug, false);
  });

  function parseSlugFromPath() {
    const path = window.location.pathname.replace(/\/$/, "") || "/";
    const match = path.match(/\/faq(?:\/([^/]+))?$/);
    return match && match[1] ? match[1] : data.defaultSlug;
  }

  function refreshForLanguage() {
    renderSidebar();
    renderTopic(findTopic(activeSlug));
  }

  document.querySelector('[data-locale-dropdown="language"]')?.addEventListener("click", (event) => {
    if (!event.target.closest("[data-locale-value]")) return;
    window.setTimeout(refreshForLanguage, 0);
  });

  setActiveSlug(page.getAttribute("data-initial-topic") || parseSlugFromPath(), false);
})();
