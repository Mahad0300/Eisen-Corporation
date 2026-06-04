(function () {
  "use strict";

  const tabButtons = document.querySelectorAll("[data-login-tab]");
  const panels = document.querySelectorAll("[data-login-panel]");
  const signupForm = document.querySelector("[data-signup-form]");

  function activateTab(tabName) {
    tabButtons.forEach((btn) => {
      const isActive = btn.getAttribute("data-login-tab") === tabName;
      btn.classList.toggle("is-active", isActive);
      btn.setAttribute("aria-selected", isActive ? "true" : "false");
    });

    panels.forEach((panel) => {
      const isActive = panel.getAttribute("data-login-panel") === tabName;
      panel.classList.toggle("is-active", isActive);
      panel.hidden = !isActive;
    });
  }

  tabButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      activateTab(btn.getAttribute("data-login-tab"));
    });
  });

  if (signupForm) {
    signupForm.addEventListener("submit", (event) => {
      const password = signupForm.querySelector("#signup-password");
      const confirm = signupForm.querySelector("#signup-password-confirm");

      if (!password || !confirm || password.value !== confirm.value) {
        event.preventDefault();
        confirm.setCustomValidity("Passwords do not match.");
        confirm.reportValidity();
        return;
      }

      confirm.setCustomValidity("");
    });

    signupForm.querySelector("#signup-password-confirm")?.addEventListener("input", (event) => {
      event.target.setCustomValidity("");
    });
  }
})();
