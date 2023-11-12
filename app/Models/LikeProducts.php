<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];
}
