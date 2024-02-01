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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->unsignedInteger('day');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year')->nullable();
            $table->boolean('is_recurrent')->default(false);
            $table->date('start_date')->nullable(); // Agregar nueva columna start_date
            $table->date('end_date')->nullable();   // Agregar nueva columna end_date
            
            // Cambiar el tipo de dato de la columna user_id a bigInteger
            $table->unsignedBigInteger('user_id'); 
    
            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    
        // Calcula las fechas de inicio y fin y actualiza las columnas start_date y end_date
        DB::statement("
            UPDATE holidays 
            SET start_date = CONCAT(year, '-', LPAD(month, 2, '0'), '-', LPAD(day, 2, '0')),
                end_date = CONCAT(year, '-', LPAD(month, 2, '0'), '-', LPAD(day, 2, '0'))
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
