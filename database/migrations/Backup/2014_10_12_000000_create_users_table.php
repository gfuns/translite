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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string('lastName');
            $table->string('firstName');
            $table->string('otherNames')->nullable();
            $table->string('email')->unique();
            $table->string('phoneNumber')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ["admin", "customer"])->default("customer");
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('account_type_id')->unsigned()->nullable()->default(1);
            $table->enum('status', ["active", "suspended"])->default("active");
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->foreign('account_type_id')->references('id')->on('account_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
