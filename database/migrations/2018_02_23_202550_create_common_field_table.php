<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommonFieldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('common_field', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sender_name');
			$table->string('sender_email');
			$table->string('email_subject')->nullable();;
			$table->longText('email_body')->nullable();;
			$table->string('customer_first_name');
			$table->string('customer_last_name');
			$table->string('customer_email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('common_field');
	}

}
