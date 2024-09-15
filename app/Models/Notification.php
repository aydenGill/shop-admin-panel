<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function markAsRead()
    {
        $this->is_read = 1;
        $this->save();
    }
    
}
