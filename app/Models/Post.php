<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'photo',
        'title',
        'slug',
        'content',
        'tag'
    ];
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
