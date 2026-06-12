@extends('frontend.master')
@section('content')

<section class="resource-hero">
    <div class="container">
        <div class="resource-hero-card reveal">
            <span class="kicker"><i class="bi bi-mortarboard-fill"></i> Internship Application</span>
            <h1>Apply For Legal Internship.</h1>
            <p>Students can submit internship details, documents and preferred practice area directly from the frontend.</p>
            <nav class="resource-crumb" aria-label="breadcrumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Internship Application</span>
            </nav>
        </div>
    </div>
</section>

<section class="section">
    <div class="container internship-layout">
        <div class="consultation-info-card reveal">
            <span class="kicker"><i class="bi bi-briefcase-fill"></i> Legal Training</span>
            <h2 class="section-title">Submit Your Internship Request.</h2>
            <p class="section-text">Add accurate academic details and upload only relevant documents. The team will review your application from the admin panel.</p>

            <div class="consult-benefit-list">
                <div>
                    <i class="bi bi-person-lines-fill"></i>
                    <strong>Student Details</strong>
                    <span>Name, contact, college and course year.</span>
                </div>
                <div>
                    <i class="bi bi-calendar-check-fill"></i>
                    <strong>Preferred Dates</strong>
                    <span>Share duration and expected start date.</span>
                </div>
                <div>
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <strong>Document Upload</strong>
                    <span>Resume, ID proof, photograph and payment screenshot if required.</span>
                </div>
            </div>
        </div>

        <div class="consultation-form-card reveal">
            <span class="form-badge">
                <i class="bi bi-send-fill"></i>
                Apply Now
            </span>

            <h2>Internship Application Form</h2>
            <p>Fill all required details carefully before submitting.</p>

            <form class="consultation-form" method="POST" action="{{ route('frontend.internship-application.store') }}" enctype="multipart/form-data">
                @csrf

                <p class="confidential-note">
                    <i class="bi bi-shield-lock-fill"></i>
                    Application data is reviewed only by the office team.
                </p>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="internFullName">Full Name *</label>
                        <input type="text" id="internFullName" name="full_name" value="{{ old('full_name') }}" required placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                        <label for="internMobile">Mobile Number</label>
                        <input type="tel" id="internMobile" name="mobile" value="{{ old('mobile') }}" inputmode="numeric" maxlength="14" placeholder="+91 XXXXX XXXXX">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="internEmail">Email Address</label>
                        <input type="email" id="internEmail" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label for="internCity">City / State</label>
                        <input type="text" id="internCity" name="city_state" value="{{ old('city_state') }}" placeholder="Patna, Bihar">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="college">College / University</label>
                        <input type="text" id="college" name="college_university" value="{{ old('college_university') }}" placeholder="College or university name">
                    </div>

                    <div class="form-group">
                        <label for="courseYear">Course / Year</label>
                        <input type="text" id="courseYear" name="course_year" value="{{ old('course_year') }}" placeholder="LL.B 3rd Year">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="internshipType">Internship Type</label>
                        <select id="internshipType" name="internship_type">
                            <option value="">Select type</option>
                            <option {{ old('internship_type') == 'Offline Internship' ? 'selected' : '' }}>Offline Internship</option>
                            <option {{ old('internship_type') == 'Online Internship' ? 'selected' : '' }}>Online Internship</option>
                            <option {{ old('internship_type') == 'Hybrid Internship' ? 'selected' : '' }}>Hybrid Internship</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="practiceInterest">Practice Area Interest</label>
                        <input type="text" id="practiceInterest" name="practice_area_interest" value="{{ old('practice_area_interest') }}" placeholder="Family law, criminal law...">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="startDate">Preferred Start Date</label>
                        <input type="date" id="startDate" name="preferred_start_date" value="{{ old('preferred_start_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="duration">Preferred Duration</label>
                        <input type="text" id="duration" name="preferred_duration" value="{{ old('preferred_duration') }}" placeholder="4 weeks">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="resume">Resume</label>
                        <label class="file-upload" for="resume">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <div><strong>Choose Resume</strong><span>PDF, DOC, DOCX</span></div>
                        </label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" hidden>
                    </div>

                    <div class="form-group">
                        <label for="aadharCard">Aadhaar / ID Proof</label>
                        <label class="file-upload" for="aadharCard">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <div><strong>Choose ID Proof</strong><span>PDF, JPG, PNG</span></div>
                        </label>
                        <input type="file" id="aadharCard" name="aadhar_card" accept=".pdf,.jpg,.jpeg,.png" hidden>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="photograph">Photograph</label>
                        <label class="file-upload" for="photograph">
                            <i class="bi bi-image-fill"></i>
                            <div><strong>Choose Photo</strong><span>JPG or PNG</span></div>
                        </label>
                        <input type="file" id="photograph" name="photograph" accept=".jpg,.jpeg,.png" hidden>
                    </div>

                    <div class="form-group">
                        <label for="paymentScreenshot">Payment Screenshot</label>
                        <label class="file-upload" for="paymentScreenshot">
                            <i class="bi bi-receipt"></i>
                            <div><strong>Choose File</strong><span>JPG, PNG, PDF</span></div>
                        </label>
                        <input type="file" id="paymentScreenshot" name="payment_screenshot" accept=".jpg,.jpeg,.png,.pdf" hidden>
                    </div>
                </div>

                <div class="form-group">
                    <label for="internMessage">Message</label>
                    <textarea id="internMessage" name="message" rows="5" placeholder="Write any additional detail...">{{ old('message') }}</textarea>
                </div>

                <label class="consent-check">
                    <input type="checkbox" name="consent" value="1" required {{ old('consent') ? 'checked' : '' }}>
                    <span>I agree to be contacted by Rajpati & Associates regarding my internship application.</span>
                </label>

                <button type="submit" class="consult-submit-btn">
                    Submit Application
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
