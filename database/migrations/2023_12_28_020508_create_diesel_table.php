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
        Schema::create('diesel', function (Blueprint $table) {
            $table->id();
            $table->integer('odo')->nullable();
            $table->timestamp('ngaydo')->nullable();
            $table->string('noido', 255)->nullable();
            $table->integer('solit')->nullable();
            $table->float('dongia')->nullable();
            $table->double('thanhtien')->nullable();
            $table->integer('quangduong')->nullable();
            $table->float('dinhmuc')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('vihicle_id');
            $table->foreign('vihicle_id')->references('id')->on('vihicle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diesel');
    }
};
