<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesReviews
{
    private const CACHE_KEY = 'google_places.reviews.v2';

    public function get(): ?array
    {
        $apiKey = config('services.google_places.api_key');
        $placeId = config('services.google_places.place_id');

        if (!$apiKey || !$placeId) {
            return null;
        }

        return Cache::remember(self::CACHE_KEY, now()->addHours(6), function () use ($apiKey, $placeId) {
            try {
                $response = Http::acceptJson()
                    ->withHeaders([
                        'X-Goog-Api-Key' => $apiKey,
                        'X-Goog-FieldMask' => 'id,displayName,rating,userRatingCount,googleMapsUri,reviews',
                    ])
                    ->timeout(8)
                    ->retry(2, 250)
                    ->get("https://places.googleapis.com/v1/places/{$placeId}");

                if ($response->failed()) {
                    Log::warning('Google Places reviews request failed.', [
                        'status' => $response->status(),
                        'response' => $response->json(),
                    ]);

                    return null;
                }

                $place = $response->json();
                $reviews = collect($place['reviews'] ?? [])
                    ->map(function (array $review) {
                        $author = $review['authorAttribution'] ?? [];

                        return [
                            'author_name' => $author['displayName'] ?? 'Google user',
                            'author_url' => $author['uri'] ?? null,
                            'photo_url' => $author['photoUri'] ?? null,
                            'rating' => (int) ($review['rating'] ?? 0),
                            'text' => data_get($review, 'text.text'),
                            'published_at' => $review['relativePublishTimeDescription'] ?? null,
                            'review_url' => $review['googleMapsUri'] ?? ($author['uri'] ?? null),
                        ];
                    })
                    ->values()
                    ->all();

                return [
                    'name' => data_get($place, 'displayName.text', 'Google Reviews'),
                    'rating' => (float) ($place['rating'] ?? 0),
                    'review_count' => (int) ($place['userRatingCount'] ?? 0),
                    'maps_url' => $place['googleMapsUri'] ?? null,
                    'reviews' => $reviews,
                ];
            } catch (\Throwable $exception) {
                Log::warning('Google Places reviews could not be loaded.', [
                    'message' => $exception->getMessage(),
                ]);

                return null;
            }
        });
    }
}
