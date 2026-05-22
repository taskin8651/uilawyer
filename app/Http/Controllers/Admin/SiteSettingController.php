<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::current();

        return view('admin.siteSettings.index', compact('siteSetting'));
    }

    public function update(Request $request)
    {
        $siteSetting = SiteSetting::current();

        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'address_short' => 'nullable|string|max:255',
            'address_full' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'office_hours' => 'nullable|string|max:255',
            'map_title' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|url',
            'map_direction_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'copyright_text' => 'nullable|string|max:255',
            'site_logo' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'favicon' => 'nullable|file|mimes:ico,jpg,jpeg,png,webp,svg|max:2048',
            'seo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $siteSetting->update($data);

        foreach (['site_logo', 'favicon', 'seo_image'] as $collection) {
            if ($request->hasFile($collection)) {
                $siteSetting
                    ->addMediaFromRequest($collection)
                    ->toMediaCollection($collection);
            }
        }

        return back()->with('message', 'Website settings updated successfully.');
    }
}
