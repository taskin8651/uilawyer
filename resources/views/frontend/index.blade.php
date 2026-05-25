
@extends('frontend.master')
@section('content')
@php 
    $siteSetting = \App\Models\SiteSetting::first();
@endphp
  <section class="hero">
    <div class="hero-grid-bg"></div>
    <div class="hero-noise"></div>

    <div class="container hero-wrap">
      <div class="hero-content">
        <div class="hero-badge"><i class="bi bi-shield-check"></i> Trusted Legal Guidance Since 1999</div>
        <h1>Strategic Legal Support For Your <span class="gold-word" id="typingWord">Justice</span><span
            class="typing-cursor"></span>, Rights & Peace.</h1>
        <p>Rajpati & Associates delivers professional legal representation across family law, criminal matters, civil
          disputes, Muslim law, service matters, cyber law, property disputes and legal notices with a confidential
          client-first approach.</p>
        <div class="hero-actions">
          <a href="#consultation" class="btn btn-primary magnetic"><i class="bi bi-chat-square-text-fill"></i> Get Legal
            Advice</a>
          <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic"><i class="bi bi-telephone-fill"></i> Call Now</a>
          <a href="{{ route('frontend.practice-area.index') }}" class="btn btn-glass magnetic"><i class="bi bi-grid-1x2-fill"></i> Explore Services</a>
        </div>
        <div class="hero-trust">
          <div class="trust-pill"><i class="bi bi-check2-circle"></i> All India Services</div>
          <div class="trust-pill"><i class="bi bi-check2-circle"></i> Experienced Attorneys</div>
          <div class="trust-pill"><i class="bi bi-check2-circle"></i> Confidential Consultation</div>
        </div>
      </div>

      <div class="legal-stage" id="legalStage">
        <div class="constellation"><span></span><span></span><span></span><span></span><span></span><span></span></div>
        <div class="orbit one"></div>
        <div class="orbit two"></div>
        <div class="orbit three"></div>
        <div class="law-book">
          <div class="book-pages"></div>
          <div class="book-side"></div>
          <div class="book-cover"></div>
        </div>
        <div class="scale-mini">
          <div class="top"></div>
          <div class="pillar"></div>
          <div class="beam"></div>
          <div class="scale-pan-mini left"></div>
          <div class="scale-pan-mini right"></div>
          <div class="base"></div>
        </div>
        <div class="gavel">
          <div class="gavel-head"></div>
          <div class="gavel-handle"></div>
        </div>
        <div class="legal-chip chip-one"><i class="bi bi-file-earmark-text"></i><span>Case File</span></div>
        <div class="legal-chip chip-two"><i class="bi bi-shield-check"></i><span>Legal Advice</span></div>
        <div class="legal-chip chip-three"><i class="bi bi-bank"></i><span>Court Matter</span></div>
        <div class="floating-symbol s1"></div>
        <div class="floating-symbol s2"></div>
        <div class="floating-symbol s3"></div>
      </div>
    </div>
  </section>

  <section class="quick-section">
    <div class="container">
      <div class="quick-grid reveal">
        <a href="tel:{{ $siteSetting->phone }}" class="quick-card">
          <div class="quick-icon"><i class="bi bi-telephone-fill"></i></div>
          <div><strong>Call Lawyer</strong><span>Instant phone support</span></div>
        </a>
        <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="quick-card">
          <div class="quick-icon"><i class="bi bi-whatsapp"></i></div>
          <div><strong>WhatsApp Us</strong><span>Quick case enquiry</span></div>
        </a>
        <a href="#consultation" class="quick-card">
          <div class="quick-icon"><i class="bi bi-calendar2-check-fill"></i></div>
          <div><strong>Appointment</strong><span>Book consultation</span></div>
        </a>
        <a href="{{ $siteSetting->map_direction_url }}" target="_blank" class="quick-card">
          <div class="quick-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div><strong>Direction</strong><span>Visit office</span></div>
        </a>
      </div>
    </div>
  </section>

  <section class="section practice" id="practice">
    <div class="container">
      <div class="head-row">
        <div class="section-head reveal">
          <span class="kicker"><i class="bi bi-grid-3x3-gap-fill"></i> Practice Areas</span>
          <h2 class="section-title">Complete Legal Services Under One Trusted Firm.</h2>
          <p class="section-text">Properly structured service categories help users quickly find their legal matter and
            improve SEO discovery.</p>
        </div>
        <a href="/practice-area" class="btn btn-dark reveal">View All Services <i class="bi bi-arrow-right"></i></a>
      </div>

    <div class="practice-grid">

    @forelse($practiceAreaCategories as $practiceArea)

        <div class="practice-card reveal tilt-card">

            <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}"
               class="practice-card-link">

                <div class="practice-icon">
                    <i class="{{ $practiceArea->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>
                </div>

                <h3>{{ $practiceArea->title }}</h3>

                <p>
                    {{ $practiceArea->short_description ?: 'Legal consultation and case support for ' . strtolower($practiceArea->title) . ' matters.' }}
                </p>
            </a>

            @if($practiceArea->services && $practiceArea->services->count())
                <div class="tags">
                    @foreach($practiceArea->services->take(3) as $service)

                        @php
                            $serviceUrl = route('frontend.practice-services.show', $service);
                        @endphp

                        <a href="{{ $serviceUrl }}">
                            {{ $service->title }}
                        </a>

                    @endforeach
                </div>
            @endif

        </div>

    @empty

        <div class="practice-card reveal tilt-card">
            <a href="#" class="practice-card-link">
                <div class="practice-icon">
                    <i class="bi bi-heartbreak"></i>
                </div>

                <h3>Family Law</h3>

                <p>
                    Divorce, mutual consent divorce, child custody, maintenance and domestic violence.
                </p>
            </a>

            <div class="tags">
                <a href="#">Divorce</a>
                <a href="#">Custody</a>
                <a href="#">Maintenance</a>
            </div>
        </div>

    @endforelse

