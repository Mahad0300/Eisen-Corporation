(function () {
  "use strict";

  const form = document.querySelector("[data-contact-form]");
  if (!form) return;

  const success = form.querySelector("[data-contact-success]");
  const submitBtn = form.querySelector(".contact-form__submit");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = submitBtn.dataset.sending || "Sending…";
    }

    window.setTimeout(() => {
      form.reset();
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = submitBtn.dataset.defaultLabel || "Send message";
      }
      if (success) success.hidden = false;
    }, 600);
  });
})();
