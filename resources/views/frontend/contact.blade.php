@extends('frontend.master')
@section('content')
@php
    $siteSetting = $siteSetting ?? \App\Models\SiteSetting::current();
@endphp


    <!-- BREADCRUMB START -->
    <section class="contact-breadcrumb">
        <div class="contact-breadcrumb-grid-bg"></div>
        <div class="contact-breadcrumb-shine"></div>
        <div class="contact-orb contact-orb-one"></div>
        <div class="contact-orb contact-orb-two"></div>

        <div class="container">
            <div class="contact-breadcrumb-card reveal">

                <span class="contact-breadcrumb-badge">
                    <i class="bi bi-geo-alt-fill"></i>
                    Contact Rajpati & Associates
                </span>

                <h1>
                    Get Legal
                    <span>Consultation Support</span>
                </h1>

                <p>
                    Contact Rajpati & Associates for confidential legal consultation, case enquiry,
                    court support, appointment booking, direction and quick WhatsApp assistance.
                </p>

                <nav class="contact-crumb" aria-label="breadcrumb">
                    <a href="/">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Contact Us</span>
                </nav>

                <div class="contact-breadcrumb-stats">
                    <div>
                        <strong>Call</strong>
                        <span>Legal Support</span>
                    </div>

                    <div>
                        <strong>WhatsApp</strong>
                        <span>Quick Enquiry</span>
                    </div>

                    <div>
                        <strong>Visit</strong>
                        <span>Patna Office</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- QUICK CONTACT START -->
    <section class="section contact-quick-section">
        <div class="container">

            <div class="contact-quick-grid">

                <a href="{{ $siteSetting->phone }}" class="contact-quick-card reveal">
                    <div class="contact-quick-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <strong>Call Now</strong>
                        <span>{{ $siteSetting->phone }}</span>
                    </div>
                </a>

                <a href="{{ $siteSetting->whatsapp }}" target="_blank" class="contact-quick-card reveal">
                    <div class="contact-quick-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div>
                        <strong>WhatsApp</strong>
                        <span>Quick legal enquiry</span>
                    </div>
                </a>

                <a href="mailto:{{ $siteSetting->email }}" class="contact-quick-card reveal">
                    <div class="contact-quick-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <strong>Email Us</strong>
                        <span>{{ $siteSetting->email }}</span>
                    </div>
                </a>

                <a href="{{ $siteSetting->map_direction_url }}" target="_blank" class="contact-quick-card reveal">
                    <div class="contact-quick-icon">
                        <i class="bi bi-map-fill"></i>
                    </div>
                    <div>
                        <strong>Direction</strong>
                        <span>Open location map</span>
                    </div>
                </a>

            </div>

        </div>
    </section>
    <!-- QUICK CONTACT END -->


    <!-- CONTACT MAIN START -->
    <section class="section contact-main-section">
        <div class="container contact-main-grid">

            <!-- LEFT CONTACT DETAILS -->
            <div class="contact-details-area reveal">

                <div class="contact-details-card">
                    <span class="kicker">
                        <i class="bi bi-building-check"></i>
                        Office Information
                    </span>

                    <h2 class="section-title">
                        Visit, Call Or Message Our Legal Team.
                    </h2>

                    <p class="section-text">
                        Share your case details with Rajpati & Associates for professional consultation,
                        document review guidance, court process support and legal enquiry assistance.
                    </p>

                    <div class="contact-info-list">

                        <div class="contact-info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <strong>Office Address</strong>
                                <span>{{ $siteSetting->address_full }}</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <strong>Phone Number</strong>
                                <a href="tel:{{ $siteSetting->phone }}">{{ $siteSetting->phone }}</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <i class="bi bi-whatsapp"></i>
                            <div>
                                <strong>WhatsApp Consultation</strong>
                                <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank">{{ $siteSetting->whatsapp }}</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <strong>Email Address</strong>
                                <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <strong>Office Hours</strong>
                                <span>{{ $siteSetting->office_hours }}</span>
                            </div>
                        </div>

                    </div>

                    <div class="contact-action-row">
                        <a href="{{ $siteSetting->phone }}" class="btn btn-primary magnetic">
                            <i class="bi bi-telephone-fill"></i>
                            Call Now
                        </a>

                        <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-dark magnetic">
                            <i class="bi bi-whatsapp"></i>
                            WhatsApp Us
                        </a>
                    </div>

                </div>

            </div>

            <!-- RIGHT FORM -->
            <div class="contact-form-card reveal" id="contactForm">

                <span class="kicker">
                    <i class="bi bi-chat-square-text-fill"></i>
                    Get Legal Advice
                </span>

                <h2>
                    Submit Your Legal Enquiry
                </h2>

                <p>
                    Fill the form and our team will connect with you for consultation support.
                </p>

              @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form class="contact-form" method="POST" action="{{ route('frontend.legal-enquiry.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="form_type" value="contact">

    <div class="form-grid">
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text"
                   id="name"
                   name="full_name"
                   value="{{ old('full_name') }}"
                   placeholder="Enter your full name"
                   required>
        </div>

        <div class="form-group">
            <label for="phone">Mobile Number *</label>
            <input type="tel"
                   id="phone"
                   name="mobile"
                   value="{{ old('mobile') }}"
                   placeholder="+91 XXXXX XXXXX"
                   required>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="contactEmail">Email Address</label>
            <input type="email"
                   id="contactEmail"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Enter email address">
        </div>

        <div class="form-group">
            <label for="category">Case Category *</label>
            <select id="category" name="case_category" required>
                <option value="">Select case category</option>
                <option {{ old('case_category') == 'Divorce / Family Law' ? 'selected' : '' }}>Divorce / Family Law</option>
                <option {{ old('case_category') == 'Criminal Law' ? 'selected' : '' }}>Criminal Law</option>
                <option {{ old('case_category') == 'Civil Law' ? 'selected' : '' }}>Civil Law</option>
                <option {{ old('case_category') == 'Muslim Law' ? 'selected' : '' }}>Muslim Law</option>
                <option {{ old('case_category') == 'Service Matter' ? 'selected' : '' }}>Service Matter</option>
                <option {{ old('case_category') == 'Property Dispute' ? 'selected' : '' }}>Property Dispute</option>
                <option {{ old('case_category') == 'Cyber Crime' ? 'selected' : '' }}>Cyber Crime</option>
                <option {{ old('case_category') == 'Legal Notice' ? 'selected' : '' }}>Legal Notice</option>
            </select>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="city">City / State</label>
            <input type="text"
                   id="city"
                   name="city_state"
                   value="{{ old('city_state') }}"
                   placeholder="Patna, Bihar">
        </div>

        <div class="form-group">
            <label for="document">Upload Case Document / ID Proof</label>

            <label class="file-upload" for="document">
                <i class="bi bi-cloud-arrow-up-fill"></i>
                <span>PDF, JPG, PNG supported</span>
            </label>

            <input type="file"
                   id="document"
                   name="case_document"
                   accept=".pdf,.jpg,.jpeg,.png"
                   hidden>
        </div>
    </div>

    <div class="form-group">
        <label for="message">Case Message *</label>
        <textarea id="message"
                  name="case_message"
                  rows="5"
                  required
                  placeholder="Briefly describe your legal matter...">{{ old('case_message') }}</textarea>
    </div>

    <label class="consent-check">
        <input type="checkbox" name="consent" value="1" required>
        <span>I agree to be contacted by Rajpati & Associates regarding my legal enquiry.</span>
    </label>

    <button type="submit" class="submit-btn">
        Get Legal Advice
        <i class="bi bi-arrow-right"></i>
    </button>
