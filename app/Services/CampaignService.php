<?php

namespace App\Services;

use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CampaignService
{

    public const CACHE_KEY = 'all-campaigns';

    /**
     * Get all campaigns
     *
     *
     * @return Collection
     */
    public function getAllCampaigns(): Collection
    {
        return Cache::tags(self::CACHE_KEY)
            ->remember(
                self::CACHE_KEY,
                Carbon::now()->addMinutes(30),
                static function () {
                    return Campaign::all();
                }
            );
    }

    /**
     * Create a campaign
     *
     * @param array $data
     * @return Model
     */
    public function createCampaign(array $data): Model
    {
        $this->clearCache();
        return Campaign::query()->create([
            'name' => $data['name'],
            'total_budget' => $data['total_budget'] * 100,
            'daily_budget' => $data['daily_budget'] * 100,
        ]);
    }

    public function clearCache(): void
    {
        Cache::tags(self::CACHE_KEY)->flush();
    }
}
