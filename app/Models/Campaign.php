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
        'daily_budget',
        'start_date',
        'end_date'
    ];

    protected $with = [
        'images',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Format the daily budget amount to USD.
     *
     * @param  float  $value
     * @return float
     */
    public function getDailyBudgetAttribute(float $value): float
    {
        return ($value) / 100;
    }

    /**
     * Format the total budget amount to USD.
     *
     * @param  float  $value
     * @return float
     */
    public function getTotalBudgetAttribute(float $value): float
    {
        return ($value) / 100;
    }
}
