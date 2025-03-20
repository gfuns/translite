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
        Schema::create('transfer_trxs', function (Blueprint $table) {
            $table->id();
            $table->integer("business_id")->unsigned();
            $table->integer("terminal_id")->unsigned();
            $table->string("reference");
            $table->string("terminal_model");
            $table->string("tid");
            $table->string("terminal_sno");
            $table->string("sender_name");
            $table->string("sender_bank");
            $table->string("sender_account");
            $table->string("receiver_name");
            $table->string("receiver_bank");
            $table->string("receiver_account");
            $table->string("description")->nullable();
            $table->double("amount", 12, 2);
            $table->double("amount_kobo", 12, 2);
            $table->double("fee", 12, 2);
            $table->double("total", 12, 2);
            $table->text("session_id")->nullable();
            $table->enum("status", ["pending", "successful", "failed", "reversed"])->default("pending");
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
        Schema::dropIfExists('transfer_trxs');
    }
};
