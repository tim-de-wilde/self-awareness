<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->text('description')
                ->nullable();
            $table->string('role');

            $table->string('gender')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
        });

        Schema::create('treatment_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('parent_id');
            $table->foreignId('psychologist_id');
            $table->timestamps();
        });

        Schema::create('psychologist_group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('admin_id')
                ->comment('This is a user ID')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('psychologist_psychologist_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('psychologist_group_id');
        });

        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')
                ->comment('Created by ( is a psychologist )');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('asset_location');
            $table->timestamps();
        });

        Schema::create('question_questionnaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->foreignId('questionnaire_id');
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->foreignId('user_id')
                ->comment('Submitted by this user');
            $table->foreignId('questionnaire_id');
            $table->foreignId('question_id');
            $table->foreignId('treatment_plan_id');
        });
    }
};
