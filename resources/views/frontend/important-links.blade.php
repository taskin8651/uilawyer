@extends('frontend.master')
@section('content')

<section class="resource-hero">
    <div class="container">
        <div class="resource-hero-card reveal">
            <span class="kicker"><i class="bi bi-link-45deg"></i> Important Legal Links</span>
            <h1>Useful Court & Legal Service Links.</h1>
            <p>Access official legal portals, court resources and service links added from the admin panel.</p>
            <nav class="resource-crumb" aria-label="breadcrumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Important Links</span>
            </nav>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="resource-grid">
            @forelse($importantLinks as $importantLink)
                <a class="resource-link-card reveal" href="{{ $importantLink->url }}" target="_blank" rel="noopener">
                    <span class="resource-link-icon">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </span>
                    <div>
                        <h2>{{ $importantLink->title }}</h2>
                        <p>{{ parse_url($importantLink->url, PHP_URL_HOST) ?: $importantLink->url }}</p>
                    </div>
                </a>
            @empty
                <div class="resource-empty reveal">
                    <i class="bi bi-info-circle-fill"></i>
                    <h2>No important links added yet.</h2>
                    <p>Once links are published from admin panel, they will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
