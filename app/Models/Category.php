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
        'parent'
    ];

    public function child(): HasMany
    {
        return $this->hasMany(Category::class , 'parent' , 'id');
    }
}
