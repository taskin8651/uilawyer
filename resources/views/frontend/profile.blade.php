

@extends('frontend.master')
@section('content')
@php
    $profileImage = $attorney->image ?: asset('assets/img/logo2.png');
    $metaItems = collect($attorney->meta_items ?? [])->filter(fn ($meta) => !empty($meta['text']))->values();
    $tags = collect($attorney->tags ?? [])->filter()->values();
    $locationMeta = $metaItems->first(fn ($meta) => str_contains($meta['icon'] ?? '', 'geo'));
    $experienceMeta = $metaItems->first(fn ($meta) => str_contains($meta['icon'] ?? '', 'award') || str_contains($meta['icon'] ?? '', 'calendar'));
    $practiceMeta = $metaItems->first(fn ($meta) => str_contains($meta['icon'] ?? '', 'bank'));
    $location = $attorney->place_of_practice ?: ($locationMeta['text'] ?? 'Patna, Bihar');
    $experience = $attorney->experience ?: ($experienceMeta['text'] ?? 'Trusted Since 1999');
    $practiceFocus = $attorney->practice_areas_text ?: ($tags->isNotEmpty() ? $tags->implode(' & ') : ($practiceMeta['text'] ?? 'Litigation & Consultation'));

    $siteSetting = \App\Models\SiteSetting::first();
