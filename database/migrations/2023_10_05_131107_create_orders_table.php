<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number")->unique();
            $table->foreignId("user_id");
            $table->decimal("total_price");
            $table->enum("payment_status", ["pending", "paid"]);
            $table->enum("order_status", ["waiting", "processed", "sent"]);
            $table->foreignId("shipping_id");
            $table->string("tracking_number")->nullable();
            $table->decimal("shipping_cost");
            $table->foreignId("coupon_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
