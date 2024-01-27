<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeProducts extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    protected $keyType = 'array';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public $timestamps = false;

    public function getKey()
    {
        return [
            $this->user_id,
            $this->product_id,
        ];
    }

    public function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }

    public function getAttribute($key)
    {
        return $this->getAttributeFromArray($key) ?? parent::getAttribute($key);
    }

    public function getKeyName()
    {
        return ['user_id', 'product_id'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
