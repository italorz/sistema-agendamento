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
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id_agenda');
            $table->date('data');
            $table->integer('id_hora');
            $table->integer('id_servico');
            $table->string('descricao');
            $table->integer('id_usuario');
            $table->char('ativo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_agenda');
    }
};
