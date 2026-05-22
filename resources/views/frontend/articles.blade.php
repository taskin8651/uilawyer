
@extends('frontend.master')
@section('content')


    <!-- BREADCRUMB START -->
    <section class="articles-breadcrumb">
        <div class="articles-breadcrumb-grid-bg"></div>
        <div class="articles-breadcrumb-shine"></div>
        <div class="articles-orb articles-orb-one"></div>
        <div class="articles-orb articles-orb-two"></div>

        <div class="container">
            <div class="articles-breadcrumb-card reveal">

                <span class="articles-breadcrumb-badge">
                    <i class="bi bi-journal-text"></i>
                    Articles & Publications
                </span>

                <h1>
                    Legal Articles,
                    <span>Verdicts & Updates</span>
                </h1>

                <p>
                    Read legal insights, publication updates, verdict previews and practical
                    guidance from Rajpati & Associates across family, criminal, civil, property,
                    cyber and litigation matters.
                </p>

                <nav class="articles-crumb" aria-label="breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Articles</span>
                </nav>

                <div class="articles-breadcrumb-stats">
                    <div>
                        <strong>SEO</strong>
                        <span>Friendly Articles</span>
                    </div>

                    <div>
                        <strong>Legal</strong>
                        <span>Case Updates</span>
                    </div>

                    <div>
                        <strong>Latest</strong>
                        <span>Judgement Insights</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- ARTICLES INTRO START -->
    <section class="section articles-intro-section">
        <div class="container articles-intro-grid">

            <div class="articles-intro-card reveal">
                <span class="kicker">
                    <i class="bi bi-search-heart-fill"></i>
                    Legal Knowledge Hub
                </span>

                <h2 class="section-title">
                    Explore Legal Articles, Publications & Important Updates.
                </h2>

                <p class="section-text">
                    This page is designed to help visitors discover legal knowledge by category,
                    search legal topics, read article summaries and move to detailed blog pages.
                </p>

                <p class="section-text">
                    Use this page for latest articles, verdict & judgement previews, legal tips,
                    law updates and client-friendly explanations of common legal matters.
                </p>
            </div>

            <div class="articles-search-card reveal">
                <span class="search-label">
                    <i class="bi bi-search"></i>
                    Search Legal Topic
                </span>

                <form class="article-search-form">
                    <input type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search divorce, bail, property, cyber crime..."
                        aria-label="Search legal articles">
                    @if($activeCategory)
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                    @endif
                    <button type="submit">
                        Search
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="popular-tags">
                    <a href="{{ route('frontend.articles.index', ['search' => 'Divorce Law']) }}">Divorce Law</a>
                    <a href="{{ route('frontend.articles.index', ['search' => 'Bail']) }}">Bail</a>
                    <a href="{{ route('frontend.articles.index', ['search' => 'Legal Notice']) }}">Legal Notice</a>
                    <a href="{{ route('frontend.articles.index', ['search' => 'Property']) }}">Property</a>
                    <a href="{{ route('frontend.articles.index', ['search' => 'Cyber Crime']) }}">Cyber Crime</a>
                </div>
            </div>

        </div>
    </section>
    <!-- ARTICLES INTRO END -->


    <!-- CATEGORY FILTER START -->
<section class="articles-filter-section">
    <div class="container">
        <div class="article-filter-wrap reveal">

            <a href="{{ route('frontend.articles.index') }}"
               class="{{ empty($activeCategory) ? 'active' : '' }}">
                All Articles
            </a>

            @foreach($articleCategories as $category)
                <a href="{{ route('frontend.articles.index', array_filter(['category' => $category->slug, 'search' => $search])) }}"
                   class="{{ $activeCategory == $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach

        </div>
    </div>
</section>
<!-- CATEGORY FILTER END -->


