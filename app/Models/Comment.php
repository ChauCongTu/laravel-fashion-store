<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id', 'product_id', 'reply_id', 'content'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function parent(): BelongsTo {
        return $this->belongsTo(Comment::class, 'reply_id');
    }
    public function child(): HasMany {
        return $this->hasMany(Comment::class);
    }
}
