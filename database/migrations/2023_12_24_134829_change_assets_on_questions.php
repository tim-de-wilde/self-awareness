<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('asset_location');
        });

        Schema::create('question_assets', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->timestamps();
        });

        Schema::create('question_question_asset', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->foreignId('question_asset_id');
            $table->integer('order');
        });
    }
};
