@extends('frontend.master')
@section('content')

<section class="resource-hero">
    <div class="container">
        <div class="resource-hero-card reveal">
            <span class="kicker"><i class="bi bi-play-btn-fill"></i> Awareness Videos</span>
            <h1>Legal Awareness & Guidance Videos.</h1>
            <p>Watch public legal awareness videos and client guidance updates managed from the admin panel.</p>
            <nav class="resource-crumb" aria-label="breadcrumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Awareness Videos</span>
            </nav>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="video-resource-grid">
            @forelse($awarenessVideos as $video)
                <article class="video-resource-card reveal">
                    <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="video-resource-thumb">
                        @if($video->thumbnail_image)
                            <img src="{{ $video->thumbnail_image }}" alt="{{ $video->title }}">
                        @else
                            <div class="video-resource-placeholder">
                                <i class="bi bi-play-circle-fill"></i>
                            </div>
                        @endif
                        <span><i class="bi bi-play-fill"></i></span>
                    </a>

                    <div class="video-resource-body">
                        <h2>{{ $video->title }}</h2>
                        <p>{{ $video->short_description ?: 'Watch this legal awareness update from Rajpati & Associates.' }}</p>
                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="read-link">
                            Watch Video <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="resource-empty reveal">
                    <i class="bi bi-play-circle-fill"></i>
                    <h2>No awareness videos added yet.</h2>
                    <p>Published videos from admin panel will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
