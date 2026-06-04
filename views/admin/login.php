<?php
$activeTab = ($activeTab ?? 'login') === 'signup' ? 'signup' : 'login';
?>
<?php include dirname(__DIR__) . '/front/partials/header.php'; ?>

  <main id="main" class="login-page">

    <section class="login-page__main section" aria-labelledby="login-page-title">
      <div class="container login-page__inner">
        <div class="login-card card">
          <div class="login-card__head">
            <h1 id="login-page-title" class="login-card__title">Welcome</h1>
            <p class="login-card__text">Sign in or create an account to continue.</p>
          </div>

          <div class="login-tabs" role="tablist" aria-label="Authentication">
            <button
              type="button"
              class="login-tabs__btn<?= $activeTab === 'login' ? ' is-active' : '' ?>"
              role="tab"
              id="login-tab-login"
              aria-selected="<?= $activeTab === 'login' ? 'true' : 'false' ?>"
              aria-controls="login-panel-login"
              data-login-tab="login"
            >Login</button>
            <button
              type="button"
              class="login-tabs__btn<?= $activeTab === 'signup' ? ' is-active' : '' ?>"
              role="tab"
              id="login-tab-signup"
              aria-selected="<?= $activeTab === 'signup' ? 'true' : 'false' ?>"
              aria-controls="login-panel-signup"
              data-login-tab="signup"
            >Sign up</button>
          </div>

          <?php if (isset($flash) && $flash): ?>
            <div class="login-flash" role="alert">
              <?= htmlspecialchars($flash['message']) ?>
            </div>
          <?php endif; ?>

          <div
            class="login-panel<?= $activeTab === 'login' ? ' is-active' : '' ?>"
            id="login-panel-login"
            role="tabpanel"
            aria-labelledby="login-tab-login"
            data-login-panel="login"
            <?= $activeTab !== 'login' ? 'hidden' : '' ?>
          >
            <form class="login-form" action="<?= BASE_URL ?>/admin/login" method="POST" novalidate>
              <div class="form-field">
                <label class="form-label" for="login-email">Email</label>
                <input
                  class="form-control form-control--text"
                  type="email"
                  id="login-email"
                  name="email"
                  placeholder="you@example.com"
                  required
                  autocomplete="email"
                />
              </div>

              <div class="form-field">
                <div class="login-form__label-row">
                  <label class="form-label" for="login-password">Password</label>
                  <a class="login-forgot" href="<?= BASE_URL ?>/admin/forgot-password">Forgot password?</a>
                </div>
                <input
                  class="form-control form-control--text"
                  type="password"
                  id="login-password"
                  name="password"
                  placeholder="Enter your password"
                  required
                  autocomplete="current-password"
                />
              </div>

              <button class="btn btn--primary btn--block login-form__submit" type="submit">Sign in</button>
            </form>
          </div>

          <div
            class="login-panel<?= $activeTab === 'signup' ? ' is-active' : '' ?>"
            id="login-panel-signup"
            role="tabpanel"
            aria-labelledby="login-tab-signup"
            data-login-panel="signup"
            <?= $activeTab !== 'signup' ? 'hidden' : '' ?>
          >
            <form class="login-form" action="<?= BASE_URL ?>/admin/signup" method="POST" novalidate data-signup-form>
              <div class="form-field">
                <label class="form-label" for="signup-name">Full name</label>
                <input
                  class="form-control form-control--text"
                  type="text"
                  id="signup-name"
                  name="name"
                  placeholder="Your name"
                  required
                  autocomplete="name"
                />
              </div>

              <div class="form-field">
                <label class="form-label" for="signup-email">Email</label>
                <input
                  class="form-control form-control--text"
                  type="email"
                  id="signup-email"
                  name="email"
                  placeholder="you@example.com"
                  required
                  autocomplete="email"
                />
              </div>

              <div class="form-field">
                <label class="form-label" for="signup-password">Password</label>
                <input
                  class="form-control form-control--text"
                  type="password"
                  id="signup-password"
                  name="password"
                  placeholder="Create a password"
                  required
                  autocomplete="new-password"
                  minlength="6"
                />
              </div>

              <div class="form-field">
                <label class="form-label" for="signup-password-confirm">Confirm password</label>
                <input
                  class="form-control form-control--text"
                  type="password"
                  id="signup-password-confirm"
                  name="password_confirm"
                  placeholder="Confirm your password"
                  required
                  autocomplete="new-password"
                  minlength="6"
                />
              </div>

              <button class="btn btn--primary btn--block login-form__submit" type="submit">Create account</button>
            </form>
          </div>

          <div class="login-divider" aria-hidden="true"><span>or</span></div>

          <a class="login-google" href="<?= BASE_URL ?>/admin/auth/google">
            <svg class="login-google__icon" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true">
              <path fill="#4285F4" d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.616z" />
              <path fill="#34A853" d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18z" />
              <path fill="#FBBC05" d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332z" />
              <path fill="#EA4335" d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58z" />
            </svg>
            <span>Continue with Google</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <script src="<?= BASE_URL ?>/public/js/login.js" defer></script>
<?php include dirname(__DIR__) . '/front/partials/footer.php'; ?>
