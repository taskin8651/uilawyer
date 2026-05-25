@extends('frontend.master')

@section('content')
@php
    $fallbackImage = 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=1000&q=80';
@endphp

<section class="articles-breadcrumb">
    <div class="articles-breadcrumb-grid-bg"></div>
    <div class="articles-breadcrumb-shine"></div>

    <div class="container">
        <div class="articles-breadcrumb-card reveal">
            <span class="articles-breadcrumb-badge">
                <i class="bi bi-bank2"></i>
                Verdicts & Judgments
            </span>

            <h1>
                Court Verdicts,
                <span>Judgments & Case Notes</span>
            </h1>

            <p>
                Read selected court decisions, case summaries, citations and important legal outcomes
                shared by Rajpati & Associates.
            </p>

            <nav class="articles-crumb" aria-label="breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Verdicts & Judgments</span>
            </nav>

            <div class="articles-breadcrumb-stats">
                <div>
                    <strong>{{ str_pad($verdictJudgments->count(), 2, '0', STR_PAD_LEFT) }}</strong>
                    <span>Published</span>
                </div>
                <div>
                    <strong>{{ str_pad($featuredVerdicts->count(), 2, '0', STR_PAD_LEFT) }}</strong>
                    <span>Featured</span>
                </div>
                <div>
                    <strong>Case</strong>
                    <span>References</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section articles-intro-section">
    <div class="container articles-intro-grid">
        <div class="articles-intro-card reveal">
            <span class="kicker">
                <i class="bi bi-search-heart-fill"></i>
                Legal Case Library
            </span>

            <h2 class="section-title">
                Browse Important Judgments With Court, Case Number & Citation Details.
            </h2>

            <p class="section-text">
                This section helps visitors find useful verdict summaries and download related
                documents where available.
            </p>
        </div>

        <div class="articles-search-card reveal">
            <span class="search-label">
                <i class="bi bi-search"></i>
                Search Judgment
            </span>

            <form class="article-search-form">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search court, case number, citation..." aria-label="Search verdicts and judgments">
                <button type="submit">
                    Search
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="popular-tags">
                <a href="{{ route('frontend.verdicts.index', ['search' => 'Bail']) }}">Bail</a>
                <a href="{{ route('frontend.verdicts.index', ['search' => 'Family Court']) }}">Family Court</a>
                <a href="{{ route('frontend.verdicts.index', ['search' => 'Property']) }}">Property</a>
                <a href="{{ route('frontend.verdicts.index', ['search' => 'High Court']) }}">High Court</a>
            </div>
        </div>
    </div>
</section>

<section class="section article-listing-section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="kicker">
                <i class="bi bi-bank2"></i>
                Latest Judgments
            </span>

            <h2 class="section-title">Recent Verdicts & Judgment Notes.</h2>
            <p class="section-text">
                Explore legal outcomes, short notes and downloadable case documents.
            </p>
        </div>

        <div class="articles-layout">
            <div class="article-grid">
                @forelse($verdictJudgments as $verdictJudgment)
                    <article class="article-card reveal">
                        <div class="article-image">
                            <img src="{{ $verdictJudgment->image ?: $fallbackImage }}" alt="{{ $verdictJudgment->title }}">
                            @if($verdictJudgment->court_name)
                                <span>{{ $verdictJudgment->court_name }}</span>
                            @endif
                        </div>

                        <div class="article-body">
                            <div class="article-meta small">
                                <span>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ optional($verdictJudgment->judgment_date)->format('d M Y') ?: optional($verdictJudgment->created_at)->format('d M Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-file-earmark-text"></i>
                                    {{ $verdictJudgment->case_number ?: 'Case Note' }}
                                </span>
                            </div>

                            <h3>{{ $verdictJudgment->title }}</h3>
                            <p>{{ $verdictJudgment->short_description ?: \Illuminate\Support\Str::limit(strip_tags($verdictJudgment->description), 130) }}</p>

                            <div class="article-bottom">
                                <a href="{{ route('frontend.verdicts.show', ['verdictJudgment' => $verdictJudgment->slug]) }}">
                                    Read More
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <div class="mini-share">
                                    <i class="bi bi-share-fill"></i>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="article-card reveal" style="padding:30px;">
                        <h3>No Judgments Found</h3>
                        <p>No verdicts or judgments match your current search right now.</p>
                    </div>
                @endforelse
            </div>

            <aside class="articles-sidebar reveal">
                @if($featuredVerdicts->isNotEmpty())
                    <div class="sidebar-box">
                        <h3>Featured Judgments</h3>
                        <div class="latest-list">
                            @foreach($featuredVerdicts as $featured)
                                <a href="{{ route('frontend.verdicts.show', ['verdictJudgment' => $featured->slug]) }}">
                                    <span>{{ optional($featured->judgment_date)->format('d M Y') ?: 'Judgment' }}</span>
                                    <strong>{{ $featured->title }}</strong>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="sidebar-box consultation-box">
                    <i class="bi bi-chat-square-text-fill"></i>
                    <h3>Need Legal Advice?</h3>
                    <p>Share your legal matter and connect with Rajpati & Associates for confidential guidance.</p>
                    <a href="{{ route('frontend.legal-enquiry.index') }}" class="sidebar-cta">
                        Book Consultation
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($relatedPractices->isNotEmpty())
                    <div class="sidebar-box">
                        <h3>Practice Areas</h3>
                        <div class="category-list">
                            @foreach($relatedPractices as $practice)
                                <a href="{{ route('frontend.practice-area.index', ['category' => $practice->slug]) }}">
                                    <span>{{ $practice->title }}</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@endsection
