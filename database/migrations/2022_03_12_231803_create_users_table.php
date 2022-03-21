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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->string('background_photo')->nullable();
            $table->text('about')->nullable();
            $table->boolean('banned')->default(false);
            $table->boolean('message')->default(true);
            $table->boolean('report_message')->default(true);
            $table->boolean('report_chapter')->default(true);
            $table->boolean('create_manga')->default(false);
            $table->boolean('update_manga')->default(false);
            $table->boolean('delete_manga')->default(false);
            $table->boolean('upload_manga_chapter')->default(false);
            $table->boolean('update_manga_chapter')->default(false);
            $table->boolean('delete_manga_chapter')->default(false);
            $table->boolean('create_novel')->default(false);
            $table->boolean('update_novel')->default(false);
            $table->boolean('delete_novel')->default(false);
            $table->boolean('upload_novel_chapter')->default(false);
            $table->boolean('update_novel_chapter')->default(false);
            $table->boolean('delete_novel_chapter')->default(false);
            $table->boolean('create_people')->default(false);
            $table->boolean('update_people')->default(false);
            $table->boolean('delete_people')->default(false);
            $table->boolean('create_category')->default(false);
            $table->boolean('update_category')->default(false);
            $table->boolean('delete_category')->default(false);
            $table->boolean('ban_user')->default(false);
            $table->boolean('unban_user')->default(false);
            $table->boolean('manager_permisions')->default(false);
            $table->boolean('owner')->default(false);
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
        Schema::dropIfExists('users');
    }
};
