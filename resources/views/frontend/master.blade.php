<!DOCTYPE html>
<html lang="en">
<head>
  @php
    $siteSetting = \App\Models\SiteSetting::current();
    $siteLogo = $siteSetting->logo ?: asset('assets/img/logo2.png');
    $centralMeta = \App\Models\MetaTag::where('status', 1)->where('page_key', optional(request()->route())->getName())->first();
    $pageMetaTitle = $centralMeta->meta_title ?? ($metaTitle ?? null);
    $pageMetaDescription = $centralMeta->meta_description ?? ($metaDescription ?? null);
    
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
    $practiceAreaCategories = \App\Models\PracticeArea::with(['services' => function ($query) {
        $query->where('status', 1)->orderBy('sort_order');
      }])
      ->where('status', 1)
      ->orderBy('sort_order')
      ->get();
    $importantFooterLinks = \App\Models\ImportantLink::where('status', 1)
      ->orderBy('sort_order')
      ->take(6)
      ->get();
  @endphp
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ $pageMetaTitle ?: ($siteSetting->seo_title ?: $siteSetting->site_name) }}</title>
  <meta name="description" content="{{ $pageMetaDescription ?: $siteSetting->seo_description }}" />
  <meta name="keywords" content="{{ $centralMeta->meta_keywords ?? ($practiceArea->meta_keywords ?? $siteSetting->seo_keywords) }}" />
  <meta property="og:title" content="{{ $pageMetaTitle ?: ($siteSetting->seo_title ?: $siteSetting->site_name) }}" />
  <meta property="og:description" content="{{ $pageMetaDescription ?: $siteSetting->seo_description }}" />
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
        <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i> Speak With an Advocate</a>
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

    $isJoinTeamActive = request()->routeIs('frontend.team.join');

    $isArticleActive = request()->routeIs(
        'frontend.articles.index',
        'frontend.articles.show'
    );

    $isSubmitArticleActive = request()->routeIs('frontend.articles.submit');

    $isVerdictActive = request()->routeIs(
        'frontend.verdicts.index',
        'frontend.verdicts.show'
    );

    $isCareerActive = request()->routeIs(
        'frontend.career-application.index',
        'frontend.internship-application.index'
    );

    $isResourceActive = request()->routeIs(
        'frontend.important-links.index',
        'frontend.awareness-videos.index',
        'frontend.legal-qa.index'
    );

    $isContactActive = request()->routeIs(
        'frontend.contact.index',
        'frontend.legal-enquiry.index'
    );

    $activePracticeSlug = optional(request()->route('practiceArea'))->slug
        ?: optional(optional(request()->route('practiceAreaService'))->practiceArea)->slug
        ?: request()->get('category');

    $activeServiceSlug = optional(request()->route('practiceAreaService'))->slug;
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

                    $isCurrentPractice = $activePracticeSlug === $practiceArea->slug;
                @endphp

                <div class="mega-card mega-practice-card {{ $isCurrentPractice ? 'active' : '' }}">
                    <a href="{{ route('frontend.practice-areas.show', ['practiceArea' => $practiceArea->slug]) }}"
                       class="mega-area-link">
                        <i class="{{ $practiceArea->icon_class ?: $practiceMeta['icon'] }}"></i>

                        <strong>
                            {{ $practiceArea->title }}
                        </strong>

                        <span>
                            {{ $practiceArea->short_description ?: $practiceMeta['text'] }}
                        </span>
                    </a>

                    @if($practiceArea->services->isNotEmpty())
                        <div class="mega-service-list">
                            @foreach($practiceArea->services as $service)
                                <a href="{{ route('frontend.practice-services.show', ['practiceAreaService' => $service->slug]) }}"
                                   class="mega-service-link {{ $activeServiceSlug === $service->slug ? 'active' : '' }}">
                                    {{ $service->title }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
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

    <div class="nav-drop team-nav-drop {{ ($isTeamActive || $isJoinTeamActive) ? 'active' : '' }}">
        <button type="button" class="nav-drop-btn {{ ($isTeamActive || $isJoinTeamActive) ? 'active' : '' }}">
            Our Team
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="nav-submenu">
            <a href="{{ route('frontend.team') }}" class="{{ $isTeamActive ? 'active' : '' }}">
                Our Team
            </a>

            <a href="{{ route('frontend.team.join') }}" class="{{ $isJoinTeamActive ? 'active' : '' }}">
                Join Team
            </a>
        </div>
    </div>

    <div class="nav-drop article-nav-drop {{ ($isArticleActive || $isSubmitArticleActive) ? 'active' : '' }}">
        <button type="button" class="nav-drop-btn {{ ($isArticleActive || $isSubmitArticleActive) ? 'active' : '' }}">
            Articles
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="nav-submenu">
            <a href="{{ route('frontend.articles.index') }}" class="{{ $isArticleActive ? 'active' : '' }}">
                Articles
            </a>

            <a href="{{ route('frontend.articles.submit') }}" class="{{ $isSubmitArticleActive ? 'active' : '' }}">
                Add Article
            </a>
            <a href="{{ route('frontend.verdicts.index') }}" class="{{ $isVerdictActive ? 'active' : '' }}">
        Verdicts
    </a>
        </div>
    </div>

    <div class="nav-drop resource-nav-drop {{ $isResourceActive ? 'active' : '' }}">
        <button type="button" class="nav-drop-btn {{ $isResourceActive ? 'active' : '' }}">
            Resources
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="nav-submenu">
            <a href="{{ route('frontend.important-links.index') }}" class="{{ request()->routeIs('frontend.important-links.index') ? 'active' : '' }}">
                Important Links
            </a>

            <a href="{{ route('frontend.awareness-videos.index') }}" class="{{ request()->routeIs('frontend.awareness-videos.index') ? 'active' : '' }}">
                 Videos
            </a>

            <a href="{{ route('frontend.legal-qa.index') }}" class="{{ request()->routeIs('frontend.legal-qa.index') ? 'active' : '' }}">
                Legal Q&A
            </a>
        </div>
    </div>

    

   

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

  @if(session('message'))
    <div class="frontend-success-modal" id="frontendSuccessModal" role="dialog" aria-modal="true" aria-labelledby="frontendSuccessTitle">
      <div class="frontend-success-card">
        <button type="button" class="frontend-success-close" id="frontendSuccessClose" aria-label="Close success popup">
          <i class="bi bi-x-lg"></i>
        </button>

        <div class="frontend-success-icon">
          <i class="bi bi-check2-circle"></i>
        </div>

        <span class="frontend-success-kicker">{{ session('message_title', 'Form Submission') }}</span>

        <h2 id="frontendSuccessTitle">{{ session('message_title', 'Thank You') }}</h2>

        <p class="frontend-success-message">
          {{ session('message') }}
        </p>

        <div class="frontend-success-contact">
          <span>For updates, contact us at</span>
          <a href="mailto:{{ $siteSetting->email }}">
            <i class="bi bi-envelope-fill"></i>
            {{ $siteSetting->email }}
          </a>
        </div>

        <button type="button" class="btn btn-primary magnetic" id="frontendSuccessOk">
          Okay
          <i class="bi bi-arrow-right"></i>
        </button>
      </div>
    </div>
  @endif


  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <h3>{{ $siteSetting->site_name }}</h3>
          <p>{{ $siteSetting->seo_description ?: 'Professional legal consultation, litigation support and client-focused guidance across important practice areas.' }}</p>
          <a href="{{ route('frontend.legal-enquiry.index') }}" class="footer-cta-link">
            Discuss Your Legal Matter
            <i class="bi bi-arrow-right"></i>
          </a>
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
            @foreach($practiceAreaCategories->take(6) as $practiceArea)
              @php
                $practiceMeta = $practiceAreaMeta[$practiceArea->slug] ?? ['anchor' => $practiceArea->slug];
              @endphp
              <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}">
                {{ $practiceArea->title }}
              </a>
            @endforeach
            <a href="{{ route('frontend.practice-area.index') }}" class="footer-more-link">View All Practice Areas</a>
          </div>
        </div>

        <div>
          <h4>Quick Links</h4>
          <div class="footer-links">
            <a href="/about">About Us</a>
            <a href="/our-team">Our Team</a>
            <a href="{{ route('frontend.team.join') }}">Join Our Team</a>
            <a href="{{ route('frontend.internship-application.index') }}">Internship Application</a>
            <a href="/articles">Articles</a>
            <a href="{{ route('frontend.verdicts.index') }}">Verdicts & Judgments</a>
            <a href="{{ route('frontend.career-application.index') }}">Career</a>
            <a href="/contact">Contact Us</a>
          </div>
        </div>

        <div>
          <h4>Resources</h4>
          <div class="footer-links">
            <a href="{{ route('frontend.important-links.index') }}">Important Legal Links</a>
            <a href="{{ route('frontend.awareness-videos.index') }}"> Videos</a>
            <a href="{{ route('frontend.legal-qa.index') }}">Legal Q&A</a>
            @foreach($importantFooterLinks->take(4) as $importantFooterLink)
              <a href="{{ $importantFooterLink->url }}" target="_blank" rel="noopener">{{ $importantFooterLink->title }}</a>
            @endforeach
            <a href="{{ route('frontend.important-links.index') }}" class="footer-more-link">View All Resources</a>
          </div>
        </div>

        <div>
          <h4>Contact Us</h4>
          <div class="footer-contact">
            <span><i class="bi bi-geo-alt-fill"></i> {{ $siteSetting->address_full }}</span>
            <a href="tel:{{ $siteSetting->phone }}"><i class="bi bi-telephone-fill"></i> {{ $siteSetting->phone }}</a>
            <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i> Speak With an Advocate</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>{{ $siteSetting->copyright_text }}</p>
        <p>
          <a href="{{ route('frontend.terms') }}">Terms</a> |
          <a href="{{ route('frontend.privacy') }}">Privacy</a> |
          <a href="{{ route('frontend.refund') }}">Refund</a>
        </p>
      </div>
    </div>
  </footer>

  <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="whatsapp-float" aria-label="Speak With an Advocate">
    <i class="bi bi-whatsapp"></i>
  </a>

  <div class="mobile-bottom-bar">
    <a href="tel:{{ $siteSetting->phone }}" class="active"><i class="bi bi-telephone-fill"></i>Call</a>
    <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank"><i class="bi bi-whatsapp"></i>Advocate</a>
    <a href="{{ route('frontend.legal-enquiry.index') }}"><i class="bi bi-calendar2-check-fill"></i>Book</a>
    <a href="{{ $siteSetting->map_direction_url ?: '#' }}" target="_blank"><i class="bi bi-geo-alt-fill"></i>Direction</a>
  </div>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @if($errors->any())
    <script>
      window.frontendValidationErrors = @json($errors->messages());
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const errors = window.frontendValidationErrors || {};

        Object.keys(errors).forEach(function (field) {
          const input = document.querySelector('[name="' + field.replace(/"/g, '\\"') + '"]');

          if (!input) {
            return;
          }

          const holder = input.closest('.form-group') || input.closest('.consent-check') || input.parentElement;

          if (!holder) {
            return;
          }

          holder.classList.add('has-field-error');

          if (holder.querySelector('.frontend-field-error')) {
            return;
          }

          const error = document.createElement('p');
          error.className = 'frontend-field-error';
          error.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> ' + errors[field][0];
          holder.appendChild(error);
        });

        const firstError = document.querySelector('.has-field-error');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      });
    </script>
  @endif
  @if(session('message'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('frontendSuccessModal');
        const close = document.getElementById('frontendSuccessClose');
        const ok = document.getElementById('frontendSuccessOk');

        function hideSuccessModal() {
          if (!modal) return;
          modal.classList.add('is-hidden');
        }

        close && close.addEventListener('click', hideSuccessModal);
        ok && ok.addEventListener('click', hideSuccessModal);
        modal && modal.addEventListener('click', function (event) {
          if (event.target === modal) {
            hideSuccessModal();
          }
        });
      });
    </script>
  @endif
  @yield('scripts')
</body>
</html>

