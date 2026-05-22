@extends('layouts.admin')

@section('page-title', 'Website Settings')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Website Settings</h2>
        <p class="admin-page-subtitle">
            Manage site identity, contact details, social media, SEO and map.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div>
                    <p class="form-card-title">Site Info</p>
                    <p class="form-card-subtitle">Name, logo and favicon</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label">Site Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-signature icon"></i>
                        <input type="text" name="site_name"
                               value="{{ old('site_name', $siteSetting->site_name) }}"
                               class="field-input {{ $errors->has('site_name') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Tagline</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-award icon"></i>
                        <input type="text" name="tagline"
                               value="{{ old('tagline', $siteSetting->tagline) }}"
                               class="field-input {{ $errors->has('tagline') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Logo</label>
                    <input type="file" name="site_logo"
                           class="field-input {{ $errors->has('site_logo') ? 'error' : '' }}">
                    @if($siteSetting->logo)
                        <div style="margin-top:14px;">
                            <img src="{{ $siteSetting->logo }}" alt="Logo"
                                 style="width:180px;height:72px;object-fit:contain;border:1px solid #e5e7eb;border-radius:14px;padding:10px;background:#fff;">
                        </div>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">Favicon</label>
                    <input type="file" name="favicon"
                           class="field-input {{ $errors->has('favicon') ? 'error' : '' }}">
                    @if($siteSetting->favicon)
                        <div style="margin-top:14px;">
                            <img src="{{ $siteSetting->favicon }}" alt="Favicon"
                                 style="width:48px;height:48px;object-fit:contain;border:1px solid #e5e7eb;border-radius:12px;padding:6px;background:#fff;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <div>
                    <p class="form-card-title">Contact</p>
                    <p class="form-card-subtitle">Phone, WhatsApp, email and address</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label">Phone</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" name="phone"
                               value="{{ old('phone', $siteSetting->phone) }}"
                               class="field-input {{ $errors->has('phone') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">WhatsApp</label>
                    <div class="input-icon-wrap">
                        <i class="fab fa-whatsapp icon"></i>
                        <input type="text" name="whatsapp"
                               value="{{ old('whatsapp', $siteSetting->whatsapp) }}"
                               class="field-input {{ $errors->has('whatsapp') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Email</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email"
                               value="{{ old('email', $siteSetting->email) }}"
                               class="field-input {{ $errors->has('email') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Short Address</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-location-dot icon"></i>
                        <input type="text" name="address_short"
                               value="{{ old('address_short', $siteSetting->address_short) }}"
                               class="field-input {{ $errors->has('address_short') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Full Address</label>
                    <textarea name="address_full" rows="4"
                              class="field-input {{ $errors->has('address_full') ? 'error' : '' }}">{{ old('address_full', $siteSetting->address_full) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label">Office Hours</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-clock icon"></i>
                        <input type="text" name="office_hours"
                               value="{{ old('office_hours', $siteSetting->office_hours) }}"
                               class="field-input {{ $errors->has('office_hours') ? 'error' : '' }}">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="admin-form-grid" style="margin-top:22px;">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-share-nodes"></i>
                </div>
                <div>
                    <p class="form-card-title">Social Media</p>
                    <p class="form-card-subtitle">Footer social links</p>
                </div>
            </div>

            <div class="form-card-body">
                @foreach([
                    'facebook_url' => ['Facebook URL', 'fab fa-facebook'],
                    'twitter_url' => ['Twitter / X URL', 'fab fa-x-twitter'],
                    'instagram_url' => ['Instagram URL', 'fab fa-instagram'],
                    'youtube_url' => ['YouTube URL', 'fab fa-youtube'],
                    'linkedin_url' => ['LinkedIn URL', 'fab fa-linkedin'],
                ] as $field => $meta)
                    <div class="field-group">
                        <label class="field-label">{{ $meta[0] }}</label>
                        <div class="input-icon-wrap">
                            <i class="{{ $meta[1] }} icon"></i>
                            <input type="url" name="{{ $field }}"
                                   value="{{ old($field, $siteSetting->{$field}) }}"
                                   class="field-input {{ $errors->has($field) ? 'error' : '' }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-magnifying-glass-chart"></i>
                </div>
                <div>
                    <p class="form-card-title">SEO</p>
                    <p class="form-card-subtitle">Meta title, description and image</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label">Meta Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text" name="seo_title"
                               value="{{ old('seo_title', $siteSetting->seo_title) }}"
                               class="field-input {{ $errors->has('seo_title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Meta Description</label>
                    <textarea name="seo_description" rows="4"
                              class="field-input {{ $errors->has('seo_description') ? 'error' : '' }}">{{ old('seo_description', $siteSetting->seo_description) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label">Keywords</label>
                    <textarea name="seo_keywords" rows="3"
                              class="field-input {{ $errors->has('seo_keywords') ? 'error' : '' }}">{{ old('seo_keywords', $siteSetting->seo_keywords) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label">SEO Image</label>
                    <input type="file" name="seo_image"
                           class="field-input {{ $errors->has('seo_image') ? 'error' : '' }}">
                    @if($siteSetting->seo_image)
                        <div style="margin-top:14px;">
                            <img src="{{ $siteSetting->seo_image }}" alt="SEO Image"
                                 style="width:180px;height:100px;object-fit:cover;border:1px solid #e5e7eb;border-radius:14px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-map-location-dot"></i>
            </div>
            <div>
                <p class="form-card-title">Map</p>
                <p class="form-card-subtitle">Google map and direction link</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="admin-form-grid">
                <div class="field-group">
                    <label class="field-label">Map Title</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-map-pin icon"></i>
                        <input type="text" name="map_title"
                               value="{{ old('map_title', $siteSetting->map_title) }}"
                               class="field-input {{ $errors->has('map_title') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Direction URL</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-diamond-turn-right icon"></i>
                        <input type="url" name="map_direction_url"
                               value="{{ old('map_direction_url', $siteSetting->map_direction_url) }}"
                               class="field-input {{ $errors->has('map_direction_url') ? 'error' : '' }}">
                    </div>
                </div>
            </div>

            <div class="field-group">
                <label class="field-label">Map Embed URL</label>
                <textarea name="map_embed_url" rows="3"
                          class="field-input {{ $errors->has('map_embed_url') ? 'error' : '' }}">{{ old('map_embed_url', $siteSetting->map_embed_url) }}</textarea>
            </div>

            <div class="field-group">
                <label class="field-label">Copyright Text</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-copyright icon"></i>
                    <input type="text" name="copyright_text"
                           value="{{ old('copyright_text', $siteSetting->copyright_text) }}"
                           class="field-input {{ $errors->has('copyright_text') ? 'error' : '' }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i>
            Save Settings
        </button>
    </div>
</form>

@endsection
