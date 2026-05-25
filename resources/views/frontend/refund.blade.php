@extends('frontend.master')
@section('content')

@php $siteSetting = \App\Models\SiteSetting::current(); @endphp

<section class="policy-breadcrumb">
    <div class="container">
        <div class="policy-breadcrumb-card reveal">
            <span class="policy-badge"><i class="bi bi-arrow-counterclockwise"></i> Refund Policy</span>
            <h1>Refund Policy</h1>
            <p>This policy explains refund handling for paid submissions, consultation requests and related website payments.</p>
            <nav class="policy-crumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Refund</span>
            </nav>
        </div>
    </div>
</section>

<section class="section policy-section">
    <div class="container policy-grid">
        <aside class="policy-sidebar reveal">
            <a href="#article">Article Fee</a>
            <a href="#consultation">Consultation</a>
            <a href="#duplicate">Duplicate Payment</a>
            <a href="#request">Refund Request</a>
            <a href="#contact">Contact</a>
        </aside>

        <article class="policy-card reveal">
            <section id="article">
                <h2>Article Submission Fee</h2>
                <p>Article submission fees are charged for review and publication processing. Submission does not guarantee approval. Articles may be rejected if content is irrelevant, duplicate, misleading, unlawful or does not meet publication standards.</p>
            </section>

            <section id="consultation">
                <h2>Consultation Payments</h2>
                <p>Consultation payments, if any, may be reviewed case by case. Once consultation time is confirmed or legal review work has started, refunds may not be available.</p>
            </section>

            <section id="duplicate">
                <h2>Duplicate Or Failed Payments</h2>
                <p>If you believe a duplicate payment was made or an amount was deducted incorrectly, share the payment screenshot, transaction ID, name and phone number for verification.</p>
            </section>

            <section id="request">
                <h2>Refund Request Process</h2>
                <p>Refund requests must be sent with complete payment proof. Approved refunds, if applicable, will be processed to the original payment method or another verified method.</p>
            </section>

            <section id="contact">
                <h2>Contact</h2>
                <p>For refund-related support, contact us at <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>.</p>
            </section>
        </article>
    </div>
</section>

@endsection
