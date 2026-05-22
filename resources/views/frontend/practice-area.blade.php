@extends('frontend.master') 
@section('content')



  <!-- BREADCRUMB START -->
  <section class="practice-breadcrumb">
    <div class="practice-breadcrumb-grid-bg"></div>
    <div class="practice-breadcrumb-shine"></div>
    <div class="practice-orb practice-orb-one"></div>
    <div class="practice-orb practice-orb-two"></div>

    <div class="container">
      <div class="practice-breadcrumb-card reveal">

        <span class="practice-breadcrumb-badge">
          <i class="bi bi-bank2"></i>
          Practice Areas
        </span>

        <h1>
          Legal Services &
          <span>Practice Areas</span>
        </h1>

        <p>
          Explore legal service categories offered by Rajpati & Associates including family law,
          criminal law, civil law, Muslim law, service matters, cyber law, legal notice,
          property disputes and litigation support.
        </p>

        <nav class="practice-crumb" aria-label="breadcrumb">
          <a href="index.html">Home</a>
          <i class="bi bi-chevron-right"></i>
          <span>Practice Areas</span>
        </nav>

        <div class="practice-breadcrumb-stats">
          <div>
            <strong>All India</strong>
            <span>Legal Services</span>
          </div>

          <div>
            <strong>1999</strong>
            <span>Trusted Since</span>
          </div>

          <div>
            <strong>Multiple</strong>
            <span>Practice Areas</span>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- BREADCRUMB END -->


  <!-- INTRO START -->
  <section class="section practice-intro-section">
    <div class="container practice-intro-grid">

      <div class="practice-intro-card reveal">
        <span class="kicker">
          <i class="bi bi-grid-3x3-gap-fill"></i>
          Service Discoverability
        </span>

        <h2 class="section-title">
          Find The Right Legal Service For Your Matter.
        </h2>

        <p class="section-text">
          This page organizes all major legal services into clear categories so visitors can
          quickly find the right lawyer page, understand services and book consultation.
        </p>

        <p class="section-text">
          Every major service can connect to a dedicated SEO-friendly detail page such as
          Divorce Lawyer, Criminal Lawyer, Civil Lawyer, Muslim Lawyer, Bail Lawyer,
          Legal Notice Lawyer, Property Lawyer and Cyber Crime Lawyer.
        </p>

        <div class="practice-intro-actions">
          <a href="book-consultation.html" class="btn btn-primary magnetic">
            Get Legal Advice
            <i class="bi bi-arrow-right"></i>
          </a>

          <a href="tel:+919431021093" class="btn btn-dark magnetic">
            <i class="bi bi-telephone-fill"></i>
            Call Now
          </a>
        </div>
      </div>

      <div class="practice-side-card reveal">
        <i class="bi bi-shield-check"></i>
        <h3>Confidential Legal Consultation</h3>
        <p>
          Share your case category, city/state, message and documents through the consultation form.
        </p>

        <div class="practice-side-list">
          <span><i class="bi bi-check-circle-fill"></i> Family, Civil & Criminal Law</span>
          <span><i class="bi bi-check-circle-fill"></i> Legal Notice & Cheque Bounce</span>
          <span><i class="bi bi-check-circle-fill"></i> Cyber Crime & Documentation</span>
          <span><i class="bi bi-check-circle-fill"></i> Call / WhatsApp Consultation</span>
        </div>
      </div>

    </div>
  </section>
  <!-- INTRO END -->


  <!-- CATEGORY QUICK FILTER START -->
  <section class="practice-filter-section">
    <div class="container">
      <div class="practice-filter-wrap reveal">
        <a href="#family-law" class="active">Family Law</a>
        <a href="#criminal-law">Criminal Law</a>
        <a href="#civil-law">Civil Law</a>
        <a href="#muslim-law">Muslim Law</a>
        <a href="#service-matters">Service Matters</a>
        <a href="#cyber-law">Cyber Law</a>
        <a href="#legal-notice">Legal Notice</a>
        <a href="#other-services">Other Services</a>
      </div>
    </div>
  </section>
  <!-- CATEGORY QUICK FILTER END -->


  <!-- FAMILY LAW START -->
  <section class="section practice-category-section" id="family-law">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-heartbreak"></i>
            Family Law
          </span>

          <h2 class="section-title">
            Divorce, Custody, Maintenance & Domestic Violence Matters.
          </h2>

          <p class="section-text">
            Family law services cover sensitive legal matters that require careful consultation,
            privacy, documentation and court process guidance.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Family Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-heartbreak"></i>
          <h3>Divorce Lawyer</h3>
          <p>Legal guidance for divorce filing, settlement, documents and court process.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-mutual-consent-divorce.html" class="practice-service-card reveal">
          <i class="bi bi-people-fill"></i>
          <h3>Mutual Consent Divorce</h3>
          <p>Support for joint petition, settlement terms and mutual consent process.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-contested-divorce.html" class="practice-service-card reveal">
          <i class="bi bi-file-earmark-text-fill"></i>
          <h3>Contested Divorce</h3>
          <p>Legal assistance for contested divorce, reply, evidence and court filing.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-annulment-of-marriage.html" class="practice-service-card reveal">
          <i class="bi bi-file-x-fill"></i>
          <h3>Annulment of Marriage</h3>
          <p>Consultation for marriage annulment, validity and legal requirements.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-child-custody-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-person-hearts"></i>
          <h3>Child Custody Lawyer</h3>
          <p>Custody, visitation, guardianship and child welfare legal guidance.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-maintenance-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-cash-coin"></i>
          <h3>Maintenance Lawyer</h3>
          <p>Maintenance claim, interim relief, reply and financial document support.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-domestic-violence-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-shield-fill-exclamation"></i>
          <h3>Domestic Violence Lawyer</h3>
          <p>Protection order, residence order and domestic violence case support.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- FAMILY LAW END -->


  <!-- CRIMINAL LAW START -->
  <section class="section practice-category-section alt-bg" id="criminal-law">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-shield-lock"></i>
            Criminal Law
          </span>

          <h2 class="section-title">
            Bail, FIR, Trial Cases & Criminal Litigation Support.
          </h2>

          <p class="section-text">
            Criminal law services include legal consultation for bail, FIR, complaint,
            trial cases, NDPS matters, PMLA and economic offences.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Criminal Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-shield-lock"></i>
          <h3>Criminal Lawyer</h3>
          <p>Legal consultation for criminal complaints, FIR, trial and court process.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-bail-application-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-unlock-fill"></i>
          <h3>Bail Application Lawyer</h3>
          <p>Support for bail application, documents, urgency and court filing.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-fir-complaint-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-journal-text"></i>
          <h3>FIR / Complaint</h3>
          <p>Guidance for FIR, complaint drafting, police matter and legal action.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-trial-cases-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-bank2"></i>
          <h3>Trial Cases</h3>
          <p>Legal support for criminal trial, evidence, hearings and case strategy.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-ndps-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-capsule"></i>
          <h3>NDPS Matters</h3>
          <p>Consultation for NDPS related cases, bail, defence and procedure.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-pmla-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-currency-rupee"></i>
          <h3>PMLA</h3>
          <p>Legal guidance for PMLA matters and economic offence proceedings.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-economic-offences-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-graph-up-arrow"></i>
          <h3>Economic Offences</h3>
          <p>Consultation for financial disputes, fraud allegations and case handling.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- CRIMINAL LAW END -->


  <!-- CIVIL LAW START -->
  <section class="section practice-category-section" id="civil-law">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-bank"></i>
            Civil Law
          </span>

          <h2 class="section-title">
            Property, Will, Probate, Inheritance & Succession.
          </h2>

          <p class="section-text">
            Civil law services include property disputes, will and probate matters,
            inheritance, succession and recovery-related legal support.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Civil Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-bank"></i>
          <h3>Civil Lawyer</h3>
          <p>Legal support for civil cases, disputes, notices and court procedures.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-property-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-house-lock-fill"></i>
          <h3>Property Lawyer</h3>
          <p>Property dispute, possession issue, title document and civil litigation.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-will-probate-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-file-earmark-check-fill"></i>
          <h3>Will & Probate Lawyer</h3>
          <p>Will drafting, probate, succession certificate and inheritance support.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-inheritance-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-diagram-3-fill"></i>
          <h3>Inheritance Lawyer</h3>
          <p>Guidance for inheritance disputes, legal heirs and property distribution.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-succession-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-file-medical-fill"></i>
          <h3>Succession Lawyer</h3>
          <p>Support for succession certificate, legal heir matters and court process.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-cash-stack"></i>
          <h3>Recovery Lawyer</h3>
          <p>Legal consultation for recovery matters, notices and civil proceedings.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- CIVIL LAW END -->


  <!-- MUSLIM LAW START -->
  <section class="section practice-category-section alt-bg" id="muslim-law">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-people-fill"></i>
            Muslim Law
          </span>

          <h2 class="section-title">
            Khula, Mubara’at & Muslim Personal Law Guidance.
          </h2>

          <p class="section-text">
            Muslim law services include guidance for Khula, Mubara’at and related personal
            law matters with confidentiality and proper document support.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Muslim Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid small-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-people-fill"></i>
          <h3>Muslim Lawyer</h3>
          <p>Legal consultation for Muslim personal law matters and family disputes.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-khula-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-person-x-fill"></i>
          <h3>Khula</h3>
          <p>Guidance for Khula process, documents, consultation and legal steps.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-mubaraat-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-person-check-fill"></i>
          <h3>Mubara’at</h3>
          <p>Consultation for mutual separation under Muslim personal law.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- MUSLIM LAW END -->


  <!-- SERVICE MATTERS START -->
  <section class="section practice-category-section" id="service-matters">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-person-vcard"></i>
            Service Matters
          </span>

          <h2 class="section-title">
            Employment Disputes, Government Service Cases & Departmental Proceedings.
          </h2>

          <p class="section-text">
            Service matter legal support includes employment disputes, government service
            cases, departmental proceedings and related documentation.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Service Matter Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid small-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-person-vcard"></i>
          <h3>Service Matter Lawyer</h3>
          <p>Legal support for employment and service-related legal disputes.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-employment-disputes-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-briefcase-fill"></i>
          <h3>Employment Disputes</h3>
          <p>Consultation for job-related disputes, termination and workplace issues.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-government-service-cases.html" class="practice-service-card reveal">
          <i class="bi bi-building-fill"></i>
          <h3>Government Service Cases</h3>
          <p>Guidance for government employee service disputes and proceedings.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-departmental-proceedings.html" class="practice-service-card reveal">
          <i class="bi bi-clipboard-check-fill"></i>
          <h3>Departmental Proceedings</h3>
          <p>Support for departmental enquiry, reply and service law process.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- SERVICE MATTERS END -->


  <!-- CYBER LAW START -->
  <section class="section practice-category-section alt-bg" id="cyber-law">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-globe2"></i>
            Cyber Law
          </span>

          <h2 class="section-title">
            Cyber Crime, Cyber Fraud & Cyber Litigation.
          </h2>

          <p class="section-text">
            Cyber law services include online fraud complaint, cyber crime consultation,
            digital evidence support and cyber litigation guidance.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Cyber Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid small-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-globe2"></i>
          <h3>Cyber Crime Lawyer</h3>
          <p>Legal support for cyber crime complaint and online offence matters.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-cyber-fraud-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-credit-card-2-front-fill"></i>
          <h3>Cyber Fraud</h3>
          <p>Guidance for online financial fraud, complaint and evidence preservation.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-cyber-litigation-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-laptop-fill"></i>
          <h3>Cyber Litigation</h3>
          <p>Consultation for cyber-related litigation and legal proceedings.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- CYBER LAW END -->


  <!-- LEGAL NOTICE START -->
  <section class="section practice-category-section" id="legal-notice">
    <div class="container">

      <div class="practice-category-head reveal">
        <div>
          <span class="kicker">
            <i class="bi bi-envelope-paper-fill"></i>
            Legal Notice
          </span>

          <h2 class="section-title">
            Legal Notice Drafting, Cheque Bounce Notice & Reply To Legal Notice.
          </h2>

          <p class="section-text">
            Legal notice services help clients send formal notices, reply to notices and
            take proper legal steps before litigation.
          </p>
        </div>

        <a href="book-consultation.html" class="category-head-btn">
          Consult Legal Notice Lawyer
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="practice-service-grid small-grid">

        <a href="service-divorce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-envelope-paper-fill"></i>
          <h3>Legal Notice Lawyer</h3>
          <p>Draft and send formal legal notices for disputes and legal claims.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-legal-notice-drafting.html" class="practice-service-card reveal">
          <i class="bi bi-pencil-square"></i>
          <h3>Legal Notice Drafting</h3>
          <p>Professional drafting for dispute, payment, property and family matters.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-cheque-bounce-lawyer.html" class="practice-service-card reveal">
          <i class="bi bi-receipt-cutoff"></i>
          <h3>Cheque Bounce Notice</h3>
          <p>Legal notice and case support for cheque bounce matters.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

        <a href="service-reply-to-legal-notice.html" class="practice-service-card reveal">
          <i class="bi bi-reply-fill"></i>
          <h3>Reply To Legal Notice</h3>
          <p>Drafting reply and legal response for received legal notices.</p>
          <span>View Details <i class="bi bi-arrow-right"></i></span>
        </a>

      </div>

    </div>
  </section>
  <!-- LEGAL NOTICE END -->


  <!-- OTHER SERVICES START -->
  <section class="section other-services-section" id="other-services">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-plus-circle-fill"></i>
          Other Legal Services
        </span>

        <h2 class="section-title">
          Additional Legal Support Areas.
        </h2>

        <p class="section-text">
          These additional services can also be connected with separate SEO-friendly service detail pages.
        </p>
      </div>

      <div class="other-service-grid">

        <a href="service-divorce-lawyer.html" class="other-service-card reveal">
          <i class="bi bi-receipt"></i>
          <h3>GST Lawyer</h3>
          <p>Consultation for GST-related legal matters and notice support.</p>
        </a>

        <a href="service-divorce-lawyer.html" class="other-service-card reveal">
          <i class="bi bi-cash-stack"></i>
          <h3>Recovery Lawyer</h3>
          <p>Legal guidance for recovery notices and civil recovery cases.</p>
        </a>

        <a href="service-divorce-lawyer.html" class="other-service-card reveal">
          <i class="bi bi-universal-access-circle"></i>
          <h3>Human Rights Lawyer</h3>
          <p>Legal support for human rights related complaints and litigation.</p>
        </a>

        <a href="service-divorce-lawyer.html" class="other-service-card reveal">
          <i class="bi bi-journal-bookmark-fill"></i>
          <h3>Constitutional Lawyer</h3>
          <p>Consultation for constitutional law issues and writ matters.</p>
        </a>

      </div>

    </div>
  </section>
  <!-- OTHER SERVICES END -->


  <!-- PROCESS START -->
  <section class="section practice-process-section">
    <div class="container">

      <div class="section-head center reveal">
        <span class="kicker">
          <i class="bi bi-diagram-3-fill"></i>
          Consultation Process
        </span>

        <h2 class="section-title">
          Simple Process To Get Legal Guidance.
        </h2>

        <p class="section-text">
          Select your practice area, share enquiry details and connect with Rajpati & Associates.
        </p>
      </div>

      <div class="practice-process-grid">

        <div class="practice-process-card reveal">
          <span>01</span>
          <i class="bi bi-search"></i>
          <h3>Choose Practice Area</h3>
          <p>Select the legal service category related to your case.</p>
        </div>

        <div class="practice-process-card reveal">
          <span>02</span>
          <i class="bi bi-pencil-square"></i>
          <h3>Submit Enquiry</h3>
          <p>Share your name, mobile, case category, city/state and message.</p>
        </div>

        <div class="practice-process-card reveal">
          <span>03</span>
          <i class="bi bi-cloud-arrow-up-fill"></i>
          <h3>Upload Documents</h3>
          <p>Attach case document or ID proof in PDF, JPG or PNG format.</p>
        </div>

        <div class="practice-process-card reveal">
          <span>04</span>
          <i class="bi bi-telephone-inbound-fill"></i>
          <h3>Get Consultation</h3>
          <p>Our team connects through call or WhatsApp for next legal steps.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- PROCESS END -->


  <!-- FINAL CTA START -->
  <section class="section practice-final-cta-section">
    <div class="container">

      <div class="practice-final-cta-box reveal">
        <div>
          <span class="practice-final-badge">
            <i class="bi bi-chat-square-text-fill"></i>
            Need Legal Advice?
          </span>

          <h2>
            Not Sure Which Practice Area Fits Your Case?
          </h2>

          <p>
            Contact Rajpati & Associates and share your legal issue. Our team will help you
            identify the correct category and next legal step.
          </p>
        </div>

        <div class="practice-final-actions">
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