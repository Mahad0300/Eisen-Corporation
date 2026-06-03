<?php include dirname(__DIR__) . '/front/partials/header.php'; ?>

  <main id="main" class="login-page">

    <section class="login-page__main section" aria-labelledby="login-page-title">
      <div class="container login-page__inner">
        <div class="login-card card">
          <div class="login-card__head">
            <h1 id="login-page-title" class="login-card__title">Sign in</h1>
            <p class="login-card__text">Enter your credentials to continue.</p>
          </div>

          <?php if (isset($flash) && $flash): ?>
            <div class="login-flash" role="alert">
              <?= htmlspecialchars($flash['message']) ?>
            </div>
          <?php endif; ?>

          <form class="login-form" action="<?= BASE_URL ?>/admin/login" method="POST" novalidate>
            <div class="form-field">
              <label class="form-label" for="email">Email</label>
              <input
                class="form-control form-control--text"
                type="email"
                id="email"
                name="email"
                placeholder="admin@eisen.com"
                required
                autocomplete="email"
                value="admin@eisen.com"
              />
            </div>

            <div class="form-field">
              <label class="form-label" for="password">Password</label>
              <input
                class="form-control form-control--text"
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
                value="admin123"
              />
            </div>

            <button class="btn btn--primary btn--block login-form__submit" type="submit">Sign in</button>
          </form>

          <div class="login-demo">
            <p>Demo account credentials are pre-filled. Click <strong>Sign in</strong> to enter the dashboard.</p>
          </div>
        </div>
      </div>
    </section>

  </main>

<?php include dirname(__DIR__) . '/front/partials/footer.php'; ?>
