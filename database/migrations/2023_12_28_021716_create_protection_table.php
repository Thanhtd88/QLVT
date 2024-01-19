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
        Schema::create('protection', function (Blueprint $table) {
            $table->id();
            $table->timestamp('ngay_ban_giao')->nullable();
            $table->integer('soluong')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')->references('id')->on('personal');
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouse');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protection');
    }
};
