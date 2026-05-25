@extends('frontend.master')
@section('content')

@php $siteSetting = \App\Models\SiteSetting::current(); @endphp

<section class="policy-breadcrumb">
    <div class="container">
        <div class="policy-breadcrumb-card reveal">
            <span class="policy-badge"><i class="bi bi-shield-lock-fill"></i> Privacy Policy</span>
            <h1>Privacy Policy</h1>
            <p>We respect your privacy and handle submitted information with care and confidentiality.</p>
            <nav class="policy-crumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Privacy</span>
            </nav>
        </div>
    </div>
</section>

<section class="section policy-section">
    <div class="container policy-grid">
        <aside class="policy-sidebar reveal">
            <a href="#collect">Information</a>
            <a href="#use">Usage</a>
            <a href="#files">Documents</a>
            <a href="#security">Security</a>
            <a href="#contact">Contact</a>
        </aside>

        <article class="policy-card reveal">
            <section id="collect">
                <h2>Information We Collect</h2>
                <p>We may collect your name, phone number, email, city, legal matter details, career information, uploaded documents, ID proof, payment screenshots and other information submitted through website forms.</p>
            </section>

            <section id="use">
                <h2>How We Use Information</h2>
                <p>Your information is used to review enquiries, respond to consultation requests, process applications, verify article submissions and communicate with you about relevant services.</p>
            </section>

            <section id="files">
                <h2>Uploaded Documents</h2>
                <p>Documents and screenshots are used only for review, verification and communication related to your submission. Please avoid uploading unnecessary sensitive information unless required for your matter.</p>
            </section>

            <section id="security">
                <h2>Data Security</h2>
                <p>We take reasonable steps to protect submitted information. However, no online transmission or storage system can be guaranteed to be completely secure.</p>
            </section>

            <section id="contact">
                <h2>Contact</h2>
                <p>For privacy-related questions, contact us at <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>.</p>
            </section>
        </article>
    </div>
</section>

@endsection
