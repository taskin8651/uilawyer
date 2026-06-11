@extends('frontend.master')

@section('content')
@php
  $fallbackImage = 'https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=1200&q=80';
  $practiceImage = $practiceArea->image ?: $fallbackImage;
  @$siteSetting = \App\Models\SiteSetting::first();
  $isMuslimLaw = str_contains(strtolower($practiceArea->slug . ' ' . $practiceArea->title), 'muslim');
  $knowledgeSections = [
    'issue_overview' => ['What is the legal issue?', 'bi bi-question-circle-fill'],
    'legal_position' => ['How the law regulates it', 'bi bi-bank2'],
    'remedies' => ['Available remedies', 'bi bi-shield-check'],
    'documents_required' => ['Documents usually required', 'bi bi-folder-check'],
    'process_overview' => ['General process', 'bi bi-diagram-3-fill'],
    'when_to_consult_lawyer' => ['When to consult a lawyer', 'bi bi-telephone-inbound-fill'],
  ];
  $practiceFaqs = $practiceArea->display_faq_items;
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

      <div class="knowledge-resource-grid">
        @foreach($knowledgeSections as $field => $meta)
          @if($practiceArea->{$field})
            <section class="knowledge-resource-card">
              <i class="{{ $meta[1] }}"></i>
              <h2>{{ $meta[0] }}</h2>
              <p>{!! nl2br(e($practiceArea->{$field})) !!}</p>
            </section>
          @endif
        @endforeach
      </div>

      @if($isMuslimLaw)
        <section class="muslim-law-resource">
          <span class="kicker"><i class="bi bi-people-fill"></i> Muslim Law Guidance</span>
          <h2>Khula, Mubaraat, Talaq, Maintenance, Custody & Inheritance</h2>
          <div class="muslim-law-grid">
            <div><h3>Khula</h3><p>Khula is a form of dissolution initiated by the wife. It usually involves a clear request, settlement discussion, documentation and legal guidance suited to Indian procedure and judicial developments.</p></div>
            <div><h3>Mubaraat</h3><p>Mubaraat is separation by mutual consent. Unlike Khula, both spouses agree to dissolve the marriage and settle implications such as mehr, maintenance, custody and documentation.</p></div>
            <div><h3>Talaq</h3><p>Talaq-related matters require careful review of facts, notices, validity, reconciliation efforts and compliance with applicable personal law and statutory developments.</p></div>
            <div><h3>Maintenance</h3><p>Maintenance concerns financial support, income records, dependency, interim relief and appropriate forum strategy.</p></div>
            <div><h3>Custody</h3><p>Custody matters focus on child welfare, visitation, guardianship, schooling, safety and practical parenting arrangements.</p></div>
            <div><h3>Inheritance</h3><p>Inheritance issues may require family details, property papers, legal heir clarity, succession concerns and careful documentation.</p></div>
          </div>
        </section>
      @endif

      <section class="practice-faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="practice-faq-list">
          @foreach($practiceFaqs as $faq)
            @if(!empty($faq['question']) || !empty($faq['answer']))
              <div class="practice-faq-item">
                @if(!empty($faq['question']))
                  <h3>{{ $faq['question'] }}</h3>
                @endif

                @if(!empty($faq['answer']))
                  <p>{{ $faq['answer'] }}</p>
                @endif
              </div>
            @endif
          @endforeach
        </div>
      </section>
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
        <h2>Speak With Rajpati & Associates For {{ $practiceArea->title }}.</h2>
        <p>Discuss your matter for practical legal guidance. Your information remains confidential.</p>
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
