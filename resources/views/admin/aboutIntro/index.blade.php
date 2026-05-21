@extends('layouts.admin')

@section('page-title', 'About Intro Section')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            About Intro Section
        </h2>

        <p class="admin-page-subtitle">
            Manage about page firm introduction content, image, experience badge and bullet points.
        </p>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.about-intro.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-info-circle"></i>
                </div>

                <div>
                    <p class="form-card-title">Intro Content</p>
                    <p class="form-card-subtitle">Main heading and description</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Kicker Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="kicker_icon"
                               value="{{ old('kicker_icon', $aboutIntro->kicker_icon) }}"
                               placeholder="bi bi-building-check"
                               class="field-input {{ $errors->has('kicker_icon') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('kicker_icon'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('kicker_icon') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Kicker Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-tag icon"></i>
                        <input type="text"
                               name="kicker_text"
                               value="{{ old('kicker_text', $aboutIntro->kicker_text) }}"
                               placeholder="Firm Introduction"
                               class="field-input {{ $errors->has('kicker_text') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('kicker_text'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('kicker_text') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Section Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $aboutIntro->title) }}"
                               placeholder="Enter section title"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('title'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Description One</label>
                    <textarea name="description_one"
                              rows="5"
                              placeholder="Enter first paragraph"
                              class="field-input {{ $errors->has('description_one') ? 'error' : '' }}">{{ old('description_one', $aboutIntro->description_one) }}</textarea>

                    @if($errors->has('description_one'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('description_one') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Description Two</label>
                    <textarea name="description_two"
                              rows="5"
                              placeholder="Enter second paragraph"
                              class="field-input {{ $errors->has('description_two') ? 'error' : '' }}">{{ old('description_two', $aboutIntro->description_two) }}</textarea>

                    @if($errors->has('description_two'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('description_two') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-image"></i>
                </div>

                <div>
                    <p class="form-card-title">Image & Floating Cards</p>
                    <p class="form-card-subtitle">Main image, experience and trust note</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">About Image</label>

                    <input type="file"
                           name="about_intro_image"
                           class="field-input {{ $errors->has('about_intro_image') ? 'error' : '' }}">

                    @if($aboutIntro->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $aboutIntro->image }}"
                                 alt="About Intro Image"
                                 style="width:180px;height:115px;object-fit:cover;border-radius:18px;border:1px solid #e5e7eb;">
                        </div>
                    @endif

                    @if($errors->has('about_intro_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('about_intro_image') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Experience Number</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-award icon"></i>
                        <input type="text"
                               name="experience_number"
                               value="{{ old('experience_number', $aboutIntro->experience_number) }}"
                               placeholder="25+"
                               class="field-input {{ $errors->has('experience_number') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Experience Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-briefcase icon"></i>
                        <input type="text"
                               name="experience_text"
                               value="{{ old('experience_text', $aboutIntro->experience_text) }}"
                               placeholder="Years of Legal Experience"
                               class="field-input {{ $errors->has('experience_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Note Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-shield-alt icon"></i>
                        <input type="text"
                               name="note_icon"
                               value="{{ old('note_icon', $aboutIntro->note_icon) }}"
                               placeholder="bi bi-shield-check"
                               class="field-input {{ $errors->has('note_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Note Small Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-certificate icon"></i>
                        <input type="text"
                               name="note_small_text"
                               value="{{ old('note_small_text', $aboutIntro->note_small_text) }}"
                               placeholder="Trusted Since 1999"
                               class="field-input {{ $errors->has('note_small_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Note Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-balance-scale icon"></i>
                        <input type="text"
                               name="note_title"
                               value="{{ old('note_title', $aboutIntro->note_title) }}"
                               placeholder="All India Legal Services"
                               class="field-input {{ $errors->has('note_title') ? 'error' : '' }}">
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-list-check"></i>
            </div>

            <div>
                <p class="form-card-title">Intro Points</p>
                <p class="form-card-subtitle">Add important points for the intro list</p>
            </div>
        </div>

        <div class="form-card-body">
            @php
                $points = old('points', $aboutIntro->points ?? []);
            @endphp

            <div class="admin-form-grid">
                @for($i = 0; $i < 6; $i++)
                    <div class="field-group">
                        <label class="field-label">Point {{ $i + 1 }}</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-check-circle icon"></i>
                            <input type="text"
                                   name="points[]"
                                   value="{{ $points[$i] ?? '' }}"
                                   placeholder="Enter point {{ $i + 1 }}"
                                   class="field-input">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update About Intro
        </button>
    </div>

</form>

@endsection