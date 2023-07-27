<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    public $fillable = [
        'name', 'photo', 'email', 'phone', 'password', 'address', 'role', 'ban_time'
    ];
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function Order(): HasMany {
        return $this->hasMany(Order::class);
    }
    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }
    public function wishlist(): HasMany {
        return $this->hasMany(Wishlist::class);
    }
}
