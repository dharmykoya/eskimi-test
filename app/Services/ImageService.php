<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadImage($campaign)
    {
        if (request()->file('banners')) {
            foreach (request()->file('banners') as $file) {
                $location = 'files';
                $filename = time() . '_' . $file->getClientOriginalName();

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
