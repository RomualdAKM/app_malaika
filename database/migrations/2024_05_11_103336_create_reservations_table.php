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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained();
            $table->integer('rooms');
            $table->integer('person');
            $table->bigInteger('price');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'rejected', 'finished']);
            $table->timestamps();
            $table->index(['structure_id', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
