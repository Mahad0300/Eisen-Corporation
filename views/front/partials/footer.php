
<footer id="contacts" class="site-footer">
    <div class="container site-footer__grid">
      <div class="site-footer__col site-footer__brand">
        <a href="<?= BASE_URL ?>/" class="site-footer__logo" aria-label="Eisen Corporation home">
          <img
            class="site-footer__logo-img"
            src="<?= BASE_URL ?>/public/image/eisen-logo.png"
            alt="Eisen Corporation"
            width="200"
            height="58"
            loading="lazy"
          />
        </a>
        <p class="site-footer__tagline" data-i18n="footer.tagline">
          Premium imported vehicles from Japan auctions. Inspection, logistics, and worldwide export for dealers and private buyers.
        </p>
      </div>

      <div class="site-footer__col">
        <h3 class="site-footer__heading" data-i18n="footer.quickLinks">Quick Links</h3>
        <ul class="site-footer__links site-footer__links--arrow-hover">
          <li><a href="<?= BASE_URL ?>/" data-i18n="footer.home">Home</a></li>
          <li><a href="<?= BASE_URL ?>/about" data-i18n="footer.about">About Us</a></li>
          <li><a href="<?= BASE_URL ?>/blog" data-i18n="footer.blog">Blog</a></li>
          <li><a href="<?= BASE_URL ?>/blog" data-i18n="footer.news">News</a></li>
          <li><a href="<?= BASE_URL ?>/listing" data-i18n="footer.inventory">Inventory</a></li>
          <li><a href="<?= BASE_URL ?>/contact" data-i18n="footer.contacts">Contacts</a></li>
        </ul>
      </div>

      <div class="site-footer__col">
        <h3 class="site-footer__heading" data-i18n="footer.services">Our Services</h3>
        <ul class="site-footer__links site-footer__links--arrow-hover">
          <li><a href="#listings" data-i18n="footer.listings">Vehicle Listings</a></li>
          <li><a href="#main" data-i18n="footer.auction">Japan Auction Sourcing</a></li>
          <li><a href="#blog" data-i18n="footer.dealerDir">Dealer Directory</a></li>
          <li><a href="#blog" data-i18n="footer.serviceIns">Service &amp; Insurance</a></li>
          <li><a href="#videos" data-i18n="footer.videoReviews">Video Reviews</a></li>
          <li><a href="#videos" data-i18n="footer.urgent">Urgent Purchase</a></li>
        </ul>
      </div>

      <div class="site-footer__col">
        <h3 class="site-footer__heading" data-i18n="footer.contact">Contact Us</h3>
        <p class="site-footer__text">
          <strong>Lorem Ipsum Dolor</strong><br />
          42 Sit Amet Street<br />
          Consectetur, Adipiscing 00000, Elit
        </p>
        <p class="site-footer__text">
          <a href="mailto:lorem.ipsum@example.com">lorem.ipsum@example.com</a><br />
          <a href="tel:+10000000000">+00 000-000-0000</a>
        </p>
        <p class="site-footer__text">
          <strong data-i18n="footer.hoursTitle">Business hours</strong><br />
          <span data-i18n="footer.hoursLine1">Lorem – Ipsum: 00:00 – 00:00</span><br />
          <span data-i18n="footer.hoursLine2">Dolor: Sit amet consectetur</span>
        </p>
      </div>
    </div>
    <div class="site-footer__bottom">
      <div class="container site-footer__bottom-inner">
        <p class="site-footer__copy">&copy; <span data-year></span> <span data-i18n="footer.copy">Eisen Corporation. All rights reserved.</span></p>
        <nav class="site-footer__legal" aria-label="Legal">
          <a href="<?= BASE_URL ?>/privacy-policy" data-i18n="footer.privacy">Privacy Policy</a>
          <a href="<?= BASE_URL ?>/terms-and-condition" data-i18n="footer.terms">Terms &amp; Conditions</a>
        </nav>
      </div>
    </div>
  </footer>

  <script>window.BASE_URL = <?= json_encode(BASE_URL) ?>;</script>
  <script src="<?= BASE_URL ?>/public/js/locale-i18n.js" defer></script>
  <script src="<?= BASE_URL ?>/public/js/currency.js" defer></script>
  <script src="<?= BASE_URL ?>/public/js/main.js" defer></script>
  <script src="<?= BASE_URL ?>/public/js/listing.js" defer></script>
</body>
</html>
