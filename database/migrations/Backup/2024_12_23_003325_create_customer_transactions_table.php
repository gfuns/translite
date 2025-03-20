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
        Schema::create('customer_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("business_id")->unsigned();
            $table->string("reference");
            $table->enum("service", ['airtime', 'data', 'power', 'tv', 'transfer', 'withdrawal']);
            $table->enum("category", ['airtime', 'data', 'power', 'tv', 'inward', 'outward', 'pos']);
            $table->longText("transaction");
            $table->double("amount", 12, 2);
            $table->double("trx_fee", 12, 2);
            $table->enum("status", ["pending", "successful", "failed"]);
            $table->enum("classification", ["inward", "outward", "bills"]);
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
        Schema::dropIfExists('customer_transactions');
    }
};
