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
        Schema::create('utility_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->string('service');
            $table->string('biller');
            $table->string('recipient');
            $table->text('recipient_address')->nullable();
            $table->string('amount');
            $table->string('reference');
            $table->string('irc_reference');
            $table->string('subscription_plan')->nullable();
            $table->string('recharge_token')->nullable();
            $table->string('units')->nullable();
            $table->string('generated_hash');
            $table->string('access_token')->nullable();
            $table->enum('status', ["pending", "successful", "failed"]);
            $table->boolean('bankone_debit_status')->default(false);
            $table->string('bankone_debit_reference')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_transactions');
    }
};
