<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'address_id',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
