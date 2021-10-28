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
        $campaign = Campaign::query()->with('images')->create([
            'name' => $data['name'],
            'total_budget' => $data['total_budget'] * 100,
            'daily_budget' => $data['daily_budget'] * 100,
        ]);
        $imageUpload = new ImageService();
        $imageUpload->uploadImage($campaign);

        return $campaign->refresh();
    }

    /**
     * Update a campaign
     *
     * @param array $data
     * @param Campaign $campaign
     * @return Campaign
     */
    public function updateCampaign(array $data, Campaign $campaign): Campaign
    {
        $campaign->update([
            'name' => $data['name'],
            'total_budget' => $data['total_budget'] * 100,
            'daily_budget' => $data['daily_budget'] * 100,
        ]);
        return $campaign->refresh();
    }

    public function clearCache(): void
    {
        Cache::tags(self::CACHE_KEY)->flush();
    }
}
