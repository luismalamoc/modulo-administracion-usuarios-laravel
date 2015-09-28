<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->bigIncrements('id')->unsigned();
			$table->string('username', 16)->unique();
			$table->string('email', 100)->unique();
			$table->string('password', 64);			
			$table->string('name', 50);
			$table->string('lastname', 50);
			//$table->date('birthday');
			//$table->tinyInteger('status');
			$table->string('remember_token')->nullable();
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
		Schema::drop('users');
	}

}
