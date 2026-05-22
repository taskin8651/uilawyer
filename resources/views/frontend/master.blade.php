<!DOCTYPE html>
<html lang="en">
<head>
  @php
    $siteSetting = \App\Models\SiteSetting::current();
    $siteLogo = $siteSetting->logo ?: asset('assets/img/logo2.png');
    $practiceAreaMeta = [
      'family-law' => ['icon' => 'bi bi-heartbreak', 'text' => 'Divorce, custody, maintenance and domestic violence matters.', 'anchor' => 'family-law'],
      'criminal-law' => ['icon' => 'bi bi-shield-lock', 'text' => 'Bail, FIR, trial cases, NDPS and economic offences.', 'anchor' => 'criminal-law'],
      'civil-law' => ['icon' => 'bi bi-bank', 'text' => 'Civil disputes, recovery, probate and court process support.', 'anchor' => 'civil-law'],
      'property-law' => ['icon' => 'bi bi-house-lock-fill', 'text' => 'Property disputes, title documents, inheritance and possession matters.', 'anchor' => 'civil-law'],
      'muslim-law' => ['icon' => 'bi bi-people-fill', 'text' => 'Khula, Mubaraat and personal law guidance.', 'anchor' => 'muslim-law'],
      'service-matters' => ['icon' => 'bi bi-person-vcard', 'text' => 'Employment disputes and departmental proceedings.', 'anchor' => 'service-matters'],
      'cyber-law' => ['icon' => 'bi bi-globe2', 'text' => 'Cyber crime, cyber fraud and digital evidence support.', 'anchor' => 'cyber-law'],
      'legal-notice' => ['icon' => 'bi bi-file-earmark-text', 'text' => 'Legal notice drafting, replies and cheque bounce support.', 'anchor' => 'legal-notice'],
    ];
    $practiceAreaCategories = \App\Models\PracticeArea::where('status', 1)
      ->orderBy('sort_order')
      ->get();
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
  <link rel="stylesheet" href="{{ asset('assets/css/article-detail.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/book-consultation.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/practice-area.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/service-detail.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/our-team.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/career.css') }}">

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
        <a href="tel:{{ $siteSetting->phone }}"><i class="bi bi-telephone-fill"></i> {{ $siteSetting->phone }}</a>
        <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        <a href="{{ route('frontend.career-application.index') }}"><i class="bi bi-briefcase-fill"></i> Career</a>
      </div>
    </div>
  </div>

  <!-- HEADER START -->
  <header class="site-header" id="siteHeader">
    <div class="container header-wrap">
      <a href="{{ url('/') }}" class="brand has-logo" aria-label="{{ $siteSetting->site_name }}">
        <img class="brand-logo-img" src="{{ $siteLogo }}" alt="{{ $siteSetting->site_name }} logo">
      </a>

      <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

      <div class="navbar-shell" id="navbarShell">
       @php
    $isHomeActive = request()->routeIs('frontend.index');

    $isPracticeActive = request()->routeIs(
        'frontend.practice-area.index',
        'frontend.practice-areas.show',
        'frontend.practice-services.show'
    );

    $isAboutActive = request()->routeIs('frontend.about');

    $isTeamActive = request()->routeIs(
        'frontend.team',
        'frontend.attorneys.show'
    );

    $isArticleActive = request()->routeIs(
        'frontend.articles.index',
        'frontend.articles.show'
    );

    $isCareerActive = request()->routeIs(
        'frontend.career-application.index'
    );

    $isContactActive = request()->routeIs(
        'frontend.contact.index',
        'frontend.legal-enquiry.index'
    );
@endphp

<nav class="navbar">

    <a href="{{ route('frontend.index') }}" class="{{ $isHomeActive ? 'active' : '' }}">
        Home
    </a>

    <div class="nav-drop {{ $isPracticeActive ? 'active' : '' }}" id="navDrop">
        <button type="button" class="nav-drop-btn {{ $isPracticeActive ? 'active' : '' }}">
            Practice Areas
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="mega-menu">
            @forelse($practiceAreaCategories as $practiceArea)
                @php
                    $practiceMeta = $practiceAreaMeta[$practiceArea->slug] ?? [
                        'icon' => $practiceArea->icon_class ?: 'bi bi-grid-3x3-gap-fill',
                        'text' => 'Legal consultation and case support for ' . strtolower($practiceArea->title) . ' matters.',
                        'anchor' => $practiceArea->slug,
                    ];

                    $isCurrentPractice =
                        request()->get('category') === $practiceArea->slug
                        || request()->is('practice-areas/' . $practiceArea->slug);
                @endphp

                <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}"
                   class="mega-card {{ $isCurrentPractice ? 'active' : '' }}">

                    <i class="{{ $practiceArea->icon_class ?: $practiceMeta['icon'] }}"></i>

                    <strong>
                        {{ $practiceArea->title }}
                    </strong>

                    <span>
                        {{ $practiceArea->short_description ?: $practiceMeta['text'] }}
                    </span>
                </a>
            @empty
                <a href="{{ route('frontend.practice-area.index') }}" class="mega-card">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <strong>Practice Areas</strong>
                    <span>Explore legal services and consultation categories.</span>
                </a>
            @endforelse
        </div>
    </div>

    <a href="{{ route('frontend.about') }}" class="{{ $isAboutActive ? 'active' : '' }}">
        About
    </a>

    <a href="{{ route('frontend.team') }}" class="{{ $isTeamActive ? 'active' : '' }}">
        Our Team
    </a>

    <a href="{{ route('frontend.articles.index') }}" class="{{ $isArticleActive ? 'active' : '' }}">
        Articles
    </a>

    <a href="{{ route('frontend.career-application.index') }}" class="{{ $isCareerActive ? 'active' : '' }}">
        Career
    </a>

    <a href="{{ route('frontend.contact.index') }}" class="{{ $isContactActive ? 'active' : '' }}">
        Contact
    </a>

</nav>
      </div>

      <div class="header-actions">
        <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-dark magnetic"><i class="bi bi-calendar2-check"></i> Book
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
            @foreach($practiceAreaCategories as $practiceArea)
              @php
                $practiceMeta = $practiceAreaMeta[$practiceArea->slug] ?? ['anchor' => $practiceArea->slug];
              @endphp
              <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}">
                {{ $practiceArea->title }}
              </a>
            @endforeach
          </div>
        </div>

        <div>
          <h4>Important Links</h4>
          <div class="footer-links">
            <a href="/about">About Us</a>
            <a href="/our-team">Our Team</a>
            <a href="/articles">Articles</a>
            <a href="/career-application">Career</a>
            <a href="/contact">Contact Us</a>
            <a href="{{ route('frontend.legal-enquiry.index') }}">Book Consultation</a>
          </div>
        </div>

        <div>
          <h4>Contact Us</h4>
          <div class="footer-contact">
            <span><i class="bi bi-geo-alt-fill"></i> {{ $siteSetting->address_full }}</span>
            <a href="tel:{{ $siteSetting->phone }}"><i class="bi bi-telephone-fill"></i> {{ $siteSetting->phone }}</a>
            <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp
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

  <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <div class="mobile-bottom-bar">
    <a href="tel:{{ $siteSetting->phone }}" class="active"><i class="bi bi-telephone-fill"></i>Call</a>
    <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i>WhatsApp</a>
    <a href="#consultation"><i class="bi bi-calendar2-check-fill"></i>Book</a>
    <a href="{{ $siteSetting->map_direction_url ?: '#' }}" target="_blank"><i class="bi bi-geo-alt-fill"></i>Direction</a>
  </div>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

