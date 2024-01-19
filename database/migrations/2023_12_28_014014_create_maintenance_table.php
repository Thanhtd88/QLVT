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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->integer('odo')->nullable();
            $table->timestamp('ngay_thuchien')->nullable();
            $table->integer('soluong')->nullable();
            $table->float('dongia')->nullable();
            $table->double('thanhtien')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('vihicle_id')->nullable();
            $table->foreign('vihicle_id')->references('id')->on('vihicle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
