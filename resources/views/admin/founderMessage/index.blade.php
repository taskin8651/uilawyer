@extends('layouts.admin')

@section('page-title', 'Founder Message Section')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Founder Message Section</h2>
        <p class="admin-page-subtitle">
            Manage founder message, quote, profile card, image, button and meta details.
        </p>
    </div>
</div>

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
                    <p class="form-card-subtitle">Main heading, message and quote</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="kicker_icon">Kicker Icon</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-icons icon"></i>
                            <input type="text" name="kicker_icon" id="kicker_icon"
                                   value="{{ old('kicker_icon', $founderMessage->kicker_icon) }}"
                                   placeholder="bi bi-person-badge-fill"
                                   class="field-input {{ $errors->has('kicker_icon') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="kicker_text">Kicker Text</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-tag icon"></i>
                            <input type="text" name="kicker_text" id="kicker_text"
                                   value="{{ old('kicker_text', $founderMessage->kicker_text) }}"
                                   placeholder="Founder Message"
                                   class="field-input {{ $errors->has('kicker_text') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="title">Section Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $founderMessage->title) }}"
                               placeholder="Enter section title"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" rows="6"
                              placeholder="Enter founder message"
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $founderMessage->description) }}</textarea>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="quote_icon">Quote Icon</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-quote-left icon"></i>
                            <input type="text" name="quote_icon" id="quote_icon"
                                   value="{{ old('quote_icon', $founderMessage->quote_icon) }}"
                                   placeholder="bi bi-quote"
                                   class="field-input {{ $errors->has('quote_icon') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="button_text">Button Text</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-arrow-pointer icon"></i>
                            <input type="text" name="button_text" id="button_text"
                                   value="{{ old('button_text', $founderMessage->button_text) }}"
                                   placeholder="Meet Our Team"
                                   class="field-input {{ $errors->has('button_text') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="quote_text">Quote Text</label>
                    <textarea name="quote_text" id="quote_text" rows="4"
                              placeholder="Enter founder quote"
                              class="field-input {{ $errors->has('quote_text') ? 'error' : '' }}">{{ old('quote_text', $founderMessage->quote_text) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="button_url">Button URL</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>
                        <input type="text" name="button_url" id="button_url"
                               value="{{ old('button_url', $founderMessage->button_url) }}"
                               placeholder="/our-team"
                               class="field-input {{ $errors->has('button_url') ? 'error' : '' }}">
                    </div>
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
                    <p class="form-card-subtitle">Image, name and designation shown on frontend</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="founder_image">Founder Image</label>
                    <input type="file" name="founder_image" id="founder_image"
                           class="field-input {{ $errors->has('founder_image') ? 'error' : '' }}">

                    @if($founderMessage->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $founderMessage->image }}" alt="Founder Image"
                                 style="width:140px;height:140px;object-fit:cover;border-radius:16px;border:1px solid #e5e7eb;background:#fff;">
                        </div>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="founder_name">Founder Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-user icon"></i>
                        <input type="text" name="founder_name" id="founder_name"
                               value="{{ old('founder_name', $founderMessage->founder_name) }}"
                               placeholder="Pramod Rajpati"
                               class="field-input {{ $errors->has('founder_name') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="founder_designation">Founder Designation</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-briefcase icon"></i>
                        <input type="text" name="founder_designation" id="founder_designation"
                               value="{{ old('founder_designation', $founderMessage->founder_designation) }}"
                               placeholder="Founder, Rajpati & Associates"
                               class="field-input {{ $errors->has('founder_designation') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="card_name">Card Name</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-user-circle icon"></i>
                            <input type="text" name="card_name" id="card_name"
                                   value="{{ old('card_name', $founderMessage->card_name) }}"
                                   placeholder="Pramod Rajpati"
                                   class="field-input {{ $errors->has('card_name') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="card_designation">Card Designation</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-scale-balanced icon"></i>
                            <input type="text" name="card_designation" id="card_designation"
                                   value="{{ old('card_designation', $founderMessage->card_designation) }}"
                                   placeholder="Founder & Legal Professional"
                                   class="field-input {{ $errors->has('card_designation') ? 'error' : '' }}">
                        </div>
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
                        <label class="field-label" for="meta_icon_{{ $i }}">Meta Icon {{ $i + 1 }}</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-icons icon"></i>
                            <input type="text" name="meta_icons[]" id="meta_icon_{{ $i }}"
                                   value="{{ old('meta_icons.' . $i, $metaItems[$i]['icon'] ?? '') }}"
                                   placeholder="bi bi-geo-alt-fill"
                                   class="field-input">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="meta_text_{{ $i }}">Meta Text {{ $i + 1 }}</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-pen icon"></i>
                            <input type="text" name="meta_texts[]" id="meta_text_{{ $i }}"
                                   value="{{ old('meta_texts.' . $i, $metaItems[$i]['text'] ?? '') }}"
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
            <i class="fas fa-save"></i>
            Update Founder Message
        </button>
    </div>
</form>

@endsection
