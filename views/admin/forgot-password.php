<?php include dirname(__DIR__) . '/front/partials/header.php'; ?>

  <main id="main" class="login-page">

    <section class="login-page__main section" aria-labelledby="forgot-page-title">
      <div class="container login-page__inner">
        <div class="login-card card">
          <div class="login-card__head">
            <h1 id="forgot-page-title" class="login-card__title">Forgot password</h1>
            <p class="login-card__text">Enter your email and we will send you a reset link.</p>
          </div>

          <?php if (isset($flash) && $flash): ?>
            <div class="login-flash login-flash--success" role="alert">
              <?= htmlspecialchars($flash['message']) ?>
            </div>
          <?php endif; ?>

          <form class="login-form" action="<?= BASE_URL ?>/admin/forgot-password" method="POST" novalidate>
            <div class="form-field">
              <label class="form-label" for="forgot-email">Email</label>
              <input
                class="form-control form-control--text"
                type="email"
                id="forgot-email"
                name="email"
                placeholder="you@example.com"
                required
                autocomplete="email"
              />
            </div>

            <button class="btn btn--primary btn--block login-form__submit" type="submit">Send reset link</button>
          </form>

          <p class="login-back">
            <a href="<?= BASE_URL ?>/admin/login">Back to login</a>
          </p>
        </div>
      </div>
    </section>

  </main>

<?php include dirname(__DIR__) . '/front/partials/footer.php'; ?>