@endphp

  <!-- BREADCRUMB START -->
  <section class="profile-breadcrumb">
    <div class="profile-breadcrumb-grid-bg"></div>
    <div class="profile-breadcrumb-shine"></div>
    <div class="profile-orb profile-orb-one"></div>
    <div class="profile-orb profile-orb-two"></div>

    <div class="container">
      <div class="profile-breadcrumb-card reveal">

        <span class="profile-breadcrumb-badge">
          <i class="bi bi-person-badge-fill"></i>
          Attorney Profile
        </span>

        <h1>
          {{ $attorney->name }}
          <span>Profile</span>
        </h1>

        <p>
          {{ $attorney->designation ?: 'Legal Professional' }} at Rajpati & Associates, focused on ethical consultation,
          practical legal guidance and client-first legal assistance.
        </p>

        <nav class="profile-crumb" aria-label="breadcrumb">
          <a href="index.html">Home</a>
          <i class="bi bi-chevron-right"></i>
          <a href="{{ route('frontend.team') }}">Our Team</a>
          <i class="bi bi-chevron-right"></i>
          <span>{{ $attorney->name }}</span>
        </nav>

        <div class="profile-breadcrumb-stats">
          <div>
            <strong>{{ $attorney->badge ?: 'Profile' }}</strong>
            <span>Leadership Profile</span>
          </div>

          <div>
            <strong>{{ $location }}</strong>
            <span>Legal Support Base</span>
          </div>

          <div>
            <strong>{{ $experience }}</strong>
            <span>Trusted Guidance</span>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- BREADCRUMB END -->


  <!-- PROFILE MAIN START -->
  <section class="section profile-main-section">
    <div class="container profile-main-grid">

      <div class="profile-photo-card reveal">

        <div class="profile-photo">
          <img src="{{ $profileImage }}" alt="{{ $attorney->name }} attorney profile image">
        </div>

        <div class="profile-card-body">
          <h2>{{ $attorney->name }}</h2>
          <p>{{ $attorney->designation ?: 'Legal Professional' }}</p>

          <div class="profile-mini-meta">
            @forelse($metaItems->take(3) as $meta)
              <span><i class="{{ $meta['icon'] ?? 'bi bi-check-circle-fill' }}"></i> {{ $meta['text'] }}</span>
            @empty
              <span><i class="bi bi-geo-alt-fill"></i> {{ $location }}</span>
              <span><i class="bi bi-bank2"></i> {{ $practiceFocus }}</span>
              <span><i class="bi bi-award-fill"></i> {{ $experience }}</span>
            @endforelse
          </div>

          <div class="profile-card-actions">
            <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic">
              <i class="bi bi-telephone-fill"></i>
              Call Now
            </a>

            <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank">
              <i class="bi bi-whatsapp"></i>
              Speak With an Advocate
            </a>
          </div>
        </div>

      </div>

      <div class="profile-content-card reveal">

        <span class="kicker">
          <i class="bi bi-person-check-fill"></i>
          {{ $attorney->badge ?: 'Legal Professional' }}
        </span>

        <h2 class="section-title">
          Client-Focused Legal Guidance With Professional Care.
        </h2>

        <p class="section-text">
          @if($attorney->biography)
            {{ $attorney->biography }}
          @elseif($attorney->about_team)
            {{ $attorney->about_team }}
          @else
            {{ $attorney->name }} is associated with Rajpati & Associates,
            a Patna-based legal services firm known for All India Legal Services and legal
            guidance since 1999.
          @endif
        </p>

        <p class="section-text">
          The profile focuses on {{ strtolower($practiceFocus) }}, practical consultation,
          ethical communication, case understanding, document guidance and clear legal direction.
        </p>

        <div class="profile-info-grid">

          <div>
            <i class="bi bi-person-fill"></i>
            <strong>Designation</strong>
            <span>{{ $attorney->designation ?: 'Legal Professional' }}</span>
          </div>

          <div>
            <i class="bi bi-geo-alt-fill"></i>
            <strong>Location</strong>
            <span>{{ $location }}</span>
          </div>

          <div>
            <i class="bi bi-calendar-check-fill"></i>
            <strong>Experience</strong>
            <span>{{ $experience }}</span>
          </div>

          <div>
            <i class="bi bi-shield-check"></i>
            <strong>Languages</strong>
            <span>{{ $attorney->languages_spoken ?: 'Hindi, English' }}</span>
          </div>

        </div>

        <div class="profile-actions">
          <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-primary magnetic">
            Book Consultation
            <i class="bi bi-arrow-right"></i>
          </a>

          <a href="{{ route('frontend.team') }}" class="btn btn-dark magnetic">
            Back To Team
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- PROFILE MAIN END -->

  <section class="section attorney-credentials-section">
    <div class="container attorney-credentials-grid">
      @foreach([
        ['bi bi-mortarboard-fill', 'Qualifications', $attorney->qualifications],
        ['bi bi-grid-3x3-gap-fill', 'Key Practice Areas', $attorney->practice_areas_text],
        ['bi bi-bank2', 'Courts Represented Before', $attorney->courts_represented],
        ['bi bi-chat-square-text-fill', 'Languages Spoken', $attorney->languages_spoken],
      ] as $item)
        <div class="attorney-credential-card reveal">
          <i class="{{ $item[0] }}"></i>
          <h3>{{ $item[1] }}</h3>
          <p>{{ $item[2] ?: 'Details can be updated from the attorney admin profile.' }}</p>
        </div>
      @endforeach
    </div>
  </section>


  <!-- PRACTICE AREAS START -->
  <section class="section profile-practice-section">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-grid-3x3-gap-fill"></i>
          Practice Areas
        </span>

        <h2 class="section-title">
          Legal Matters Handled By The Firm.
        </h2>

        <p class="section-text">
          Visitors can understand the main legal categories connected with this profile.
        </p>
      </div>

     <div class="profile-practice-grid">

    @forelse($teamPractices as $practiceArea)

        <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}"
           class="profile-practice-card reveal">

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
           class="profile-practice-card reveal">
            <i class="bi bi-heartbreak"></i>
            <h3>Family Law</h3>
            <p>Divorce, maintenance, domestic violence and child custody matters.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'criminal-law']) }}"
           class="profile-practice-card reveal">
            <i class="bi bi-shield-lock"></i>
            <h3>Criminal Law</h3>
            <p>Bail, FIR, criminal complaints, trial support and legal consultation.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'civil-law']) }}"
           class="profile-practice-card reveal">
            <i class="bi bi-bank"></i>
            <h3>Civil Law</h3>
            <p>Property disputes, recovery, succession, inheritance and civil cases.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'cyber-law']) }}"
           class="profile-practice-card reveal">
            <i class="bi bi-globe2"></i>
            <h3>Cyber Law</h3>
            <p>Cyber crime, cyber fraud, cyber litigation and digital evidence support.</p>
        </a>

    @endforelse

