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
        Schema::create('custom_fee_configs', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->enum("config_type", ["fixed", "percentage"]);
            $table->double("airtime_fee", 12, 2);
            $table->double("data_fee", 12, 2);
            $table->double("electricity_fee", 12, 2);
            $table->double("tv_fee", 12, 2);
            $table->double("withdrawal_fee", 12, 2);
            $table->double("inward_trf_fee", 12, 2);
            $table->double("outward_trf_fee", 12, 2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fee_configs');
    }
};
