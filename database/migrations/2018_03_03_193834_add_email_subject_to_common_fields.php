<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailSubjectToCommonFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('common_field', function (Blueprint $table) {
            $table->string('email_subject')->nullable()->default(null)->after('sender_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('common_field', function (Blueprint $table) {
            $table->dropColumn('email_subject');
        });
    }
}
