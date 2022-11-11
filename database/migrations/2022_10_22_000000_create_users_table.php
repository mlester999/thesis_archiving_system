<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('email_status')->default(0);
            $table->boolean('acc_status')->default(1);
            $table->integer('student_id')->unique();
            $table->string('year_level');
            $table->foreignId('department_id')->constrained('departments', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('curriculum_id')->constrained('curricula', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('password')->default(Hash::make('00000000'));
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
