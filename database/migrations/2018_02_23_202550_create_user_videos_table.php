<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_videos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('project_id');
			$table->string('project_title');
			$table->string('video_url', 191)->default('');
			$table->integer('user_id');
			$table->integer('common_field_id');
			$table->integer('template_video_id');
			$table->string('status');
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
		Schema::drop('user_videos');
	}

}
