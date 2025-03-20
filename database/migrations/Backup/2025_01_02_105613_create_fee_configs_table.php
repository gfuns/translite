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
        Schema::create('fee_configs', function (Blueprint $table) {
            $table->increments("id");
            $table->enum("trans_type", ["transfer", "withdrawal", "utilities"]);
            $table->enum("category", ["inward", "outward", "pos", "airtime", "data", "power", "tv"]);
            $table->double("fee_amount", 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_configs');
    }
};
