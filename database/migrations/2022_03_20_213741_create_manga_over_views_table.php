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
        Schema::create('manga_over_views', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('background_photo')->nullable();
            $table->string('name')->unique();
            $table->string('synopsis')->nullable();
            $table->integer('format')->nullable();
            $table->integer('status')->nullable();
            $table->integer('views')->default(0);
            $table->double('score')->default(0);
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
        Schema::dropIfExists('manga_over_views');
    }
};
