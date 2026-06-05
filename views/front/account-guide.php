<?php include __DIR__ . '/partials/header.php'; ?>

  <main id="main" class="ag-page">

    <section class="ag-hero" aria-labelledby="ag-page-title">
      <div class="ag-hero__media" aria-hidden="true">
        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1800&q=80" alt="" width="1800" height="900" fetchpriority="high" />
        <div class="ag-hero__overlay"></div>
      </div>
      <div class="container ag-hero__inner">
        <div class="ag-hero__content">
          <p class="ag-hero__eyebrow" data-i18n="accountGuide.eyebrow">Customer onboarding</p>
          <h1 id="ag-page-title" class="ag-hero__title" data-i18n="accountGuide.title" data-page-title="accountGuide.pageTitle">How to create your Eisen account</h1>
          <p class="ag-hero__lead" data-i18n="accountGuide.lead">
            A step-by-step guide to registering your Eisen customer account, accessing stock tools, and reaching our export team when you need support.
          </p>
          <div class="ag-hero__actions">
            <a class="btn btn--gold" href="<?= BASE_URL ?>/login?tab=signup" data-i18n="accountGuide.hero.signup">Create your account</a>
            <a class="btn btn--white" href="<?= BASE_URL ?>/contact" data-i18n="accountGuide.hero.contact">Contact our team</a>
          </div>
        </div>
      </div>
    </section>

    <section class="ag-intro section" aria-labelledby="ag-intro-title">
      <div class="container">
        <div class="ag-section-head ag-section-head--center">
          <span class="ag-section-head__label" data-i18n="accountGuide.intro.label">Before you begin</span>
          <span class="ag-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="ag-intro-title" class="ag-section-title ag-section-title--center" data-i18n="accountGuide.intro.title">Why register with Eisen?</h2>
        <p class="ag-section-lead" data-i18n="accountGuide.intro.lead">
          A registered Eisen account unlocks stock watchlists, reservation holds, export pricing tools, and direct communication with our Japan export specialists — built for dealers and private buyers importing vehicles worldwide.
        </p>
        <ul class="ag-checklist">
          <li data-i18n="accountGuide.intro.l1">Browse and shortlist available Japan car stock</li>
          <li data-i18n="accountGuide.intro.l2">Save favourites and track vehicles of interest</li>
          <li data-i18n="accountGuide.intro.l3">Calculate C&amp;F pricing before you reserve</li>
          <li data-i18n="accountGuide.intro.l4">Manage profile, consignee, and export details in one place</li>
        </ul>
      </div>
    </section>

    <section class="ag-steps section" aria-labelledby="ag-steps-title">
      <div class="container">
        <div class="ag-section-head ag-section-head--center">
          <span class="ag-section-head__label" data-i18n="accountGuide.steps.label">Account creation</span>
          <span class="ag-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="ag-steps-title" class="ag-section-title ag-section-title--center" data-i18n="accountGuide.steps.title">Create your account in three steps</h2>
        <p class="ag-section-lead" data-i18n="accountGuide.steps.lead">
          Go to the Login page, select the Sign up tab, and follow the guided registration flow below.
        </p>

        <ol class="ag-steps__grid">
          <li class="ag-step card">
            <span class="ag-step__num" aria-hidden="true">01</span>
            <h3 class="ag-step__title" data-i18n="accountGuide.step1.title">Enter your email address</h3>
            <p class="ag-step__text" data-i18n="accountGuide.step1.text">
              Open <a href="<?= BASE_URL ?>/login?tab=signup">Sign up</a>, enter a valid email address, and click Continue with email. If the address is already registered, sign in instead.
            </p>
            <ul class="ag-step__tips">
              <li data-i18n="accountGuide.step1.t1">Use an inbox you check regularly — export updates may be sent here</li>
              <li data-i18n="accountGuide.step1.t2">A 6-digit verification code is sent instantly</li>
            </ul>
          </li>
          <li class="ag-step card">
            <span class="ag-step__num" aria-hidden="true">02</span>
            <h3 class="ag-step__title" data-i18n="accountGuide.step2.title">Verify your email with OTP</h3>
            <p class="ag-step__text" data-i18n="accountGuide.step2.text">
              Check your inbox for an email from Eisen Corporation titled &ldquo;Verify Your Email&rdquo;. Enter the 6-digit code on screen. The code expires after 10 minutes — use Resend if needed.
            </p>
            <ul class="ag-step__tips">
              <li data-i18n="accountGuide.step2.t1">Check spam or promotions folders if the email does not arrive</li>
              <li data-i18n="accountGuide.step2.t2">Do not share your verification code with anyone</li>
            </ul>
          </li>
          <li class="ag-step card">
            <span class="ag-step__num" aria-hidden="true">03</span>
            <h3 class="ag-step__title" data-i18n="accountGuide.step3.title">Complete your profile</h3>
            <p class="ag-step__text" data-i18n="accountGuide.step3.text">
              Fill in your name, destination country, account type (Individual or Corporate Buyer), phone number, and password. Accept the Anti-Social Forces (ASF) policy, then click Create account.
            </p>
            <ul class="ag-step__tips">
              <li data-i18n="accountGuide.step3.t1">Password must be at least 8 characters</li>
              <li data-i18n="accountGuide.step3.t2">WhatsApp can match your phone number or be entered separately</li>
              <li data-i18n="accountGuide.step3.t3">You are logged in automatically after registration</li>
            </ul>
          </li>
        </ol>

        <div class="ag-alt card">
          <div class="ag-alt__icon" aria-hidden="true">
            <svg width="28" height="28" viewBox="0 0 18 18" fill="none"><path fill="#4285F4" d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.616z"/><path fill="#34A853" d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18z"/><path fill="#FBBC05" d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332z"/><path fill="#EA4335" d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58z"/></svg>
          </div>
          <div class="ag-alt__body">
            <h3 class="ag-alt__title" data-i18n="accountGuide.google.title">Prefer Google sign-up?</h3>
            <p class="ag-alt__text" data-i18n="accountGuide.google.text">
              Click Continue with Google on the login page. If your Google email is new to Eisen, email verification is skipped and you proceed directly to the profile form. Existing members are signed in immediately.
            </p>
            <a class="btn btn--outline" href="<?= BASE_URL ?>/auth/google" data-i18n="accountGuide.google.btn">Continue with Google</a>
          </div>
        </div>
      </div>
    </section>

    <section class="ag-after section" aria-labelledby="ag-after-title">
      <div class="container">
        <div class="ag-section-head ag-section-head--center">
          <span class="ag-section-head__label" data-i18n="accountGuide.after.label">After registration</span>
          <span class="ag-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="ag-after-title" class="ag-section-title ag-section-title--center" data-i18n="accountGuide.after.title">What you can do next</h2>
        <ul class="ag-after__grid">
          <li class="ag-after__item card">
            <h3 class="ag-after__item-title" data-i18n="accountGuide.after1.title">Browse available stock</h3>
            <p class="ag-after__item-text" data-i18n="accountGuide.after1.text">Search live Japan inventory by make, model, year, and price from the Available Stock page.</p>
            <a class="ag-after__link" href="<?= BASE_URL ?>/listing" data-i18n="accountGuide.after1.link">View stock &rarr;</a>
          </li>
          <li class="ag-after__item card">
            <h3 class="ag-after__item-title" data-i18n="accountGuide.after2.title">Manage your account</h3>
            <p class="ag-after__item-text" data-i18n="accountGuide.after2.text">Update profile details, consignee information, favourites, and export preferences from your account dashboard.</p>
            <a class="ag-after__link" href="<?= BASE_URL ?>/account" data-i18n="accountGuide.after2.link">Go to account &rarr;</a>
          </li>
          <li class="ag-after__item card">
            <h3 class="ag-after__item-title" data-i18n="accountGuide.after3.title">Calculate export pricing</h3>
            <p class="ag-after__item-text" data-i18n="accountGuide.after3.text">Use our price calculation tool to estimate C&amp;F costs before reserving a vehicle from stock.</p>
            <a class="ag-after__link" href="<?= BASE_URL ?>/price-calculation" data-i18n="accountGuide.after3.link">Calculate pricing &rarr;</a>
          </li>
        </ul>
      </div>
    </section>

    <section class="ag-contact section" aria-labelledby="ag-contact-title">
      <div class="container">
        <div class="ag-section-head ag-section-head--center">
          <span class="ag-section-head__label" data-i18n="accountGuide.contact.label">Get support</span>
          <span class="ag-section-head__line" aria-hidden="true"></span>
        </div>
        <h2 id="ag-contact-title" class="ag-section-title ag-section-title--center" data-i18n="accountGuide.contact.title">How to contact Eisen</h2>
        <p class="ag-section-lead" data-i18n="accountGuide.contact.lead">
          Need help with registration, stock enquiries, or export logistics? Our team responds within one business day (JST).
        </p>

        <div class="ag-contact__grid">
          <div class="ag-contact__card card">
            <span class="ag-contact__card-icon" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.75"/><path d="M4 8l8 5 8-5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
            </span>
            <h3 class="ag-contact__card-title" data-i18n="accountGuide.contact.email.title">Email us</h3>
            <p class="ag-contact__card-text" data-i18n="accountGuide.contact.email.text">For stock enquiries, account issues, and export quotes.</p>
            <a class="ag-contact__card-link" href="mailto:sales@eisenwheels.com">sales@eisenwheels.com</a>
          </div>
          <div class="ag-contact__card card">
            <span class="ag-contact__card-icon" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M6.5 4h11l1 16H5.5l1-16z" stroke="currentColor" stroke-width="1.75"/><path d="M9 7h6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
            </span>
            <h3 class="ag-contact__card-title" data-i18n="accountGuide.contact.phone.title">Call or WhatsApp</h3>
            <p class="ag-contact__card-text" data-i18n="accountGuide.contact.phone.text">Speak directly with our export team during business hours.</p>
            <a class="ag-contact__card-link" href="tel:09033508523">090 3350 8523</a>
          </div>
          <div class="ag-contact__card card">
            <span class="ag-contact__card-icon" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 3C8.5 3 5.5 5.5 5.5 9c0 5.25 6.5 12 6.5 12s6.5-6.75 6.5-12c0-3.5-3-6-6.5-6z" stroke="currentColor" stroke-width="1.75"/><circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.75"/></svg>
            </span>
            <h3 class="ag-contact__card-title" data-i18n="accountGuide.contact.form.title">Contact form</h3>
            <p class="ag-contact__card-text" data-i18n="accountGuide.contact.form.text">Send a detailed message about vehicles, destination port, or support you need.</p>
            <a class="ag-contact__card-link" href="<?= BASE_URL ?>/contact" data-i18n="accountGuide.contact.form.link">Open contact page &rarr;</a>
          </div>
        </div>

        <div class="ag-office card">
          <div class="ag-office__col">
            <h3 class="ag-office__title" data-i18n="accountGuide.office.title">Head office</h3>
            <address class="ag-office__address">
              <strong>Eisen Inc.</strong><br />
              3-22-32 Tanaka, Matsubushi Machi<br />
              Kitakatsushika Gun, Saitama Prefecture 343-0117, Japan
            </address>
          </div>
          <div class="ag-office__col">
            <h3 class="ag-office__title" data-i18n="accountGuide.hours.title">Business hours (JST)</h3>
            <ul class="ag-office__hours">
              <li><span data-i18n="accountGuide.hours.weekdays">Mon – Fri</span><span>09:00 – 18:00</span></li>
              <li><span data-i18n="accountGuide.hours.saturday">Saturday</span><span>09:00 – 13:00</span></li>
              <li><span data-i18n="accountGuide.hours.sunday">Sunday &amp; holidays</span><span data-i18n="accountGuide.hours.closed">Closed</span></li>
            </ul>
          </div>
          <div class="ag-office__col">
            <h3 class="ag-office__title" data-i18n="accountGuide.inquiry.title">When contacting us, include</h3>
            <ul class="ag-office__list">
              <li data-i18n="accountGuide.inquiry.l1">Your registered email or account name</li>
              <li data-i18n="accountGuide.inquiry.l2">Stock ID or vehicle details (make, model, year)</li>
              <li data-i18n="accountGuide.inquiry.l3">Destination country and port</li>
              <li data-i18n="accountGuide.inquiry.l4">Whether you are an individual or corporate buyer</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="ag-cta section" aria-labelledby="ag-cta-title">
      <div class="container">
        <div class="ag-cta__banner">
          <div class="ag-cta__content">
            <p class="ag-cta__eyebrow" data-i18n="accountGuide.cta.eyebrow">Ready to get started?</p>
            <h2 id="ag-cta-title" class="ag-cta__title" data-i18n="accountGuide.cta.title">Create your Eisen account today</h2>
            <p class="ag-cta__text" data-i18n="accountGuide.cta.text">Register in minutes, browse Japan car stock, and connect with our export specialists when you are ready to buy.</p>
          </div>
          <div class="ag-cta__actions">
            <a class="btn btn--gold" href="<?= BASE_URL ?>/login?tab=signup" data-i18n="accountGuide.cta.signup">Create account</a>
            <a class="btn btn--white" href="<?= BASE_URL ?>/contact" data-i18n="accountGuide.cta.contact">Contact us</a>
          </div>
        </div>
      </div>
    </section>

  </main>

<?php include __DIR__ . '/partials/footer.php'; ?>
