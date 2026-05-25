@extends('frontend.master')
@section('content')

@php
    $siteSetting = \App\Models\SiteSetting::first();
@endphp

<div class="article-payment-modal" id="articlePaymentModal" aria-hidden="false">
    <div class="article-payment-dialog">
        <button type="button" class="article-payment-close" id="articlePaymentClose" aria-label="Close payment notice">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="wpo-section-title">
            <h2>
                Publish Your Article on Rajpati and Associates
                <br>
                <p>
                    Get your article featured on Rajpati and Associates' website. Showcase your expertise to our audience for a nominal fee of Rs. 400. Submit your article today!
                </p>
            </h2>
        </div>

        <div class="article-payment-points">
            <span><i class="bi bi-currency-rupee"></i> Pay Rs. 400 before submitting</span>
            <span><i class="bi bi-image-fill"></i> Upload payment screenshot with the form</span>
            <span><i class="bi bi-shield-check"></i> Article publishes only after admin approval</span>
        </div>

        <a href="upi://pay?pa=mdsayebalam10@okhdfcbank&pn=Rajpati%20and%20Associates&am=400&cu=INR"
           class="article-payment-upi"
           target="_blank">
            <span class="payment-icon">
                <i class="bi bi-qr-code-scan"></i>
            </span>
            <span>
                <strong>Click To Payment</strong>
                <small>UPI: mdsayebalam10@okhdfcbank</small>
            </span>
            <i class="bi bi-arrow-up-right-circle-fill"></i>
        </a>

        <a href="#submitArticleForm" class="btn btn-primary magnetic" id="articlePaymentContinue">
            Continue To Form
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

<section class="articles-breadcrumb">
    <div class="articles-breadcrumb-grid-bg"></div>
    <div class="articles-breadcrumb-shine"></div>

    <div class="container">
        <div class="articles-breadcrumb-card reveal">
            <span class="articles-breadcrumb-badge">
                <i class="bi bi-pencil-square"></i>
                Submit Article
            </span>

            <h1>
                Publish Your
                <span>Legal Article</span>
            </h1>

            <p>
                Submit your article, featured image, optional document and payment screenshot.
                The article will appear on the website after admin approval.
            </p>

            <nav class="articles-crumb" aria-label="breadcrumb">
                <a href="{{ route('frontend.index') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('frontend.articles.index') }}">Articles</a>
                <i class="bi bi-chevron-right"></i>
                <span>Submit Article</span>
            </nav>
        </div>
    </div>
</section>

<section class="section application-section" id="submitArticleForm">
    <div class="container application-grid">
        <div class="application-info-card reveal">
            <span class="kicker">
                <i class="bi bi-journal-check"></i>
                Article Submission
            </span>

            <h2 class="section-title">
                Share Your Legal Expertise With Our Audience.
            </h2>

            <p class="section-text">
                Fill the article details carefully and upload the payment screenshot. Admin will review
                the payment and article content before publishing.
            </p>

            <div class="application-points">
                <span><i class="bi bi-check-circle-fill"></i> Article fee Rs. 400</span>
                <span><i class="bi bi-check-circle-fill"></i> CKEditor enabled content box</span>
                <span><i class="bi bi-check-circle-fill"></i> Image and document upload supported</span>
                <span><i class="bi bi-check-circle-fill"></i> Admin approval required before listing</span>
            </div>
        </div>

        <div class="career-form-card reveal">
            <h3>Submit Article</h3>

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    Please check the required fields and try again.
                </div>
            @endif

            <form class="career-form" method="POST" action="{{ route('frontend.articles.submit.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="article_title">Article Title *</label>
                        <input type="text" id="article_title" name="title" value="{{ old('title') }}" required placeholder="Enter article title">
                    </div>

                    <div class="form-group">
                        <label for="article_category">Category</label>
                        <select id="article_category" name="article_category_id">
                            <option value="">Select category</option>
                            @foreach($articleCategories as $id => $category)
                                <option value="{{ $id }}" {{ old('article_category_id') == $id ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="author_name">Author Name *</label>
                        <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}" required placeholder="Enter author name">
                    </div>

                    <div class="form-group">
                        <label for="submitter_phone">Phone *</label>
                        <input type="text" id="submitter_phone" name="submitter_phone" value="{{ old('submitter_phone') }}" required placeholder="+91 XXXXX XXXXX">
                    </div>
                </div>

                <div class="form-group">
                    <label for="submitter_email">Email *</label>
                    <input type="email" id="submitter_email" name="submitter_email" value="{{ old('submitter_email') }}" required placeholder="Enter email address">
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description *</label>
                    <textarea id="short_description" name="short_description" rows="4" required placeholder="Write short article summary...">{{ old('short_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">Article Content *</label>
                    <textarea id="description" name="description" rows="8" class="js-ckeditor" placeholder="Write full article content...">{{ old('description') }}</textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="article_image">Article Image</label>
                        <label for="article_image" class="file-upload">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <div>
                                <strong>Upload Image</strong>
                                <span>JPG, PNG, WEBP supported</span>
                            </div>
                        </label>
                        <input type="file" id="article_image" name="article_image" accept=".jpg,.jpeg,.png,.webp" hidden>
                    </div>

                    <div class="form-group">
                        <label for="article_document">Article Document</label>
                        <label for="article_document" class="file-upload">
                            <i class="bi bi-file-earmark-arrow-up-fill"></i>
                            <div>
                                <strong>Upload Document</strong>
                                <span>PDF, DOC, DOCX supported</span>
                            </div>
                        </label>
                        <input type="file" id="article_document" name="article_document" accept=".pdf,.doc,.docx" hidden>
                    </div>
                </div>

                <div class="form-group">
                    <label for="payment_screenshot">Payment Screenshot *</label>
                    <label for="payment_screenshot" class="file-upload">
                        <i class="bi bi-receipt-cutoff"></i>
                        <div>
                            <strong>Upload Payment Screenshot</strong>
                            <span>Required after Rs. 400 payment</span>
                        </div>
                    </label>
                    <input type="file" id="payment_screenshot" name="payment_screenshot" accept=".jpg,.jpeg,.png,.webp" required hidden>
                </div>

                <button type="submit" class="submit-btn">
                    Submit Article
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('articlePaymentModal');
    const close = document.getElementById('articlePaymentClose');
    const proceed = document.getElementById('articlePaymentContinue');

    function hideModal() {
        modal.classList.add('is-hidden');
        modal.setAttribute('aria-hidden', 'true');
    }

    close.addEventListener('click', hideModal);
    proceed.addEventListener('click', hideModal);

    if (window.ClassicEditor) {
        document.querySelectorAll('.js-ckeditor').forEach(function (textarea) {
            ClassicEditor.create(textarea).catch(function () {});
        });
    }
});
</script>
@endsection
