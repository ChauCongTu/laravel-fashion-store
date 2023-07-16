<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;
    public $fillable = [
        'product_id', 'photo'
    ];
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
