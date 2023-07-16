<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id', 'product_id'
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function exists($user_id, $product_id)
    {
        if (Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->count() > 0) {
            return true;
        }
        return false;
    }
}
