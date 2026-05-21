
@extends('frontend.master')
@section('content')

    <!-- BREADCRUMB START -->
    <section class="about-breadcrumb">
        <div class="breadcrumb-grid-bg"></div>
        <div class="about-breadcrumb-shine"></div>
        <div class="about-breadcrumb-orb orb-one"></div>
        <div class="about-breadcrumb-orb orb-two"></div>

        <div class="container">
            <div class="about-breadcrumb-card reveal">

                <span class="about-breadcrumb-badge">
                    <i class="bi bi-bank2"></i>
                    Rajpati & Associates
                </span>

                <h1>
                    About Our
                    <span>Legal Firm</span>
                </h1>

                <p>
                    A trusted Patna-based legal services firm offering All India Legal Services,
                    professional consultation, litigation support and practical legal guidance since 1999.
                </p>

                <nav class="about-crumb" aria-label="breadcrumb">
                    <a href="index.html">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>About Us</span>
                </nav>

                <div class="about-breadcrumb-stats">
                    <div>
                        <strong>1999</strong>
                        <span>Established</span>
                    </div>

                    <div>
                        <strong>25+</strong>
                        <span>Years Experience</span>
                    </div>

                    <div>
                        <strong>All India</strong>
                        <span>Legal Services</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


   <!-- ABOUT INTRO START -->
@if($aboutIntro)
<section class="section about-intro-section">
    <div class="container about-intro-grid">

        <div class="about-intro-visual reveal">

            <div class="about-main-image">
                <img src="{{ $aboutIntro->image ?: 'https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=1200&q=80' }}"
                    alt="{{ $aboutIntro->title }}">
            </div>

            <div class="about-floating-experience">
                <strong>{{ $aboutIntro->experience_number }}</strong>
                <span>{{ $aboutIntro->experience_text }}</span>
            </div>

            <div class="about-floating-note">
                <i class="{{ $aboutIntro->note_icon }}"></i>
                <div>
                    <small>{{ $aboutIntro->note_small_text }}</small>
                    <strong>{{ $aboutIntro->note_title }}</strong>
                </div>
            </div>

        </div>

        <div class="about-text-card reveal">

            <span class="kicker">
                <i class="{{ $aboutIntro->kicker_icon }}"></i>
                {{ $aboutIntro->kicker_text }}
            </span>

            <h2 class="section-title">
                {{ $aboutIntro->title }}
            </h2>

            <p class="section-text">
                {{ $aboutIntro->description_one }}
            </p>

            <p class="section-text">
                {{ $aboutIntro->description_two }}
            </p>

            @if(!empty($aboutIntro->points))
                <div class="about-intro-list">
                    @foreach($aboutIntro->points as $point)
                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            {{ $point }}
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>
</section>
@endif
<!-- ABOUT INTRO END -->


