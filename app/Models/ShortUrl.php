<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_url', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

