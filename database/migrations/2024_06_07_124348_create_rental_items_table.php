<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rental_items', function(Blueprint $table) {
            $table->id();
            $table->foreignId(('user_id'))->constrained();
            $table->string('name');
            $table->string('description');
            $table->decimal('price_per_hour', 8, 2)->nullable();
            $table->decimal('price_per_day', 8, 2)->nullable();
            $table->decimal('price_per_month', 8, 2)->nullable();
            $table->enum('status', ['available', 'reserved', 'maintenance'])->default('available');
            $table->longText('rental_item_notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_items');
    }
};
