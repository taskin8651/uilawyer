@extends('frontend.master')

@section('content')
@php
  $fallbackImage = 'https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=1200&q=80';
  $practiceImage = $practiceArea->image ?: $fallbackImage;
@endphp

<section class="article-breadcrumb">
  <div class="article-breadcrumb-grid-bg"></div>
  <div class="article-breadcrumb-shine"></div>

  <div class="container">
    <div class="article-breadcrumb-card reveal">
      <span class="article-breadcrumb-badge">
        <i class="{{ $practiceArea->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>
        Practice Area
      </span>

      <h1>
        {{ $practiceArea->title }}
        <span>Legal Support</span>
      </h1>

      @if($practiceArea->short_description)
        <p>{{ $practiceArea->short_description }}</p>
      @endif

      <nav class="article-crumb" aria-label="breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('frontend.practice-area.index') }}">Practice Areas</a>
        <i class="bi bi-chevron-right"></i>
        <span>{{ $practiceArea->title }}</span>
      </nav>
    </div>
  </div>
</section>

<section class="section article-detail-section">
  <div class="container article-detail-grid">
    <main class="article-main-card reveal">
      <div class="article-featured-image">
        <img src="{{ $practiceImage }}" alt="{{ $practiceArea->title }}">
        <span class="article-category-tag">
          <i class="{{ $practiceArea->icon_class ?: 'bi bi-grid-3x3-gap-fill' }}"></i>
          {{ $practiceArea->title }}
        </span>
      </div>

      <article class="article-content">
        @if($practiceArea->description)
          {!! $practiceArea->description !!}
        @else
          <p>Practice area details will be available soon.</p>
        @endif
      </article>
    </main>

    <aside class="article-sidebar">
      <div class="article-sidebar-card reveal">
        <h3 class="sidebar-title">Practice Areas</h3>

        <div class="article-category-list">
          @foreach($latestPracticeAreas as $item)
            <a href="{{ route('frontend.practice-areas.show', ['practiceArea' => $item->slug]) }}">
              {{ $item->title }}
              <i class="bi bi-chevron-right"></i>
            </a>
          @endforeach
        </div>
      </div>

      <div class="article-sidebar-card reveal">
        <h3 class="sidebar-title">Need Legal Advice?</h3>
        <p>{{ $practiceArea->short_description ?: 'Share your matter and connect for confidential legal guidance.' }}</p>
        <a href="{{ route('frontend.legal-enquiry.index') }}" class="author-btn">
          Book Consultation
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
        <h2>Speak With Rajpati & Associates For {{ $practiceArea->title }}.</h2>
        <p>Book consultation and share your matter for practical legal guidance.</p>
      </div>

      <div class="article-consult-actions">
        <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-primary magnetic">
          {{ $practiceArea->button_text ?: 'Book Consultation' }}
          <i class="bi bi-arrow-right"></i>
        </a>
        <a href="tel:+919431021093" class="btn btn-glass magnetic">
          <i class="bi bi-telephone-fill"></i>
          Call Now
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
