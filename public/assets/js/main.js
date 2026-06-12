const siteHeader = document.getElementById("siteHeader");
    const menuToggle = document.getElementById("menuToggle");
    const navbarShell = document.getElementById("navbarShell");
    const mobileMenuOverlay = document.getElementById("mobileMenuOverlay");
    const navDrops = document.querySelectorAll(".nav-drop");
    const scrollProgress = document.getElementById("scrollProgress");
    const legalStage = document.getElementById("legalStage");
    const typingWord = document.getElementById("typingWord");
    const cursorGlow = document.getElementById("cursorGlow");

    function openMobileMenu() {
      navbarShell.classList.add("active");
      mobileMenuOverlay.classList.add("active");
      document.body.classList.add("no-scroll");

      const icon = menuToggle.querySelector("i");
      icon.classList.remove("bi-list");
      icon.classList.add("bi-x-lg");
    }

    function closeMobileMenu() {
      navbarShell.classList.remove("active");
      mobileMenuOverlay.classList.remove("active");
      document.body.classList.remove("no-scroll");

      const icon = menuToggle.querySelector("i");
      icon.classList.remove("bi-x-lg");
      icon.classList.add("bi-list");

      navDrops.forEach(function (navDrop) {
        navDrop.classList.remove("open");
      });
    }

    window.addEventListener("scroll", function () {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const percent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

      scrollProgress.style.width = percent + "%";

      if (scrollTop > 20) {
        siteHeader.classList.add("scrolled");
      } else {
        siteHeader.classList.remove("scrolled");
      }
    });

    menuToggle.addEventListener("click", function (event) {
      event.stopPropagation();
      navbarShell.classList.contains("active") ? closeMobileMenu() : openMobileMenu();
    });

    if (mobileMenuOverlay) {
      mobileMenuOverlay.addEventListener("click", closeMobileMenu);
    }

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") closeMobileMenu();
    });

    navbarShell.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", closeMobileMenu);
    });

    navDrops.forEach(function (navDrop) {
      const navDropBtn = navDrop.querySelector(".nav-drop-btn");
      if (!navDropBtn) return;

      navDropBtn.addEventListener("click", function (event) {
        if (window.innerWidth <= 1120) {
          event.preventDefault();
          event.stopPropagation();
          navDrops.forEach(function (otherDrop) {
            if (otherDrop !== navDrop) otherDrop.classList.remove("open");
          });
          navDrop.classList.toggle("open");
        }
      });
    });

    if (cursorGlow) {
      window.addEventListener("mousemove", function (event) {
        cursorGlow.style.left = event.clientX + "px";
        cursorGlow.style.top = event.clientY + "px";
      });
    }

    if (legalStage) {
      legalStage.addEventListener("mousemove", function (event) {
        if (window.innerWidth <= 900) return;

        const rect = legalStage.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        const rotateY = ((x / rect.width) - 0.5) * 12;
        const rotateX = ((y / rect.height) - 0.5) * -12;

        legalStage.style.transform =
          `perspective(1100px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
      });

      legalStage.addEventListener("mouseleave", function () {
        legalStage.style.transform =
          "perspective(1100px) rotateX(0deg) rotateY(0deg)";
      });
    }

    if (typingWord) {
      const words = ["Rights", "Disputes", "Cases", "Relief", "Strategy"];
      let wordIndex = 0;
      let charIndex = 0;
      let isDeleting = false;

      function typeEffect() {
        const current = words[wordIndex];

        if (!isDeleting) {
          typingWord.textContent = current.substring(0, charIndex + 1);
          charIndex++;

          if (charIndex === current.length) {
            isDeleting = true;
            setTimeout(typeEffect, 1250);
            return;
          }
        } else {
          typingWord.textContent = current.substring(0, charIndex - 1);
          charIndex--;

          if (charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
          }
        }

        setTimeout(typeEffect, isDeleting ? 52 : 92);
      }

      typeEffect();
    }

    const revealItems = document.querySelectorAll(".reveal");

    const revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );

    revealItems.forEach(function (item, index) {
      item.style.transitionDelay = Math.min(index * 0.035, 0.24) + "s";
      revealObserver.observe(item);
    });

    const magneticItems = document.querySelectorAll(".magnetic");

    magneticItems.forEach(function (item) {
      item.addEventListener("mousemove", function (event) {
        if (window.innerWidth <= 900) return;

        const rect = item.getBoundingClientRect();
        const x = event.clientX - rect.left - rect.width / 2;
        const y = event.clientY - rect.top - rect.height / 2;

        item.style.transform = `translate(${x * 0.16}px, ${y * 0.24}px)`;
      });

      item.addEventListener("mouseleave", function () {
        item.style.transform = "";
      });
    });

    const tiltCards = document.querySelectorAll(".tilt-card");

    tiltCards.forEach(function (card) {
      card.addEventListener("mousemove", function (event) {
        if (window.innerWidth <= 900) return;

        const rect = card.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        card.style.setProperty("--mx", x + "px");
        card.style.setProperty("--my", y + "px");

        const rotateY = ((x / rect.width) - 0.5) * 7;
        const rotateX = ((y / rect.height) - 0.5) * -7;

        card.style.transform =
          `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
      });

      card.addEventListener("mouseleave", function () {
        card.style.transform = "";
      });
    });
















    /* TESTIMONIAL SLIDER */
const testimonialSlider = document.getElementById("testimonialSlider");

