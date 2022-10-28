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
            $table->string('archive_code');
            $table->foreignId('user_id')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('curriculum_id')->constrained('curricula', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->year('year');
            $table->text('title');
            $table->text('abstract');
            $table->text('members');
            $table->text('banner_path');
            $table->text('document_path');
            $table->text('document_name');
            $table->boolean('status')->default(0);
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