<!-- ARTICLE LISTING START -->
<section class="section article-listing-section">
    <div class="container">

        <div class="section-head center reveal">
            <span class="kicker">
                <i class="bi bi-newspaper"></i>
                Latest Articles
            </span>

            <h2 class="section-title">
                Recent Legal Articles & Publications.
            </h2>

            <p class="section-text">
                Browse fresh legal insights, practical guides and publication updates from
                Rajpati & Associates.
            </p>
        </div>

        <div class="articles-layout">

            <div class="article-grid">

                @forelse($articles as $article)
                    <article class="article-card reveal">
                        <div class="article-image">
                            <img src="{{ $article->image ?: 'https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=900&q=80' }}"
                                 alt="{{ $article->title }}">

                            @if($article->category)
                                <span>{{ $article->category->name }}</span>
                            @endif
                        </div>

                        <div class="article-body">
                            <div class="article-meta small">
                                <span>
                                    <i class="bi bi-person-circle"></i>
                                    {{ $article->author_name ?: 'Legal Desk' }}
                                </span>

                                <span>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ optional($article->published_date)->format('d M Y') ?: optional($article->created_at)->format('d M Y') }}
                                </span>
                            </div>

                            <h3>{{ $article->title }}</h3>

                            <p>
                                {{ $article->short_description }}
                            </p>

                            <div class="article-bottom">
                                <a href="{{ route('frontend.articles.show', ['article' => $article->slug]) }}">
                                    {{ $article->read_more_text ?: 'Read More' }}
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
                        <h3>No Articles Found</h3>
                        <p>No articles match your current category or search filter right now.</p>
                    </div>
                @endforelse

            </div>

            <!-- SIDEBAR -->
            <aside class="articles-sidebar reveal">

                <div class="sidebar-box">
                    <h3>Categories</h3>

                    <div class="category-list">
                        @foreach($articleCategories as $category)
                            <a href="{{ route('frontend.articles.index', ['category' => $category->slug]) }}">
                                <span>{{ $category->name }}</span>
                                <strong>{{ str_pad($category->articles_count, 2, '0', STR_PAD_LEFT) }}</strong>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-box">
                    <h3>Latest Updates</h3>

                    <div class="latest-list">
                        @foreach($latestArticles as $latest)
                            <a href="{{ route('frontend.articles.show', ['article' => $latest->slug]) }}">
                                <span>{{ optional($latest->category)->name ?: 'Article' }}</span>
                                <strong>{{ $latest->title }}</strong>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-box consultation-box">
                    <i class="bi bi-chat-square-text-fill"></i>
                    <h3>Need Legal Advice?</h3>
                    <p>
                        Share your legal matter and connect with Rajpati & Associates for confidential guidance.
                    </p>

                    <a href="{{ route('frontend.legal-enquiry.index') }}" class="sidebar-cta">
                        Book Consultation
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </aside>

        </div>

    </div>
