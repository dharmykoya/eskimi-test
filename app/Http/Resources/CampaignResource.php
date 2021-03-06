<?php

namespace App\Http\Resources;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'total_budget' => $this->total_budget,
            'daily_budget' => $this->daily_budget,
            'images' => ImageResource::collection($this->images),
            'start_date' => Carbon::parse($this->start_date)->toFormattedDateString(),
            'end_date' => Carbon::parse($this->end_date)->toFormattedDateString(),
            'created_at' => Carbon::parse($this->created_at)->toFormattedDateString(),
            'updated_at' => Carbon::parse($this->updated_at)->toFormattedDateString(),
        ];
    }
}
