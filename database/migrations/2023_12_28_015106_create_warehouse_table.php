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
        Schema::create('warehouse', function (Blueprint $table) {
            $table->id();
            $table->string('phutung', 255)->nullable();
            $table->string('donvitinh', 20)->nullable();
            $table->integer('tongnhap')->nullable();
            $table->integer('tongxuat')->nullable();
            $table->integer('tonkho')->nullable();
            $table->float('dongia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
