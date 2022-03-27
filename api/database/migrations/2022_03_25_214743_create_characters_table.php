<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255);
            $table->char('gender', 255);
            $table->char('culture', 255);
            $table->char('born', 255);
            $table->char('died', 255)->nullable();
            $table->json('titles');
            $table->json('aliases');
            $table->char('father', 255)->nullable();
            $table->char('mother', 255)->nullable();
            $table->char('spouse', 255)->nullable();
            $table->json('allegiances')->nullable();
            $table->json('books')->nullable();
            $table->json('povBooks')->nullable();
            $table->json('tvSeries')->nullable();
            $table->json('playedBy')->nullable();
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
        Schema::dropIfExists('characters');
    }
}
