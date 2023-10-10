<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user_cart() {
        return $this->belongsToMany(User::class, "carts")->withPivot("quantity", "id");
    }

    public function user_wishlist() {
        return $this->belongsToMany(User::class, "wishlists")->withPivot("id");
    }

    public function user_rating() {
        return $this->belongsToMany(User::class, "ratings")->withPivot("value");
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function discount() {
        return $this->hasOne(Discount::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, "order_items")->withPivot("quantity", "price_per_unit");
    }

    public function images() {
        return $this->hasMany(Images::class);
    }

    public function getAvgRating() {
        return $this->user_rating()->avg("value");
    }

    public function scopeFilter($query, $filter) {
        return $query->where("name", "like", "%" . $filter . "%");
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
