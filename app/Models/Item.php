<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = ['title', 'description', 'price_per_day', 'category', 'image_path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
