@extends('layouts.admin')

@section('page-title', 'Founder Message Section')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Founder Message Section
        </h2>

        <p class="admin-page-subtitle">
            Manage founder message, quote, profile card, image and meta information.
        </p>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.founder-message.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>

                <div>
                    <p class="form-card-title">Founder Content</p>
                    <p class="form-card-subtitle">Main message and founder introduction</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Kicker Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="kicker_icon"
                               value="{{ old('kicker_icon', $founderMessage->kicker_icon) }}"
                               placeholder="bi bi-person-badge-fill"
                               class="field-input {{ $errors->has('kicker_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Kicker Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-tag icon"></i>
                        <input type="text"
                               name="kicker_text"
                               value="{{ old('kicker_text', $founderMessage->kicker_text) }}"
                               placeholder="Founder Message"
                               class="field-input {{ $errors->has('kicker_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Section Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $founderMessage->title) }}"
                               placeholder="Enter section title"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Description</label>
                    <textarea name="description"
                              rows="5"
                              placeholder="Enter founder message"
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $founderMessage->description) }}</textarea>

                    @if($errors->has('description'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Quote Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-quote-left icon"></i>
                        <input type="text"
                               name="quote_icon"
                               value="{{ old('quote_icon', $founderMessage->quote_icon) }}"
                               placeholder="bi bi-quote"
                               class="field-input {{ $errors->has('quote_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Quote Text</label>
                    <textarea name="quote_text"
                              rows="4"
                              placeholder="Enter founder quote"
                              class="field-input {{ $errors->has('quote_text') ? 'error' : '' }}">{{ old('quote_text', $founderMessage->quote_text) }}</textarea>
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <div>
                    <p class="form-card-title">Founder Profile Card</p>
                    <p class="form-card-subtitle">Image, name, designation and button</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Founder Image</label>

                    <input type="file"
                           name="founder_image"
                           class="field-input {{ $errors->has('founder_image') ? 'error' : '' }}">

                    @if($founderMessage->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $founderMessage->image }}"
                                 alt="Founder Image"
                                 style="width:130px;height:130px;object-fit:cover;border-radius:22px;border:1px solid #e5e7eb;">
                        </div>
                    @endif

                    @if($errors->has('founder_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('founder_image') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Founder Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-user icon"></i>
                        <input type="text"
                               name="founder_name"
                               value="{{ old('founder_name', $founderMessage->founder_name) }}"
                               placeholder="Pramod Rajpati"
                               class="field-input {{ $errors->has('founder_name') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Founder Designation</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-briefcase icon"></i>
                        <input type="text"
                               name="founder_designation"
                               value="{{ old('founder_designation', $founderMessage->founder_designation) }}"
                               placeholder="Founder, Rajpati & Associates"
                               class="field-input {{ $errors->has('founder_designation') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Card Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-user-circle icon"></i>
                        <input type="text"
                               name="card_name"
                               value="{{ old('card_name', $founderMessage->card_name) }}"
                               placeholder="Pramod Rajpati"
                               class="field-input {{ $errors->has('card_name') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Card Designation</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-balance-scale icon"></i>
                        <input type="text"
                               name="card_designation"
                               value="{{ old('card_designation', $founderMessage->card_designation) }}"
                               placeholder="Founder & Legal Professional"
                               class="field-input {{ $errors->has('card_designation') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Button Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>
                        <input type="text"
                               name="button_text"
                               value="{{ old('button_text', $founderMessage->button_text) }}"
                               placeholder="View Team"
                               class="field-input {{ $errors->has('button_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Button URL</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>
                        <input type="text"
                               name="button_url"
                               value="{{ old('button_url', $founderMessage->button_url) }}"
                               placeholder="our-team.html"
                               class="field-input {{ $errors->has('button_url') ? 'error' : '' }}">
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-list"></i>
            </div>

            <div>
                <p class="form-card-title">Founder Meta Items</p>
                <p class="form-card-subtitle">Small profile details like location, practice and experience</p>
            </div>
        </div>

        <div class="form-card-body">
            @php
                $metaItems = old('meta_items', $founderMessage->meta_items ?? []);
            @endphp

            @for($i = 0; $i < 5; $i++)
                <div class="admin-form-grid" style="margin-bottom:14px;">
                    <div class="field-group">
                        <label class="field-label">Meta Icon {{ $i + 1 }}</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-icons icon"></i>
                            <input type="text"
                                   name="meta_icons[]"
                                   value="{{ $metaItems[$i]['icon'] ?? '' }}"
                                   placeholder="bi bi-geo-alt-fill"
                                   class="field-input">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Meta Text {{ $i + 1 }}</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-pen icon"></i>
                            <input type="text"
                                   name="meta_texts[]"
                                   value="{{ $metaItems[$i]['text'] ?? '' }}"
                                   placeholder="Patna, Bihar"
                                   class="field-input">
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Founder Message
        </button>
    </div>

</form>

@endsection