</div>
    </div>
  </section>

  <section class="section about" id="about">
    <div class="container about-wrap">

        <div class="about-visual reveal">

            <div class="about-photo"
                 @if(!empty($aboutIntro?->image))
                     style="background-image: url('{{ $aboutIntro->image }}');"
                 @endif>
            </div>

            <div class="about-panel">
                <strong>
                    {{ $aboutIntro->experience_number ?? '25+' }}
                </strong>

                <span>
                    {{ $aboutIntro->experience_text ?? 'Years of legal service, professional guidance and client-focused representation.' }}
                </span>
            </div>

        </div>

        <div class="about-content reveal">

            <span class="kicker">
                <i class="{{ $aboutIntro->kicker_icon ?? 'bi bi-building-check' }}"></i>
                {{ $aboutIntro->kicker_text ?? 'About Rajpati & Associates' }}
            </span>

            <h2 class="section-title">
                {{ $aboutIntro->title ?? 'A Modern Law Firm Built On Experience, Ethics & Practical Legal Strategy.' }}
            </h2>

            <p class="section-text">
                {{ $aboutIntro->description_one ?? 'Rajpati & Associates is a professional legal services firm committed to helping clients understand their rights, evaluate options and take confident legal action with confidentiality and clarity.' }}
            </p>

            @if(!empty($aboutIntro?->description_two))
                <p class="section-text">
                    {{ $aboutIntro->description_two }}
                </p>
            @endif

            <ul class="about-list">
                @if(!empty($aboutIntro?->points) && is_array($aboutIntro->points))
                    @foreach($aboutIntro->points as $point)
                        @if(!empty($point))
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                {{ $point }}
                            </li>
                        @endif
                    @endforeach
                @else
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Client-first legal consultation with clear guidance and private case discussion.
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Wide practice coverage including family, criminal, civil, Muslim, cyber and service matters.
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Professional attorney profiles, articles, verdicts and legal resources for better credibility.
                    </li>
                @endif
            </ul>

            <a href="{{ url('our-team') }}" class="btn btn-primary magnetic">
                Meet Our Lawyers
                <i class="bi bi-arrow-right"></i>
            </a>

            <div class="stats-grid">
                <div class="stat-card">
                    <strong>1999</strong>
                    <span>Established</span>
                </div>

                <div class="stat-card">
                    <strong>All India</strong>
                    <span>Legal Services</span>
                </div>

                <div class="stat-card">
                    <strong>24/7</strong>
                    <span>Enquiry Access</span>
                </div>
            </div>

        </div>

    </div>
