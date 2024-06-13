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
        Schema::create('reserves', function(Blueprint $table) {
            $table->id();
            $table->foreignId(('user_id'))->constrained();
            $table->string('title');
            $table->string('description')->nullable();
            $table->decimal('start')->nullable();
            $table->decimal('end')->nullable();
            $table->foreignId(('rental_item_id'))->constrained();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
