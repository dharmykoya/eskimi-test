<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class ImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  Image  $image
     * @return JsonResponse
     */
    public function destroy(Image $image): JsonResponse
    {
        if ($image->delete()) {
            Cache::tags('all-campaigns')->flush();
        }
        return $this->success([], Lang::get('operation.delete'));
    }
}