</div>

    </div>
  </section>
  <!-- PRACTICE AREAS END -->


  <!-- PROFESSIONAL APPROACH START -->
  <section class="section profile-approach-section">
    <div class="container profile-approach-grid">

      <div class="profile-approach-content reveal">

        <span class="kicker">
          <i class="bi bi-lightbulb-fill"></i>
          Professional Approach
        </span>

        <h2 class="section-title">
          Clear Communication, Practical Advice & Ethical Handling.
        </h2>

        <p class="section-text">
          Legal matters require patience, confidentiality and proper understanding.
          The profile page should build trust by showing the attorney’s approach,
          practice focus and consultation process.
        </p>

      </div>

      <div class="profile-approach-list reveal">

        <div>
          <i class="bi bi-lock-fill"></i>
          <strong>Confidential Consultation</strong>
          <span>Private discussion for sensitive legal matters and case facts.</span>
        </div>

        <div>
          <i class="bi bi-file-earmark-text-fill"></i>
          <strong>Document Guidance</strong>
          <span>Support for legal notice, case papers, ID proof and supporting documents.</span>
        </div>

        <div>
          <i class="bi bi-bank2"></i>
          <strong>Court Process Support</strong>
          <span>Guidance for hearings, filing, notices, reply and litigation steps.</span>
        </div>

        <div>
          <i class="bi bi-chat-square-text-fill"></i>
          <strong>Clear Legal Direction</strong>
          <span>Simple explanation of options, risks, remedies and next action.</span>
        </div>

      </div>

    </div>
  </section>
  <!-- PROFESSIONAL APPROACH END -->


  <!-- CONSULT FORM START -->
  <section class="section profile-consult-section">
    <div class="container profile-consult-grid">

      <div class="profile-consult-content reveal">
        <span class="kicker">
          <i class="bi bi-calendar2-check-fill"></i>
          Consult This Profile
        </span>

        <h2 class="section-title">
          Share Your Legal Matter For Consultation.
        </h2>

        <p class="section-text">
          Submit your name, contact number, case category, city/state and message.
          You can also upload case document or ID proof.
        </p>

        <div class="profile-consult-points">
          <span><i class="bi bi-check-circle-fill"></i> Confidential enquiry</span>
          <span><i class="bi bi-check-circle-fill"></i> Call / advocate chat follow-up</span>
          <span><i class="bi bi-check-circle-fill"></i> Document upload support</span>
        </div>
      </div>

      <div class="profile-form-card reveal">

        <h3>Get Legal Advice</h3>

        @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        Please check the required fields and try again.
    </div>
@endif

