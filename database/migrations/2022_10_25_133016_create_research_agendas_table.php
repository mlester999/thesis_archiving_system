<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('agenda_name');
            $table->string('agenda_description');
            $table->boolean('agenda_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_agendas');
    }
};
