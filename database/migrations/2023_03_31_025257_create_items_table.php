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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('IdItems');
            $table->string('uuid', 255)->unique();
            $table->string('ItemName', 255);
            $table->string('Color', 255)->nullable();
            $table->string('Style', 255)->nullable();
            $table->string('Size', 255);
            $table->decimal('Price', $total = 10, $places = 2);
            // $table->decimal('Stock', $total = 10, $places = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
