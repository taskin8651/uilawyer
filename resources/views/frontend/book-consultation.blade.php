@extends('frontend.master')
@section('content')


    <!-- BREADCRUMB START -->
    <section class="consult-breadcrumb">
        <div class="consult-breadcrumb-grid-bg"></div>
        <div class="consult-breadcrumb-shine"></div>
        <div class="consult-orb consult-orb-one"></div>
        <div class="consult-orb consult-orb-two"></div>

        <div class="container">
            <div class="consult-breadcrumb-card reveal">

                <span class="consult-breadcrumb-badge">
                    <i class="bi bi-calendar2-check-fill"></i>
                    Book Legal Consultation
                </span>

                <h1>
                    Get Confidential
                    <span>Legal Advice</span>
                </h1>

                <p>
                    Submit your legal enquiry with basic case details. Rajpati & Associates will connect
                    with you for consultation support, document review guidance and next legal steps.
                </p>

                <nav class="consult-crumb" aria-label="breadcrumb">
                    <a href="/">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Book Consultation</span>
                </nav>

                <div class="consult-breadcrumb-stats">
                    <div>
                        <strong>Private</strong>
                        <span>Consultation</span>
                    </div>

                    <div>
                        <strong>Upload</strong>
                        <span>Case Documents</span>
                    </div>

                    <div>
                        <strong>Call / WhatsApp</strong>
                        <span>Quick Support</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- QUICK STEPS START -->
    <section class="section consult-steps-section">
        <div class="container">

            <div class="consult-steps-grid">

                <div class="consult-step-card reveal">
                    <span>01</span>
                    <i class="bi bi-pencil-square"></i>
                    <h3>Fill Enquiry Form</h3>
                    <p>Share your name, contact number, city, case category and brief legal issue.</p>
                </div>

                <div class="consult-step-card reveal">
                    <span>02</span>
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <h3>Upload Documents</h3>
                    <p>Attach case papers, ID proof or supporting documents in PDF, JPG or PNG format.</p>
                </div>

                <div class="consult-step-card reveal">
                    <span>03</span>
                    <i class="bi bi-telephone-inbound-fill"></i>
                    <h3>Team Connects</h3>
                    <p>Our legal team reviews the enquiry and contacts you for consultation assistance.</p>
                </div>

                <div class="consult-step-card reveal">
                    <span>04</span>
                    <i class="bi bi-bank2"></i>
                    <h3>Legal Guidance</h3>
                    <p>Get practical legal direction for consultation, notice, filing or litigation support.</p>
                </div>

            </div>

        </div>
    </section>
    <!-- QUICK STEPS END -->


    <!-- CONSULTATION MAIN START -->
    <section class="section consultation-main-section">
        <div class="container consultation-main-grid">

            <!-- LEFT CONTENT -->
            <div class="consultation-info-card reveal">

                <span class="kicker">
                    <i class="bi bi-shield-check"></i>
                    Confidential Legal Support
                </span>

                <h2 class="section-title">
                    Book A Consultation For Your Legal Matter.
                </h2>

                <p class="section-text">
                    Rajpati & Associates provides consultation support for family law, criminal law,
                    civil disputes, property matters, service cases, cyber crime and legal notice matters.
                </p>

                <div class="consult-benefit-list">

                    <div>
                        <i class="bi bi-lock-fill"></i>
                        <strong>Confidential Enquiry</strong>
                        <span>Your legal matter is handled with privacy and professional care.</span>
                    </div>

                    <div>
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <strong>Document Review Support</strong>
                        <span>Upload case documents or ID proof for better initial understanding.</span>
                    </div>

                    <div>
                        <i class="bi bi-chat-square-text-fill"></i>
                        <strong>Call / WhatsApp Follow-Up</strong>
                        <span>Our team can contact you through phone or WhatsApp after enquiry submission.</span>
                    </div>

                    <div>
                        <i class="bi bi-bank2"></i>
                        <strong>Court & Litigation Guidance</strong>
                        <span>Get direction for legal notice, reply, filing, bail, divorce or other legal steps.</span>
                    </div>

                </div>

                <div class="consult-contact-mini">
                    <a href="tel:+919431021093">
                        <i class="bi bi-telephone-fill"></i>
                        +91 94310 21093
                    </a>

                    <a href="https://wa.me/919117577770" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                        WhatsApp Consultation
                    </a>
                </div>

            </div>

            <!-- RIGHT FORM -->
            <div class="consultation-form-card reveal" id="consultationForm">

                <span class="form-badge">
                    <i class="bi bi-chat-square-text-fill"></i>
                    Get Legal Advice
                </span>

                <h2>Submit Consultation Request</h2>

                <p>
                    Fill this form with accurate details. Our team will connect with you for next steps.
                </p>

                @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form class="consultation-form" method="POST" action="{{ route('frontend.legal-enquiry.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="form_type" value="consultation">

    <div class="form-grid">
        <div class="form-group">
            <label for="fullName">Full Name *</label>
            <input type="text"
                   id="fullName"
                   name="full_name"
                   value="{{ old('full_name') }}"
                   placeholder="Enter your full name"
                   required>
        </div>

        <div class="form-group">
            <label for="mobile">Mobile Number *</label>
            <input type="tel"
                   id="mobile"
                   name="mobile"
                   value="{{ old('mobile') }}"
                   placeholder="+91 XXXXX XXXXX"
                   required>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="consultEmail">Email Address</label>
            <input type="email"
                   id="consultEmail"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Enter email address">
        </div>

        <div class="form-group">
            <label for="caseCategory">Case Category *</label>
            <select id="caseCategory" name="case_category" required>
                <option value="">Select case category</option>
                <option {{ old('case_category') == 'Divorce / Family Law' ? 'selected' : '' }}>Divorce / Family Law</option>
                <option {{ old('case_category') == 'Child Custody / Maintenance' ? 'selected' : '' }}>Child Custody / Maintenance</option>
                <option {{ old('case_category') == 'Domestic Violence' ? 'selected' : '' }}>Domestic Violence</option>
                <option {{ old('case_category') == 'Criminal Law / Bail' ? 'selected' : '' }}>Criminal Law / Bail</option>
                <option {{ old('case_category') == 'Civil Law' ? 'selected' : '' }}>Civil Law</option>
                <option {{ old('case_category') == 'Property Dispute' ? 'selected' : '' }}>Property Dispute</option>
                <option {{ old('case_category') == 'Muslim Law' ? 'selected' : '' }}>Muslim Law</option>
                <option {{ old('case_category') == 'Service Matter' ? 'selected' : '' }}>Service Matter</option>
                <option {{ old('case_category') == 'Cyber Crime / Cyber Fraud' ? 'selected' : '' }}>Cyber Crime / Cyber Fraud</option>
                <option {{ old('case_category') == 'Legal Notice / Reply' ? 'selected' : '' }}>Legal Notice / Reply</option>
                <option {{ old('case_category') == 'Cheque Bounce' ? 'selected' : '' }}>Cheque Bounce</option>
                <option {{ old('case_category') == 'Other Legal Matter' ? 'selected' : '' }}>Other Legal Matter</option>
            </select>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="cityState">City / State *</label>
            <input type="text"
                   id="cityState"
                   name="city_state"
                   value="{{ old('city_state') }}"
                   placeholder="Patna, Bihar"
                   required>
        </div>

        <div class="form-group">
            <label for="preferredMode">Preferred Contact Mode</label>
            <select id="preferredMode" name="preferred_contact_mode">
                <option {{ old('preferred_contact_mode') == 'Phone Call' ? 'selected' : '' }}>Phone Call</option>
                <option {{ old('preferred_contact_mode') == 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                <option {{ old('preferred_contact_mode') == 'Email' ? 'selected' : '' }}>Email</option>
                <option {{ old('preferred_contact_mode') == 'Office Visit' ? 'selected' : '' }}>Office Visit</option>
            </select>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="preferredDate">Preferred Date</label>
            <input type="date"
                   id="preferredDate"
                   name="preferred_date"
                   value="{{ old('preferred_date') }}">
        </div>

        <div class="form-group">
            <label for="preferredTime">Preferred Time</label>
            <input type="time"
                   id="preferredTime"
                   name="preferred_time"
                   value="{{ old('preferred_time') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="documentUpload">Upload Case Document / ID Proof</label>

        <label class="file-upload" for="documentUpload">
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <div>
                <strong>Choose File</strong>
                <span>PDF, JPG, PNG supported</span>
            </div>
        </label>

        <input type="file"
               id="documentUpload"
               name="case_document"
               accept=".pdf,.jpg,.jpeg,.png"
               hidden>
    </div>

    <div class="form-group">
        <label for="caseMessage">Case Message *</label>
        <textarea id="caseMessage"
                  name="case_message"
                  rows="5"
                  required
                  placeholder="Briefly describe your legal matter, case stage, notices received, court date or urgent issue...">{{ old('case_message') }}</textarea>
    </div>

    <label class="consent-check">
        <input type="checkbox" name="consent" value="1" required>
        <span>I agree to be contacted by Rajpati & Associates regarding my legal enquiry.</span>
    </label>

    <button type="submit" class="consult-submit-btn">
        Get Legal Advice
        <i class="bi bi-arrow-right"></i>
    </button>
</form>

            </div>

        </div>
    </section>
    <!-- CONSULTATION MAIN END -->


    <!-- CASE CATEGORY START -->
    <section class="section consult-category-section">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    Consultation Categories
                </span>

                <h2 class="section-title">
                    Choose The Right Legal Matter Category.
                </h2>

                <p class="section-text">
                    These categories help our legal team understand your matter and connect you with suitable guidance.
                </p>
            </div>

            <div class="consult-category-grid">

    @forelse($practiceAreaCategories as $practiceArea)

        <a href="{{ route('frontend.practice-area.index', ['category' => $practiceArea->slug]) }}"
           class="consult-category-card reveal">

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
           class="consult-category-card reveal">
            <i class="bi bi-heartbreak"></i>
            <h3>Divorce & Family Law</h3>
            <p>Divorce, child custody, maintenance and domestic violence consultation.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'criminal-law']) }}"
           class="consult-category-card reveal">
            <i class="bi bi-shield-lock"></i>
            <h3>Criminal Law & Bail</h3>
            <p>Bail application, FIR, trial cases, complaints and criminal litigation.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'civil-law']) }}"
           class="consult-category-card reveal">
            <i class="bi bi-bank"></i>
            <h3>Civil & Property Matters</h3>
            <p>Property disputes, recovery, succession, inheritance and civil cases.</p>
        </a>

        <a href="{{ route('frontend.practice-area.index', ['category' => 'cyber-law']) }}"
           class="consult-category-card reveal">
            <i class="bi bi-globe2"></i>
            <h3>Cyber Crime</h3>
            <p>Cyber fraud, online complaint, digital evidence and cyber litigation.</p>
        </a>

    @endforelse

