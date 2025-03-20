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
        Schema::create('terminals', function (Blueprint $table) {
            $table->increments("id");
            $table->string("model");
            $table->string("terminal_id");
            $table->string("serial_number");
            $table->string("sim")->nullable();
            $table->boolean("assigned")->default(0);
            $table->integer("state_head")->unsigned()->nullable();
            $table->integer("super_agent")->unsigned()->nullable();
            $table->integer("agent")->unsigned()->nullable();
            $table->enum("status", ["active", "inactive", "deactivated"])->default("inactive");
            $table->string("ip")->nullable();
            $table->string("port")->nullable();
            $table->string("notification_ip")->nullable();
            $table->timestamps();
            $table->foreign('state_head')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('super_agent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminals');
    }
};
