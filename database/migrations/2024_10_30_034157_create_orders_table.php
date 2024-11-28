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
            $table->string('order_id', 32)->primary();
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('user_id', 32)->nullable()->index();
            $table->string('note', 128)->nullable();
            $table->decimal('order_discount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->smallInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
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
