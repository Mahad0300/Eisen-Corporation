(function () {
  "use strict";

  const gallery = document.querySelector("[data-product-gallery]");
  const lightbox = document.querySelector("[data-gallery-lightbox]");
  if (!gallery || !lightbox) return;

  const mainImg = gallery.querySelector("[data-gallery-main]");
  const openBtn = gallery.querySelector("[data-gallery-open]");
  const thumbsTrack = gallery.querySelector("[data-gallery-thumbs]");
  const thumbs = [...gallery.querySelectorAll("[data-gallery-index]")];
  const countBadge = gallery.querySelector("[data-gallery-count]");
  const thumbPrev = gallery.querySelector("[data-thumb-prev]");
  const thumbNext = gallery.querySelector("[data-thumb-next]");
  const lightboxImg = lightbox.querySelector("[data-gallery-lightbox-img]");
  const counter = lightbox.querySelector("[data-gallery-counter]");
  const prevBtn = lightbox.querySelector("[data-gallery-prev]");
  const nextBtn = lightbox.querySelector("[data-gallery-next]");
  const closeTriggers = [...lightbox.querySelectorAll("[data-gallery-close]")];

  if (!mainImg || !openBtn || !thumbs.length || !lightboxImg || !thumbsTrack) return;

  let currentIndex = 0;
  let lastFocus = null;

  function getSlide(index) {
    const thumb = thumbs[index];
    if (!thumb) return null;
    return {
      src: thumb.dataset.gallerySrc,
      alt: thumb.dataset.galleryAlt || "",
    };
  }

  function updateCount() {
    const text = `${currentIndex + 1} / ${thumbs.length}`;
    if (countBadge) countBadge.textContent = text;
  }

  function scrollThumbIntoView(index) {
    const thumb = thumbs[index];
    if (!thumb) return;
    thumb.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "center" });
  }

  function setActiveThumb(index) {
    thumbs.forEach((thumb, i) => {
      const active = i === index;
      thumb.classList.toggle("is-active", active);
      thumb.setAttribute("aria-selected", String(active));
    });
    scrollThumbIntoView(index);
    updateCount();
  }

  function showSlide(index) {
    const slide = getSlide(index);
    if (!slide) return;

    currentIndex = index;
    mainImg.src = slide.src;
    mainImg.alt = slide.alt;
    setActiveThumb(index);
  }

  function updateLightbox() {
    const slide = getSlide(currentIndex);
    if (!slide) return;

    lightboxImg.src = slide.src;
    lightboxImg.alt = slide.alt;
    counter.textContent = `${currentIndex + 1} / ${thumbs.length}`;
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex === thumbs.length - 1;
  }

  function openLightbox(index) {
    lastFocus = document.activeElement;
    currentIndex = index;
    updateLightbox();
    lightbox.hidden = false;
    document.body.style.overflow = "hidden";
    lightbox.querySelector(".product-lightbox__close")?.focus();
  }

  function closeLightbox() {
    lightbox.hidden = true;
    document.body.style.overflow = "";
    lastFocus?.focus();
  }

  function stepLightbox(delta) {
    const next = Math.min(Math.max(0, currentIndex + delta), thumbs.length - 1);
    if (next === currentIndex) return;
    currentIndex = next;
    showSlide(currentIndex);
    updateLightbox();
  }

  function scrollThumbs(direction) {
    const amount = Math.max(thumbsTrack.clientWidth * 0.75, 180);
    thumbsTrack.scrollBy({ left: direction * amount, behavior: "smooth" });
  }

  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      showSlide(Number(thumb.dataset.galleryIndex));
    });

    thumb.addEventListener("dblclick", () => {
      openLightbox(Number(thumb.dataset.galleryIndex));
    });
  });

  openBtn.addEventListener("click", () => {
    openLightbox(currentIndex);
  });

  thumbPrev?.addEventListener("click", () => scrollThumbs(-1));
  thumbNext?.addEventListener("click", () => scrollThumbs(1));

  prevBtn.addEventListener("click", () => stepLightbox(-1));
  nextBtn.addEventListener("click", () => stepLightbox(1));

  closeTriggers.forEach((el) => {
    el.addEventListener("click", closeLightbox);
  });

  document.addEventListener("keydown", (event) => {
    if (lightbox.hidden) return;

    if (event.key === "Escape") {
      closeLightbox();
      return;
    }

    if (event.key === "ArrowLeft") stepLightbox(-1);
    if (event.key === "ArrowRight") stepLightbox(1);
  });

  updateCount();
})();
