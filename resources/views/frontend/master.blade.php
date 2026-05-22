<!DOCTYPE html>
<html lang="en">
<head>
  @php
    $siteSetting = \App\Models\SiteSetting::current();
    $siteLogo = $siteSetting->logo ?: asset('assets/img/logo2.png');
  @endphp
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ $siteSetting->seo_title ?: $siteSetting->site_name }}</title>
  <meta name="description" content="{{ $siteSetting->seo_description }}" />
  <meta name="keywords" content="{{ $siteSetting->seo_keywords }}" />
  <meta property="og:title" content="{{ $siteSetting->seo_title ?: $siteSetting->site_name }}" />
  <meta property="og:description" content="{{ $siteSetting->seo_description }}" />
  @if($siteSetting->seo_image)
    <meta property="og:image" content="{{ $siteSetting->seo_image }}" />
  @endif
  @if($siteSetting->favicon)
    <link rel="icon" href="{{ $siteSetting->favicon }}">
  @endif

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Marcellus&family=Manrope:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/articles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/book-consultation.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/service-detail.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/our-team.css') }}">

</head>
<body>
  <div class="scroll-progress" id="scrollProgress"></div>
  <div class="cursor-glow" id="cursorGlow"></div>

  <div class="topbar">
    <div class="container topbar-wrap">
      <div class="topbar-left">
        <a href="{{ $siteSetting->map_direction_url ?: '#' }}" target="_blank"><i class="bi bi-geo-alt-fill"></i> {{ $siteSetting->address_short }}</a>
        <span><i class="bi bi-award-fill"></i> {{ $siteSetting->tagline }}</span>
      </div>
      <div class="topbar-right">
        <a href="{{ $siteSetting->phone_link }}"><i class="bi bi-telephone-fill"></i> {{ $siteSetting->phone }}</a>
        <a href="{{ $siteSetting->whatsapp_link }}" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        <a href="#"><i class="bi bi-briefcase-fill"></i> Career</a>
      </div>
    </div>
  </div>

  <!-- HEADER START -->
  <header class="site-header" id="siteHeader">
    <div class="container header-wrap">
      <a href="index.html" class="brand has-logo" aria-label="{{ $siteSetting->site_name }}">
        <img class="brand-logo-img" src="{{ $siteLogo }}" alt="{{ $siteSetting->site_name }} logo">
      </a>

      <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

      <div class="navbar-shell" id="navbarShell">
        <nav class="navbar">
          <a href="index.html" class="active">Home</a>
          <div class="nav-drop" id="navDrop">
            <button type="button" class="nav-drop-btn">Practice Areas <i class="bi bi-chevron-down"></i></button>
            <div class="mega-menu">
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-heartbreak"></i><strong>Family
                  Law</strong><span>Divorce,
                  custody, maintenance and domestic violence matters.</span></a>
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-shield-lock"></i><strong>Criminal
                  Law</strong><span>Bail,
                  FIR, trial cases, NDPS and economic offences.</span></a>
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-bank"></i><strong>Civil
                  Law</strong><span>Property,
                  succession, probate, inheritance and recovery.</span></a>
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-people-fill"></i><strong>Muslim
                  Law</strong><span>Khula,
                  Mubara’at and personal law guidance.</span></a>
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-person-vcard"></i><strong>Service
                  Matters</strong><span>Employment disputes and departmental proceedings.</span></a>
              <a href="service-divorce-lawyer.html" class="mega-card"><i class="bi bi-globe2"></i><strong>Cyber
                  Law</strong><span>Cyber crime,
                  cyber fraud and digital evidence support.</span></a>
            </div>
          </div>
          <a href="about.html">About</a>
          <a href="our-team.html">Our Team</a>
          <a href="articles.html">Articles</a>
          <a href="contact.html">Contact</a>
        </nav>
      </div>

      <div class="header-actions">
        <a href="book-consultation.html" class="btn btn-dark magnetic"><i class="bi bi-calendar2-check"></i> Book
          Consultation</a>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu"><i class="bi bi-list"></i></button>
      </div>
    </div>
  </header>
  <!-- HEADER END -->


  @yield('content')


  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <h3>{{ $siteSetting->site_name }}</h3>
          <p>{{ $siteSetting->seo_description }}</p>
          <div class="socials">
            @if($siteSetting->facebook_url)<a href="{{ $siteSetting->facebook_url }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif
            @if($siteSetting->twitter_url)<a href="{{ $siteSetting->twitter_url }}" target="_blank"><i class="bi bi-twitter-x"></i></a>@endif
            @if($siteSetting->instagram_url)<a href="{{ $siteSetting->instagram_url }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif
            @if($siteSetting->youtube_url)<a href="{{ $siteSetting->youtube_url }}" target="_blank"><i class="bi bi-youtube"></i></a>@endif
            @if($siteSetting->linkedin_url)<a href="{{ $siteSetting->linkedin_url }}" target="_blank"><i class="bi bi-linkedin"></i></a>@endif
          </div>
        </div>

        <div>
          <h4>Practice Areas</h4>
          <div class="footer-links">
            <a href="#">Divorce Lawyer</a>
            <a href="#">Criminal Lawyer</a>
            <a href="#">Civil Lawyer</a>
            <a href="#">Muslim Lawyer</a>
            <a href="#">Cyber Crime Lawyer</a>
          </div>
        </div>

        <div>
          <h4>Important Links</h4>
          <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Our Team</a>
            <a href="#">Articles</a>
            <a href="#">Verdict & Judgement</a>
            <a href="#">Career</a>
            <a href="#">Contact Us</a>
          </div>
        </div>

        <div>
          <h4>Contact Us</h4>
          <div class="footer-contact">
            <span><i class="bi bi-geo-alt-fill"></i> {{ $siteSetting->address_full }}</span>
            <a href="{{ $siteSetting->phone_link }}"><i class="bi bi-telephone-fill"></i> {{ $siteSetting->phone }}</a>
            <a href="{{ $siteSetting->whatsapp_link }}" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp
              Consultation</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>{{ $siteSetting->copyright_text }}</p>
        <p><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Refund</a></p>
      </div>
    </div>
  </footer>

  <a href="{{ $siteSetting->whatsapp_link }}" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <div class="mobile-bottom-bar">
    <a href="{{ $siteSetting->phone_link }}" class="active"><i class="bi bi-telephone-fill"></i>Call</a>
    <a href="{{ $siteSetting->whatsapp_link }}" target="_blank"><i class="bi bi-whatsapp"></i>WhatsApp</a>
    <a href="#consultation"><i class="bi bi-calendar2-check-fill"></i>Book</a>
    <a href="{{ $siteSetting->map_direction_url ?: '#' }}" target="_blank"><i class="bi bi-geo-alt-fill"></i>Direction</a>
  </div>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

