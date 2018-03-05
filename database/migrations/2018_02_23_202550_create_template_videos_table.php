<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('template_videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name', 191);
			$table->string('url', 191);
			$table->integer('template_group_id')->default(1);
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
		Schema::drop('template_videos');
	}

}