</div>

        </div>
    </section>
    <!-- CASE CATEGORY END -->


    <!-- DOCUMENT REQUIREMENTS START -->
    <section class="section documents-section">
        <div class="container documents-grid">

            <div class="documents-card reveal">
                <span class="kicker">
                    <i class="bi bi-folder-check"></i>
                    Documents You Can Upload
                </span>

                <h2 class="section-title">
                    Attach Basic Documents For Better Initial Review.
                </h2>

                <p class="section-text">
                    Upload only relevant documents. Avoid sharing sensitive information unless required
                    and after proper consultation confirmation.
                </p>
            </div>

            <div class="documents-list reveal">

                <div>
                    <i class="bi bi-person-badge-fill"></i>
                    <strong>ID Proof</strong>
                    <span>Aadhaar, PAN, voter ID or other basic identity proof.</span>
                </div>

                <div>
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    <strong>Case Papers</strong>
                    <span>Petition, complaint, FIR, notice, order copy or related documents.</span>
                </div>

                <div>
                    <i class="bi bi-envelope-paper-fill"></i>
                    <strong>Legal Notice</strong>
                    <span>Received notice, reply draft, cheque bounce notice or demand notice.</span>
                </div>

                <div>
                    <i class="bi bi-image-fill"></i>
                    <strong>Evidence Files</strong>
                    <span>Images, screenshots or transaction records in supported format.</span>
                </div>

            </div>

        </div>
    </section>
    <!-- DOCUMENT REQUIREMENTS END -->


    <!-- TRUST CTA START -->
    <section class="section consultation-trust-section">
        <div class="container">

            <div class="consult-trust-box reveal">

                <div>
                    <span class="kicker">
                        <i class="bi bi-shield-lock-fill"></i>
                        Why Book Consultation With Us?
                    </span>

                    <h2 class="section-title">
                        Clear Legal Guidance With Confidential Communication.
                    </h2>

                    <p class="section-text">
                        Rajpati & Associates focuses on practical legal advice, clear communication,
                        privacy and step-by-step direction for your legal matter.
                    </p>
                </div>

                <div class="consult-trust-grid">

                    <div>
                        <i class="bi bi-lock-fill"></i>
                        <strong>Confidential</strong>
                        <span>Private legal enquiry handling</span>
                    </div>

                    <div>
                        <i class="bi bi-chat-square-text-fill"></i>
                        <strong>Clear Guidance</strong>
                        <span>Understand the next legal step</span>
                    </div>

                    <div>
                        <i class="bi bi-bank2"></i>
                        <strong>Court Support</strong>
                        <span>Litigation and filing assistance</span>
                    </div>

                    <div>
                        <i class="bi bi-phone-fill"></i>
                        <strong>Easy Contact</strong>
                        <span>Call and WhatsApp support</span>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- TRUST CTA END -->


    <!-- FAQ START -->
    <section class="section consultation-faq-section">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-question-circle-fill"></i>
                    Consultation FAQs
                </span>

                <h2 class="section-title">
                    Questions Before Booking Consultation.
                </h2>

                <p class="section-text">
                    Common answers about consultation request, document upload and legal enquiry process.
                </p>
            </div>

            <div class="consult-faq-grid">

                <div class="consult-faq-card reveal">
                    <i class="bi bi-calendar-check-fill"></i>
                    <h3>Will I get confirmation after submitting?</h3>
                    <p>Yes, the team can contact you by phone, WhatsApp or email after reviewing your enquiry details.
                    </p>
                </div>

                <div class="consult-faq-card reveal">
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <h3>Can I upload case documents?</h3>
                    <p>Yes, the form supports file upload for PDF, JPG and PNG documents such as ID proof or case
                        papers.</p>
                </div>

                <div class="consult-faq-card reveal">
                    <i class="bi bi-shield-check"></i>
                    <h3>Is this legal advice immediately?</h3>
                    <p>This is an enquiry and consultation request. Formal legal advice begins after consultation and
                        acceptance.</p>
                </div>

            </div>

        </div>
    </section>
    <!-- FAQ END -->


    <!-- FINAL CTA START -->
    <section class="section consultation-final-cta-section">
        <div class="container">

            <div class="consult-final-cta-box reveal">

                <div>
                    <span class="consult-final-badge">
                        <i class="bi bi-telephone-fill"></i>
                        Urgent Legal Matter?
                    </span>

                    <h2>
                        Call Or WhatsApp Rajpati & Associates For Quick Consultation Support.
                    </h2>

                    <p>
                        For urgent bail, notice, court date, family dispute, cyber fraud or property matter,
                        contact our team directly.
                    </p>
                </div>

                <div class="consult-final-actions">
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
    <!-- FINAL CTA END -->

@endsection