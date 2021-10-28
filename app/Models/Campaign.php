<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'total_budget',
        'daily_budget'
    ];

    protected $with = [
        'images',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
