
@extends('frontend.master')
@section('content')
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
          <a href="tel:+919431021093" class="btn btn-glass magnetic"><i class="bi bi-telephone-fill"></i> Call Now</a>
          <a href="#practice" class="btn btn-glass magnetic"><i class="bi bi-grid-1x2-fill"></i> Explore Services</a>
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
        <a href="tel:+919431021093" class="quick-card">
          <div class="quick-icon"><i class="bi bi-telephone-fill"></i></div>
          <div><strong>Call Lawyer</strong><span>Instant phone support</span></div>
        </a>
        <a href="https://wa.me/919117577770" target="_blank" class="quick-card">
          <div class="quick-icon"><i class="bi bi-whatsapp"></i></div>
          <div><strong>WhatsApp Us</strong><span>Quick case enquiry</span></div>
        </a>
        <a href="#consultation" class="quick-card">
          <div class="quick-icon"><i class="bi bi-calendar2-check-fill"></i></div>
          <div><strong>Appointment</strong><span>Book consultation</span></div>
        </a>
        <a href="#" class="quick-card">
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
        <a href="service-divorce-lawyer.html" class="btn btn-dark reveal">View All Services <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="practice-grid">
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-heartbreak"></i></div>
          <h3>Family Law</h3>
          <p>Divorce, mutual consent divorce, contested divorce, child custody, maintenance and domestic violence.</p>
          <div class="tags"><span>Divorce</span><span>Custody</span><span>Maintenance</span></div>
        </div>
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-shield-lock"></i></div>
          <h3>Criminal Law</h3>
          <p>Bail application, FIR, trial cases, NDPS matters, PMLA and economic offences.</p>
          <div class="tags"><span>Bail</span><span>FIR</span><span>Trial</span></div>
        </div>
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-bank"></i></div>
          <h3>Civil Law</h3>
          <p>Property disputes, will and probate, inheritance, succession, recovery and civil litigation.</p>
          <div class="tags"><span>Property</span><span>Will</span><span>Recovery</span></div>
        </div>
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-people-fill"></i></div>
          <h3>Muslim Law</h3>
          <p>Khula, Mubara’at, family disputes, marriage dissolution and personal law guidance.</p>
          <div class="tags"><span>Khula</span><span>Mubara’at</span><span>Family</span></div>
        </div>
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-person-vcard"></i></div>
          <h3>Service Matters</h3>
          <p>Employment disputes, government service cases, departmental proceedings and service appeals.</p>
          <div class="tags"><span>Employment</span><span>Govt. Service</span></div>
        </div>
        <div class="practice-card reveal tilt-card">
          <div class="practice-icon"><i class="bi bi-globe2"></i></div>
          <h3>Cyber Law</h3>
          <p>Cyber crime, cyber fraud, online harassment, cyber litigation and digital evidence support.</p>
          <div class="tags"><span>Fraud</span><span>Cyber Crime</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section about" id="about">
    <div class="container about-wrap">
      <div class="about-visual reveal">
        <div class="about-photo"></div>
        <div class="about-panel"><strong>25+</strong><span>Years of legal service, professional guidance and
            client-focused representation.</span></div>
      </div>
      <div class="about-content reveal">
        <span class="kicker"><i class="bi bi-building-check"></i> About Rajpati & Associates</span>
        <h2 class="section-title">A Modern Law Firm Built On Experience, Ethics & Practical Legal Strategy.</h2>
        <p class="section-text">Rajpati & Associates is a professional legal services firm committed to helping clients
          understand their rights, evaluate options and take confident legal action with confidentiality and clarity.
        </p>
        <ul class="about-list">
          <li><i class="bi bi-check-circle-fill"></i> Client-first legal consultation with clear guidance and private
            case discussion.</li>
          <li><i class="bi bi-check-circle-fill"></i> Wide practice coverage including family, criminal, civil, Muslim,
            cyber and service matters.</li>
          <li><i class="bi bi-check-circle-fill"></i> Professional attorney profiles, articles, verdicts and legal
            resources for better credibility.</li>
        </ul>
        <a href="our-team.html" class="btn btn-primary magnetic">Meet Our Lawyers <i class="bi bi-arrow-right"></i></a>
        <div class="stats-grid">
          <div class="stat-card"><strong>1999</strong><span>Established</span></div>
          <div class="stat-card"><strong>All India</strong><span>Legal Services</span></div>
          <div class="stat-card"><strong>24/7</strong><span>Enquiry Access</span></div>
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

      <form class="consult-form reveal">
        <div class="form-grid">
          <div class="form-group"><label>Your Name</label><input type="text" placeholder="Enter full name" required>
          </div>
          <div class="form-group"><label>Mobile Number</label><input type="tel" placeholder="+91 XXXXX XXXXX" required>
          </div>
          <div class="form-group"><label>Email Address</label><input type="email" placeholder="name@example.com"></div>
          <div class="form-group"><label>Case Category</label><select required>
              <option value="">Select category</option>
              <option>Family Law / Divorce</option>
              <option>Criminal Law / Bail</option>
              <option>Civil / Property Matter</option>
              <option>Muslim Law</option>
              <option>Service Matter</option>
              <option>Cyber Law</option>
              <option>Legal Notice</option>
            </select></div>
          <div class="form-group full"><label>City / State</label><input type="text" placeholder="Patna, Bihar"></div>
          <div class="form-group full"><label>Case Message</label><textarea
              placeholder="Write your legal issue briefly..."></textarea></div>
          <label class="consent"><input type="checkbox" required><span>I agree to be contacted by Rajpati & Associates
              for legal consultation.</span></label>
          <div class="form-group full"><button class="btn btn-primary" type="submit"><i class="bi bi-send-fill"></i>
              Submit Consultation Request</button></div>
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
        <a href="#" class="btn btn-dark reveal">View All Team <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="team-grid">
        <div class="team-card reveal">
          <div class="team-photo"><img
              src="https://www.rajpatiandassociates.com/frontend/assets/images/team/pramod-rajpati.jpg"
              alt="Attorney profile"></div>
          <div class="team-info">
            <h3>Pramod Rajpati</h3>
            <p>CEO & Founder</p>
            <div class="tags"><span>Founder</span><span>Patna</span></div>
          </div>
        </div>
        <div class="team-card reveal">
          <div class="team-photo"><img
              src="https://rajpatiandassociates.com/storage/63/IMG-20231231-WA0301.jpg"
              alt="Attorney profile"></div>
          <div class="team-info">
            <h3>Nirbhay Jain</h3>
            <p>Advocate | 19 Years</p>
            <div class="tags"><span>Criminal Law</span><span>Ghaziabad</span></div>
          </div>
        </div>
        <div class="team-card reveal">
          <div class="team-photo"><img
              src="https://rajpatiandassociates.com/storage/33/IMG_20220324_100123.jpg"
              alt="Attorney profile"></div>
          <div class="team-info">
            <h3>Deepshika Paul</h3>
            <p>Advocate | 1 Year</p>
            <div class="tags"><span>Family Law</span><span>Guwahati</span></div>
          </div>
        </div>
        <div class="team-card reveal">
          <div class="team-photo"><img
              src="https://rajpatiandassociates.com/storage/62/WhatsApp-Image-2024-04-16-at-13.53.21_b274197b.jpg"
              alt="Attorney profile"></div>
          <div class="team-info">
            <h3>Anjumar Dewarshi</h3>
            <p>Advocate | 1 Year</p>
            <div class="tags"><span>Cyber Law</span><span>Delhi </span></div>
          </div>
        </div>
        <div class="team-card reveal">
          <div class="team-photo"><img
              src="https://rajpatiandassociates.com/storage/26/1712071896654.png"
              alt="Attorney profile"></div>
          <div class="team-info">
            <h3>Raj Bardhan</h3>
            <p>Advocate | 5 Years</p>
            <div class="tags"><span>Civil Law</span><span>Delhi</span></div>
          </div>
        </div>
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

          <div class="review-card">
            <div class="stars">★★★★★</div>
            <p>
              “One of the best legal teams in Patna. The consultation was clear,
              professional and very helpful during a difficult situation.”
            </p>

            <div class="review-user">
              <div class="avatar">D</div>
              <div>
                <strong>Deepak Kumar</strong>
                <span>Client Review</span>
              </div>
            </div>
          </div>

          <div class="review-card">
            <div class="stars">★★★★★</div>
            <p>
              “They explained the process properly and guided us with patience.
              Highly recommended for serious legal matters.”
            </p>

            <div class="review-user">
              <div class="avatar">K</div>
              <div>
                <strong>Kunal Anand</strong>
                <span>Client Review</span>
              </div>
            </div>
          </div>

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

          <div class="review-card">
            <div class="stars">★★★★★</div>
            <p>
              “The team gave clear legal direction and helped us understand the
              correct process before taking any legal step.”
            </p>

            <div class="review-user">
              <div class="avatar">A</div>
              <div>
                <strong>Amit Sharma</strong>
                <span>Legal Consultation</span>
              </div>
            </div>
          </div>

          <div class="review-card">
            <div class="stars">★★★★★</div>
            <p>
              “Very professional consultation. They listened carefully and
              explained documents, process and next steps in simple language.”
            </p>

            <div class="review-user">
              <div class="avatar">S</div>
              <div>
                <strong>Shalini Verma</strong>
                <span>Client Feedback</span>
              </div>
            </div>
          </div>

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
        <a href="articles.html" class="btn btn-dark reveal">View Publications <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="article-grid">
        <article class="article-card reveal">
          <div class="article-img"><img
              src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=900&q=80"
              alt="Family law article"></div>
          <div class="article-content"><span class="article-tag">Family Law</span>
            <h3>Understanding Mutual Consent Divorce Process</h3>
            <p>Know the basic process, documents and timeline before filing a mutual consent divorce case.</p><a
              href="articles.html" class="read-link">Read Article <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
        <article class="article-card reveal">
          <div class="article-img"><img
              src="https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=900&q=80"
              alt="Criminal law article"></div>
          <div class="article-content"><span class="article-tag">Criminal Law</span>
            <h3>What To Know Before Filing A Bail Application</h3>
            <p>Important points, legal support and documentation needed for bail-related matters.</p><a href="articles.html"
              class="read-link">Read Article <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
        <article class="article-card reveal">
          <div class="article-img"><img
              src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=80"
              alt="Legal notice article"></div>
          <div class="article-content"><span class="article-tag">Legal Notice</span>
            <h3>When Should You Send A Legal Notice?</h3>
            <p>Learn how legal notice drafting helps in disputes, cheque bounce and formal replies.</p><a href="articles.html"
              class="read-link">Read Article <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
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
          <a href="tel:+919431021093" class="btn btn-glass magnetic"><i class="bi bi-telephone-fill"></i> Call Now</a>
          <a href="https://wa.me/919117577770" target="_blank" class="btn btn-primary magnetic"><i
              class="bi bi-whatsapp"></i> WhatsApp Us</a>
        </div>
      </div>
    </div>
  </section>

  @endsection