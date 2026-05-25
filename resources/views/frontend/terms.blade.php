@extends('frontend.master')
@section('content')

@php $siteSetting = \App\Models\SiteSetting::current(); @endphp

<section class="policy-breadcrumb">
    <div class="container">
        <div class="policy-breadcrumb-card reveal">
            <span class="policy-badge"><i class="bi bi-file-earmark-text-fill"></i> Legal Terms</span>
            <h1>Terms & Conditions</h1>
            <p>Please read these terms carefully before using {{ $siteSetting->site_name }} services or submitting any enquiry.</p>
            <nav class="policy-crumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Terms</span>
            </nav>
        </div>
    </div>
</section>

<section class="section policy-section">
    <div class="container policy-grid">
        <aside class="policy-sidebar reveal">
            <a href="#use">Use Of Website</a>
            <a href="#consultation">Consultation</a>
            <a href="#submissions">Submissions</a>
            <a href="#liability">Limitation</a>
            <a href="#contact">Contact</a>
        </aside>

        <article class="policy-card reveal">
            <section id="use">
                <h2>Use Of Website</h2>
                <p>This website provides general information about legal services, practice areas, articles and consultation options. The information on this website is not a substitute for professional legal advice for your specific matter.</p>
            </section>

            <section id="consultation">
                <h2>Consultation & Legal Services</h2>
                <p>Submitting a form, enquiry, article or application does not automatically create a lawyer-client relationship. A formal engagement, consultation confirmation or written acceptance may be required before legal services begin.</p>
            </section>

            <section id="submissions">
                <h2>User Submissions</h2>
                <p>Users must submit genuine, accurate and lawful information. Fake, misleading, abusive, incomplete or spam submissions may be rejected without notice.</p>
            </section>

            <section id="liability">
                <h2>Limitation Of Liability</h2>
                <p>{{ $siteSetting->site_name }} is not responsible for loss arising from reliance on general website content without case-specific legal consultation. External links, third-party platforms and payment channels may have their own terms.</p>
            </section>

            <section id="contact">
                <h2>Contact</h2>
                <p>For questions about these terms, contact us at <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>.</p>
            </section>
        </article>
    </div>
</section>

@endsection
