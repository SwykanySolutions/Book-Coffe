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
        Schema::create('manga_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_manga_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('page');
            $table->string('width');
            $table->string('height');
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
        Schema::dropIfExists('manga_pages');
    }
};
