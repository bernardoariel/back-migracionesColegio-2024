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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre
            $table->string('cuil'); // CUIL
            $table->string('email')->unique(); // Correo electrónico
            $table->boolean('active')->default(false); // Activo
            $table->enum('privilege', ['basic', 'intermediate', 'advanced'])->default('basic'); // Privilegio con valor por defecto 'basic'
            $table->unsignedBigInteger('user_id'); // Relación con usuarios

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users'); // Clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
