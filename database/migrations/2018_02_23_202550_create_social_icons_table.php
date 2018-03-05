<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialIconsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_icons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('facebook', 191);
			$table->string('twitter', 191);
			$table->string('google_plus', 191);
			$table->string('linkedin', 191);
			$table->string('youtube', 191);
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
		Schema::drop('social_icons');
	}

}
