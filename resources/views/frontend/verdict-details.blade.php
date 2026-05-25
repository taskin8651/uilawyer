@extends('frontend.master')

@section('content')
@php
    $judgmentImage = $verdictJudgment->image ?: $fallbackImage;
    $judgmentDate = optional($verdictJudgment->judgment_date)->format('d M Y') ?: optional($verdictJudgment->created_at)->format('d M Y');
    $summary = $verdictJudgment->short_description ?: \Illuminate\Support\Str::limit(strip_tags($verdictJudgment->description), 180);
    $content = $verdictJudgment->description ?: $verdictJudgment->short_description;
    $shareUrl = urlencode(request()->fullUrl());
    $shareText = urlencode($verdictJudgment->title);
    $siteSetting = \App\Models\SiteSetting::first();
@endphp

<section class="article-breadcrumb">
    <div class="article-breadcrumb-grid-bg"></div>
    <div class="article-breadcrumb-shine"></div>

    <div class="container">
        <div class="article-breadcrumb-card reveal">
            <span class="article-breadcrumb-badge">
                <i class="bi bi-bank2"></i>
                {{ $verdictJudgment->court_name ?: 'Court Judgment' }}
            </span>

            <h1>
                {{ $verdictJudgment->title }}
                <span>Verdict & Judgment</span>
            </h1>

            @if($summary)
                <p>{{ $summary }}</p>
            @endif

            <nav class="article-crumb" aria-label="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('frontend.verdicts.index') }}">Verdicts & Judgments</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ \Illuminate\Support\Str::limit($verdictJudgment->title, 35) }}</span>
            </nav>

            <div class="article-meta-row">
                <span><i class="bi bi-calendar2-check-fill"></i> {{ $judgmentDate }}</span>
                <span><i class="bi bi-bank2"></i> {{ $verdictJudgment->court_name ?: 'Court' }}</span>
                <span><i class="bi bi-file-earmark-text-fill"></i> {{ $verdictJudgment->case_number ?: 'Case Note' }}</span>
                @if($verdictJudgment->citation)
                    <span><i class="bi bi-quote"></i> {{ $verdictJudgment->citation }}</span>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section article-detail-section">
    <div class="container article-detail-grid">
        <main class="article-main-card reveal">
            <div class="article-featured-image">
                <img src="{{ $judgmentImage }}" alt="{{ $verdictJudgment->title }}">
                <span class="article-category-tag">
                    <i class="bi bi-bank2"></i>
                    Judgment
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
                    <p>Judgment details will be available soon.</p>
                @endif

                @if($verdictJudgment->result_summary)
                    <h3>Result Summary</h3>
                    @if($verdictJudgment->result_summary !== strip_tags($verdictJudgment->result_summary))
                        {!! $verdictJudgment->result_summary !!}
                    @else
                        {!! nl2br(e($verdictJudgment->result_summary)) !!}
                    @endif
                @endif
            </article>

            <div class="article-share-box">
                <strong>Share This Judgment</strong>
                <div class="article-share-links">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" aria-label="Share on Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" aria-label="Share on Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareText }}" target="_blank" aria-label="Share on LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" aria-label="Share on WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </main>

        <aside class="article-sidebar">
            <div class="article-toc-card reveal">
                <h3 class="sidebar-title">Case Information</h3>
                <div class="article-toc-list">
                    <a href="{{ route('frontend.verdicts.index') }}">All Judgments <i class="bi bi-arrow-right"></i></a>
                    <a href="{{ route('frontend.legal-enquiry.index') }}">Book Consultation <i class="bi bi-arrow-right"></i></a>
                    @if($verdictJudgment->document)
                        <a href="{{ $verdictJudgment->document }}" target="_blank">Download Judgment Document <i class="bi bi-download"></i></a>
                    @endif
                </div>
            </div>

            <div class="article-author-card reveal">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="{{ $verdictJudgment->author_name ?: 'Legal Desk' }}">
                <h3>{{ $verdictJudgment->author_name ?: 'Legal Desk' }}</h3>
                <p>Judgment notes and legal insights from Rajpati & Associates.</p>
                <a href="{{ route('frontend.team') }}" class="author-btn">
                    View Team
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($latestVerdicts->isNotEmpty())
                <div class="article-sidebar-card reveal">
                    <h3 class="sidebar-title">Latest Judgments</h3>
                    <div class="latest-article-list">
                        @foreach($latestVerdicts as $latest)
                            <a href="{{ route('frontend.verdicts.show', ['verdictJudgment' => $latest->slug]) }}" class="latest-article-item">
                                <img src="{{ $latest->image ?: $fallbackImage }}" alt="{{ $latest->title }}">
                                <div>
                                    <h4>{{ $latest->title }}</h4>
                                    <span>{{ $latest->court_name ?: 'Judgment' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</section>

<section class="section article-consult-section">
    <div class="container">
        <div class="article-consult-box reveal">
            <div>
                <span class="article-consult-badge">
                    <i class="bi bi-calendar2-check-fill"></i>
                    Need Legal Advice?
                </span>

                <h2>Discuss Your Legal Matter With Rajpati & Associates.</h2>

                <p>
                    Book consultation for family, civil, criminal, property, notice or court-related guidance.
                </p>
            </div>

            <div class="article-consult-actions">
                <a href="{{ route('frontend.legal-enquiry.index') }}" class="btn btn-primary magnetic">
                    Book Consultation
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
