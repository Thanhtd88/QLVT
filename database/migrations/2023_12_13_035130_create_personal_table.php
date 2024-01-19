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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('manv', 5)->nullable();
            $table->string('hoten', 255)->nullable();
            $table->string('sdt', 11)->nullable();
            $table->string('diachi', 255)->nullable();
            $table->string('cccd', 15)->nullable();
            $table->timestamp('ngaycap_cccd')->nullable();
            $table->string('noicap_cccd', 255)->nullable();
            $table->string('gplx', 15)->nullable();
            $table->string('hang_gplx', 5)->nullable();
            $table->timestamp('ngaycap_gplx')->nullable();
            $table->string('noicap_gplx')->nullable();
            $table->timestamp('hieuluc_gplx')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->unsignedBigInteger('phongban_id')->nullable();
            $table->unsignedBigInteger('donvi_id')->nullable();
            $table->unsignedBigInteger('duan_id')->nullable();
            $table->timestamp('ngayvao')->nullable();
            $table->timestamp('ngaynghi')->nullable();
            $table->string('trangthai')->nullable();
            $table->boolean('bhxh')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
