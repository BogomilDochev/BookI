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
        Schema::create('old_slugs', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('slug')->index();
            $table->unsignedInteger('book_id')->index();
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
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
        Schema::dropIfExists('old_slugs');
    }
};
