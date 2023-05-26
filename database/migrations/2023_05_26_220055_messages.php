<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gonderen_id');
            $table->unsignedBigInteger('alici_id');
            $table->longText('baslik');
            $table->longText('mesaj');
            $table->enum('okundu_bilgisi', [0, 1]);
            $table->timestamps();
            $table->foreign('gonderen_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alici_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');

    }
}