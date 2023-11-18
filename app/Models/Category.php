<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'icon',
        'parent'
    ];

    public function child(): HasMany
    {
        return $this->hasMany(Category::class , 'parent' , 'id');
    }

    // Helper
    public function getIconAttribute($value): string
    {
        if ($value) {
            return env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }

}
