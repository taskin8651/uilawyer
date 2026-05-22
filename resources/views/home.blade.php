@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('styles')
<style>
    .dash-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        padding: 28px;
        border-radius: 18px;
        color: #fff;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 52%, #d1a93d 140%);
        box-shadow: 0 20px 48px rgba(15, 23, 42, .16);
    }
    .dash-hero::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -80px;
        top: -110px;
        border-radius: 50%;
        background: rgba(209, 169, 61, .2);
    }
    .dash-hero > * { position: relative; z-index: 1; }
    .dash-title { margin: 0; font-size: 26px; font-weight: 800; }
    .dash-subtitle { max-width: 720px; margin: 8px 0 0; color: rgba(255,255,255,.78); font-size: 14px; line-height: 1.7; }
    .dash-date {
        align-self: flex-start;
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        color: rgba(255,255,255,.9);
        font-size: 13px;
        white-space: nowrap;
    }
    .dash-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 20px;
    }
    .dash-card,
    .dash-panel {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, .06);
    }
    .dash-card {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 18px;
        min-height: 132px;
    }
    .dash-card-label { margin: 0; color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .05em; }
    .dash-card-number { margin: 8px 0 0; color: #0f172a; font-size: 30px; font-weight: 900; line-height: 1; }
    .dash-card-note { display: inline-flex; margin-top: 12px; padding: 4px 9px; border-radius: 999px; background: #f8fafc; color: #475569; font-size: 12px; font-weight: 700; }
    .dash-card-icon {
        display: grid;
        place-items: center;
        flex: 0 0 46px;
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #f8fafc;
        color: #d1a93d;
        font-size: 19px;
    }
    .dash-panels {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(320px, .8fr);
        gap: 18px;
        margin-top: 20px;
    }
    .dash-panel { padding: 20px; }
    .dash-panel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }
    .dash-panel-title { margin: 0; color: #0f172a; font-size: 16px; font-weight: 900; }
    .dash-panel-link { color: #b48621; font-size: 13px; font-weight: 800; text-decoration: none; }
    .dash-table { width: 100%; border-collapse: collapse; }
    .dash-table th {
        padding: 10px 12px;
        color: #64748b;
        background: #f8fafc;
        font-size: 12px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .05em;
    }
    .dash-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 13px; vertical-align: top; }
    .dash-table tr:last-child td { border-bottom: 0; }
    .dash-person { margin: 0; color: #0f172a; font-weight: 800; }
    .dash-muted { margin: 3px 0 0; color: #94a3b8; font-size: 12px; }
    .status-chip {
        display: inline-flex;
        padding: 4px 9px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 800;
        text-transform: capitalize;
    }
    .status-chip.new { background: #fef3c7; color: #92400e; }
    .status-chip.closed,
    .status-chip.shortlisted { background: #dcfce7; color: #166534; }
    .quick-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .quick-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border-radius: 12px;
        background: #f8fafc;
        color: #0f172a;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        border: 1px solid #eef2f7;
    }
    .quick-card i {
        display: grid;
        place-items: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #fff;
        color: #d1a93d;
    }
    .article-list { display: grid; gap: 12px; }
    .article-item { padding: 13px; border: 1px solid #eef2f7; border-radius: 12px; }
    .article-item h4 { margin: 0; color: #0f172a; font-size: 14px; }
    @media (max-width: 1100px) {
        .dash-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .dash-panels { grid-template-columns: 1fr; }
    }
    @media (max-width: 680px) {
        .dash-hero { flex-direction: column; padding: 22px; }
        .dash-grid,
        .quick-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<section class="dash-hero">
    <div>
        <h1 class="dash-title">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="dash-subtitle">
            Track main enquiries, book consultation requests, career applications and active site content from one focused dashboard.
        </p>
    </div>
    <div class="dash-date">
        <i class="fas fa-calendar-alt"></i>
        {{ now()->format('D, d M Y') }}
    </div>
</section>

<section class="dash-grid">
    <div class="dash-card">
        <div>
            <p class="dash-card-label">Main Enquiries</p>
            <p class="dash-card-number">{{ $stats['main_enquiries'] }}</p>
            <span class="dash-card-note">{{ $stats['new_main_enquiries'] }} new</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-envelope-open-text"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Book Consultations</p>
            <p class="dash-card-number">{{ $stats['book_consultations'] }}</p>
            <span class="dash-card-note">{{ $stats['new_book_consultations'] }} new</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Career Applications</p>
            <p class="dash-card-number">{{ $stats['career_applications'] }}</p>
            <span class="dash-card-note">{{ $stats['new_career_applications'] }} new</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-briefcase"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Active Articles</p>
            <p class="dash-card-number">{{ $stats['active_articles'] }}</p>
            <span class="dash-card-note">{{ $stats['articles'] }} total</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-newspaper"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Practice Areas</p>
            <p class="dash-card-number">{{ $stats['practice_areas'] }}</p>
            <span class="dash-card-note">{{ $stats['practice_services'] }} services</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-scale-balanced"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Attorneys</p>
            <p class="dash-card-number">{{ $stats['attorneys'] }}</p>
            <span class="dash-card-note">active profiles</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-user-tie"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Testimonials</p>
            <p class="dash-card-number">{{ $stats['testimonials'] }}</p>
            <span class="dash-card-note">published</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-star"></i></div>
    </div>

    <div class="dash-card">
        <div>
            <p class="dash-card-label">Quick Health</p>
            <p class="dash-card-number">{{ $stats['practice_services'] + $stats['active_articles'] }}</p>
            <span class="dash-card-note">content items</span>
        </div>
        <div class="dash-card-icon"><i class="fas fa-chart-line"></i></div>
    </div>
</section>

<section class="dash-panels">
    <div class="dash-panel">
        <div class="dash-panel-head">
            <h2 class="dash-panel-title">Latest Enquiries</h2>
            @can('legal_enquiry_access')
                <a href="{{ route('admin.legal-enquiries.index') }}" class="dash-panel-link">View all</a>
            @endcan
        </div>

        <table class="dash-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentEnquiries as $enquiry)
                    <tr>
                        <td>
                            <p class="dash-person">{{ $enquiry->full_name ?: 'Unknown' }}</p>
                            <p class="dash-muted">{{ $enquiry->mobile ?: $enquiry->email }}</p>
                        </td>
                        <td>{{ $enquiry->form_type === 'consultation' ? 'Book Consultation' : 'Main Enquiry' }}</td>
                        <td>{{ $enquiry->case_category ?: '-' }}</td>
                        <td><span class="status-chip {{ $enquiry->status }}">{{ $enquiry->status }}</span></td>
                        <td>{{ optional($enquiry->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No enquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="dash-panel">
        <div class="dash-panel-head">
            <h2 class="dash-panel-title">Quick Actions</h2>
        </div>
        <div class="quick-grid">
            @can('legal_enquiry_access')
                <a href="{{ route('admin.legal-enquiries.index') }}" class="quick-card"><i class="fas fa-envelope-open-text"></i>Main Enquiries</a>
            @endcan
            @can('legal_enquiry_access')
                <a href="{{ route('admin.legal-enquiries.index') }}" class="quick-card"><i class="fas fa-calendar-check"></i>Book Consultations</a>
            @endcan
            @can('career_application_access')
                <a href="{{ route('admin.career-applications.index') }}" class="quick-card"><i class="fas fa-briefcase"></i>Career Applications</a>
            @endcan
            @can('article_create')
                <a href="{{ route('admin.articles.create') }}" class="quick-card"><i class="fas fa-plus"></i>Add Article</a>
            @endcan
            @can('practice_area_access')
                <a href="{{ route('admin.practice-areas.index') }}" class="quick-card"><i class="fas fa-scale-balanced"></i>Practice Areas</a>
            @endcan
            @can('testimonial_access')
                <a href="{{ route('admin.testimonials.index') }}" class="quick-card"><i class="fas fa-star"></i>Testimonials</a>
            @endcan
        </div>
    </div>
</section>

<section class="dash-panels">
    <div class="dash-panel">
        <div class="dash-panel-head">
            <h2 class="dash-panel-title">Career Applications</h2>
            @can('career_application_access')
                <a href="{{ route('admin.career-applications.index') }}" class="dash-panel-link">View all</a>
            @endcan
        </div>
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Interest</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentCareerApplications as $application)
                    <tr>
                        <td>
                            <p class="dash-person">{{ $application->full_name ?: 'Unknown' }}</p>
                            <p class="dash-muted">{{ $application->phone ?: $application->email }}</p>
                        </td>
                        <td>{{ $application->practice_area_interest ?: '-' }}</td>
                        <td><span class="status-chip {{ $application->status }}">{{ $application->status }}</span></td>
                        <td>{{ optional($application->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No career applications yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="dash-panel">
        <div class="dash-panel-head">
            <h2 class="dash-panel-title">Recent Articles</h2>
            @can('article_access')
                <a href="{{ route('admin.articles.index') }}" class="dash-panel-link">View all</a>
            @endcan
        </div>
        <div class="article-list">
            @forelse($recentArticles as $article)
                <div class="article-item">
                    <h4>{{ $article->title }}</h4>
                    <p class="dash-muted">
                        {{ optional($article->category)->name ?: 'Article' }}
                        · {{ optional($article->created_at)->format('d M Y') }}
                    </p>
                </div>
            @empty
                <p class="dash-muted">No articles yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