<!-- FOUNDER MESSAGE START -->
@if($founderMessage)
<section class="section founder-section">
    <div class="container founder-grid">

        <div class="founder-text-card reveal">

            <span class="kicker">
                <i class="{{ $founderMessage->kicker_icon }}"></i>
                {{ $founderMessage->kicker_text }}
            </span>

            <h2 class="section-title">
                {{ $founderMessage->title }}
            </h2>

            <p class="section-text">
                {{ $founderMessage->description }}
            </p>

            <div class="founder-quote">
                <i class="{{ $founderMessage->quote_icon }}"></i>
                <p>
                    “{{ $founderMessage->quote_text }}”
                </p>
            </div>

            <div class="founder-sign">
                <strong>{{ $founderMessage->founder_name }}</strong>
                <span>{{ $founderMessage->founder_designation }}</span>
            </div>

        </div>

        <div class="founder-card reveal">

            <div class="founder-photo">
                <img src="{{ $founderMessage->image ?: 'https://www.rajpatiandassociates.com/frontend/assets/images/team/pramod-rajpati.jpg' }}"
                    alt="{{ $founderMessage->card_name }}">
            </div>

            <div class="founder-card-body">
                <h3>{{ $founderMessage->card_name }}</h3>
                <p>{{ $founderMessage->card_designation }}</p>

                @if(!empty($founderMessage->meta_items))
                    <div class="founder-meta">
                        @foreach($founderMessage->meta_items as $item)
                            <span>
                                <i class="{{ $item['icon'] ?? 'bi bi-check-circle-fill' }}"></i>
                                {{ $item['text'] ?? '' }}
                            </span>
                        @endforeach
                    </div>
                @endif

                @if($founderMessage->button_text)
                    <a href="{{ $founderMessage->button_url ?: '#' }}" class="founder-link">
                        {{ $founderMessage->button_text }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                @endif
            </div>

        </div>

    </div>
</section>
@endif
<!-- FOUNDER MESSAGE END -->


<!-- VISION MISSION START -->
@if($visionMission)
<section class="section vision-mission-section">
    <div class="container">

        <div class="section-head center reveal">
            <span class="kicker">
                <i class="{{ $visionMission->kicker_icon }}"></i>
                {{ $visionMission->kicker_text }}
            </span>

            <h2 class="section-title">
                {{ $visionMission->title }}
            </h2>

            <p class="section-text">
                {{ $visionMission->description }}
            </p>
        </div>

        <div class="vm-grid">

            <div class="vm-card reveal">
                <div class="vm-icon">
                    <i class="{{ $visionMission->vision_icon }}"></i>
                </div>

                <h3>{{ $visionMission->vision_title }}</h3>

                <p>
                    {{ $visionMission->vision_text }}
                </p>
            </div>

            <div class="vm-card reveal">
                <div class="vm-icon">
                    <i class="{{ $visionMission->mission_icon }}"></i>
                </div>

                <h3>{{ $visionMission->mission_title }}</h3>

                <p>
                    {{ $visionMission->mission_text }}
                </p>
            </div>

            <div class="vm-card reveal">
                <div class="vm-icon">
                    <i class="{{ $visionMission->values_icon }}"></i>
                </div>

                <h3>{{ $visionMission->values_title }}</h3>

                <p>
                    {{ $visionMission->values_text }}
                </p>
            </div>

        </div>

    </div>
</section>
@endif
<!-- VISION MISSION END -->


    <!-- LEGAL EXPERTISE START -->
    <section class="section expertise-section">
        <div class="container expertise-grid">

            <div class="expertise-text-card reveal">

                <span class="kicker">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    Legal Expertise
                </span>

                <h2 class="section-title">
                    Multi-Practice Legal Support For Individuals, Families & Businesses.
                </h2>

                <p class="section-text">
                    Rajpati & Associates provides legal guidance across important practice areas
                    where clients need clarity, proper documentation and timely legal action.
                </p>

                <a href="services.html" class="btn btn-primary magnetic">
                    Explore Legal Services
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="expertise-list">

                <a href="service-divorce-lawyer.html" class="expertise-item reveal">
                    <i class="bi bi-heartbreak"></i>
                    <div>
                        <h3>Family & Divorce Law</h3>
                        <p>Divorce, child custody, maintenance and domestic violence guidance.</p>
                    </div>
                </a>

                <a href="service-criminal-lawyer.html" class="expertise-item reveal">
                    <i class="bi bi-shield-lock"></i>
                    <div>
                        <h3>Criminal Law</h3>
                        <p>Bail application, FIR, criminal defence and court-related support.</p>
                    </div>
                </a>

                <a href="service-civil-lawyer.html" class="expertise-item reveal">
                    <i class="bi bi-bank"></i>
                    <div>
                        <h3>Civil & Property Matters</h3>
                        <p>Property disputes, recovery, inheritance, succession and civil litigation.</p>
                    </div>
                </a>

                <a href="service-cyber-crime-lawyer.html" class="expertise-item reveal">
                    <i class="bi bi-globe2"></i>
                    <div>
                        <h3>Cyber Law</h3>
                        <p>Cyber fraud, online complaint, digital evidence and cyber litigation.</p>
                    </div>
                </a>

            </div>

        </div>
    </section>
    <!-- LEGAL EXPERTISE END -->


    <!-- EXPERIENCE PHILOSOPHY START -->
    <section class="section philosophy-section">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-stars"></i>
                    Experience & Service Philosophy
                </span>

                <h2 class="section-title">
                    Every Legal Matter Needs Careful Listening, Proper Planning & Timely Action.
                </h2>

                <p class="section-text">
                    Our service philosophy is built around clear communication and practical
                    legal direction so that clients understand what to do next.
                </p>
            </div>

            <div class="philosophy-grid">

                <div class="philosophy-card reveal">
                    <span>01</span>
                    <h3>Listen First</h3>
                    <p>
                        We first understand the facts, documents, urgency and concerns involved
                        in the client’s legal matter.
                    </p>
                </div>

                <div class="philosophy-card reveal">
                    <span>02</span>
                    <h3>Explain Clearly</h3>
                    <p>
                        Clients are guided with simple explanations about legal options, process,
                        documents and possible next steps.
                    </p>
                </div>

                <div class="philosophy-card reveal">
                    <span>03</span>
                    <h3>Plan Practically</h3>
                    <p>
                        Every matter is approached with a practical legal strategy based on
                        facts, jurisdiction and legal remedies.
                    </p>
                </div>

                <div class="philosophy-card reveal">
                    <span>04</span>
                    <h3>Proceed Responsibly</h3>
                    <p>
                        We focus on responsible action through consultation, notice, reply,
                        filing or litigation support as required.
                    </p>
                </div>

            </div>

        </div>
    </section>
    <!-- EXPERIENCE PHILOSOPHY END -->


    <!-- WHY TRUST START -->
    <section class="section about-trust-section">
        <div class="container">

            <div class="about-trust-box reveal">

                <div class="about-trust-content">

                    <span class="kicker">
                        <i class="bi bi-shield-check"></i>
                        Why Clients Trust Us
                    </span>

                    <h2 class="section-title">
                        Trust-Focused Legal Support For Sensitive & Serious Matters.
                    </h2>

                    <p class="section-text">
                        Legal matters are often stressful. Clients trust Rajpati & Associates because
                        the firm focuses on confidentiality, clarity, responsive communication and
                        practical legal support.
                    </p>

                </div>

                <div class="trust-mini-grid">

                    <div class="trust-mini-card">
                        <i class="bi bi-lock-fill"></i>
                        <strong>Confidential</strong>
                        <span>Private case discussions</span>
                    </div>

                    <div class="trust-mini-card">
                        <i class="bi bi-chat-square-text-fill"></i>
                        <strong>Clear Advice</strong>
                        <span>Simple legal explanation</span>
                    </div>

                    <div class="trust-mini-card">
                        <i class="bi bi-bank2"></i>
                        <strong>Court Support</strong>
                        <span>Litigation assistance</span>
                    </div>

                    <div class="trust-mini-card">
                        <i class="bi bi-phone-fill"></i>
                        <strong>Easy Contact</strong>
                        <span>Call & WhatsApp access</span>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- WHY TRUST END -->


    <!-- CTA START -->
    <section class="section about-cta-section">
        <div class="container">

            <div class="about-cta-box reveal">

                <div>
                    <span class="about-cta-badge">
                        <i class="bi bi-chat-square-text-fill"></i>
                        Need Legal Guidance?
                    </span>

                    <h2>
                        Speak With Rajpati & Associates For Confidential Legal Consultation.
                    </h2>

                    <p>
                        Book consultation for divorce, criminal law, civil law, property disputes,
                        service matters, cyber law, legal notice or court-related support.
                    </p>
                </div>

                <div class="about-cta-actions">
                    <a href="tel:+919431021093" class="btn btn-glass magnetic">
                        <i class="bi bi-telephone-fill"></i>
                        Call Now
                    </a>

                    <a href="https://wa.me/919117577770" target="_blank" class="btn btn-primary magnetic">
                        <i class="bi bi-whatsapp"></i>
                        WhatsApp Us
                    </a>
                </div>

            </div>

        </div>
    </section>
    <!-- CTA END -->

@endesection