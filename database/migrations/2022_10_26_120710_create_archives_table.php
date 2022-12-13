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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->integer('archive_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained('departments', 'id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('curriculum_id')->nullable()->constrained('curricula', 'id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('research_agenda_id')->nullable()->constrained('research_agendas', 'id')->onUpdate('cascade')->onDelete('set null');
            $table->year('year');
            $table->text('title');
            $table->text('abstract');
            $table->text('members');
            $table->text('document_path');
            $table->string('document_name');
            $table->text('imrad_path');
            $table->string('imrad_name');
            $table->text('signature_path');
            $table->string('signature_name');
            $table->boolean('archive_status')->default(0);
            $table->string('admin_comment')->nullable();
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
        Schema::dropIfExists('archives');
    }
};
