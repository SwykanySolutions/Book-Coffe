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
        Schema::table('manga_over_views', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->constrained()->cascadeOnDelete()->after('id');
            $table->foreignId('format_id')->nullable()->constrained()->cascadeOnDelete()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manga_over_views', function (Blueprint $table) {
            $table->dropColumn('status_id');
            $table->dropColumn('format_id');
        });
    }
};