</section>
<!-- ARTICLE LISTING END -->


    <!-- FEATURED ARTICLE START -->
    <!-- <section class="section featured-article-section">
        <div class="container">

            <div class="featured-article-card reveal">

                <div class="featured-article-image">
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1200&q=80"
                        alt="Legal documents and law article featured image">
                    <span>Featured Article</span>
                </div>

                <div class="featured-article-content">
                    <span class="article-category">
                        <i class="bi bi-heartbreak"></i>
                        Family Law
                    </span>

                    <h2>
                        Understanding Mutual Consent Divorce Process In India
                    </h2>

                    <p>
                        Learn the basic process, documents, legal timeline and important considerations
                        before filing a mutual consent divorce matter.
                    </p>

                    <div class="article-meta">
                        <span><i class="bi bi-person-circle"></i> Rajpati Legal Desk</span>
                        <span><i class="bi bi-calendar-event"></i> 08 May 2026</span>
                        <span><i class="bi bi-clock"></i> 5 Min Read</span>
                    </div>

                    <div class="article-share">
                        <span>Share:</span>
                        <a href="#" aria-label="Share on Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Share on X"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" aria-label="Share on WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" aria-label="Copy article link"><i class="bi bi-link-45deg"></i></a>
                    </div>

                    <a href="article-mutual-consent-divorce.html" class="btn btn-primary magnetic">
                        Read Full Article
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </section> -->
    <!-- FEATURED ARTICLE END -->


  


    <!-- VERDICT PREVIEW START -->
    <section class="section verdict-preview-section">
        <div class="container">

            <div class="section-head center reveal">
                <span class="kicker">
                    <i class="bi bi-bank2"></i>
                    Verdict & Judgement
                </span>

                <h2 class="section-title">
                    Recent Verdicts & Important Judgement Updates.
                </h2>

                <p class="section-text">
                    Use this section to highlight legal case updates, judgement notes and important
                    court-related publications.
                </p>
            </div>

            <div class="verdict-preview-grid">

                <article class="verdict-preview-card reveal">
                    <span>Recent Verdict</span>
                    <h3>Family Dispute Settlement Update</h3>
                    <p>
                        Important points around family dispute settlement, mediation and court-based remedies.
                    </p>
                    <a href="service-divorce-lawyer.html">Read More <i class="bi bi-arrow-right"></i></a>
                </article>

                <article class="verdict-preview-card reveal">
                    <span>Judgement Note</span>
                    <h3>Bail & Criminal Procedure Overview</h3>
                    <p>
                        Useful observations for bail applications, FIR matters and criminal case timelines.
                    </p>
                    <a href="service-divorce-lawyer.html">Read More <i class="bi bi-arrow-right"></i></a>
                </article>

                <article class="verdict-preview-card reveal">
                    <span>Case Update</span>
                    <h3>Property & Civil Litigation Notes</h3>
                    <p>
                        Legal update on property disputes, inheritance documentation and civil litigation support.
                    </p>
                    <a href="service-divorce-lawyer.html">Read More <i class="bi bi-arrow-right"></i></a>
                </article>

            </div>

        </div>
    </section>
    <!-- VERDICT PREVIEW END -->


    <!-- RELATED ARTICLES START -->
    <section class="section related-articles-section">
        <div class="container">

            <div class="related-articles-box reveal">
                <div>
                    <span class="kicker">
                        <i class="bi bi-link-45deg"></i>
                        Related Legal Topics
                    </span>

                    <h2 class="section-title">
                        Explore More Legal Resources.
                    </h2>

                    <p class="section-text">
                        Internal links help visitors discover important service pages and improve SEO structure.
                    </p>
                </div>

                <div class="related-topic-grid">
                    <a href="service-divorce-lawyer.html">
                        <i class="bi bi-heartbreak"></i>
                        Divorce Lawyer
                    </a>

                    <a href="service-criminal-lawyer.html">
                        <i class="bi bi-shield-lock"></i>
                        Criminal Lawyer
                    </a>

                    <a href="service-property-lawyer.html">
                        <i class="bi bi-house-lock-fill"></i>
                        Property Lawyer
                    </a>

                    <a href="service-cyber-crime-lawyer.html">
                        <i class="bi bi-globe2"></i>
                        Cyber Crime Lawyer
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!-- RELATED ARTICLES END -->


    <!-- CTA START -->
    <section class="section articles-cta-section">
        <div class="container">

            <div class="articles-cta-box reveal">
                <div>
                    <span class="articles-cta-badge">
                        <i class="bi bi-chat-square-text-fill"></i>
                        Legal Issue?
                    </span>

                    <h2>
                        Reading An Article Is Helpful, But Your Case Needs Personal Legal Guidance.
                    </h2>

                    <p>
                        Book consultation for divorce, bail, civil litigation, cyber crime, legal notice,
                        property dispute or court-related matters.
                    </p>
                </div>

                <div class="articles-cta-actions">
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
    <!-- CTA END -->


   @endsection
