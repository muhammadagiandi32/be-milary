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
        Schema::create('outgoing_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255)->unique();
            $table->string('ItemsId');
            $table->string('StockId');
            $table->integer('total');
            $table->decimal('Price', $total = 10, $places = 2);
            $table->timestamps();

            $table->foreign('ItemsId')->references('uuid')->on('items');
            $table->foreign('StockId')->references('uuid')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_stocks');
    }
};
