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
        Schema::create('escribanos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('matricula')->nullable()->unique();
            $table->string('dni')->unique();
            $table->string('cuil');
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']);
            $table->string('direccion'); // Cambio de nombre
            $table->string('telefono');
            $table->string('email')->unique();
            $table->unsignedBigInteger('condicion_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('condicion_id')->references('id')->on('conditions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escribanos');
    }
};
