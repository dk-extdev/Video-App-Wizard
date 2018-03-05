<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplateFieldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('template_field', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('template_group_id');
			$table->string('title');
			$table->string('html_label')->nullable()->default(null);
			$table->string('type');
			$table->integer('mandatory')->default(0);
			$table->string('validation_rules');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('template_field');
	}

}
