<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    public $fillable = [
        'code',
        'user_id',
        'sub_total',
        'coupon',
        'quantity',
        'payment_method',
        'payment_status',
        'status',
        'name',
        'email',
        'phone',
        'post_code',
        'address1',
        'address2'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detail(): HasMany {
        return $this->hasMany(OrderDetail::class);
    }
}
