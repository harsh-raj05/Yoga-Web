<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('meditation_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['stress_relief', 'focus', 'sleep']);
            $table->integer('duration');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meditation_sessions');
    }
};
