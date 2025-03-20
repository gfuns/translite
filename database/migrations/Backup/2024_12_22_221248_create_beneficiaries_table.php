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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("business_id")->unsigned();
            $table->enum("service", ["airtime/data", "power", "tv", "transfer"]);
            $table->string("provider");
            $table->string("logo")->nullable();
            $table->string("beneficiary");
            $table->string("recipient")->nullable();
            $table->enum("category", ["transfer", "bills", "airtime/data"]);
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
        Schema::dropIfExists('beneficiaries');
    }
};
