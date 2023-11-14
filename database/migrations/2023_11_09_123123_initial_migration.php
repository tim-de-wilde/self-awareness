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
        });

        Schema::table('treatment_plan', function (Blueprint $table) {
            // todo dit linkt aan answers of questionnaires.
        });

        Schema::create('psychologist_group', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->foreignId('admin_user_id')->nullable();
        });

        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
};
