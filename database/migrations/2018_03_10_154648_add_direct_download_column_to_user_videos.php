<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectDownloadColumnToUserVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_videos', function (Blueprint $table) {
            $table->boolean('direct_download')->default(0)->after('project_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_videos', function (Blueprint $table) {
            $table->dropColumn('direct_download');
        });
    }
}
