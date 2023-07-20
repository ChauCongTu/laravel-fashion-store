<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsed extends Model
{
    use HasFactory;
    protected $table = 'coupon_used';
    public $fillable = [
        'user_id', 'coupon_id'
    ];
}
