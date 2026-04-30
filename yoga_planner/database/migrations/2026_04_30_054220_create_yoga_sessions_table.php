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
        Schema::create('yoga_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('goal', ['weight_loss', 'stress_relief', 'flexibility']);
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->integer('duration'); // minutes
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yoga_sessions');
    }
};
