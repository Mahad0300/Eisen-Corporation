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
          <div class="header-locale__group">
            <label class="header-locale__label" for="header-language" data-i18n="locale.language">Language</label>
            <select class="header-locale__select" id="header-language" name="language" data-locale-language>
              <option value="en" selected>English</option>
              <option value="ja">Japanese</option>
            </select>
          </div>
          <div class="header-locale__group">
            <label class="header-locale__label" for="header-currency" data-i18n="locale.currency">Currency</label>
            <select class="header-locale__select" id="header-currency" name="currency" data-locale-currency>
              <option value="usd" selected>Dollar</option>
              <option value="jpy">Japanese</option>
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
