<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eisen Corporation — premium imported vehicles, auction-grade stock, and expert export services." />
  <title>Eisen Corporation | Premium Auto Dealership</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Montserrat:ital,wght@0,600;0,700;0,800;1,600;1,700;1,800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/global.css" />
</head>
<body>
  <a class="skip-link" href="#main" data-i18n="skip">Skip to content</a>

  <header class="site-header">
    <div class="header-brand">
      <div class="container header-brand__inner">
        <a href="<?= BASE_URL ?>/" class="logo" aria-label="Eisen Corporation home">
          <img
            class="logo__img"
            src="<?= BASE_URL ?>/public/image/eisen-logo.png"
            alt="Eisen Corporation"
            width="220"
            height="64"
            fetchpriority="high"
          />
        </a>

        <div class="header-locale" data-header-locale>
          <div class="header-locale__dropdown" data-locale-dropdown="language">
            <label class="visually-hidden" id="header-language-label" data-i18n="locale.language">Language</label>
            <button
              type="button"
              class="header-locale__trigger"
              id="header-language-btn"
              data-locale-trigger
              aria-expanded="false"
              aria-haspopup="listbox"
              aria-labelledby="header-language-label"
            >
              <span class="header-locale__trigger-icon" data-locale-trigger-icon aria-hidden="true">
                <svg class="header-locale__flag-svg" width="22" height="15" viewBox="0 0 21 15" xmlns="http://www.w3.org/2000/svg"><rect width="21" height="15" fill="#fff" /><path fill="#B22234" d="M0 0h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21H0Z" /><rect width="8.4" height="8.05" fill="#3C3B6E" /></svg>
              </span>
              <span class="header-locale__trigger-label" data-locale-trigger-label>English</span>
              <svg class="header-locale__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </button>
            <ul class="header-locale__menu" role="listbox" data-locale-menu hidden>
              <li role="presentation">
                <button type="button" class="header-locale__option is-active" role="option" data-locale-value="en" aria-selected="true">
                  <span class="header-locale__option-icon" aria-hidden="true">
                    <svg class="header-locale__flag-svg" width="22" height="15" viewBox="0 0 21 15" xmlns="http://www.w3.org/2000/svg"><rect width="21" height="15" fill="#fff" /><path fill="#B22234" d="M0 0h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21v1.154H0Zm0 2.308h21H0Z" /><rect width="8.4" height="8.05" fill="#3C3B6E" /></svg>
                  </span>
                  <span class="header-locale__option-label">English</span>
                </button>
              </li>
              <li role="presentation">
                <button type="button" class="header-locale__option" role="option" data-locale-value="ja" aria-selected="false">
                  <span class="header-locale__option-icon" aria-hidden="true">
                    <svg class="header-locale__flag-svg" width="22" height="15" viewBox="0 0 21 15" xmlns="http://www.w3.org/2000/svg"><rect width="21" height="15" fill="#fff" /><circle cx="10.5" cy="7.5" r="4.2" fill="#BC002D" /></svg>
                  </span>
                  <span class="header-locale__option-label">日本語</span>
                </button>
              </li>
            </ul>
            <select class="visually-hidden" id="header-language" name="language" data-locale-language tabindex="-1" aria-hidden="true">
              <option value="en" selected>English</option>
              <option value="ja">日本語</option>
            </select>
          </div>

          <span class="header-locale__divider" aria-hidden="true"></span>

          <div class="header-locale__dropdown" data-locale-dropdown="currency">
            <label class="visually-hidden" id="header-currency-label" data-i18n="locale.currency">Currency</label>
            <button
              type="button"
              class="header-locale__trigger"
              id="header-currency-btn"
              data-locale-trigger
              aria-expanded="false"
              aria-haspopup="listbox"
              aria-labelledby="header-currency-label"
            >
              <span class="header-locale__trigger-icon header-locale__trigger-icon--symbol" data-locale-trigger-icon aria-hidden="true">$</span>
              <span class="header-locale__trigger-label" data-locale-trigger-label>USD</span>
              <svg class="header-locale__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </button>
            <ul class="header-locale__menu" role="listbox" data-locale-menu hidden>
              <li role="presentation">
                <button type="button" class="header-locale__option is-active" role="option" data-locale-value="usd" aria-selected="true">
                  <span class="header-locale__option-icon header-locale__option-icon--symbol" aria-hidden="true">$</span>
                  <span class="header-locale__option-label">USD</span>
                </button>
              </li>
              <li role="presentation">
                <button type="button" class="header-locale__option" role="option" data-locale-value="jpy" aria-selected="false">
                  <span class="header-locale__option-icon header-locale__option-icon--symbol" aria-hidden="true">¥</span>
                  <span class="header-locale__option-label">JPY</span>
                </button>
              </li>
            </ul>
            <select class="visually-hidden" id="header-currency" name="currency" data-locale-currency tabindex="-1" aria-hidden="true">
              <option value="usd" selected>USD</option>
              <option value="jpy">JPY</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="header-bar">
      <div class="container header-bar__inner">
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
          <span class="nav-toggle__bar" aria-hidden="true"></span>
          <span class="visually-hidden" data-i18n="nav.menu">Menu</span>
        </button>

        <nav id="site-nav" class="site-nav" aria-label="Primary">
          <ul class="site-nav__list">
            <li class="site-nav__item"><a class="site-nav__link is-active" href="#" aria-current="page" data-i18n="nav.home">Home</a></li>
            <li class="site-nav__item"><a class="site-nav__link" href="#about" data-i18n="nav.about">About Us</a></li>
            <li class="site-nav__item"><a class="site-nav__link" href="#blog" data-i18n="nav.blog">Blog</a></li>
            <li class="site-nav__item"><a class="site-nav__link" href="#news" data-i18n="nav.news">News</a></li>
            <li class="site-nav__item"><a class="site-nav__link" href="#sellers" data-i18n="nav.sellers">For Sellers</a></li>
            <li class="site-nav__item"><a class="site-nav__link" href="#contacts" data-i18n="nav.contacts">Contacts</a></li>
          </ul>
        </nav>

        <form class="header-search" role="search" data-i18n-aria="search.aria">
          <label class="visually-hidden" for="header-search-input" data-i18n="search.label">Search on site</label>
          <input
            id="header-search-input"
            class="header-search__input"
            type="search"
            name="q"
            placeholder="Search On Site"
            data-i18n-placeholder="search.placeholder"
            autocomplete="off"
          />
          <button class="btn btn--primary header-search__btn" type="submit" data-i18n="search.btn">search</button>
        </form>
      </div>
    </div>
  </header>
