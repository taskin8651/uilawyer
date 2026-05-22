
@extends('frontend.master')
@section('content')


@php 
    $siteSetting = \App\Models\SiteSetting::first();
@endphp


  <!-- BREADCRUMB START -->
  <section class="team-breadcrumb">
    <div class="team-breadcrumb-grid-bg"></div>
    <div class="team-breadcrumb-shine"></div>
    <div class="team-orb team-orb-one"></div>
    <div class="team-orb team-orb-two"></div>

    <div class="container">
      <div class="team-breadcrumb-card reveal">

        <span class="team-breadcrumb-badge">
          <i class="bi bi-person-badge-fill"></i>
          Our Legal Professionals
        </span>

        <h1>
          Meet Our
          <span>Legal Team</span>
        </h1>

        <p>
          Connect with experienced attorneys and legal professionals at Rajpati & Associates
          for confidential consultation, practical legal guidance and court-related support.
        </p>

        <nav class="team-crumb" aria-label="breadcrumb">
          <a href="/">Home</a>
          <i class="bi bi-chevron-right"></i>
          <span>Our Team</span>
        </nav>

        <div class="team-breadcrumb-stats">
          <div>
            <strong>1999</strong>
            <span>Trusted Since</span>
          </div>

          <div>
            <strong>All India</strong>
            <span>Legal Services</span>
          </div>

          <div>
            <strong>Multi</strong>
            <span>Practice Areas</span>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- BREADCRUMB END -->


  <!-- TEAM INTRO START -->
  <section class="section team-intro-section">
    <div class="container team-intro-grid">

      <div class="team-intro-card reveal">
        <span class="kicker">
          <i class="bi bi-shield-check"></i>
          Trusted Legal Team
        </span>

        <h2 class="section-title">
          Professional Attorneys For Serious Legal Matters.
        </h2>

        <p class="section-text">
          Rajpati & Associates brings together legal professionals with practice area
          experience across family law, criminal law, civil matters, service disputes,
          cyber law and litigation support.
        </p>

        <p class="section-text">
          Each profile card helps visitors understand the attorney’s designation,
          location, experience, practice areas and consultation options.
        </p>
      </div>

      <div class="team-intro-points reveal">

        <div class="team-intro-point">
          <i class="bi bi-lock-fill"></i>
          <div>
            <strong>Confidential Consultation</strong>
            <span>Private discussion for sensitive and serious legal matters.</span>
          </div>
        </div>

        <div class="team-intro-point">
          <i class="bi bi-bank2"></i>
          <div>
            <strong>Court & Litigation Support</strong>
            <span>Guidance for case process, documents and legal proceedings.</span>
          </div>
        </div>

        <div class="team-intro-point">
          <i class="bi bi-grid-3x3-gap-fill"></i>
          <div>
            <strong>Multiple Practice Areas</strong>
            <span>Family, criminal, civil, property, cyber and service matters.</span>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- TEAM INTRO END -->


  <!-- LEADERSHIP START -->
  <section class="section leadership-section">
    <div class="container leadership-grid">

      <div class="leadership-visual reveal">
        <div class="leadership-photo">
          <img src="https://www.rajpatiandassociates.com/frontend/assets/images/team/pramod-rajpati.jpg" alt="Pramod Rajpati founder profile image">
        </div>

        <div class="leadership-floating-card">
          <i class="bi bi-award-fill"></i>
          <div>
            <small>Founder Profile</small>
            <strong>Trusted Since 1999</strong>
          </div>
        </div>
      </div>

      <div class="leadership-content-card reveal">
        <span class="kicker">
          <i class="bi bi-person-check-fill"></i>
          Founder & Leadership
        </span>

        <h2 class="section-title">
          Led By A Client-Focused Legal Approach.
        </h2>

        <p class="section-text">
          The leadership at Rajpati & Associates is focused on practical legal guidance,
          ethical consultation, clear communication and responsible case handling.
        </p>

        <div class="leadership-meta-grid">

          <div>
            <i class="bi bi-person-fill"></i>
            <strong>Pramod Rajpati</strong>
            <span>CEO & Founder</span>
          </div>

          <div>
            <i class="bi bi-geo-alt-fill"></i>
            <strong>Patna, Bihar</strong>
            <span>Legal support base</span>
          </div>

          <div>
            <i class="bi bi-briefcase-fill"></i>
            <strong>Litigation</strong>
            <span>Consultation support</span>
          </div>

          <div>
            <i class="bi bi-shield-check"></i>
            <strong>Confidential</strong>
            <span>Client-first guidance</span>
          </div>

        </div>

        <div class="leadership-actions">
          <a href="{{ $attorneys->first() ? route('frontend.attorneys.show', $attorneys->first()) : route('frontend.team') }}" class="btn btn-primary magnetic">
            View Founder Profile
            <i class="bi bi-arrow-right"></i>
          </a>

          <a href="/#consultation" class="btn btn-dark magnetic">
            Consult Now
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- LEADERSHIP END -->


  <!-- ATTORNEY CARDS START -->
  <section class="section attorneys-section">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-people-fill"></i>
          Attorney Profiles
        </span>

        <h2 class="section-title">
          Our Attorneys & Legal Professionals.
        </h2>

        <p class="section-text">
          Browse attorney profiles with designation, location, experience, practice areas,
          profile page link and direct consultation action.
        </p>
      </div>

      <div class="attorney-grid">

    @forelse($attorneys as $attorney)
        <article class="attorney-card reveal">
            <div class="attorney-photo">
                <img src="{{ $attorney->image ?: asset('assets/img/logo2.png') }}"
                     alt="{{ $attorney->name }} attorney profile">

                @if($attorney->badge)
                    <span class="attorney-badge">{{ $attorney->badge }}</span>
                @endif
            </div>

            <div class="attorney-body">
                <h3>{{ $attorney->name }}</h3>

                @if($attorney->designation)
                    <p class="attorney-designation">{{ $attorney->designation }}</p>
                @endif

                @if(!empty($attorney->meta_items))
                    <div class="attorney-meta">
                        @foreach($attorney->meta_items as $meta)
                            @if(!empty($meta['text']))
                                <span>
                                    <i class="{{ $meta['icon'] ?? 'bi bi-check-circle-fill' }}"></i>
                                    {{ $meta['text'] }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                @endif

                @if(!empty($attorney->tags))
                    <div class="attorney-tags">
                        @foreach($attorney->tags as $tag)
                            @if($tag)
                                <span>{{ $tag }}</span>
                            @endif
                        @endforeach
                    </div>
                @endif

                <div class="attorney-actions">
                    @if($attorney->profile_button_text)
                        <a href="{{ route('frontend.attorneys.show', $attorney) }}" class="profile-btn">
                            {{ $attorney->profile_button_text }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif

                    @if($attorney->consult_button_text)
                        <a href="{{ $attorney->consult_button_url ?: '#consultation' }}" class="consult-btn">
                            {{ $attorney->consult_button_text }}
                        </a>
                    @endif
                </div>
            </div>
        </article>
    @empty
        <p>No attorney profiles found.</p>
    @endforelse

</div>

    </div>
  </section>
  <!-- ATTORNEY CARDS END -->


  <!-- PRACTICE SUPPORT START -->
  <section class="section team-practice-section">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-grid-3x3-gap-fill"></i>
          Team Practice Support
        </span>

        <h2 class="section-title">
          Legal Support Across Important Practice Areas.
        </h2>

        <p class="section-text">
          Our team page helps users quickly understand which legal matters the firm can support.
        </p>
      </div>

    <div class="team-practice-grid">

    @forelse($teamPractices as $practiceArea)

        <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}"
           class="team-practice-card reveal">

            <i class="{{ $practiceArea->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>

            <h3>
                {{ $practiceArea->title }}
            </h3>

            <p>
                {{ $practiceArea->short_description ?: 'Legal consultation and case support for ' . strtolower($practiceArea->title) . ' matters.' }}
            </p>

        </a>

    @empty

        <a href="{{ route('frontend.practice-area.index', ['category' => 'family-law']) }}"
           class="team-practice-card reveal">
            <i class="bi bi-heartbreak"></i>
            <h3>Family & Divorce Law</h3>
            <p>Divorce, maintenance, child custody and domestic violence guidance.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'criminal-law']) }}"
           class="team-practice-card reveal">
            <i class="bi bi-shield-lock"></i>
            <h3>Criminal Law</h3>
            <p>Bail, FIR, trial cases, NDPS and criminal defence support.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'civil-law']) }}"
           class="team-practice-card reveal">
            <i class="bi bi-bank"></i>
            <h3>Civil & Property</h3>
            <p>Property disputes, recovery, succession and civil litigation.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'cyber-law']) }}"
           class="team-practice-card reveal">
            <i class="bi bi-globe2"></i>
            <h3>Cyber Law</h3>
            <p>Cyber fraud, cyber crime, online complaint and evidence support.</p>
        </a>

    @endforelse

</div>

    </div>
  </section>
  <!-- PRACTICE SUPPORT END -->


  <!-- TEAM CTA START -->
  <section class="section team-cta-section">
    <div class="container">

      <div class="team-cta-box reveal">
        <div>
          <span class="team-cta-badge">
            <i class="bi bi-chat-square-text-fill"></i>
            Need Legal Consultation?
          </span>

          <h2>
            Speak With Our Legal Team For Confidential Guidance.
          </h2>

          <p>
            Book consultation for divorce, criminal law, civil law, property disputes,
            service matters, cyber law, legal notice or court-related support.
          </p>
        </div>

        <div class="team-cta-actions">
          <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic">
            <i class="bi bi-telephone-fill"></i>
            Call Now
          </a>

          <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-primary magnetic">
            <i class="bi bi-whatsapp"></i>
            WhatsApp Us
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- TEAM CTA END -->

@endsection