</form>

            </div>

        </div>
    </section>
    <!-- CONTACT MAIN END -->


    <!-- MAP START -->
    <section class="section contact-map-section" id="map">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-map-fill"></i>
                    Direction / Google Map
                </span>

                <h2 class="section-title">
                    Find Our Office Location.
                </h2>

                <p class="section-text">
                    Visit {{ $siteSetting->site_name }} at {{ $siteSetting->address_full }}.
                </p>
            </div>

            <div class="map-wrapper reveal">

                <div class="map-glass-card">
                    <i class="bi bi-geo-alt-fill"></i>
                    <h3>{{ $siteSetting->map_title }}</h3>
                    <p>{{ $siteSetting->address_full }}</p>

                    <a href="{{ $siteSetting->map_direction_url }}"
                        target="_blank">
                        Open Direction
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <iframe title="{{ $siteSetting->site_name }} Office Location Map"
                    src="{{ $siteSetting->map_embed_url }}"
                    loading="lazy">
                </iframe>

            </div>

        </div>
    </section>
    <!-- MAP END -->


    <!-- OFFICE HOURS START -->
    <section class="section office-hours-section">
        <div class="container office-hours-grid">

            <div class="office-hours-card reveal">
                <span class="kicker">
                    <i class="bi bi-clock-history"></i>
                    Office Hours
                </span>

                <h2 class="section-title">
                    Consultation By Appointment.
                </h2>

                <p class="section-text">
                    For urgent legal matters, you can call or send a WhatsApp enquiry with basic case details.
                </p>

                <div class="hours-list">
                    <div>
                        <span>Monday - Friday</span>
                        <strong>Appointment Based</strong>
                    </div>

                    <div>
                        <span>Saturday</span>
                        <strong>Appointment Based</strong>
                    </div>

                    <div>
                        <span>Sunday</span>
                        <strong>Prior Confirmation Required</strong>
                    </div>
                </div>
            </div>

            <div class="appointment-card reveal">
                <i class="bi bi-calendar2-check-fill"></i>
                <h3>Quick Appointment CTA</h3>
                <p>
                    Book your consultation for divorce, criminal law, civil litigation, legal notice,
                    property, cyber crime or court-related matters.
                </p>

                <div class="appointment-actions">
                    <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic">
                        <i class="bi bi-telephone-fill"></i>
                        Call Now
                    </a>

                    <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-primary magnetic">
                        <i class="bi bi-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!-- OFFICE HOURS END -->


    <!-- FAQ START -->
    <section class="section contact-faq-section">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-question-circle-fill"></i>
                    Contact FAQs
                </span>

                <h2 class="section-title">
                    Common Questions Before Consultation.
                </h2>

                <p class="section-text">
                    Quick answers about contacting {{ $siteSetting->site_name }} and submitting your legal enquiry.
                </p>
            </div>

            <div class="contact-faq-grid">

                <div class="contact-faq-card reveal">
                    <i class="bi bi-chat-dots-fill"></i>
                    <h3>Can I share case details on WhatsApp?</h3>
                    <p>Yes, you can share basic enquiry details through WhatsApp. Sensitive documents should be shared
                        carefully after consultation confirmation.</p>
                </div>

                <div class="contact-faq-card reveal">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <h3>Can I upload documents?</h3>
                    <p>The enquiry form includes a file upload field for PDF, JPG and PNG documents such as case papers
                        or ID proof.</p>
                </div>

                <div class="contact-faq-card reveal">
                    <i class="bi bi-shield-check"></i>
                    <h3>Is the enquiry confidential?</h3>
                    <p>Legal enquiries are handled with privacy. A lawyer-client relationship is created only after
                        formal consultation and acceptance.</p>
                </div>

            </div>

        </div>
    </section>
    <!-- FAQ END -->


    <!-- CONTACT CTA START -->
    <section class="section contact-cta-section">
        <div class="container">

            <div class="contact-cta-box reveal">
                <div>
                    <span class="contact-cta-badge">
                        <i class="bi bi-bank2"></i>
                        Need Legal Support?
                    </span>

                    <h2>
                        Speak With {{ $siteSetting->site_name }} For Confidential Legal Guidance.
                    </h2>

                    <p>
                        Connect for family law, criminal law, civil law, property disputes, cyber crime,
                        legal notice, service matters or court-related legal support.
                    </p>
                </div>

                <div class="contact-cta-actions">
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
    <!-- CONTACT CTA END -->


   @endsection
