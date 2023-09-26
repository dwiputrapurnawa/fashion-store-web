<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
