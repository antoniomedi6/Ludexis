<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class IgdbGameService
{
    public function getAllGames(int $page = 1, int $perPage = 16): LengthAwarePaginator
    {
        $page = max(1, $page);
        $perPage = max(1, min($perPage, 48));

        $query = IGDBGame::select([
            'id',
            'name',
            'first_release_date',
            'total_rating',
            'total_rating_count',
            'game_type',
            'slug',
        ])
            ->with([
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name'],
                'screenshots' => ['image_id'],
            ])
            ->where('total_rating_count', '>=', 25)
            ->whereIn('game_type', [0, 8, 9])
            ->whereNull('version_parent')
            ->whereHas('cover')
            ->orderBy('first_release_date', 'desc');

        $total = (clone $query)->count();

        $igdbGames = $query
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $items = $igdbGames
            ->map(fn(IGDBGame $igdbGame) => $this->mapGameForApi($igdbGame))
            ->filter()
            ->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function fetchPopularGames(int $limit, int $minRatingFilter): Collection
    {
        return IGDBGame::select([
            'id',
            'name',
            'first_release_date',
            'total_rating',
            'total_rating_count',
            'game_type',
            'slug',
            'hypes',
        ])
            ->with([
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name'],
                'screenshots' => ['image_id'],
            ])
            ->where('total_rating', '>=', $minRatingFilter)
            ->where('total_rating_count', '>=', 25)
            ->whereIn('game_type', [0, 8, 9])
            ->whereNull('version_parent')
            ->whereHas('cover')
            ->orderByDesc('hypes')
            ->limit($limit)
            ->get();
    }

    private function mapGameForApi(IGDBGame $igdbGame): ?array
    {
        $coverUrl = $this->resolveCoverUrl($igdbGame);

        if (!$coverUrl) {
            return null;
        }

        return [
            'id' => $igdbGame->id,
            'igdb_id' => $igdbGame->id,
            'title' => $igdbGame->name,
            'cover_url' => $coverUrl,
            'rating' => $igdbGame->total_rating ?? 0,
            'igdb_rating' => $igdbGame->total_rating ?? 0,
            'first_release_date' => $igdbGame->first_release_date,
            'slug' => $igdbGame->slug,
        ];
    }

    private function resolveCoverUrl(IGDBGame $igdbGame): ?string
    {
        $url = data_get($igdbGame, 'cover.url');

        if (!$url) {
            return null;
        }

        $coverUrl = str_replace('t_thumb', 't_cover_big', $url);

        if (str_starts_with($coverUrl, '//')) {
            $coverUrl = 'https:' . $coverUrl;
        }

        return $coverUrl;
    }
}