if (testimonialSlider) {
  const track = testimonialSlider.querySelector(".testimonial-track");
  const cards = Array.from(testimonialSlider.querySelectorAll(".review-card"));
  const prevBtn = testimonialSlider.querySelector(".testimonial-prev");
  const nextBtn = testimonialSlider.querySelector(".testimonial-next");
  const dotsWrap = testimonialSlider.querySelector(".testimonial-dots");

  let currentIndex = 0;
  let autoplayTimer = null;

  function getVisibleCards() {
    if (window.innerWidth <= 760) return 1;
    if (window.innerWidth <= 1120) return 2;
    return 3;
  }

  function getMaxIndex() {
    return Math.max(cards.length - getVisibleCards(), 0);
  }

  function createDots() {
    dotsWrap.innerHTML = "";

    for (let i = 0; i <= getMaxIndex(); i++) {
      const dot = document.createElement("button");
      dot.className = "testimonial-dot";
      dot.type = "button";
      dot.setAttribute("aria-label", `Go to testimonial slide ${i + 1}`);

      dot.addEventListener("click", function () {
        currentIndex = i;
        updateSlider();
        restartAutoplay();
      });

      dotsWrap.appendChild(dot);
    }
  }

  function updateDots() {
    const dots = dotsWrap.querySelectorAll(".testimonial-dot");

    dots.forEach((dot, index) => {
      dot.classList.toggle("active", index === currentIndex);
    });
  }

  function updateSlider() {
    const cardWidth = cards[0].offsetWidth;
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    const moveX = currentIndex * (cardWidth + gap);

    track.style.transform = `translateX(-${moveX}px)`;
    updateDots();
  }

  function nextSlide() {
    currentIndex = currentIndex >= getMaxIndex() ? 0 : currentIndex + 1;
    updateSlider();
  }

  function prevSlide() {
    currentIndex = currentIndex <= 0 ? getMaxIndex() : currentIndex - 1;
    updateSlider();
  }

  function startAutoplay() {
    autoplayTimer = setInterval(nextSlide, 4000);
  }

  function stopAutoplay() {
    clearInterval(autoplayTimer);
  }

  function restartAutoplay() {
    stopAutoplay();
    startAutoplay();
  }

  nextBtn.addEventListener("click", function () {
    nextSlide();
    restartAutoplay();
  });

  prevBtn.addEventListener("click", function () {
    prevSlide();
    restartAutoplay();
  });

  testimonialSlider.addEventListener("mouseenter", stopAutoplay);
  testimonialSlider.addEventListener("mouseleave", startAutoplay);

  window.addEventListener("resize", function () {
    currentIndex = Math.min(currentIndex, getMaxIndex());
    createDots();
    updateSlider();
  });

  createDots();
  updateSlider();
  startAutoplay();
}

/* GOOGLE REVIEW SLIDER */
const googleReviewSlider = document.getElementById("googleReviewSlider");

if (googleReviewSlider) {
  const track = googleReviewSlider.querySelector(".google-review-track");
  const cards = Array.from(googleReviewSlider.querySelectorAll(".google-review-card"));
  const prevBtn = googleReviewSlider.querySelector(".google-review-prev");
  const nextBtn = googleReviewSlider.querySelector(".google-review-next");
  const dotsWrap = googleReviewSlider.querySelector(".google-review-dots");

  let currentIndex = 0;
  let autoplayTimer = null;

  function getVisibleCards() {
    if (window.innerWidth <= 760) return 1;
    if (window.innerWidth <= 1120) return 2;
    return 3;
  }

  function getMaxIndex() {
    return Math.max(cards.length - getVisibleCards(), 0);
  }

  function updateSlider() {
    if (!cards.length) return;

    const cardWidth = cards[0].offsetWidth;
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    track.style.transform = `translateX(-${currentIndex * (cardWidth + gap)}px)`;

    dotsWrap.querySelectorAll(".google-review-dot").forEach((dot, index) => {
      dot.classList.toggle("active", index === currentIndex);
    });
  }

  function createDots() {
    dotsWrap.innerHTML = "";

    for (let i = 0; i <= getMaxIndex(); i++) {
      const dot = document.createElement("button");
      dot.className = "google-review-dot";
      dot.type = "button";
      dot.setAttribute("aria-label", `Go to Google review slide ${i + 1}`);
      dot.addEventListener("click", function () {
        currentIndex = i;
        updateSlider();
        restartAutoplay();
      });
      dotsWrap.appendChild(dot);
    }
  }

  function nextSlide() {
    currentIndex = currentIndex >= getMaxIndex() ? 0 : currentIndex + 1;
    updateSlider();
  }

  function prevSlide() {
    currentIndex = currentIndex <= 0 ? getMaxIndex() : currentIndex - 1;
    updateSlider();
  }

  function stopAutoplay() {
    clearInterval(autoplayTimer);
  }

  function startAutoplay() {
    if (getMaxIndex() > 0) autoplayTimer = setInterval(nextSlide, 4000);
  }

  function restartAutoplay() {
    stopAutoplay();
    startAutoplay();
  }

  prevBtn.addEventListener("click", function () {
    prevSlide();
    restartAutoplay();
  });

  nextBtn.addEventListener("click", function () {
    nextSlide();
    restartAutoplay();
  });

  googleReviewSlider.addEventListener("mouseenter", stopAutoplay);
  googleReviewSlider.addEventListener("mouseleave", startAutoplay);

  window.addEventListener("resize", function () {
    currentIndex = Math.min(currentIndex, getMaxIndex());
    createDots();
    updateSlider();
    restartAutoplay();
  });

  createDots();
  updateSlider();
  startAutoplay();
}
