@extends('frontend.master')

@section('content')
@php
  $parent = $practiceAreaService->practiceArea;
  $fallbackImage = 'https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=1200&q=80';
  $serviceImage = optional($parent)->image ?: $fallbackImage;
  @$siteSetting = \App\Models\SiteSetting::first();
@endphp

<section class="article-breadcrumb">
  <div class="article-breadcrumb-grid-bg"></div>
  <div class="article-breadcrumb-shine"></div>

  <div class="container">
    <div class="article-breadcrumb-card reveal">
      <span class="article-breadcrumb-badge">
        <i class="{{ $practiceAreaService->icon_class ?: optional($parent)->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>
        {{ optional($parent)->title ?: 'Practice Service' }}
      </span>

      <h1>
        {{ $practiceAreaService->title }}
        <span>Legal Service</span>
      </h1>

      @if($practiceAreaService->short_description)
        <p>{{ $practiceAreaService->short_description }}</p>
      @endif

      <nav class="article-crumb" aria-label="breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('frontend.practice-area.index', ['category' => optional($parent)->slug]) }}">Practice Areas</a>
        <i class="bi bi-chevron-right"></i>
        <span>{{ $practiceAreaService->title }}</span>
      </nav>
    </div>
  </div>
</section>

<section class="section article-detail-section">
  <div class="container article-detail-grid">
    <main class="article-main-card reveal">
      <div class="article-featured-image">
        <img src="{{ $serviceImage }}" alt="{{ $practiceAreaService->title }}">
        <span class="article-category-tag">
          <i class="{{ $practiceAreaService->icon_class ?: optional($parent)->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>
          {{ $practiceAreaService->title }}
        </span>
      </div>

      <article class="article-content">
        @if($practiceAreaService->description)
          {!! $practiceAreaService->description !!}
        @else
          <h2>{{ $practiceAreaService->title }}</h2>
          <p>{{ $practiceAreaService->short_description }}</p>
          <h3>How Rajpati & Associates Can Help</h3>
          <p>Our team helps with consultation, document review, drafting support and court process guidance for this service.</p>
        @endif
      </article>
    </main>

    <aside class="article-sidebar">
      <div class="article-sidebar-card reveal">
        <h3 class="sidebar-title">{{ optional($parent)->title ?: 'Related Services' }}</h3>

        <div class="article-category-list">
          @foreach($relatedServices as $service)
            <a href="{{ route('frontend.practice-services.show', ['practiceAreaService' => $service->slug]) }}">
              {{ $service->title }}
              <i class="bi bi-chevron-right"></i>
            </a>
          @endforeach
        </div>
      </div>

      <div class="article-sidebar-card reveal">
        <h3 class="sidebar-title">Need Legal Advice?</h3>
        <p>{{ $practiceAreaService->short_description ?: 'Share your matter and connect for confidential legal guidance.' }}</p>
        <p class="confidential-note compact"><i class="bi bi-shield-lock-fill"></i> Your information remains confidential and is reviewed only by our legal team.</p>
        <a href="{{ route('frontend.legal-enquiry.index') }}" class="author-btn">
          Speak With an Advocate
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </aside>
  </div>
</section>

<section class="section article-consult-section">
  <div class="container">
    <div class="article-consult-box reveal">
      <div>
        <span class="article-consult-badge">
          <i class="bi bi-calendar2-check-fill"></i>
          Consultation
        </span>
        <h2>Speak With Rajpati & Associates For {{ $practiceAreaService->title }}.</h2>
        <p>Book consultation and share your matter for practical legal guidance.</p>
      </div>

      <div class="article-consult-actions">
        <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-primary magnetic">
          Discuss Your Matter
          <i class="bi bi-arrow-right"></i>
        </a>
        <a href="tel:{{ $siteSetting->phone }}" class="btn btn-glass magnetic">
          <i class="bi bi-telephone-fill"></i>
          Call Now
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
