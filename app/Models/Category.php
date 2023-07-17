<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
        'name', 'slug', 'type', 'summary', 'photo', 'parent_id', 'user_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public static function hasParent($category_id)
    {
        $a = Category::find($category_id);
        if ($a->parent != null) {
            return true;
        }
        return false;
    }
}
