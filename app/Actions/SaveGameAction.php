<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Company;
use Carbon\Carbon;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class SaveGameAction
{
    public function __invoke(string $slug): ?Game
    {
        $localGame = Game::where('slug', $slug)->first();

        if ($localGame) {
            return $localGame;
        }

        $igdbGame = IGDBGame::select([
            'id',
            'name',
            'summary',
            'first_release_date',
            'slug',
            'total_rating'
        ])
            ->with([
                'videos' => ['video_id', 'name'],
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name', 'slug', 'description', 'country', 'start_date'],
                'screenshots' => ['image_id']
            ])
            ->where('slug', $slug)
            ->first();

        if (!$igdbGame) {
            return null;
        }

        $coverUrl = null;
        $url = data_get($igdbGame, 'cover.url');
        if ($url) {
            $coverUrl = str_replace('t_thumb', 't_cover_big', $url);
        }

        $releaseDate = data_get($igdbGame, 'first_release_date');
        $formattedDate = null;
        if ($releaseDate) {
            $formattedDate = is_numeric($releaseDate)
                ? Carbon::createFromTimestamp($releaseDate)->format('Y-m-d')
                : Carbon::parse($releaseDate)->format('Y-m-d');
        }

        $videoUrl = null;
        $videos = data_get($igdbGame, 'videos', []);
        if (!empty($videos)) {
            foreach ($videos as $video) {
                if (isset($video['video_id']) && isset($video['name']) && stripos($video['name'], 'trailer') !== false) {
                    $videoUrl = 'https://www.youtube.com/embed/' . $video['video_id'];
                    break;
                }
            }
        }

        $screenshotHashes = [];
        $screenshotsData = data_get($igdbGame, 'screenshots', []);
        if (!empty($screenshotsData)) {
            foreach ($screenshotsData as $screenshot) {
                if (isset($screenshot['image_id'])) {
                    $screenshotHashes[] = $screenshot['image_id'];
                }
            }
        }

        $game = Game::create([
            'igdb_id' => $igdbGame->id,
            'title' => $igdbGame->name,
            'synopsis' => data_get($igdbGame, 'summary', ''),
            'cover_url' => $coverUrl,
            'first_release_date' => $formattedDate,
            'slug' => $igdbGame->slug,
            'rating' => $igdbGame->total_rating ?? 0,
            'avg_time' => 0,
            'video_url' => $videoUrl,
            'screenshots' => !empty($screenshotHashes) ? $screenshotHashes : null
        ]);

        $genres = data_get($igdbGame, 'genres', []);
        if (!empty($genres)) {
            $genreIds = [];
            foreach ($genres as $genreData) {
                $genreName = data_get($genreData, 'name');
                if ($genreName) {
                    $genre = Genre::firstOrCreate(['name' => $genreName]);
                    $genreIds[] = $genre->id;
                }
            }
            $game->genres()->sync($genreIds);
        }

        $companies = data_get($igdbGame, 'involved_companies', []);
        if (!empty($companies)) {
            $companiesPivotData = [];
            foreach ($companies as $involvedCompany) {
                $companyData = data_get($involvedCompany, 'company');
                $companyName = data_get($companyData, 'name');
                $companySlug = data_get($companyData, 'slug');

                if ($companyName && $companySlug) {
                    $startDate = data_get($companyData, 'start_date');
                    $compFormattedDate = null;

                    if ($startDate) {
                        $compFormattedDate = is_numeric($startDate)
                            ? Carbon::createFromTimestamp($startDate)->format('Y-m-d')
                            : Carbon::parse($startDate)->format('Y-m-d');
                    }

                    $company = Company::updateOrCreate(
                        ['slug' => $companySlug],
                        [
                            'name' => $companyName,
                            'description' => data_get($companyData, 'description'),
                            'country' => data_get($companyData, 'country'),
                            'start_date' => $compFormattedDate,
                        ]
                    );

                    $companiesPivotData[$company->id] = [
                        'is_developer' => data_get($involvedCompany, 'developer', false),
                        'is_publisher' => data_get($involvedCompany, 'publisher', false),
                    ];
                }
            }
            $game->companies()->sync($companiesPivotData);
        }

        $platforms = data_get($igdbGame, 'platforms', []);
        if (!empty($platforms)) {
            $platformIds = [];
            foreach ($platforms as $platformData) {
                $platformName = data_get($platformData, 'name');
                if ($platformName) {
                    $platform = Platform::firstOrCreate(['name' => $platformName]);
                    $platformIds[] = $platform->id;
                }
            }
            $game->platforms()->sync($platformIds);
        }

        return $game;
    }
}