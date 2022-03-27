<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255);
            $table->char('isbn', 255);
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('pov_character_id');
            $table->integer('numberOfPages')->default(0);
            $table->char('publisher', 255);
            $table->char('country', 255);
            $table->char('mediaType', 255);
            $table->json('authors')->nullable();
            $table->timestamp('released');
            $table->timestamps();
            /**
             * Foreign keys
             */
            $table->foreign('character_id')->references('id')->on('characters')->restrictOnDelete();
            $table->foreign('pov_character_id')->references('id')->on('characters')->restrictOnDelete();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
