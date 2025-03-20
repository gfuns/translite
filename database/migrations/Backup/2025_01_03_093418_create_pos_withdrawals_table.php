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
        Schema::create('pos_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer("business_id")->unsigned();
            $table->integer("terminal_id")->unsigned();
            $table->string("reference");
            $table->string("terminal_model");
            $table->string("tid");
            $table->string("terminal_sno");
            $table->double("amount", 12, 2);
            $table->double("fee", 12, 2);
            $table->double("total", 12, 2);
            $table->double("profit", 12, 2)->nullable();
            $table->string("bank")->nullable();
            $table->string("masked_pan")->nullable();
            $table->string("stan")->nullable();
            $table->longText("description")->nullable();
            $table->string("gateway")->nullable();
            $table->string("charge")->nullable();
            $table->longText("gateway_response")->nullable();
            $table->enum("status", ["initiated", "pending", "successful", "failed", "reversed"])->default("initiated");
            $table->integer("treated")->default(0);
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_withdrawals');
    }
};
