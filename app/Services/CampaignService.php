<?php


namespace App\Services;


use App\Models\Campaign;

class CampaignService
{
    public function createCampaign($data)
    {
        return Campaign::query()->create([
            'name' => $data['name'],
            'total_budget' => $data['total_budget'],
            'daily_budget' => $data['daily_budget'],
        ]);
    }
}
