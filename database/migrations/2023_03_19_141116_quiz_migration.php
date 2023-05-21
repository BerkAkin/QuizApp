<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('slug');
            $table->timestamp('finished_at')->nullable();
            $table->enum('status', ['published', 'draft', 'passive'])->default('draft');
            $table->string('sahip')->default('');
            $table->integer('counter')->default(60);
            $table->integer('kisi_sayisi')->default(80);
            $table->integer('gereken_min_not')->default(60);
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
        Schema::dropIfExists('quizzes');
    }
}