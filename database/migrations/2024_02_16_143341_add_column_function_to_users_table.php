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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('vehicle_read')->nullable();
            $table->boolean('vehicle_action')->nullable();
            $table->boolean('transfer_read')->nullable();
            $table->boolean('transfer_action')->nullable();
            $table->boolean('maintenance_read')->nullable();
            $table->boolean('maintenance_action')->nullable();
            $table->boolean('personal_read')->nullable();
            $table->boolean('personal_action')->nullable();
            $table->boolean('department_read')->nullable();
            $table->boolean('department_action')->nullable();
            $table->boolean('project_read')->nullable();
            $table->boolean('project_action')->nullable();
            $table->boolean('unit_read')->nullable();
            $table->boolean('unit_action')->nullable();
            $table->boolean('warehouse_read')->nullable();
            $table->boolean('warehouse_action')->nullable();
            $table->boolean('stockin_read')->nullable();
            $table->boolean('stockin_action')->nullable();
            $table->boolean('supplier_read')->nullable();
            $table->boolean('supplier_action')->nullable();
            $table->boolean('diesel_read')->nullable();
            $table->boolean('diesel_action')->nullable();
            $table->boolean('protection_read')->nullable();
            $table->boolean('protection_action')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
