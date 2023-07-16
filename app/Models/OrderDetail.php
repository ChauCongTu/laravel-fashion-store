<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetail extends Model
{
    use HasFactory;
    public $fillable = [
        'product_id', 'size', 'color', 'order_id', 'price', 'quantity', 'total_price'
    ];
    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