</section>

  <section class="section consult" id="consultation">
    <div class="container consult-wrap">
      <div class="consult-info reveal">
        <span class="kicker"><i class="bi bi-chat-square-text-fill"></i> Get Legal Advice</span>
        <h2 class="section-title">Book A Confidential Legal Consultation.</h2>
        <p class="section-text">Share your matter details securely. Our legal team can connect with you for initial
          guidance, document clarity and next legal steps.</p>
        <div class="consult-points">
          <div class="consult-point"><i class="bi bi-check-circle-fill"></i> Quick call, WhatsApp and appointment
            access.</div>
          <div class="consult-point"><i class="bi bi-check-circle-fill"></i> Suitable for divorce, bail, property, cyber
            and service matters.</div>
          <div class="consult-point"><i class="bi bi-check-circle-fill"></i> Clear process, documents, timeline and
            legal options.</div>
        </div>
      </div>

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

<form class="consult-form reveal"
      method="POST"
      action="{{ route('frontend.legal-enquiry.store') }}">
    @csrf

    <input type="hidden" name="form_type" value="consultation">

    <div class="form-grid">

        <div class="form-group">
            <label>Your Name</label>

            <input type="text"
                   name="full_name"
                   value="{{ old('full_name') }}"
                   placeholder="Enter full name"
                   required>
        </div>

        <div class="form-group">
            <label>Mobile Number</label>

            <input type="tel"
                   name="mobile"
                   value="{{ old('mobile') }}"
                   placeholder="+91 XXXXX XXXXX"
                   required>
        </div>

        <div class="form-group">
            <label>Email Address</label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="name@example.com">
        </div>

        <div class="form-group">
            <label>Case Category</label>

            <select name="case_category" required>
                <option value="">Select category</option>

                @forelse($practiceAreaCategories as $practiceArea)
                    <option value="{{ $practiceArea->title }}"
                        {{ old('case_category') == $practiceArea->title ? 'selected' : '' }}>
                        {{ $practiceArea->title }}
                    </option>
                @empty
                    <option value="Family Law / Divorce" {{ old('case_category') == 'Family Law / Divorce' ? 'selected' : '' }}>
                        Family Law / Divorce
                    </option>

                    <option value="Criminal Law / Bail" {{ old('case_category') == 'Criminal Law / Bail' ? 'selected' : '' }}>
                        Criminal Law / Bail
                    </option>

                    <option value="Civil / Property Matter" {{ old('case_category') == 'Civil / Property Matter' ? 'selected' : '' }}>
                        Civil / Property Matter
                    </option>

                    <option value="Muslim Law" {{ old('case_category') == 'Muslim Law' ? 'selected' : '' }}>
                        Muslim Law
                    </option>

                    <option value="Service Matter" {{ old('case_category') == 'Service Matter' ? 'selected' : '' }}>
                        Service Matter
                    </option>

                    <option value="Cyber Law" {{ old('case_category') == 'Cyber Law' ? 'selected' : '' }}>
                        Cyber Law
                    </option>

                    <option value="Legal Notice" {{ old('case_category') == 'Legal Notice' ? 'selected' : '' }}>
                        Legal Notice
                    </option>
                @endforelse
            </select>
        </div>

        <div class="form-group full">
            <label>City / State</label>

            <input type="text"
                   name="city_state"
                   value="{{ old('city_state') }}"
                   placeholder="Patna, Bihar">
        </div>

        <div class="form-group full">
            <label>Case Message</label>

            <textarea name="case_message"
                      placeholder="Write your legal issue briefly..."
                      required>{{ old('case_message') }}</textarea>
        </div>

        <label class="consent">
            <input type="checkbox"
                   name="consent"
                   value="1"
                   required
                   {{ old('consent') ? 'checked' : '' }}>

            <span>
                I agree to be contacted by Rajpati & Associates for legal consultation.
            </span>
        </label>

        <div class="form-group full">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-send-fill"></i>
                Submit Consultation Request
            </button>
        </div>

    </div>
