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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreignId('product_id');

            $table->integer('count')->default(1);

            $table->enum('status', ['created', 'pending_payment', 'paid', 'cancelled'])->default('created');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
