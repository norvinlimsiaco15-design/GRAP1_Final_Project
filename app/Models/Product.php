<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'is_new_arrival',
        'sizes',
        'stock',
        'discount_percent',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_new_arrival' => 'boolean',
            'stock' => 'integer',
            'discount_percent' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getFinalPriceAttribute(): float
    {
        $price = (float) $this->price;

        return round($price - ($price * ((float) $this->discount_percent / 100)), 2);
    }
}
