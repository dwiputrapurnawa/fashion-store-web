<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, "order_items")->withPivot("quantity", "price_per_unit");
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function getTotalPriceItem() {
        $totalPrice = 0;
        $products = $this->products;


        foreach($products as $product) {
            $price = $product->pivot->quantity * $product->pivot->price_per_unit;
            $totalPrice += $price;
        }

        return $totalPrice;
    }
}
