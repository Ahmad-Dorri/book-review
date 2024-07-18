<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function scopePopular(Builder $query, ?string $start = null, ?string $end = null): Builder
    {
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');
        $startDate = (new \DateTime())->setTimestamp(0)->format('Y-m-d H:i:s');

        return $query
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->whereBetween('created_at', [$start ?? $startDate, $end ?? $currentDate]);
    }

    public function scopeHighestRated(Builder $query): Builder
    {
        return $query
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeLastMonth(Builder $query): Builder
    {
        return $query->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'));
    }

    public function scopeLastYear(Builder $query): Builder
    {
        return $query->whereYear('created_at', date('Y'));
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
