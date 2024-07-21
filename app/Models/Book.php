<?php

declare(strict_types=1);

namespace App\Models ;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function scopeSearchByTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopePopular(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withCount(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)])
            ->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withAvg(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)], 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $amount): Builder
    {
        return $query->having('reviews_count', '>=', $amount);
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

    private function dateRangeFilter(Builder $query, ?string $from = null, ?string $to = null): void
    {
        if ($from && ! $to) {
            $query->where('created_at', '>=', $from);
        } elseif (! $from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->wherebetween('created_at', [$from, $to]);
        }
    }
}
