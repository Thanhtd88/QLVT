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
        Schema::create('vihicle', function (Blueprint $table) {
            $table->id();
            $table->string('soxe', 8)->nullable();
            $table->string('loaithung', 255)->nullable();
            $table->string('mauson', 255)->nullable();
            $table->string('nhanhieu', 255)->nullable();
            $table->string('soloai', 255)->nullable();
            $table->string('somay', 255)->nullable();
            $table->string('sokhung', 255)->nullable();
            $table->integer('namsx')->nullable();
            $table->integer('nienhan')->nullable();
            $table->string('congthucbanhxe', 255)->nullable();
            $table->string('kichthuoc_bao', 255)->nullable();
            $table->string('kichthuoc_longthung', 255)->nullable();
            $table->string('chieudaicoso', 255)->nullable();
            $table->integer('khoiluong_banthan')->nullable();
            $table->integer('khoiluong_hanghoa')->nullable();
            $table->integer('khoiluong_toanbo')->nullable();
            $table->integer('khoiluong_keotheo')->nullable();
            $table->integer('songuoi_cho')->nullable();
            $table->string('loainhienlieu', 255)->nullable();
            $table->timestamp('hieuluc_kiemdinh')->nullable();
            $table->timestamp('hieuluc_bhds')->nullable();
            $table->string('congty_bhds', 255)->nullable();
            $table->timestamp('hieuluc_bhvc')->nullable();
            $table->string('congty_bhvc', 255)->nullable();
            $table->timestamp('hieuluc_nganhang')->nullable();
            $table->unsignedBigInteger('donvi_id')->nullable();
            $table->float('dinhmuc_tb')->nullable();
            $table->timestamp('ngaymua')->nullable();
            $table->timestamp('ngayban')->nullable();
            $table->string('trangthai', 255)->nullable();
            $table->timestamps();

            $table->foreign('donvi_id')->references('id')->on('unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vihicle');
    }
};
