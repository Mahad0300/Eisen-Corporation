<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="faq-page" data-faq-page data-initial-topic="<?= htmlspecialchars($initialTopic ?? 'general-questions') ?>">

    <section class="faq-page__main section">
      <div class="container faq-layout">
        <div class="faq-main">
          <nav class="faq-breadcrumb" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/contact" data-i18n="faq.breadcrumb.support">Support</a>
            <span class="faq-breadcrumb__sep" aria-hidden="true">&gt;</span>
            <span class="faq-breadcrumb__current" data-faq-breadcrumb-current>General Questions</span>
          </nav>

          <header class="faq-main__head">
            <h1 class="faq-main__title" data-faq-topic-title>General Questions</h1>
            <p class="faq-main__subtitle" data-i18n="faq.subtitle">Frequently Asked Questions</p>
          </header>

          <div class="faq-list" data-faq-list role="list"></div>
          <p class="faq-empty" data-faq-empty hidden data-i18n="faq.noResults">No questions match your search.</p>
        </div>

        <aside class="faq-sidebar card" aria-label="Help topics">
          <form class="faq-sidebar__search" role="search" data-faq-search-form>
            <label class="visually-hidden" for="faq-search-input" data-i18n="faq.searchLabel">Search by keywords</label>
            <input
              id="faq-search-input"
              class="faq-sidebar__input form-control form-control--text"
              type="search"
              placeholder="Search by Keywords"
              data-i18n-placeholder="faq.searchPlaceholder"
              autocomplete="off"
            />
            <button class="faq-sidebar__search-btn" type="submit" aria-label="Search">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                <path d="M20 20L16.5 16.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              </svg>
            </button>
          </form>

          <h2 class="faq-sidebar__heading" data-i18n="faq.sidebarTitle">Help topics</h2>
          <ul class="faq-sidebar__topics" data-faq-topics></ul>
        </aside>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/public/js/faq-data.js" defer></script>
  <script src="<?= BASE_URL ?>/public/js/faq.js" defer></script>
<?php include __DIR__ . '/partials/footer.php'; ?>