<form class="profile-form"
      method="POST"
      action="{{ route('frontend.legal-enquiry.store') }}"
      enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="form_type" value="attorney_profile">

    <p class="confidential-note">
        <i class="bi bi-shield-lock-fill"></i>
        Your information remains confidential and is reviewed only by our legal team.
    </p>

    <div class="form-grid">
        <div class="form-group">
            <label for="profile_name">Full Name *</label>

            <input type="text"
                   id="profile_name"
                   name="full_name"
                   value="{{ old('full_name') }}"
                   placeholder="Enter your full name"
                   required>
        </div>

        <div class="form-group">
            <label for="profile_phone">Mobile Number *</label>

            <input type="tel"
                   id="profile_phone"
                   name="mobile"
                   value="{{ old('mobile') }}"
                   placeholder="+91 XXXXX XXXXX"
                   required>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="profile_email">Email Address</label>

            <input type="email"
                   id="profile_email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Enter email address">
        </div>

        <div class="form-group">
            <label for="profile_category">Case Category *</label>

            <select id="profile_category"
                    name="case_category"
                    required>
                <option value="">Select case category</option>

                @forelse($practiceAreaCategories as $practiceArea)
                    <option value="{{ $practiceArea->title }}"
                        {{ old('case_category') == $practiceArea->title ? 'selected' : '' }}>
                        {{ $practiceArea->title }}
                    </option>
                @empty
                    <option value="Divorce / Family Law" {{ old('case_category') == 'Divorce / Family Law' ? 'selected' : '' }}>
                        Divorce / Family Law
                    </option>

                    <option value="Criminal Law / Bail" {{ old('case_category') == 'Criminal Law / Bail' ? 'selected' : '' }}>
                        Criminal Law / Bail
                    </option>

                    <option value="Civil Law" {{ old('case_category') == 'Civil Law' ? 'selected' : '' }}>
                        Civil Law
                    </option>

                    <option value="Property Dispute" {{ old('case_category') == 'Property Dispute' ? 'selected' : '' }}>
                        Property Dispute
                    </option>

                    <option value="Cyber Crime" {{ old('case_category') == 'Cyber Crime' ? 'selected' : '' }}>
                        Cyber Crime
                    </option>

                    <option value="Legal Notice" {{ old('case_category') == 'Legal Notice' ? 'selected' : '' }}>
                        Legal Notice
                    </option>

                    <option value="Service Matter" {{ old('case_category') == 'Service Matter' ? 'selected' : '' }}>
                        Service Matter
                    </option>
                @endforelse
            </select>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="profile_city">City / State</label>

            <input type="text"
                   id="profile_city"
                   name="city_state"
                   value="{{ old('city_state') }}"
                   placeholder="Patna, Bihar">
        </div>

        <div class="form-group">
            <label for="uploadFile">Upload Case Document / ID Proof</label>

            <label for="uploadFile" class="file-upload">
                <i class="bi bi-cloud-arrow-up-fill"></i>
                <span>PDF, JPG, PNG supported</span>
            </label>

            <input type="file"
                   id="uploadFile"
                   name="case_document"
                   accept=".pdf,.jpg,.jpeg,.png"
                   hidden>
        </div>
    </div>

    <div class="form-group">
        <label for="profile_message">Case Message *</label>

        <textarea id="profile_message"
                  name="case_message"
                  rows="5"
                  required
                  placeholder="Briefly describe your legal matter...">{{ old('case_message') }}</textarea>
    </div>

    <label class="consent-check">
        <input type="checkbox"
               name="consent"
               value="1"
               required
               {{ old('consent') ? 'checked' : '' }}>

        <span>
            I agree to be contacted by Rajpati & Associates regarding my legal enquiry.
        </span>
    </label>

    <button type="submit" class="submit-btn">
        Get Legal Advice
        <i class="bi bi-arrow-right"></i>
    </button>

</form>

      </div>

    </div>
  </section>
  <!-- CONSULT FORM END -->


  <!-- RELATED PROFILES START -->
  <section class="section related-profile-section">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-people-fill"></i>
          Related Profiles
        </span>

        <h2 class="section-title">
          Meet Other Legal Professionals.
        </h2>

        <p class="section-text">
          Explore other attorney profiles connected with Rajpati & Associates.
        </p>
      </div>

      <div class="related-profile-grid">

        @forelse($relatedAttorneys as $relatedAttorney)
          <a href="{{ route('frontend.attorneys.show', $relatedAttorney) }}" class="related-profile-card reveal">
            <img src="{{ $relatedAttorney->image ?: asset('assets/img/logo2.png') }}" alt="{{ $relatedAttorney->name }} advocate profile">
            <div>
              <h3>{{ $relatedAttorney->name }}</h3>
              <span>{{ $relatedAttorney->designation ?: 'Legal Professional' }}</span>
            </div>
          </a>
        @empty
          <a href="{{ route('frontend.team') }}" class="related-profile-card reveal">
            <img src="{{ asset('assets/img/logo2.png') }}" alt="Attorney profiles">
            <div>
              <h3>Our Legal Team</h3>
              <span>View all profiles</span>
            </div>
          </a>
        @endforelse

      </div>

    </div>
  </section>
  <!-- RELATED PROFILES END -->


  <!-- FINAL CTA START -->
  <section class="section profile-final-cta-section">
    <div class="container">

      <div class="profile-final-cta-box reveal">
        <div>
          <span class="profile-final-badge">
            <i class="bi bi-telephone-fill"></i>
            Need Legal Consultation?
          </span>

          <h2>
            Speak With Rajpati & Associates For Confidential Legal Guidance.
          </h2>

          <p>
            Call or chat with an advocate for family law, criminal law, civil law, property dispute,
            cyber crime, legal notice or litigation support.
          </p>
        </div>

        <div class="profile-final-actions">
          <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic">
            <i class="bi bi-telephone-fill"></i>
            Call Now
          </a>

          <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-primary magnetic">
            <i class="bi bi-whatsapp"></i>
            Discuss Your Matter
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- FINAL CTA END -->

@endsection