</form>
    </div>
  </section>

  <section class="section why">
    <div class="container">
      <div class="section-head center reveal">
        <span class="kicker"><i class="bi bi-stars"></i> Why Choose Us</span>
        <h2 class="section-title">Trust-Focused Legal Experience For Every Client.</h2>
        <p class="section-text">A premium legal website should build confidence, simplify service discovery and make
          consultation easy.</p>
      </div>
      <div class="why-grid">
        <div class="why-card reveal"><i class="bi bi-lock-fill"></i>
          <h3>Confidential Guidance</h3>
          <p>Your legal information is handled with privacy, discretion and professional care.</p>
        </div>
        <div class="why-card reveal"><i class="bi bi-compass-fill"></i>
          <h3>Clear Direction</h3>
          <p>Understand your options, documents, timeline and next legal steps clearly.</p>
        </div>
        <div class="why-card reveal"><i class="bi bi-people-fill"></i>
          <h3>Experienced Team</h3>
          <p>Attorney profiles, expertise and service history are presented with better trust.</p>
        </div>
        <div class="why-card reveal"><i class="bi bi-phone-fill"></i>
          <h3>Easy Contact Flow</h3>
          <p>Call, WhatsApp, direction and appointment actions stay visible and mobile-friendly.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section team" id="team">
    <div class="container">
      <div class="head-row">
        <div class="section-head reveal">
          <span class="kicker"><i class="bi bi-person-badge-fill"></i> Our Attorneys</span>
          <h2 class="section-title">Meet Our Legal Professionals.</h2>
          <p class="section-text">Attorney cards can include image, name, designation, location, experience, practice
            area and individual profile page.</p>
        </div>
        <a href="{{ route('frontend.team') }}" class="btn btn-dark reveal">View All Team <i class="bi bi-arrow-right"></i></a>
      </div>

    <div class="team-grid">

    @forelse($homeAttorneys as $attorney)

        <a href="{{ route('frontend.attorneys.show', $attorney->id) }}"
           class="team-card reveal"
           style="text-decoration:none; color:inherit;">

            <div class="team-photo">
                @if($attorney->image)
                    <img src="{{ $attorney->image }}"
                         alt="{{ $attorney->name }}">
                @else
                    <img src="{{ asset('frontend/assets/images/team/default-attorney.jpg') }}"
                         alt="{{ $attorney->name }}">
                @endif
            </div>

            <div class="team-info">
                <h3>{{ $attorney->name }}</h3>

                <p>{{ $attorney->designation ?: 'Advocate' }}</p>

                @if(!empty($attorney->tags) && is_array($attorney->tags))
                    <div class="tags">
                        @foreach(array_slice($attorney->tags, 0, 2) as $tag)
                            <span>{{ $tag }}</span>
                        @endforeach
                    </div>
                @else
                    <div class="tags">
                        @if($attorney->badge)
                            <span>{{ $attorney->badge }}</span>
                        @endif

                        <span>Legal Expert</span>
                    </div>
                @endif
            </div>

        </a>

    @empty

        <div class="team-card reveal">
            <div class="team-photo">
                <img src="https://www.rajpatiandassociates.com/frontend/assets/images/team/pramod-rajpati.jpg"
                     alt="Attorney profile">
            </div>

            <div class="team-info">
                <h3>Pramod Rajpati</h3>
                <p>CEO & Founder</p>

                <div class="tags">
                    <span>Founder</span>
                    <span>Patna</span>
                </div>
            </div>
        </div>

    @endforelse

</div>
    </div>
  </section>

<!-- TESTIMONIALS START -->
<section class="section testimonials">
  <div class="container">

    <div class="section-head center reveal">
      <span class="kicker">
        <i class="bi bi-chat-quote-fill"></i>
        Client Testimonials
      </span>

      <h2 class="section-title">
        What Clients Say About Our Legal Support.
      </h2>

      <p class="section-text">
        Premium testimonial cards help build trust and can be connected with Google review links.
      </p>
    </div>

    <div class="testimonial-slider reveal" id="testimonialSlider">

      <button class="testimonial-nav testimonial-prev" type="button" aria-label="Previous testimonial">
        <i class="bi bi-arrow-left"></i>
      </button>

      <div class="testimonial-track-wrap">
        <div class="testimonial-track">

        @forelse($homeTestimonials as $testimonial)

    <div class="review-card">
        <div class="stars">
            {{ str_repeat('★', (int) $testimonial->rating) }}
        </div>

        <p>
            “{{ $testimonial->review }}”
        </p>

        <div class="review-user">
            <div class="avatar">
                {{ strtoupper(substr($testimonial->client_name ?? 'R', 0, 1)) }}
            </div>

            <div>
                <strong>
                    {{ $testimonial->client_name ?? 'Rajpati Client' }}
                </strong>

                <span>
                    {{ $testimonial->client_designation ?: 'Verified Feedback' }}
                </span>
            </div>
        </div>
    </div>

