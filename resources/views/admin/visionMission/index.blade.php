@extends('layouts.admin')

@section('page-title', 'Vision Mission Section')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Vision Mission Section
        </h2>

        <p class="admin-page-subtitle">
            Manage about page vision, mission and values content.
        </p>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.vision-mission.update') }}">
    @csrf

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-bullseye"></i>
            </div>

            <div>
                <p class="form-card-title">Section Header</p>
                <p class="form-card-subtitle">Main heading and short section description</p>
            </div>
        </div>

        <div class="form-card-body">

            <div class="admin-form-grid">

                <div class="field-group">
                    <label class="field-label">Kicker Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="kicker_icon"
                               value="{{ old('kicker_icon', $visionMission->kicker_icon) }}"
                               placeholder="bi bi-compass-fill"
                               class="field-input {{ $errors->has('kicker_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Kicker Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-tag icon"></i>
                        <input type="text"
                               name="kicker_text"
                               value="{{ old('kicker_text', $visionMission->kicker_text) }}"
                               placeholder="Vision & Mission"
                               class="field-input {{ $errors->has('kicker_text') ? 'error' : '' }}">
                    </div>
                </div>

            </div>

            <div class="field-group">
                <label class="field-label">Section Title</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-heading icon"></i>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $visionMission->title) }}"
                           placeholder="Enter section title"
                           class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                </div>
            </div>

            <div class="field-group">
                <label class="field-label">Section Description</label>
                <textarea name="description"
                          rows="4"
                          placeholder="Enter section description"
                          class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $visionMission->description) }}</textarea>
            </div>

        </div>
    </div>

    <div class="admin-form-grid" style="margin-top:22px;">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-eye"></i>
                </div>

                <div>
                    <p class="form-card-title">Vision Card</p>
                    <p class="form-card-subtitle">Manage vision card content</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Vision Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="vision_icon"
                               value="{{ old('vision_icon', $visionMission->vision_icon) }}"
                               placeholder="bi bi-eye-fill"
                               class="field-input {{ $errors->has('vision_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Vision Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text"
                               name="vision_title"
                               value="{{ old('vision_title', $visionMission->vision_title) }}"
                               placeholder="Our Vision"
                               class="field-input {{ $errors->has('vision_title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Vision Text</label>
                    <textarea name="vision_text"
                              rows="5"
                              placeholder="Enter vision text"
                              class="field-input {{ $errors->has('vision_text') ? 'error' : '' }}">{{ old('vision_text', $visionMission->vision_text) }}</textarea>
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-crosshairs"></i>
                </div>

                <div>
                    <p class="form-card-title">Mission Card</p>
                    <p class="form-card-subtitle">Manage mission card content</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Mission Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="mission_icon"
                               value="{{ old('mission_icon', $visionMission->mission_icon) }}"
                               placeholder="bi bi-bullseye"
                               class="field-input {{ $errors->has('mission_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Mission Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text"
                               name="mission_title"
                               value="{{ old('mission_title', $visionMission->mission_title) }}"
                               placeholder="Our Mission"
                               class="field-input {{ $errors->has('mission_title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Mission Text</label>
                    <textarea name="mission_text"
                              rows="5"
                              placeholder="Enter mission text"
                              class="field-input {{ $errors->has('mission_text') ? 'error' : '' }}">{{ old('mission_text', $visionMission->mission_text) }}</textarea>
                </div>

            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-gem"></i>
            </div>

            <div>
                <p class="form-card-title">Values Card</p>
                <p class="form-card-subtitle">Manage values card content</p>
            </div>
        </div>

        <div class="form-card-body">

            <div class="admin-form-grid">

                <div class="field-group">
                    <label class="field-label">Values Icon</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>
                        <input type="text"
                               name="values_icon"
                               value="{{ old('values_icon', $visionMission->values_icon) }}"
                               placeholder="bi bi-gem"
                               class="field-input {{ $errors->has('values_icon') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Values Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text"
                               name="values_title"
                               value="{{ old('values_title', $visionMission->values_title) }}"
                               placeholder="Our Values"
                               class="field-input {{ $errors->has('values_title') ? 'error' : '' }}">
                    </div>
                </div>

            </div>

            <div class="field-group">
                <label class="field-label">Values Text</label>
                <textarea name="values_text"
                          rows="5"
                          placeholder="Enter values text"
                          class="field-input {{ $errors->has('values_text') ? 'error' : '' }}">{{ old('values_text', $visionMission->values_text) }}</textarea>
            </div>

        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Vision Mission
        </button>
    </div>

</form>

@endsection