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
            $table->integerIncrements('id');
            $table->unsignedInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->string('author');
            $table->string('publisher');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('cover')->nullable();
            $table->text('description');
            $table->unsignedDecimal('price',6,2);
            $table->unsignedSmallInteger('in_stock_quantity')->default(10);
            $table->date('date');
            $table->unsignedSmallInteger('pages');
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