@empty

    <div class="review-card">
        <div class="stars">★★★★★</div>

        <p>
            “Professional behaviour, strong knowledge and practical advice.
            The team handled our concerns with full attention.”
        </p>

        <div class="review-user">
            <div class="avatar">R</div>

            <div>
                <strong>Rajpati Client</strong>
                <span>Verified Feedback</span>
            </div>
        </div>
    </div>

@endforelse

        </div>
      </div>

      <button class="testimonial-nav testimonial-next" type="button" aria-label="Next testimonial">
        <i class="bi bi-arrow-right"></i>
      </button>

      <div class="testimonial-dots" aria-label="Testimonial slider dots"></div>

    </div>

  </div>
</section>
<!-- TESTIMONIALS END -->
 
  <section class="section articles" id="articles"> 
    <div class="container">
      <div class="head-row">
        <div class="section-head reveal">
          <span class="kicker"><i class="bi bi-journal-text"></i> Articles & Publications</span>
          <h2 class="section-title">Legal Insights, Verdicts & Judgements.</h2>
          <p class="section-text">Article listing, category filters, search, detail pages and related posts can improve
            SEO authority.</p>
        </div>
        <a href="/articles  " class="btn btn-dark reveal">View Publications <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="article-grid">

    @forelse($homeArticles as $article)

        <article class="article-card reveal">

            <a href="{{ route('frontend.articles.show', $article->slug) }}"
               class="article-img"
               style="display:block; text-decoration:none; color:inherit;">

                @if($article->image)
                    <img src="{{ $article->image }}"
                         alt="{{ $article->title }}">
                @else
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=900&q=80"
                         alt="{{ $article->title }}">
                @endif

            </a>

            <div class="article-content">

                <span class="article-tag">
                    {{ optional($article->category)->title ?: 'Legal Article' }}
                </span>

                <h3>
                    <a href="{{ route('frontend.articles.show', $article->slug) }}"
                       style="text-decoration:none; color:inherit;">
                        {{ $article->title }}
                    </a>
                </h3>

                <p>
                    {{ $article->short_description ?: 'Read legal insights, updates and practical guidance from Rajpati & Associates.' }}
                </p>

                <a href="{{ route('frontend.articles.show', $article->slug) }}" class="read-link">
                    Read Article
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </article>

    @empty

        <article class="article-card reveal">
            <div class="article-img">
                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=900&q=80"
                     alt="Family law article">
            </div>

            <div class="article-content">
                <span class="article-tag">Family Law</span>

                <h3>Understanding Mutual Consent Divorce Process</h3>

                <p>
                    Know the basic process, documents and timeline before filing a mutual consent divorce case.
                </p>

                <a href="{{ route('frontend.articles.index') }}" class="read-link">
                    Read Article
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </article>

        <article class="article-card reveal">
            <div class="article-img">
                <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=900&q=80"
                     alt="Criminal law article">
            </div>

            <div class="article-content">
                <span class="article-tag">Criminal Law</span>

                <h3>What To Know Before Filing A Bail Application</h3>

                <p>
                    Important points, legal support and documentation needed for bail-related matters.
                </p>

                <a href="{{ route('frontend.articles.index') }}" class="read-link">
                    Read Article
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </article>

    @endforelse

</div>
    </div>
  </section>

  <section class="section cta">
    <div class="container">
      <div class="cta-box reveal">
        <div class="cta-content">
          <h2>Need Legal Advice? Speak With Our Team Today.</h2>
          <p>Book a confidential consultation for divorce, criminal, civil, property, service, cyber or legal notice
            matters.</p>
        </div>
        <div class="cta-actions">
          <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic"><i class="bi bi-telephone-fill"></i> Call Now</a>
          <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-primary magnetic"><i
              class="bi bi-whatsapp"></i> WhatsApp Us</a>
        </div>
      </div>
    </div>
  </section>

  @endsection
