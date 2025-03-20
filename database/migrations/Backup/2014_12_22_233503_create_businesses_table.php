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
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('businessName');
            $table->string('businessAddress');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('terminal_id')->unsigned()->nullable();
            $table->string('agentId')->unique();
            $table->string('agentFirstName');
            $table->string('agentLastName');
            $table->string('agentOtherNames')->nullable();
            $table->string('agentPhoneNumber')->nullable();
            $table->enum("gender", ["male", "female"])->nullable();
            $table->string("bvn")->nullable();
            $table->string("dob")->nullable();
            $table->string('accountOfficerCode');
            $table->string('productCode');
            $table->string('accountNumber');
            $table->string('bankOneAccountNumber');
            $table->string('customerId');
            $table->string('bankName')->default("Peace MFB");
            $table->string('bankId');
            $table->string('pin')->nullable();
            $table->boolean('isLoggedInBefore')->default(false);
            $table->boolean('isDefaultPasswordChanged')->default(false);
            $table->boolean('isPinCreated')->default(false);
            $table->enum('status', ["active", "suspended", "banned"])->default("active");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
