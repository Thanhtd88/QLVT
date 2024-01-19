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
        Schema::table('transfer_histories', function (Blueprint $table) {
            $table->foreign('nhansu_id')->references('id')->on('personal');
            $table->foreign('phuongtien_id')->references('id')->on('vihicle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_histories', function (Blueprint $table) {
            //
        });
    }
};
