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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto', 8, 2, true);
            $table->string('numero_comprobante', 255);
            $table->decimal('total', 8, 2)->unsigned();
            $table->tinyInteger('estado')->default(1);
            $table
                ->foreignId('comprobante_id')
                ->nullable()
                ->constrained('comprobantes')
                ->onDelete('SET NULL');
            $table
                ->foreignId('proveedore_id')
                ->nullable()
                ->constrained('proveedores')
                ->onDelete('SET NULL');

            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
