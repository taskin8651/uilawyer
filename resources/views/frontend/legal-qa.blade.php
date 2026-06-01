@extends('frontend.master')
@section('content')

<section class="resource-hero">
    <div class="container">
        <div class="resource-hero-card reveal">
            <span class="kicker"><i class="bi bi-question-circle-fill"></i> Legal Q&A</span>
            <h1>Ask A General Legal Question.</h1>
            <p>Submit a general legal question for review. Published answers are educational and do not replace private legal consultation.</p>
            <nav class="resource-crumb" aria-label="breadcrumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Legal Q&A</span>
            </nav>
        </div>
    </div>
</section>

<section class="section">
    <div class="container legal-qa-layout">
        <div class="consultation-form-card reveal">
            <span class="form-badge">
                <i class="bi bi-chat-square-text-fill"></i>
                Ask Question
            </span>

            <h2>Submit Your Legal Question</h2>
            <p>Share only basic facts. Avoid uploading or writing sensitive private details here.</p>

            <form class="consultation-form" method="POST" action="{{ route('frontend.legal-qa.store') }}">
                @csrf

                <p class="confidential-note">
                    <i class="bi bi-shield-lock-fill"></i>
                    For private legal advice, please book a confidential consultation.
                </p>

                <div class="form-group">
                    <label for="question">Question *</label>
                    <textarea id="question" name="question" rows="7" required placeholder="Write your general legal question...">{{ old('question') }}</textarea>
                </div>

                <label class="consent-check">
                    <input type="checkbox" name="consent" value="1" required {{ old('consent') ? 'checked' : '' }}>
                    <span>I agree that this question may be reviewed and answered as general legal information.</span>
                </label>

                <button type="submit" class="consult-submit-btn">
                    Submit Question
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="legal-qa-list reveal">
            <span class="kicker"><i class="bi bi-journal-check"></i> Published Answers</span>
            <h2 class="section-title">Recent Legal Q&A.</h2>

            <div class="legal-qa-items">
                @forelse($legalQas as $legalQa)
                    <article class="legal-qa-card">
                        <h3>{{ $legalQa->question }}</h3>
                        <p>{{ $legalQa->answer }}</p>
                    </article>
                @empty
                    <div class="resource-empty">
                        <i class="bi bi-question-circle-fill"></i>
                        <h2>No published Q&A yet.</h2>
                        <p>Questions submitted from this page will be visible after review.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection
