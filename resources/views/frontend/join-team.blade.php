@extends('frontend.master')
@section('content')

@php
    $siteSetting = \App\Models\SiteSetting::first();
@endphp

<section class="career-breadcrumb">
  <div class="career-breadcrumb-grid-bg"></div>
  <div class="career-breadcrumb-shine"></div>

  <div class="container">
    <div class="career-breadcrumb-card reveal">
      <span class="career-breadcrumb-badge">
        <i class="bi bi-person-plus-fill"></i>
        Join Our Team
      </span>

      <h1>
        Apply To Join
        <span>Our Legal Team</span>
      </h1>

      <p>
        Submit your professional details and photograph. After admin approval, your active
        profile will appear on the Our Team page.
      </p>

      <nav class="career-crumb" aria-label="breadcrumb">
        <a href="{{ route('frontend.index') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('frontend.team') }}">Our Team</a>
        <i class="bi bi-chevron-right"></i>
        <span>Join Our Team</span>
      </nav>

      <div class="career-breadcrumb-stats">
        <div>
          <strong>Apply</strong>
          <span>Submit Details</span>
        </div>

        <div>
          <strong>Review</strong>
          <span>Admin Approval</span>
        </div>

        <div>
          <strong>Active</strong>
          <span>Shown On Team</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section application-section" id="joinTeamApplication">
  <div class="container application-grid">
    <div class="application-info-card reveal">
      <span class="kicker">
        <i class="bi bi-shield-check"></i>
        Team Application
      </span>

      <h2 class="section-title">
        Share Your Professional Profile For Review.
      </h2>

      <p class="section-text">
        Your application stays pending first. The admin can review it from Attorneys,
        update any details, upload or replace the photo, and activate the profile.
      </p>

      <div class="application-points">
        <span><i class="bi bi-check-circle-fill"></i> Professional photograph upload</span>
        <span><i class="bi bi-check-circle-fill"></i> Practice and experience details</span>
        <span><i class="bi bi-check-circle-fill"></i> Admin approval before public listing</span>
        <span><i class="bi bi-check-circle-fill"></i> Active profiles show on Our Team</span>
      </div>
    </div>

    <div class="career-form-card reveal">
      <h3>Apply Now</h3>

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

      <form class="career-form" method="POST" action="{{ route('frontend.team.join.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
          <div class="form-group">
            <label for="join_name">Full Name *</label>
            <input type="text" id="join_name" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
          </div>

          <div class="form-group">
            <label for="join_place">Place Of Practice *</label>
            <input type="text" id="join_place" name="place_of_practice" value="{{ old('place_of_practice') }}" placeholder="Place Of Practice" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label for="join_position">Designation *</label>
            <input type="text" id="join_position" name="position" value="{{ old('position') }}" placeholder="Designation" required>
          </div>

          <div class="form-group">
            <label for="join_experience">Experience *</label>
            <input type="text" id="join_experience" name="experience" value="{{ old('experience') }}" placeholder="Experience" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label for="join_address">Address *</label>
            <input type="text" id="join_address" name="address" value="{{ old('address') }}" placeholder="Address" required>
          </div>

          <div class="form-group">
            <label for="join_phone">Phone *</label>
            <input type="text" id="join_phone" name="phone" value="{{ old('phone') }}" placeholder="Phone" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label for="join_email">Email</label>
            <input type="email" id="join_email" name="email" value="{{ old('email') }}" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="join_photo">Upload Your Professional Photograph</label>
            <label for="join_photo" class="file-upload">
              <i class="bi bi-cloud-arrow-up-fill"></i>
              <div>
                <strong>Upload Photo</strong>
                <span>JPG, PNG, WEBP supported</span>
              </div>
            </label>
            <input type="file" id="join_photo" name="photo" accept=".jpg,.jpeg,.png,.webp" hidden>
          </div>
        </div>

        <div class="form-group">
          <label for="join_about">Write About Your Self</label>
          <textarea id="join_about" name="about_team" rows="5" placeholder="Write about your professional background, practice areas and experience...">{{ old('about_team') }}</textarea>
        </div>

        <button class="submit-btn" type="submit">
          Apply Now
          <i class="bi bi-arrow-right"></i>
        </button>
      </form>
    </div>
  </div>
</section>

<section class="section career-final-cta-section">
  <div class="container">
    <div class="career-final-cta-box reveal">
      <div>
        <span class="career-final-badge">
          <i class="bi bi-people-fill"></i>
          Legal Professionals
        </span>

        <h2>
          Approved Applicants Become Visible On The Team Page.
        </h2>

        <p>
          After review, the admin can activate your attorney profile and visitors can view it
          from the Our Team page.
        </p>
      </div>

      <div class="career-final-actions">
        <a href="{{ route('frontend.team') }}" class="btn btn-primary magnetic">
          View Team
          <i class="bi bi-arrow-right"></i>
        </a>

        <a href="https://wa.me/{{ $siteSetting->whatsapp }}" target="_blank" class="btn btn-glass magnetic">
          <i class="bi bi-whatsapp"></i>
          WhatsApp
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
