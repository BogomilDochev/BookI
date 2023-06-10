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
        Schema::create('coupons', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type');
            $table->unsignedSmallInteger('value')->nullable();
            $table->unsignedSmallInteger('percent_off')->nullable();
            $table->unsignedInteger('times_used')->default(0);
            $table->date('valid_from');
            $table->date('valid_until');
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
        Schema::dropIfExists('coupons');
    }
};
