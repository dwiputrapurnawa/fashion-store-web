<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function product_cart() {
        return $this->belongsToMany(Product::class, "carts")->withPivot("quantity", "id");
    }

    public function wishlist() {
        return $this->belongsToMany(Product::class, "wishlists")->withPivot("id");
    }

    public function product_rating() {
        return $this->belongsToMany(Product::class, "ratings")->withPivot("value");
    }

    public function review() {
        return $this->hasOne(Review::class);
    }

    public function rating() {
        return $this->hasOne(Rating::class);
    }

    public function getTotalPrice() {


        $discountPrice = collect([]);

        $discountProduct = $this->product_cart->filter(function($item) {
            return $item->discount;
        });

        $notDiscountProduct = $this->product_cart->filter(function($item){
            return !$item->discount;
        });


        foreach($discountProduct as $product) {
          $discountPrice->push($product->pivot->quantity * ($product->price - (($product->discount->percentage / 100) * $product->price)));
        }

        $notDiscountSumPrice =  $notDiscountProduct->sum(function($item) {
            return $item->pivot->quantity * $item->price;
        });

        $discountSumPrice = $discountPrice->sum();

        return $discountSumPrice + $notDiscountSumPrice;
    }
}
