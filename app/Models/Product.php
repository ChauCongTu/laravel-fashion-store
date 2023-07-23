<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public $fillable = [
        'code',
        'name',
        'slug',
        'summary',
        'description',
        'photo',
        'size',
        'color',
        'stock',
        'price',
        'discount',
        'is_featured',
        'status',
        'cat_id',
        'brand_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
    public function order_detail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public static function findByName($name, $limit = null)
    {
        if ($limit == null)
            return Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))->where('name', 'LIKE', '%' . $name . '%')->get();
        else
            return Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))->where('name', 'LIKE', '%' . $name . '%')->limit($limit)->get();
    }
    public function bestSeller($limit)
    {
        $products = OrderDetail::select('product_id', DB::raw('COUNT(*) as quantity'))
            ->groupBy('product_id')
            ->orderBy('quantity', 'desc')
            ->limit($limit)
            ->get();
        return $products;
    }
}
