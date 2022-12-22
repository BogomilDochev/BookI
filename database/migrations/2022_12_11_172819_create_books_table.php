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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('author');
            $table->string('publisher');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('cover')->nullable();
            $table->text('description');
            $table->decimal('price',6,2);
            $table->date('date');
            $table->integer('pages');
            $table->string('dimensions');
            $table->string('languages');
            $table->string('type');
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
        Schema::dropIfExists('books');
    }
};
