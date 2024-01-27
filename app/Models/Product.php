<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'price',
        'image',
        'inventory',
        'view_count',
        'category_id',
    ];

    // You can use this code for many-to-many relation
    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class , 'category_products')->withPivot('product_id', 'category_id');
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
