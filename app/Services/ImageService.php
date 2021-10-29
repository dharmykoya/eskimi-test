<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ImageService
{
    /**
     * Upload Image
     *
     * @param Model $campaign
     * @return Model
     */
    public static function uploadImage(Model $campaign): Model
    {
        if (request()->file('banners')) {
            $count = 1;
            foreach (request()->file('banners') as $file) {
                $location = 'files';
                $filename = now()->timestamp . '_' . $count++ . '.' . $file->getClientOriginalExtension();
                $file->move($location, $filename);

                $image = new Image();
                $image->campaign_id = $campaign->id;
                $image->name = $filename;
                $image->url = $location . '/' . $filename;
                $image->save();
            }
        }
        return $campaign;
    }
}
