@extends('frontend.master')

@section('content')
@php
  $categoryName = optional($article->category)->name ?: 'Legal Article';
  $articleImage = $article->image ?: $fallbackImage;
  $publishedAt = optional($article->published_date)->format('d M Y') ?: optional($article->created_at)->format('d M Y');
  $authorName = $article->author_name ?: 'Legal Desk';
  $summary = $article->short_description ?: \Illuminate\Support\Str::limit(strip_tags($article->description), 180);
  $content = $article->description ?: $article->short_description;
  $wordCount = str_word_count(strip_tags((string) $content));
  $readMinutes = max(1, (int) ceil($wordCount / 200));
  $shareUrl = urlencode(request()->fullUrl());
  $shareText = urlencode($article->title);
  $siteSetting = \App\Models\SiteSetting::first();
@endphp

  <!-- BREADCRUMB START -->
  <section class="article-breadcrumb">
    <div class="article-breadcrumb-grid-bg"></div>
    <div class="article-breadcrumb-shine"></div>
    <div class="article-orb article-orb-one"></div>
    <div class="article-orb article-orb-two"></div>

    <div class="container">
      <div class="article-breadcrumb-card reveal">

        <span class="article-breadcrumb-badge">
          <i class="bi bi-newspaper"></i>
          {{ $categoryName }}
        </span>

        <h1>
          {{ $article->title }}
          <span>{{ $categoryName }}</span>
        </h1>

        @if($summary)
          <p>{{ $summary }}</p>
        @endif

        <nav class="article-crumb" aria-label="breadcrumb">
          <a href="{{ url('/') }}">Home</a>
          <i class="bi bi-chevron-right"></i>
          <a href="{{ route('frontend.articles.index') }}">Articles</a>
          <i class="bi bi-chevron-right"></i>
          <span>{{ \Illuminate\Support\Str::limit($article->title, 35) }}</span>
        </nav>

        <div class="article-meta-row">
          <span><i class="bi bi-person-fill"></i> {{ $authorName }}</span>
          <span><i class="bi bi-calendar2-check-fill"></i> {{ $publishedAt }}</span>
          <span><i class="bi bi-folder-fill"></i> {{ $categoryName }}</span>
          <span><i class="bi bi-clock-fill"></i> {{ $readMinutes }} Min Read</span>
        </div>

      </div>
    </div>
  </section>
  <!-- BREADCRUMB END -->


  <!-- ARTICLE DETAIL START -->
  <section class="section article-detail-section">
    <div class="container article-detail-grid">

      <!-- LEFT MAIN ARTICLE -->
      <main class="article-main-card reveal">

        <div class="article-featured-image">
          <img src="{{ $articleImage }}" alt="{{ $article->title }}">
          <span class="article-category-tag">
            <i class="bi bi-folder-fill"></i>
            {{ $categoryName }}
          </span>
        </div>

        <article class="article-content">
          @if($content)
            @if($content !== strip_tags($content))
              {!! $content !!}
            @else
              {!! nl2br(e($content)) !!}
            @endif
          @else
            <p>Article detail content will be available soon.</p>
          @endif
        </article>

        <div class="article-share-box">
          <strong>Share This Article</strong>

          <div class="article-share-links">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" aria-label="Share on Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" aria-label="Share on Twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareText }}" target="_blank" aria-label="Share on LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" aria-label="Share on WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

      </main>


      <!-- RIGHT SIDEBAR -->
      <aside class="article-sidebar">

        <div class="article-toc-card reveal">
          <h3 class="sidebar-title">Article Summary</h3>

          <div class="article-toc-list">
            <a href="{{ route('frontend.articles.index', ['category' => optional($article->category)->slug]) }}">
              {{ $categoryName }} Articles <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('frontend.articles.index') }}">
              All Legal Articles <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('frontend.legal-enquiry.index') }}">
              Book Consultation <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="article-author-card reveal">
          <img src="{{ asset('assets/img/logo2.png') }}" alt="{{ $authorName }}">

          <h3>{{ $authorName }}</h3>
          <p>
            Legal insights and consultation support from Rajpati & Associates across family,
            civil, criminal and litigation matters.
          </p>

          <a href="{{ route('frontend.team') }}" class="author-btn">
            View Team
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <div class="article-sidebar-card reveal">
          <h3 class="sidebar-title">Categories</h3>

          <div class="article-category-list">
            @foreach($articleCategories as $category)
              <a href="{{ route('frontend.articles.index', ['category' => $category->slug]) }}">
                {{ $category->name }}
                <i class="bi bi-chevron-right"></i>
              </a>
            @endforeach
          </div>
        </div>

        @if($latestArticles->isNotEmpty())
          <div class="article-sidebar-card reveal">
            <h3 class="sidebar-title">Latest Articles</h3>

            <div class="latest-article-list">
              @foreach($latestArticles as $latest)
                <a href="{{ route('frontend.articles.show', ['article' => $latest->slug]) }}" class="latest-article-item">
                  <img src="{{ $latest->image ?: $fallbackImage }}" alt="{{ $latest->title }}">
                  <div>
                    <h4>{{ $latest->title }}</h4>
                    <span>{{ optional($latest->category)->name ?: 'Article' }}</span>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif

      </aside>

    </div>
  </section>
  <!-- ARTICLE DETAIL END -->


  @if($relatedArticles->isNotEmpty())
    <!-- RELATED ARTICLES START -->
    <section class="section related-articles-section">
      <div class="container">

        <div class="section-head center reveal">
          <span class="kicker">
            <i class="bi bi-link-45deg"></i>
            Related Articles
          </span>

          <h2 class="section-title">Read More Legal Insights.</h2>

          <p class="section-text">
            Explore more articles from Rajpati & Associates based on similar legal topics.
          </p>
        </div>

        <div class="related-articles-grid">
          @foreach($relatedArticles as $related)
            <article class="related-article-card reveal">
              <div class="related-article-img">
                <img src="{{ $related->image ?: $fallbackImage }}" alt="{{ $related->title }}">
              </div>

              <div class="related-article-body">
                <span><i class="bi bi-folder-fill"></i> {{ optional($related->category)->name ?: 'Article' }}</span>
                <h3>{{ $related->title }}</h3>
                <p>{{ $related->short_description ?: \Illuminate\Support\Str::limit(strip_tags($related->description), 120) }}</p>
                <a href="{{ route('frontend.articles.show', ['article' => $related->slug]) }}">
                  Read More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </article>
          @endforeach
        </div>

      </div>
    </section>
    <!-- RELATED ARTICLES END -->
  @endif


  <!-- CONSULT CTA START -->
  <section class="section article-consult-section">
    <div class="container">

      <div class="article-consult-box reveal">
        <div>
          <span class="article-consult-badge">
            <i class="bi bi-calendar2-check-fill"></i>
            Need Legal Advice?
          </span>

          <h2>
            Speak With Rajpati & Associates For Confidential Legal Guidance.
          </h2>

          <p>
            Book consultation for legal notices, family disputes, criminal matters,
            property disputes or court-related guidance.
          </p>
        </div>

        <div class="article-consult-actions">
          <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-primary magnetic">
            Discuss Your Legal Matter
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
  <!-- CONSULT CTA END -->

@endsection
