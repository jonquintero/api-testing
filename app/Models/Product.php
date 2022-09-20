<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku_id', 'category_id', 'name', 'price'];

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class);
    }

     public function category(): BelongsTo
     {
         return $this->belongsTo(Category::class);
     }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? null, function ($query, $name) {
            $query->where(function ($query) use ($name) {
                $query->where('name', 'like', '%'.$name.'%');
            });
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'like', '%'.$category.'%');
            });
        })->when($filters['price'] ?? null, function ($query, $price) {
            $query->where('price', (int)$price);
        });
    }
}
