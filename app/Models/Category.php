<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'icon',
        'parent',
    ];

    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    // Helper
    public function getIconAttribute($value): string
    {
        if ($value) {
            return env('APP_URL').'/storage/'.$value;
        }

        return $value;
    }

    // You can use this code for many-to-many relation
    //    public function products()
    //    {
    //        return $this->belongsToMany(Product::class ,'category_products');
    //    }

}
