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
        Schema::create('end_of_years', function (Blueprint $table) {
            $table->id();
            $table->string("year");
            $table->double("airtime", 12, 2);
            $table->double("airtime_fees", 12, 2);
            $table->double("data", 12, 2);
            $table->double("data_fees", 12, 2);
            $table->double("electricity", 12, 2);
            $table->double("electricity_fees", 12, 2);
            $table->double("tv", 12, 2);
            $table->double("tv_fees", 12, 2);
            $table->double("total_utilities", 12, 2);
            $table->double("utility_fees", 12, 2);
            $table->double("pos_withdrawals", 12, 2);
            $table->double("withdrawal_fees", 12, 2);
            $table->double("inward_transfer", 12, 2);
            $table->double("inward_fees", 12, 2);
            $table->double("outward_transfer", 12, 2);
            $table->double("outward_fees", 12, 2);
            $table->double("total_transfers", 12, 2);
            $table->double("transfer_fees", 12, 2);
            $table->double("total_transactions", 12, 2);
            $table->double("total_fees", 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_of_years');
    }
};
